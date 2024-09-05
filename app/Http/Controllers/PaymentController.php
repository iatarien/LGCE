<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class PaymentController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function select($type,$n=1)
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
        (SELECT DISTINCT id_op from engagements ";
        if($user->service !="Paiement"){
            $query = $query." WHERE engagements.user_id =".$user->id." )";
        }else{
            $query = $query." )";
        }
        $query = $query." ORDER BY id DESC";
        $operations = DB::select( DB::raw($query));
        $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals ";
        if($user->service !="Paiement"){
            $q = $q." WHERE deals.user_id =".$user->id." )";
        }else{
            $q = $q.")";
        }

        $es = DB::select( DB::raw($q));
        $view = 'comptabilite.select';
        
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,
        "operations"=>$operations,"type"=>$type,'es'=>$es,"n"=>$n]);
    }
    public function ajouter($id_eng,$n=1)
    {    
        $user = Auth::user();
        $view = 'pays.ajouter_pay';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,'id_eng'=>$id_eng,"n"=>$n]);
    }
    public function index($type=""){
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN
         (SELECT DISTINCT id_op from engagements where id IN 
         (SELECT id_eng from payments) )";
        $q = "SELECT * from entreprises WHERE id IN 
        (SELECT DISTINCT entreprise FROM deals WHERE id_deal IN 
        (SELECT deal FROM engagements WHERE id IN 
        (SELECT id_eng from payments) ))";
        if($type == ""){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
            (SELECT DISTINCT id_op from engagements where id IN 
            (SELECT id_eng from payments WHERE user_id = ".$user->id.") )";
            $q = "SELECT * from entreprises WHERE id IN 
            (SELECT DISTINCT entreprise FROM deals WHERE id_deal IN 
            (SELECT deal FROM engagements WHERE id IN 
            (SELECT id_eng from payments WHERE user_id = ".$user->id.") ))";
        }

        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = 'pays.payments';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"type"=>$type,
        "operations"=>$operations,'es'=>$es]);
    }
    public function pays($filters=""){
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, 
        payments.num_visa as p_num_visa from `payments` left join `engagements` 
        on `engagements`.`id` = `payments`.`id_eng` inner join deals ON 
        engagements.deal = deals.id_deal INNER JOIN `entreprises` on 
        `deals`.`entreprise` = `entreprises`.`id` inner join `operations`
         on `engagements`.`id_op` = `operations`.`id` ";
        if($user->service !="Comptabilité" && $user->service !="Paiement"){
            $query = $query." WHERE payments.visa IS NOT NULL ";
        }else{
            $query = $query." WHERE 1 ";
        }
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $year = $filters[2];
            $user_id = $filters[3];
            $user_id = "";
            if(isset($filters[3])){
                $user_id = $filters[3];
            }
            
            if($numero !=""){
                $query = $query."AND operations.numero= '".$numero."'";
            }
            if($e !=""){
                $query = $query." AND deals.entreprise= ".$e;
            }
            if($year !=""){
                $query = $query." AND payments.visa <= '".$year."-12-31' 
                AND payments.visa >= '".$year."-01-01' ";
            }
            if($user_id !="" && $user->service !="Paiement"){
                $query = $query." AND payments.user_id= ".$user_id;
            }
            
        }
        $query = $query." ORDER BY p_id DESC LIMIT 50";
        //$pays = DB::table('payments')->leftjoin("engagements","engagements.id","=","payments.id_eng")->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('operations','engagements.id_op','=','operations.id')->toSql();
        //return $query;
        return DB::select( DB::raw($query));
    }
    public function get_pay($id)
    {   
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, 
        payments.num_visa as p_num_visa from `payments` left join 
        `engagements` on `engagements`.`id` = `payments`.`id_eng` 
        LEFT JOIN deals on deals.id_deal = engagements.deal
        inner join `entreprises` on `deals`.`entreprise` = `entreprises`.`id` 
        inner join `operations` on `engagements`.`id_op` = `operations`.`id` 
        WHERE payments.id =".$id;


        return DB::select( DB::raw($query));
    }
    
    public function edit_bank($id)
    {   
        
        $user = Auth::user();
        $id_eng = DB::table("payments")->where('id',$id)->select('id_eng')->first();
        $eng = DB::table('engagements')->where("id",$id_eng->id_eng)->select('deal')->first();
        $deal = DB::table('deals')->where("id_deal",$eng->deal)->select('bank',"entreprise")->first();
        $e = DB::table('entreprises')->where('id',$deal->entreprise)->first();
        $bank = DB::table('banks')->where('id',$deal->bank)->first();
        $banques = DB::table('banques')->get();

        $view = 'comptabilite.edit_bank';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,['id'=>$id,
        'user'=>$user,"e"=>$e,"bank"=>$bank,'banques'=>$banques,"id_deal"=>$eng->deal]);

    }
    public function update_bank(Request $request)
    {   
        $bank_acc = $request['bank_acc'];
        $bank = $request['bank'];
        $bank_user = $request['bank_user'];
        $bank_agc = $request['bank_agc'];
        $bank_id = $request['bank_id'];
        $id = $request['id'];
        DB::table('banks')->where('id',$bank_id)->update(['bank_acc'=>$bank_acc,'bank'=>$bank,"bank_user"=>$bank_user,"bank_agc"=>$bank_agc]);
        return Redirect::to('/fiche_pay/'.$id);
    }
    public function fiche_pay($id)
    {   
        $user = Auth::user();
        $visa = DB::table('payments')->select('visa')->where('id',$id)->first()->visa;
        $editor = DB::table('payments')->select('user_id')->where('id',$id)->first()->user_id;
        $q = "SELECT op from reb_pay where id = (SELECT rebrique from payments WHERE id =".$id.")";
        $op_id = DB::select(DB::raw($q))[0]->op;
        $op = DB::table('operations')->select('numero')->where('id',$op_id)->first()->numero;
        $view = 'pays.fiche_pay';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,['id'=>$id,'user'=>$user,"editor"=>$editor,"visa"=>$visa,"op"=>$op]);

    }
    
    public function pays_bord($filters=""){
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, 
        payments.num_visa as p_num_visa from `payments` left join `engagements` 
        on `engagements`.`id` = `payments`.`id_eng` inner join deals on deals.id_deal = engagements.deal
        inner join `entreprises` on `deals`.`entreprise` = `entreprises`.`id`
        inner join `operations` on `engagements`.`id_op` = `operations`.`id` ";
        $query = $query." WHERE payments.visa IS NULL ";

        if($filters != ""){
            $filters = explode("*1989*",$filters);

            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $user_id ="";
            if(isset($filters[4])){
                $user_id = $filters[4];
            }
            
            

            if($numero !=""){
                $query = $query."AND operations.numero= '".$numero."'";
            }
            if($e !=""){
                $query = $query." AND engagements.entreprise_id= ".$e;
            }
            if($user_id !=""){
                $query = $query." AND payments.user_id= ".$user_id;
            }
            
        }
        $query = $query." ORDER BY p_id DESC LIMIT 50";
        //$pays = DB::table('payments')->leftjoin("engagements","engagements.id","=","payments.id_eng")->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('operations','engagements.id_op','=','operations.id')->toSql();
        //echo $query;
        return DB::select( DB::raw($query));
    }
    public function mondat($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->join('engagements','payments.id_eng',"=","engagements.id")->where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank_id)->first();
        $op = DB::table('operations')->where('id',$pay->id_op)->select('numero','intitule','intitule_ar','chapitre','source',"secteur")->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise_id)->first();
        $nums = Null;
        
        $view ="comptabilite.mondat";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,'pay'=>$pay,'op'=>$op,'e'=>$e,'bank'=>$bank,"id"=>$id,"nums"=>$nums]);

    }
    public function mondat1($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->
        join("portefeuille","portefeuille.code","=","operations.portefeuille")->
        where('id',$pay->id_op)->first();
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        if($prog == NULL){
            $prog = (object) [];
            $prog->code = "";
            $prog->designation = "";   
        }
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $nums = Null;
        $qq = "SELECT * FROM titres WHERE id_titre = (SELECT sous_titre FROM rebriques WHERE id_eng = ".$pay->id_eng." 
        AND ( sous_montant != 0 OR sous_montant_1 != 0) LIMIT 1)";
 
        $sous_titre = NULL;
        if(isset(DB::select(DB::raw($qq))[0])){
            $sous_titre = DB::select(DB::raw($qq))[0];
        }
        $titre = NULL;
        if(isset($sous_titre->father)){
            $titre = DB::table("titres")->where("id_titre",$sous_titre->father)->first();
        }
        
        
        $view ='pays.mondat1';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        if($this->ville_fr =="Mila" || $this->ville_fr =="Touggourt"){
            $view = $view."_mila";
        }

        $txt = " ";
        if($pay->travaux_type != "فاتورة  " && $pay->travaux_num != null){
            $txt = $txt.$pay->travaux_type." رقم ".$pay->travaux_num." بتاريخ ".$pay->date_pay;
        }
        $txt = $txt."\n حصة : ".$pay->lot."\n ".$e->name;
        $txt1 = " تسوية ";
        if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
            $txt1 = $txt1.$pay->travaux_type." رقم ".$pay->travaux_num." لل".$pay->deal_type." رقم ".$pay->deal_num." بتاريخ ".$pay->date_pay;
            
        }
        $txt1 = $txt1." المقدمة من طرف ".$e->name;
        $txt1 = $txt1."   لمشروع ".$pay->lot;
        return view($view,["user"=>$user,'pay'=>$pay,'op'=>$op,'e'=>$e,'bank'=>$bank,"sous_titre"=>$sous_titre,
        "titre"=>$titre,'txt'=>$txt,'txt1'=>$txt1,
        "id"=>$id,"nums"=>$nums,"prog"=>$prog,"sous_prog"=>$sous_prog]);

    }
    public function attestation($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->where('id',$pay->id_op)->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $total = $pay->total_done - $pay->total_cut;

        if($pay->type != "FSDRS"){
            $matieres = explode('.',$op->numero);
            if (strlen($matieres[0]) > 2){
                $matiere = $matieres[2];
            }else{
                $matiere = $matieres[3];
            }
        }else{
            $matiere = "";
        }
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        if($prog == NULL){
            $prog = (object) [];
            $prog->code = "";
            $prog->designation = "";   
        }

        $view ='pays.attestation_payement';
        if($this->ville_fr =="Medea"){
            $view = $view."_medea";
        }
        if($this->ville_fr =="Mila"){
            $view = $view."_mila";
        }
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
     
        return view($view,["user"=>$user,'pay'=>$pay,'op'=>$op,'e'=>$e,'bank'=>$bank,"prog"=>$prog,
        'total'=>$total,"id"=>$id,"matiere"=>$matiere,"sous_prog"=>$sous_prog]);

    }
    public function attestation_2($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        where('payments.id',$id)->first();

        $op = DB::table('operations')->where('id',$pay->id_op)->first();
     
        $view ="pays.att_pay_2";

        return view($view,["user"=>$user,'pay'=>$pay,'op'=>$op,"id"=>$id]);

    }
    public function resume_pay($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->where('id',$pay->id_op)->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $total = $pay->total_done - $pay->total_cut;

        if($pay->type != "FSDRS"){
            $matieres = explode('.',$op->numero);
            if (strlen($matieres[0]) > 2){
                $matiere = $matieres[2];
            }else{
                $matiere = $matieres[3];
            }
        }else{
            $matiere = "";
        }
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        if($prog == NULL){
            $prog = (object) [];
            $prog->code = "";
            $prog->designation = "";   
        }

        $view ='pays.resume_pay';
        if($this->ville_fr =="Medea"){
            $view = $view."_medea";
        }
        if($this->ville_fr =="Mila"){
            $view = $view."_mila";
        }
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
     
        return view($view,["user"=>$user,'pay'=>$pay,'op'=>$op,'e'=>$e,'bank'=>$bank,"prog"=>$prog,
        'total'=>$total,"id"=>$id,"matiere"=>$matiere,"sous_prog"=>$sous_prog]);

    }
    public function fiche($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->
        join("portefeuille","portefeuille.code","=","operations.portefeuille")->
        where('id',$pay->id_op)->first();
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $total = $pay->total_done - $pay->total_cut;
        $pay0 = DB::table('reb_pay')->where('id',$pay->rebrique)->first();

        

        // if($this->lang =="fr"){
        //     $txt = " ";
        //     if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
        //         $txt = $txt.$pay->travaux_type." N° ".$pay->travaux_num." DU ".$pay->date_pay;
        //     }
        //     if($pay->travaux_type  !="facture" && $pay->deal != null){
        //         $txt = $txt.$pay->deal_type." ";
        //     }

        //     if($pay->deal_num != null){
        //         $txt=$txt." N° ".$pay->deal_num;
        //     }
        //     if($pay->deal_date != null){
        //         $txt=$txt." DU ".$pay->deal_date." ";
        //     }
        // }

        $txt = " ";
        if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
            $txt = $txt.$pay->travaux_type." رقم ".$pay->travaux_num." بتاريخ ".$pay->date_pay;
        }else{
            $txt = $txt.$pay->travaux_type." رقم ".$pay->travaux_num." بتاريخ ".$pay->date_pay;
        }
        $txt = $txt." حصة : ".$pay->lot."\n ".$e->name;
        // if($pay->travaux_type  !="facture" && $pay->deal != null){
        //     $txt = $txt.$pay->deal_type." ";
        // }

        // if($pay->deal_num != null){
        //     $txt=$txt." N° ".$pay->deal_num;
        // }
        // if($pay->deal_date != null){
        //     $txt=$txt." DU ".$pay->deal_date." ";
        // }

        $qq = "SELECT * FROM titres WHERE id_titre = (SELECT sous_titre FROM rebriques WHERE id_eng = ".$pay->id_eng." 
        AND ( sous_montant != 0 OR sous_montant_1 != 0) LIMIT 1)";
 
        $sous_titre = NULL;
        if(isset(DB::select(DB::raw($qq))[0])){
            $sous_titre = DB::select(DB::raw($qq))[0];
        }
        $titre = NULL;
        if(isset($sous_titre->father)){
            $titre = DB::table("titres")->where("id_titre",$sous_titre->father)->first();
        }

        $view ="pays.fiche_payement";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        if($this->ville_fr =="Medea"){
            $view = $view."_medea";
        }
        if($this->ville_fr =="Mila"){
            $view = $view."_mila";
        }
	    if($this->ville_fr =="Ouargla"){
            $view = $view."_medea";
        }
        if($this->ville_fr =="Touggourt"){
            $view = $view."_touggourt";
        }
        $s_end = substr($sous_titre->code, -2);
        
        $start = substr($titre->code, 0, 2);
        $q_titres = 'SELECT * FROM `titres` WHERE code LIKE "'.$start.'%" AND code LIKE "%00"';
        $titres = DB::select(DB::raw($q_titres));

        if($s_end != "00"){
            $s_start = substr($sous_titre->code, 0, 3);
            $ass = array($sous_titre);
            for($i = 0; $i <count($titres); $i++){
                $t_start = substr($titres[$i]->code, 0, 3);
                if($t_start == $s_start){
                    echo $i."\n";
                    array_splice( $titres, $i+1, 0, $ass );
                    break;
                }
            }
        }
        

        // var_dump($titres);
        // return $q_titres;
        return view($view,["user"=>$user,'pay'=>$pay,'pay0'=>$pay0,'op'=>$op,"titre"=>$titre,"sous_titre"=>$sous_titre,
        'e'=>$e,'bank'=>$bank,'total'=>$total,'sujet'=>$txt,"id"=>$id,"sous_prog"=>$sous_prog,
        "prog"=>$prog,"titres"=>$titres]);   
    }
    public function maitre_ouvrage($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->leftjoin('banques','banques.nom','=',"banks.bank")->where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->
        join("portefeuille","portefeuille.code","=","operations.portefeuille")->
        where('id',$pay->id_op)->first();
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $total = $pay->total_done - $pay->total_cut;
        $pay0 = DB::table('reb_pay')->where('id',$pay->rebrique)->first();
    
        $txt = " ";
        if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
            $txt = $txt.$pay->travaux_type." N° ".$pay->travaux_num." DU ".$pay->date_pay;
        }
        if($pay->travaux_type  !="facture" && $pay->deal != null){
            $txt = $txt.$pay->deal_type." ";
        }

        if($pay->deal_num != null){
            $txt=$txt." N° ".$pay->deal_num;
        }
        if($pay->deal_date != null){
            $txt=$txt." DU ".$pay->deal_date." ";
        }

        $view ="pays.maitre_ouvrage";

        // var_dump($op);
        // return "";
        return view($view,["user"=>$user,'pay'=>$pay,'pay0'=>$pay0,'op'=>$op,'e'=>$e,'bank'=>$bank,'total'=>$total,'sujet'=>$txt,"id"=>$id]);   
    }
    public function declaration($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->
        leftjoin('banques','banques.nom','=',"banks.bank")->
        where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->
        join("portefeuille","portefeuille.code","=","operations.portefeuille")->
        where('id',$pay->id_op)->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $nums = NULL;

        if($pay->type != "FSDRS"){
            $matieres = explode('.',$op->numero);
            if (strlen($matieres[0]) > 2){
                $matiere = $matieres[2];
            }else{
                $matiere = $matieres[3];
            }
        }else{
            $matiere = "";
        }
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }

        $view ='pays.declaration';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }

        return view($view,["user"=>$user,'pay'=>$pay,
        'op'=>$op,'e'=>$e,'bank'=>$bank,"id"=>$id,"prog"=>$prog,
        "sous_prog"=>$sous_prog,"matiere"=>$matiere]);

    }
    public function order($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        where('payments.id',$id)->first();
        $bank = DB::table('banks')->
        leftjoin('banques','banques.nom','=',"banks.bank")->
        where('banks.id',$pay->bank)->first();
        $op = DB::table('operations')->
        join("portefeuille","portefeuille.code","=","operations.portefeuille")->
        where('id',$pay->id_op)->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $nums = NULL;
        
        if($pay->type != "FSDRS"){
            $matieres = explode('.',$op->numero);
            if (strlen($matieres[0]) > 2){
                $matiere = $matieres[2];
            }else{
                $matiere = $matieres[3];
            }
        }else{
            $matiere = "";
        }
        $prog = DB::table('programme')->where('code',$op->programme)->first();
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        $view ='pays.transfert';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        $txt = " ";
        if($pay->travaux_type != "فاتورة  " && $pay->travaux_num != null){
            $txt = $txt.$pay->travaux_type." رقم ".$pay->travaux_num." بتاريخ ".$pay->date_pay;
        }
        $txt = $txt."\n حصة : ".$pay->lot."\n ".$e->name;

        return view($view,["user"=>$user,'pay'=>$pay,"txt"=>$txt,
        'op'=>$op,'e'=>$e,'bank'=>$bank,"id"=>$id,"prog"=>$prog,
        "sous_prog"=>$sous_prog,"matiere"=>$matiere]);

    }
    public function avancement($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('deals','engagements.deal',"=","deals.id_deal")
        ->where('payments.id',$id)->first();
        $op = DB::table('operations')->where('id',$pay->id_op)->first();
        $e = DB::table('entreprises')->where('id',$pay->entreprise)->first();
        $pay2 = (object)array(
            "etude" => floatval($pay->etude_done) - floatval($pay->etude_cut),
            "non_termine" => floatval($pay->non_termine_done) - floatval($pay->non_termine_cut),
            "extra"=>floatval($pay->extra_done) - floatval($pay->extra_cut),
            "avan"=>floatval($pay->avan_done) - floatval($pay->avan_cut),
            "revision"=>floatval($pay->revision_done) - floatval($pay->revision_cut),
            "assurance"=>floatval($pay->assurance_done) - floatval($pay->assurance_cut),
            "avancement"=>floatval($pay->avancement_done) - floatval($pay->avancement_cut),
            "sanction"=>floatval($pay->sanction_done) - floatval($pay->sanction_cut),
            "total"=>floatval($pay->total_done) - floatval($pay->total_cut),
        );
        if($pay->type != "FSDRS"){
            $matieres = explode('.',$op->numero);
            if (strlen($matieres[0]) > 2){
                $matiere = $matieres[2];
            }else{
                $matiere = $matieres[3];
            }
        }else{
            $matiere = "";
        }
        $sous_prog =  DB::table('programme')->where('id',$op->sous_programme)->first();
        if($sous_prog == NULL){
            $sous_prog = (object) [];
            $sous_prog->code = "";
            $sous_prog->designation = "";   
        }
        $view ='pays.avancement';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }

        return view($view,["user"=>$user,"sous_prog"=>$sous_prog,
        'pay'=>$pay,"pay2"=>$pay2,'op'=>$op,'e'=>$e,"id"=>$id,"matiere"=>$matiere]);
    }

    public function modifier($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->where('id',$id)->first();
        $view ='pays.modifier_pay';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,'pay'=>$pay]);
    }
    public function edit_fiche_pay($id)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->where('id',$id)->first();
        $pay0 = DB::table('reb_pay')->where('id',$pay->rebrique)->first();
        return view('comptabilite.modifier_fiche_pay',["user"=>$user,'pay'=>$pay,'pay0'=>$pay0]);
    }
    public function get_last_fiche($id){
        $query = "SELECT id_op FROM engagements WHERE id IN (SELECT id_eng FROM payments WHERE id =".$id.")";
        $op = DB::select( DB::raw($query))[0]->id_op;
        $query = "SELECT fiche_pay from payments WHERE id_eng IN (SELECT id from engagements WHERE id_op = ".$op." ) AND fiche_pay IS NOT NULL ORDER BY id DESC LIMIT 1 ";
        return DB::select( DB::raw($query));
    }
   
    public function update_fiche(Request $request){
        $etude = $request['etude'];
        $genie_civil = $request['genie_civil'];
        $travaux_publics = $request['travaux_publics'];
        $equipements = $request['equipements'];
        $materiel_transport = $request['materiel_transport'];
        $formation = $request['formation'];
        $travaux_exterieurs = $request['travaux_exterieurs'];
        $publicite = $request['publicite'];
        $fonds = $request['fonds'];
        $env = $request['env'];
        $terrain = $request['terrain'];
        $interets = $request['interets'];
        $douane = $request['douane'];
        $stock = $request['stock'];
        $suiv = $request['suiv'];
        $tech = $request['tech'];
        $labo = $request['labo'];
        $montant_libre = $request['montant_libre'];
        $total = $request['total'];
        $id_reb = $request['id_reb'];

        $cumul_old = floatval(str_replace(",","",$request['cumul_old']));
        $to_pay = floatval($request['to_pay']);
        $cumul_new = $cumul_old + $to_pay;

        DB::table('reb_pay')->where('id', $id_reb)->update([
        "etude"=>$etude,"genie_civil"=>$genie_civil,"travaux_publics"=>$travaux_publics,
        "equipements"=>$equipements,"materiel_transport"=>$materiel_transport,
        "formation"=>$formation,"travaux_exterieurs"=>$travaux_exterieurs,
        "publicite"=>$publicite,"montant_libre"=>$montant_libre,"total"=>$total,
        "fonds"=>$fonds,"env"=>$env,"terrain"=>$terrain,
        "interets"=>$interets,"douane"=>$douane,"stock"=>$stock,
        "suiv"=>$suiv,"tech"=>$tech,"labo"=>$labo,
        "cumul_old"=>$cumul_old,"cumul_new"=>$cumul_new]);
        
        $fiche_pay = $request['fiche_pay'];
        $id = $request['id'];
        DB::table('payments')->where('id', $id)->update([
        "fiche_pay"=>$fiche_pay,"updated_at"=>Date('Y-m-d')]);
        return Redirect::to('/fiche_payment/'.$id);
    }
    public function add_pay(Request $request)
    {   
        $user = Auth::user();
        $etude_done = $request['etude_done'];
        $non_termine_done = $request['non_termine_done'];
        $extra_done = $request['extra_done'];
        $avan_done = $request['avan_done'];

        $revision_done = $request['revision_done'];
        $assurance_done = $request['assurance_done'];
        $avancement_done = $request['avancement_done'];
        $sanction_done = $request['sanction_done'];
        $total_done = $request['total_done'];
        
        $etude_cut = $request['etude_cut'];
        $non_termine_cut = $request['non_termine_cut'];
        $extra_cut = $request['extra_cut'];
        $avan_cut = $request['avan_cut'];
        $revision_cut = $request['revision_cut'];
        $assurance_cut = $request['assurance_cut'];
        $avancement_cut = $request['avancement_cut'];
        $sanction_cut = $request['sanction_cut'];
        $total_cut = $request['total_cut'];

        $old_payments = $request['old_payments'];
        $new_payment = $request['new_payment'];
        $this_year_cut = $request['this_year_cut'];
        $to_pay = $request['to_pay'];

        $num = $request['num'];
        $date_pay = $request['date_pay'];
        $travaux_num = $request['travaux_num'];
        $travaux_type = $request['travaux_type'];
        $num_visa = $request['num_visa'];
        $visa = $request['visa'];
        $id_eng = $request['id_eng'];


        $op = DB::table('engagements')->select('id_op')->where('id',$id_eng)->first()->id_op;

        $q = "SELECT cumul_new as somme from reb_pay where reb_pay.id IN (SELECT rebrique from payments WHERE payments.id_eng IN (SELECT id from engagements WHERE id_op = ".$op.")) ORDER BY reb_pay.id DESC";
        $cumul_old = DB::select( DB::raw($q));
        if($cumul_old == NULL){
            $cumul_old = 0;
        }else{
            $cumul_old = $cumul_old[0]->somme;
        }
        $cumul_new = $cumul_old + $to_pay;
        $rebrique = DB::table('reb_pay')->insertGetId(['id'=>NULL,"cumul_old"=>$cumul_old,"cumul_new"=>$cumul_new,"op"=>$op]);
        
        $id = DB::table('payments')->insertGetId(['etude_done' => $etude_done,
        'non_termine_done' => $non_termine_done,
        'extra_done' => $extra_done,
        'avan_done' => $avan_done,
        'revision_done' => $revision_done,
        'assurance_done' => $assurance_done,
        'avancement_done' => $avancement_done,
        'sanction_done' => $sanction_done,
        'total_done' => $total_done,
        'etude_cut' => $etude_cut,
        'avan_cut' => $avan_cut,
        'non_termine_cut' => $non_termine_cut,
        'extra_cut' => $extra_cut,
        'revision_cut' => $revision_cut,
        'assurance_cut' => $assurance_cut,
        'avancement_cut' => $avancement_cut,
        'sanction_cut' => $sanction_cut,
        'total_cut' => $total_cut,
        'old_payments'=>$old_payments,
        'new_payment'=>$new_payment,
        'this_year_cut'=>$this_year_cut,
        'to_pay'=>$to_pay,
        'num'=>$num,
        'date_pay'=>$date_pay,
        'travaux_num'=>$travaux_num,
        "travaux_type"=>$travaux_type,
        'id_eng'=>$id_eng,
        'year'=> $this->year,//
        //'year'=> Date('Y'),
        'inserted_at'=>Date('Y-m-d'),
        'updated_at'=> NULL,
        'user_id'=>$user->id,
        "fiche_pay"=>NULL,
        "rebrique"=>$rebrique,
        "num_visa"=>$num_visa,
        "visa"=>$visa,
        ]);

        if($this->ville_fr =="Mila"){
            $rev1_done = $request['rev1_done'];
            $rev2_done = $request['rev2_done'];
            DB::table('payments')->where('id',$id)->
            update(['rev1_done' => $rev1_done,'rev2_done' => $rev2_done]);
        }
        
        
        return Redirect::to('/fiche_pay/'.$id);

    }
    public function update_pay(Request $request)
    {   
        $etude_done = $request['etude_done'];
        $non_termine_done = $request['non_termine_done'];
        $extra_done = $request['extra_done'];
        $avan_done = $request['avan_done'];
        $revision_done = $request['revision_done'];
        $assurance_done = $request['assurance_done'];
        $avancement_done = $request['avancement_done'];
        $sanction_done = $request['sanction_done'];
        $total_done = $request['total_done'];
        
        $etude_cut = $request['etude_cut'];
        $non_termine_cut = $request['non_termine_cut'];
        $extra_cut = $request['extra_cut'];
        $avan_cut = $request['avan_cut'];
        $revision_cut = $request['revision_cut'];
        $assurance_cut = $request['assurance_cut'];
        $avancement_cut = $request['avancement_cut'];
        $sanction_cut = $request['sanction_cut'];
        $total_cut = $request['total_cut'];

        $old_payments = $request['old_payments'];
        $new_payment = $request['new_payment'];
        $this_year_cut = $request['this_year_cut'];
        $to_pay = $request['to_pay'];

        $num = $request['num'];
        $date_pay = $request['date_pay'];
        $travaux_num = $request['travaux_num'];
        $travaux_type = $request['travaux_type'];
        $num_visa = $request['num_visa'];
        $visa = $request['visa'];
        $id = $request['id'];
        $id_reb = $request['id_reb'];
        $cumul_old = DB::table('reb_pay')->select('cumul_old')->where('id',$id_reb)->first()->cumul_old;
        $cumul_new = floatval($cumul_old) + floatval($to_pay);
        DB::table('reb_pay')->where('id', $id_reb)->update(["cumul_new"=>$cumul_new]);
        

        DB::table('payments')->where('id',$id)->update(['etude_done' => $etude_done,
        'non_termine_done' => $non_termine_done,
        'extra_done' => $extra_done,
        'avan_done' => $avan_done,
        'revision_done' => $revision_done,
        'assurance_done' => $assurance_done,
        'avancement_done' => $avancement_done,
        'sanction_done' => $sanction_done,
        'total_done' => $total_done,
        'etude_cut' => $etude_cut,
        'avan_cut' => $avan_cut,
        'non_termine_cut' => $non_termine_cut,
        'extra_cut' => $extra_cut,
        'revision_cut' => $revision_cut,
        'assurance_cut' => $assurance_cut,
        'avancement_cut' => $avancement_cut,
        'sanction_cut' => $sanction_cut,
        'total_cut' => $total_cut,
        'old_payments'=>$old_payments,
        'new_payment'=>$new_payment,
        'this_year_cut'=>$this_year_cut,
        'to_pay'=>$to_pay,
        'num'=>$num,
        'date_pay'=>$date_pay,
        'travaux_num'=>$travaux_num,
        "travaux_type"=>$travaux_type,
        'updated_at'=>Date('Y-m-d'),
        "num_visa"=>$num_visa,
        "visa"=>$visa,
        ]);

        if($this->ville_fr =="Mila"){
            $rev1_done = $request['rev1_done'];
            $rev2_done = $request['rev2_done'];
            DB::table('payments')->where('id',$id)->
            update(['rev1_done' => $rev1_done,'rev2_done' => $rev2_done]);
        }
        return Redirect::to('/fiche_pay/'.$id);
        
        //return view('comptabilite.ajouter_pay',["user"=>$user,'id_eng'=>$id_eng]);
    }
    public function delete($id){
        $reb = DB::table("payments")->where("id",$id)->first()->rebrique;
        DB::table("reb_pay")->where("id",$reb)->delete();
        DB::table("payments")->where("id",$id)->delete();
        return redirect('/payments');
    }
    public function print_pays($filters){
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, 
        payments.num_visa as p_num_visa from `payments` left join 
        `engagements` on `engagements`.`id` = `payments`.`id_eng` 
        inner join deals ON engagements.deal = deals.id_deal
        INNER JOIN `entreprises` on `deals`.`entreprise` 
        = `entreprises`.`id` inner join `operations` on 
        `engagements`.`id_op` = `operations`.`id` ";
        if($user->service !="Comptabilité"){
            $query = $query." WHERE payments.visa IS NOT NULL ";
        }else{
            $query = $query." WHERE 1 ";
        }
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = $filters[0];
            $e = $filters[1];
            $year = $filters[2];
            $type = $filters[3];
            $user_id = $filters[4];
            

            if($numero !=""){
                $query = $query."AND operations.numero= '".$numero."'";
            }
            if($e !=""){
                $query = $query." AND deals.entreprise= ".$e;
            }
            if($year !=""){
                $query = $query." AND payments.visa <= '".$year."-12-31' 
                AND payments.visa >= '".$year."-01-01' ";
            }
            if($user_id !=""){
                $query = $query." AND payments.user_id= ".$user_id;
            }
            
        }
        $query = $query." ORDER BY p_id DESC LIMIT 50";
        //$pays = DB::table('payments')->leftjoin("engagements","engagements.id","=","payments.id_eng")->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('operations','engagements.id_op','=','operations.id')->toSql();
        //echo $query;
        $pays =  DB::select( DB::raw($query));
        $n = ceil(count($pays)/7);
        //echo count($engs);
        //echo $n;
        $view ='pays.print_pays';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["pays"=>$pays,"n"=>$n]);
    }  
    public function print_pays2($filters=""){
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, 
        payments.num_visa as p_num_visa from `payments` left join `engagements` 
        on `engagements`.`id` = `payments`.`id_eng` 
        inner join deals ON engagements.deal = deals.id_deal
        inner join `entreprises` on `deals`.`entreprise` = `entreprises`.`id` 
        inner join `operations` on `engagements`.`id_op` = `operations`.`id` ";
    
        $query = $query." WHERE payments.visa IS NULL ";
     
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $user_id = $filters[0];
            
            if($user_id !=""){
                $query = $query." AND payments.user_id= ".$user_id;
            }
            
        }
        $query = $query." ORDER BY p_id DESC LIMIT 50";
        //$pays = DB::table('payments')->leftjoin("engagements","engagements.id","=","payments.id_eng")->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('operations','engagements.id_op','=','operations.id')->toSql();
        //echo $query;
        $pays =  DB::select( DB::raw($query));
        $n = ceil(count($pays)/7);
        //echo count($engs);
        //echo $n;
        return view('pays.print_pays',["pays"=>$pays,"n"=>$n]);
    } 

}