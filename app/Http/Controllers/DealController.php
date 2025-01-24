<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class DealController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function select_deals($type="")
    {   
        $user = Auth::user();
        if($type == "avenant" || $type=="engagement"){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN (SELECT DISTINCT id_op from deals WHERE deals.user_id =".$user->id." )";
            $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals WHERE deals.user_id =".$user->id." )";
        }
        if($this->ville_fr =="Medea"){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN (SELECT DISTINCT id_op from deals )";
            $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals )";
        }
        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = 'deals.select_deals';
        if($this->lang == "fr"){
            $view = "deals.select_deals_fr";
        }

        return view($view,["user"=>$user,"type"=>$type,"operations"=>$operations,"es"=>$es]);
    }
    public function deals($type="")
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN (SELECT DISTINCT id_op from deals)";
        $q = "SELECT * FROM entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals)";
        if($type == "" && $this->ville_fr != "Medea"){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN (SELECT DISTINCT id_op from deals WHERE deals.user_id =".$user->id." )";
            $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals WHERE deals.user_id =".$user->id." )";
        }
        
        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = "deals.deals";
        if($this->lang == "fr"){
            $view = "deals.deals_fr";
        }

        return view($view,["user"=>$user,"type"=>$type,"operations"=>$operations,"es"=>$es]);
    }

    public function get_deals($filters=""){
        $user = Auth::user();

        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = $filters[0];
            $e = $filters[1];
            if(isset($filters[2]) && $this->ville_fr != "Medea"){
                $user_id = $filters[2];
            }else{
                $user_id = "";
            }
            if(isset($filters[3])){
                $type = $filters[3];
            }else{
                $type = "";
            }
            

            $query = "SELECT *,engagements.id as id_eng, d.id_deal as deal_id, d.montant as montant ,d.user_id as user_id FROM deals d 
            INNER JOIN operations ON d.id_op = operations.id 
            LEFT JOIN entreprises ON d.entreprise = entreprises.id 
            LEFT JOIN engagements ON d.id_deal = engagements.deal WHERE ";
            

            if($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND";
            }
            if($e != ""){
                $query = $query." d.entreprise ='".$e."' AND";
            }
            if($user_id != ""){
                $query = $query." d.user_id ='".$user_id."' AND";
            }
            if($type == "avenant"){
                $query = $query." ( ( d.deal_type ='صفقة' OR d.deal_type ='عقد' ) OR 
                (d.deal_type ='marche' OR d.deal_type ='convention' ) ) AND ";
            }
            
            $query= $query." 1 GROUP BY deal_id ORDER BY deal_id DESC LIMIT 100";
          

            return DB::select( DB::raw($query));
        }else{
            $query = "SELECT *, d.id_deal as deal_id, d.montant as montant, d.user_id as user_id FROM deals d 
            INNER JOIN operations ON d.id_op = operations.id 
            LEFT JOIN entreprises ON d.entreprise = entreprises.id 
            LEFT JOIN engagements ON d.id_deal = engagements.deal WHERE ";
            $query= $query." 1 GROUP BY deal_id ORDER BY deal_id DESC LIMIT 100";
            return DB::select( DB::raw($query));
        }
    }
    public function modifier($id){
        $user = Auth::user();
        $chapitre = $user->chapitre;

        $entreprises = DB::table('entreprises')->select('id','name')->get();
        for($i =0; $i< count($entreprises); $i++){
            $bank = DB::table('banks')->where('entreprise',$entreprises[$i]->id)
            ->orderBy('id',"ASC")->first();
            if(!empty($bank)){
                $entreprises[$i]->bank_acc = $bank->bank_acc;
                $entreprises[$i]->bank = $bank->bank;
                $entreprises[$i]->bank_user = $bank->bank_user;
                $entreprises[$i]->bank_agc = $bank->bank_agc;
            }else{
                $entreprises[$i]->bank_acc = null;
                $entreprises[$i]->bank = null;
                $entreprises[$i]->bank_user = null;
                $entreprises[$i]->bank_agc = null;
            }
        }
        $banques = DB::table('banques')->get();

        $deal = DB::table('deals')->
        join("operations",'deals.id_op','=','operations.id')
        ->where('id_deal',$id)->first();
        $bank = DB::table('banks')->where('id',$deal->bank)->first();
        $e = DB::table('entreprises')->where('id',$deal->entreprise)->first();
        $view = 'deals.modifier_deal';
        if($this->lang =="fr"){
            $view = 'deals.modifier_deal_fr';
        }
        return view($view,['user'=>$user,"deal"=>$deal,"bank"=>$bank,
        "entreprises"=>$entreprises,"banques"=>$banques,"id"=>$id,"e"=>$e]);
    }
    public function ajouter_avenant($id){
        $user = Auth::user();
        $chapitre = $user->chapitre;
        $deal = DB::table('deals')->
        join("operations",'deals.id_op','=','operations.id')
        ->where('id_deal',$id)->first();
        $banques = DB::table('banques')->get();
        $bank = DB::table('banks')->where('id',$deal->bank)->first();
        $e = DB::table('entreprises')->where('id',$deal->entreprise)->first();
        
        $view = 'deals.ajouter_avenant';
        if($this->lang =="fr"){
            $view = 'deals.ajouter_avenant_fr';
        }

        return view($view,['user'=>$user,"deal"=>$deal,
        "id"=>$id,"e"=>$e,"bank"=>$bank,"banques"=>$banques]);
    }
    public function ajouter($type,$number=1){
        $user = Auth::user();
        #$chapitre = explode(",",$user->chapitre);
        $chapitre = explode(",",$user->chapitre);
        
        if($this->ville_fr !=="never" && $this->ville_fr !=="Medea" ){
            $operations = DB::table('operations')->
            select('id','numero','intitule_ar','intitule')->
            where('user_id',$user->id)->
            whereNull("date_cloture")->orderBy('id','DESC')->get();
        }else {
            $operations = DB::table('operations')->
            select('id','numero','intitule_ar','intitule')->
            whereNull("date_cloture")->orderBy('id','DESC')->get();
        }
        $entreprises = DB::table('entreprises')->select('id','name')->get();
        for($i =0; $i< count($entreprises); $i++){
            $bank = DB::table('banks')->where('entreprise',$entreprises[$i]->id)
            ->orderBy('id',"ASC")->first();
            if(!empty($bank)){
                $entreprises[$i]->bank_acc = $bank->bank_acc;
                $entreprises[$i]->bank = $bank->bank;
                $entreprises[$i]->bank_user = $bank->bank_user;
                $entreprises[$i]->bank_agc = $bank->bank_agc;
            }else{
                $entreprises[$i]->bank_acc = null;
                $entreprises[$i]->bank = null;
                $entreprises[$i]->bank_user = null;
                $entreprises[$i]->bank_agc = null;
            }
        }
        $banques = DB::table('banques')->get();

        if($type == "marche"){
            $type_ar = "صفقة";
        }
                     
        elseif($type =="convention"){
            $type_ar = "عقد";
        }
                       
        elseif($type =="devis"){
            $type_ar ="كشف كمي و تقديري ";
        }
                      
        elseif($type =="facture"){
            $type_ar = "فاتورة";
        }

        $view = 'deals.ajouter_deal';
        if($this->lang =="fr"){
            $view = 'deals.ajouter_deal_fr';
        }

        return view($view,
        ['user'=>$user,"type"=>$type,'operations'=>$operations,"type_ar"=>$type_ar,
        "entreprises"=>$entreprises,"banques"=>$banques,"number"=>$number]);
    }
    public function check_deal($deal_num,$deal_date){
        return DB::table('deals')->where("deal_num",$deal_num)->
        where("deal_date",$deal_date)->count();
    }
    public function add_deal(Request $request){
        $user_id = $user = Auth::user()->id;
        $id_op = $request['id_op'];
        $deal_type = $request['type_ar'];
        $deal_num = $request['deal_num'];
        $deal_date = $request['deal_date'];
        // $check = $this->check_deal($deal_num,$deal_date);
        // if($check > 0){
        //     return redirect("/redirect/رقم الصفقة مكرر !/error/ajouter_deal");
        // }

        $lot = $request['lot'];
        
        $montant = $request['montant'];
        $type = $request['type'];
        $entreprise = $request['entreprise_id'];
        $bank_acc = $request['bank_acc'];
        $bank = $request['bank'];
        $bank_user = $request['bank_user'];
        $bank_agc = $request['bank_agc'];
        $bank = DB::table('banks')->insertGetId(["entreprise"=>$entreprise,'bank_acc'=>$bank_acc,'bank'=>$bank,"bank_user"=>$bank_user,"bank_agc"=>$bank_agc]);
        
        if($type =="facture" || $type =="devis"){
            $duree = null;
        }else{
            $duree = $request['duree'];
        }
        $taux = 0; 
        if(isset($request['parent'])){
            $parent = $request['parent'];
        }else{
            $parent = null;
        }
        

        $inserted_at = Date('Y-m-d');
        $updated_at = null;
        $observations = "";
        
        $id = DB::table('deals')->
        insertGetId(["id_op"=>$id_op,"deal_type"=>$deal_type,
        "deal_num"=>$deal_num,'deal_date'=>$deal_date,'lot'=>$lot,
        'parent'=>$parent,'montant'=>$montant,'entreprise'=>$entreprise,
        'bank'=>$bank,'duree'=>$duree,'taux'=>$taux,
        'inserted_at'=>$inserted_at,"observations"=>$observations,
        'updated_at'=>$updated_at,"user_id"=>$user_id]);

        if(isset($request['signed']) && isset($request['visa_cmw']) && isset($request['num_cmw'] )){
            $signed = $request['signed'];
            $visa_cmw = $request['visa_cmw'];
            $num_cmw = $request['num_cmw'];
            DB::table('deals')->where('id_deal',$id)->
            update(["signed"=>$signed,'visa_cmw'=>$visa_cmw,'num_cmw'=>$num_cmw]);
        }
        return Redirect::to('/deals/all');
    }
    public function add_avenant(Request $request){
        $user_id = $user = Auth::user()->id;
        $id_op = $request['id_op'];
        $deal_type = $request['type_ar'];
        $deal_num = $request['deal_num'];
        $deal_date = $request['deal_date'];
        $lot = $request['lot'];
        $parent = null;
        $montant = $request['montant'];
        $type = $request['type'];
        
        $entreprise = $request['entreprise_id'];
        $bank_acc = $request['bank_acc'];
        $bank = $request['bank'];
        $bank_user = $request['bank_user'];
        $bank_agc = $request['bank_agc'];
        $bank = DB::table('banks')->insertGetId(["entreprise"=>$entreprise,'bank_acc'=>$bank_acc,'bank'=>$bank,"bank_user"=>$bank_user,"bank_agc"=>$bank_agc]);
        
        if($type =="facture" || $type =="devis"){
            $duree = null;
        }else{
            $duree = $request['duree'];
        }
        $taux = 0; 

        $inserted_at = Date('Y-m-d');
        $updated_at = null;
        $observations = "";
        $id = DB::table('deals')->
        insertGetId(["id_op"=>$id_op,"deal_type"=>$deal_type,
        "deal_num"=>$deal_num,'deal_date'=>$deal_date,'lot'=>$lot,
        'parent'=>$parent,'montant'=>$montant,'entreprise'=>$entreprise,
        'bank'=>$bank,'duree'=>$duree,'taux'=>$taux,
        'inserted_at'=>$inserted_at,"observations"=>$observations,
        'updated_at'=>$updated_at,"user_id"=>$user_id]);
        return Redirect::to('/deals/all');
    }
    public function update_deal(Request $request){
        $id = $request['id_deal'];
        $deal_num = $request['deal_num'];
        $deal_date = $request['deal_date'];
        $lot = $request['lot'];
        if(isset($request['parent'])){
            $parent = $request['parent'];
        }else{
            $parent = null;
        }
        $montant = $request['montant'];

        if(isset($request['duree'])) {
            $duree = $request['duree'];
        }else{
            $duree = 0;
        }
        if(isset($request['taux'])) {
            $taux = $request['taux'];
        }else{
            $taux = 0; 
        }
        if(isset($request['observations'])) {
            $observations = $request['observations'];
        }else{
            $observations = "";
        }
        $bank_acc = $request['bank_acc'];
        $bank = $request['bank'];
        $bank_user = $request['bank_user'];
        $bank_agc = $request['bank_agc'];
        $entreprise = $request['entreprise_id'];
        $bank_id = $request['bank_id'];
        DB::table('banks')->where('id',$bank_id)->
        update(["entreprise"=>$entreprise,'bank_acc'=>$bank_acc,
        'bank'=>$bank,"bank_user"=>$bank_user,"bank_agc"=>$bank_agc]);
    

        $updated_at = Date('Y-m-d');

        DB::table('deals')->where('id_deal',$id)->
        update(["deal_num"=>$deal_num,'deal_date'=>$deal_date,'lot'=>$lot,
        'parent'=>$parent,'montant'=>$montant,'entreprise'=>$entreprise,
        'duree'=>$duree,'taux'=>$taux,'updated_at'=>$updated_at,
        "observations"=>$observations]);
         
        if(isset($request['signed']) && isset($request['visa_cmw']) && isset($request['num_cmw'] )){
            $signed = $request['signed'];
            $visa_cmw = $request['visa_cmw'];
            $num_cmw = $request['num_cmw'];
            DB::table('deals')->where('id_deal',$id)->
            update(["signed"=>$signed,'visa_cmw'=>$visa_cmw,'num_cmw'=>$num_cmw]);
        }

        return Redirect::to('/deals/all');
    }
    public function delete($id)
    {   
        DB::table('deals')->where('id_deal',$id)->delete();
        return Redirect::to('/deals/all');    
    }
}
