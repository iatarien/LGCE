<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class ComptabiliteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function banques()
    {   
        $user = Auth::user();

        return view('comptabilite.banques',["user"=>$user]);
    }
    public function banques_get()
    {   

        return DB::table("banques")->get();
    }
    public function ajouter_banque()
    {   
        $user = Auth::user();
        return view('comptabilite.ajouter_banque',["user"=>$user]);
    }
    public function modifier_banque($id)
    {   
        $user = Auth::user();
        $banque = DB::table("banques")->where('id',$id)->first();  
        return view('comptabilite.modifier_banque',["user"=>$user,"banque"=>$banque]);
    }
    public function insert_banque(Request $request)
    {   
        $nom = $request['nom'];
        $abr = $request['abr'];
        $num = $request['num'];
        $cle = $request['cle'];

        DB::table('banques')->
        insert(['nom'=>$nom,'abr'=>$abr,'num'=>$num,'cle'=>$cle]);
        return Redirect::to('/banques');
        
    }
    public function update_banque(Request $request)
    {   
        $id = $request['id'];
        $nom = $request['nom'];
        $abr = $request['abr'];
        $num = $request['num'];
        $cle = $request['cle'];

        DB::table('banques')->where('id',$id)->
        update(['nom'=>$nom,'abr'=>$abr,'num'=>$num,'cle'=>$cle]);
        return Redirect::to('/banques');
        
    }
    
    public function index()
    {   
        $user = Auth::user();
        $number_eng = DB::table('engagements')->where('type','juridique')->orWhere('type','FSDRS')->orWhere('type','mixte')->count();
        $number_pay = DB::table('payments')->count();

        return view('comptabilite.index_compta',["user"=>$user,"number_eng"=>$number_eng,"number_pay"=>$number_pay]);
    }
    public function anep_ctc()
    {   
        $user = Auth::user();
        return view('comptabilite.anep_ctc',["user"=>$user]);
    
    }
    public function get_ctc($type,$year="")
    {
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, payments.num_visa as p_num_visa from `payments` left join `engagements` on `engagements`.`id` = `payments`.`id_eng` inner join `entreprises` on `engagements`.`entreprise_id` = `entreprises`.`id` inner join `operations` on `engagements`.`id_op` = `operations`.`id` ";
        $query = $query." WHERE payments.visa IS NOT NULL ";
        if($year !=""){
            $query = $query." AND payments.visa <= '".$year."-12-31' AND payments.visa >= '".$year."-01-01'";
        }
        
        if ($type =="ctc"){
            $query = $query." AND (entreprise_id = 28 or entreprise_id = 40 or entreprise_id = 157) ";
        }else {
            $query = $query." AND entreprise_id = 15 ";
        }
        

        
        $query = $query." ORDER BY payments.visa DESC";
        //$pays = DB::table('payments')->leftjoin("engagements","engagements.id","=","payments.id_eng")->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('operations','engagements.id_op','=','operations.id')->toSql();
        //echo $query."<br>";
        return DB::select( DB::raw($query));
    }
    public function print_ctc($type,$year="")
    {
        $user = Auth::user();
        $query = "select *,payments.id as p_id, payments.user_id as pay_user, payments.num_visa as p_num_visa from `payments` left join `engagements` on `engagements`.`id` = `payments`.`id_eng` inner join `entreprises` on `engagements`.`entreprise_id` = `entreprises`.`id` inner join `operations` on `engagements`.`id_op` = `operations`.`id` ";
        $query = $query." WHERE payments.visa IS NOT NULL ";
        if($year !=""){
            $query = $query." AND payments.visa <= '".$year."-12-31' AND payments.visa >= '".$year."-01-01'";
        }
        
        if ($type =="ctc"){
            $query = $query." AND (entreprise_id = 28 or entreprise_id = 40 or entreprise_id = 157) ";
        }else {
            $query = $query." AND entreprise_id = 15 ";
        }
        

        
        $query = $query." ORDER BY payments.visa DESC";
        $pays =  DB::select( DB::raw($query));
        $n = ceil(count($pays)/9);
        return view('comptabilite.print_ctc',["pays"=>$pays,"n"=>$n]);
    }
    public function historique(){
        $user = Auth::user();
        if($user->position =="Admin"){
            $engs = DB::table("users")->join('engagements',"engagements.user_id","=","users.id")->orderby("engagements.id","DESC")->get();
            $pays = DB::table("users")->join('payments',"payments.user_id","=","users.id")->orderby("payments.id","DESC")->get();
        }else{
            $engs = DB::table("users")->join('engagements',"engagements.user_id","=","users.id")->orderby("engagements.id","DESC")->where("users.id",$user->id)->get();
            $pays = DB::table("users")->join('payments',"payments.user_id","=","users.id")->orderby("payments.id","DESC")->where("users.id",$user->id)->get();
        }
        return view('comptabilite.historique',["user"=>$user,"engs"=>$engs,"pays"=>$pays]);

    }

    public function psc()
    {   
        $user = Auth::user();

        return view('comptabilite.psc_stuff',["user"=>$user]);
    }

    public function consommation($start="",$end=""){
        if($start == ""){
            $start = Date('Y')."-01-01";
        }
        $starts = explode('-',$start);
        $year = $starts[0];
        if ($end == ""){
            $end = $year."-12-31";
        }
        $user = Auth::user();
        $ends = explode('-',$end);
        $month0 = $ends[1];
        $end = $ends[0]."-".($month0-1)."-".$ends[2];
        $months = ["",'Janvier','Fevrier',"Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
        // var_dump($months);
        // echo $month0;
        $month = $months[intVal($month0)];
        $chaps = DB::table('operations')->select('chapitre')->where('source',"PSC")->distinct()->get();
        for($j = 0; $j< count($chaps); $j++){
            $ops = DB::table('operations')->where('operations.numero','!=','N?')->whereNull("date_cloture")->
            where('operations.source','PSC')->where('operations.chapitre',$chaps[$j]->chapitre)->get();
            $n = count($ops);
            for ($i = 0; $i < count($ops); $i++) {
                $q = "SELECT *,SUM(to_pay) as pay_ant FROM payments INNER JOIN reb_pay ON payments.rebrique = reb_pay.id
                WHERE op =".$ops[$i]->id." AND
                visa >= '".$start."' AND visa <= '".$end."' ";
                $ops[$i]->pay_ant = DB::select(DB::raw($q))[0]->pay_ant;
                $q = "SELECT *,SUM(to_pay) as depenses FROM payments INNER JOIN reb_pay ON payments.rebrique = reb_pay.id
                WHERE op =".$ops[$i]->id." AND
                visa >= '".$year."-".$month0."-01' AND visa <= '".$year."-".$month0."-31' ";
                $ops[$i]->depenses = DB::select(DB::raw($q))[0]->depenses;

                $q = "SELECT montant_cp FROM cp WHERE ze_op =".$ops[$i]->id." AND year = ".$year;
                $cp = DB::select(DB::raw($q));
                if(!isset($cp[0]->montant_cp)){
                    $ops[$i]->montant_cp = 0;
                }else{
                    $ops[$i]->montant_cp = $cp[0]->montant_cp;
                }
                
            }
            $chaps[$j]->ops = $ops->toArray();
            $chaps[$j]->montant_cp = array_sum(array_column($chaps[$j]->ops,'montant_cp'));
            $chaps[$j]->pay_ant = array_sum(array_column($chaps[$j]->ops,'pay_ant'));
            $chaps[$j]->depenses = array_sum(array_column($chaps[$j]->ops,'depenses'));
            $chaps[$j]->n = $n;
        }
        $end = $ends[2]."/".$ends[1]."/".$ends[0];
        $start = $starts[2]."/".$starts[1]."/".$starts[0]; 
        $tots = new \stdClass();
        $chaps = $chaps->toArray();
        $tots->montant_cp = array_sum(array_column($chaps,'montant_cp'));
        $tots->pay_ant = array_sum(array_column($chaps,'pay_ant'));
        $tots->depenses = array_sum(array_column($chaps,'depenses'));
        //var_dump($chaps);
        return view('comptabilite.consommation1',["year"=>$year,"month"=>$month,'chaps'=>$chaps,"start"=>$start,"end"=>$end,'tots'=>$tots]);

    }
    public function situation_psc($year=""){
        if($year == ""){
            $year = Date('Y');
            $year = "2021";
        }

        $start = $year."-01-01";
        $end = $year."-12-31";
        if( date('N', strtotime($end)) == "6"){
            $end = $year."-12-29";
        }
        if( date('N', strtotime($end)) == "5"){
            $end = $year."-12-30";
        }

        $user = Auth::user();
        $ends = explode('-',$end);
        $month0 = $ends[1];
        $end = $ends[0]."-".($month0)."-".$ends[2];
        $months = ["",'Janvier','Fevrier',"Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
        $month = $months[$month0];
        $chaps = DB::table('operations')->select('chapitre')->where('source',"PSC")->distinct()->get();
        for($j = 0; $j< count($chaps); $j++){
            $ops = DB::table('operations')->where('operations.numero','!=','N?')->whereNull("date_cloture")->
            where('operations.source','PSC')->where('operations.chapitre',$chaps[$j]->chapitre)->get();
            $n = count($ops);
            for ($i = 0; $i < count($ops); $i++) {

                $q = "SELECT *,SUM(total) as depenses FROM engagements WHERE id_op =".$ops[$i]->id." AND
                 type IN ('juridique','mixte') AND date_visa >= '".$year."-".$month0."-01' AND date_visa <= '".$year."-".$month0."-31' ";
                $ops[$i]->depenses = DB::select(DB::raw($q))[0]->depenses;
                $q1 = "SELECT SUM(to_pay) as pays FROM payments INNER JOIN reb_pay ON reb_pay.id = payments.rebrique 
                WHERE payments.visa <= '".$year."-12-31' and payments.visa >= '".$year."-01-01'
                AND reb_pay.op = ".$ops[$i]->id;
                $ops[$i]->pays = DB::select(DB::raw($q1))[0]->pays;

                $q = "SELECT montant_cp FROM cp WHERE ze_op =".$ops[$i]->id." AND year = ".$year;
                $cp = DB::select(DB::raw($q));
                if(!isset($cp[0]->montant_cp)){
                    $ops[$i]->montant_cp = 0;
                }else{
                    $ops[$i]->montant_cp = $cp[0]->montant_cp;
                }
                
            }
            $chaps[$j]->ops = $ops->toArray();
            $chaps[$j]->montant_cp = array_sum(array_column($chaps[$j]->ops,'montant_cp'));
            $chaps[$j]->AP_act = array_sum(array_column($chaps[$j]->ops,'AP_act'));
            $chaps[$j]->depenses = array_sum(array_column($chaps[$j]->ops,'depenses'));
            $chaps[$j]->pays = array_sum(array_column($chaps[$j]->ops,'pays'));
            $chaps[$j]->n = $n;
        }
        $ends = explode('-',$end);
        $end = $ends[2]."/".$ends[1]."/".$ends[0];
        $tots = new \stdClass();
        $chaps = $chaps->toArray();
        $tots->montant_cp = array_sum(array_column($chaps,'montant_cp'));
        $tots->AP_act = array_sum(array_column($chaps,'AP_act'));
        $tots->depenses = array_sum(array_column($chaps,'depenses'));
        $tots->pays = array_sum(array_column($chaps,'pays'));
        //var_dump($chaps);
       return view('comptabilite.situation_psc',
       ["year"=>$year,'chaps'=>$chaps,"end"=>$end,'tots'=>$tots]);

    }

    public function nc13($year, $month=""){
        $user = Auth::user();
        $months = ["",'Janvier','Fevrier',"Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
        $month0 = array_search($month,$months);
        //$year = Date('Y');
        //$ops = DB::table('operations')->where('numero','!=','N?')->where('source','PSC')->get();
        $chaps = DB::table('operations')->select('chapitre')->where('source',"PSC")->distinct()->get();
        for($j = 0; $j< count($chaps); $j++){
            $ops = DB::table('operations')->where('operations.numero','!=','N?')->whereNull("date_cloture")->
            where('operations.source','PSC')->where('operations.chapitre',$chaps[$j]->chapitre)->get();
            $n = count($ops);
            for ($i = 0; $i < count($ops); $i++) {
                $q = "SELECT *,SUM(to_pay) as pay_ant FROM payments INNER JOIN reb_pay ON payments.rebrique = reb_pay.id
                WHERE op =".$ops[$i]->id." AND
                visa >= '".$year."-01-01' AND visa <= '".$year."-".$month0."-01' ";
                $ops[$i]->pay_ant = DB::select(DB::raw($q))[0]->pay_ant;
                $q = "SELECT *,SUM(to_pay) as depenses FROM payments INNER JOIN reb_pay ON payments.rebrique = reb_pay.id
                WHERE op =".$ops[$i]->id." AND
                visa >= '".$year."-".$month0."-01' AND visa <= '".$year."-".$month0."-31' ";
                $ops[$i]->depenses = DB::select(DB::raw($q))[0]->depenses;
                $q = "SELECT montant_cp FROM cp WHERE ze_op =".$ops[$i]->id." AND year = ".$year;
                $cp = DB::select(DB::raw($q));
                if(!isset($cp[0]->montant_cp)){
                    $ops[$i]->montant_cp = 0;
                }else{
                    $ops[$i]->montant_cp = $cp[0]->montant_cp;
                }
                    

            // echo $q.'<br><br>';
            }
            $chaps[$j]->ops = $ops->toArray();
            $chaps[$j]->montant_cp = array_sum(array_column($chaps[$j]->ops,'montant_cp'));
            $chaps[$j]->pay_ant = array_sum(array_column($chaps[$j]->ops,'pay_ant'));
            $chaps[$j]->depenses = array_sum(array_column($chaps[$j]->ops,'depenses'));
            $chaps[$j]->n = $n;
        }
       return view('comptabilite.nc13',["chaps"=>$chaps,"year"=>$year,"month"=>$month,'ops'=>$ops]);

    }
    public function fiche_comptable($id){
        $user = Auth::user();
        $year = Date('Y') - 1 ;
        $op = DB::table('operations')->where('id',$id)->first();
        /*$q = "SELECT *,SUM(total) as somme, SUM(to_pay) as pays FROM engagements LEFT JOIN payments ON
        engagements.id = payments.id_eng
        WHERE id_op = ".$id." AND type IN ('comptable','mixte','FSDRS') AND engagements.date_visa GROUP BY deal_num,deal_date"; */
        $q = "SELECT *,SUM(total) as somme FROM engagements WHERE id_op = ".$id." AND 
        type IN ('comptable','mixte') AND (engagements.date_visa >= '".$year."-01-01' AND 
        engagements.date_visa <= '".$year."-12-31') GROUP BY deal_num,deal_date";
        $engs = DB::select( DB::raw($q));
        $n = count($engs);


        $i = 0-1;
        foreach ($engs as $eng){
            $i = $i + 1;
            
        
            $p_q = "SELECT *,SUM(to_pay) as pays FROM payments WHERE id_eng = 
            (SELECT id_juridique from aprobations WHERE id_eng =".$eng->id.") AND
            (visa >= '".$year."-01-01' AND visa <= '".$year."-12-31')";
           
            //echo $p_q.'<br><br>';

            $pays = DB::select( DB::raw($p_q))[0];

            if(isset($pays->pays) && $pays != null ){
                $pays = $pays->pays;
            }else{
                $pays = 0;
            }
            
            $engs[$i]->pays = $pays;

            $deal = $eng->deal_type;
            $deal_num = $eng->deal_num;
            $deal_date = $eng->deal_date;
            $annexe = $eng->annexe;
            $sujet = $eng->sujet;
            $e = "";
            $type = $eng->type;
            $e = DB::table('entreprises')->select('name')->where('id',$eng->entreprise_id)->first();
            $e = $e->name;
            
            
            if($eng->real_sujet != null ){
                
            }else{
                if (strpos($sujet, '1989raouf1989') !== false) {
                    $sujets = explode("1989raouf1989",$sujet);
                    $sujet = $sujets[1];
                    $txt = $sujets[0];
                }else{
                    $txt = "";
                }
                
                if($type !="fiche_eco"){
                    
                    if($type == "juridique"){
                    $txt = $txt."الالتزام القانوني ";
                    }else if($type=="comptable"){
                    $txt =$txt."الالتزام المحاسبي ";
                    }else if($type=="FSDRS"){
                    $txt =$txt."الالتزام  ";
                    }else if($type=="mixte"){
                        $txt =$txt."الالتزام القانوني و المحاسبي ";
                        }
                    else {
                    $txt =$txt."تكفل بمقرر ";
                    } 
                    if($annexe != null){
                        if($type == "juridique" || $type == "FSDRS"){
                            $txt =$txt."  بالملحق "." ".$annexe." ";
                        }else{
                            $txt =$txt."في إطار الملحق "." ".$annexe." ";
                        }
                    
                    }
                    if($deal !="مقرر"){
                        if($type == "juridique" || $type == "mixte"){
                            $txt =$txt."ل".$deal." ";
                        }else if($type == "FSDRS") {
                            $txt =$txt."ل".$deal." ";
                        }else {
                            $txt =$txt."في إطار ال".$deal." ";
                        }
                    
                    }
                    $txt =$txt." رقم ".$deal_num;
                    if($deal_date != null){
                        $txt =$txt." بتاريخ ".$deal_date." ";
                    }
                    
                    if($e != ""){
                    $txt =$txt." المقدمة من طرف "." ".$e." ";
                    }
                    $txt =$txt."ل".$sujet;
                    
                }else{
                    $txt =$txt.$sujet;
                }
                $eng->real_sujet = $txt;
            }
        }

        $tot_eng = array_sum(array_column($engs,'somme'));
        $tot_pay = array_sum(array_column($engs,'pays'));
        $nums = null;
        if($op->source =="PSC"){
            $nums = explode("-",$op->numero);
            $num1 = $nums[count($nums)-2];
            $num2 = $nums[count($nums)-3]; 
            $nums = [$num2,$num1];
        }
        
        return view('comptabilite.fiche_comptable',["op"=>$op,"nums"=>$nums,"engs"=>$engs,"n"=>$n,"tot_eng"=>$tot_eng,"tot_pay"=>$tot_pay]);

    }
    public function fiche_consom($id){
        $user = Auth::user();
        $year = Date('Y') - 1 ;
        $query = "SELECT *,payments.id as p_id from payments INNER JOIN engagements 
        ON engagements.id = payments.id_eng inner join entreprises on 
        `engagements`.`entreprise_id` = `entreprises`.`id` 
        WHERE engagements.id_op = ".$id." AND 
        (visa >= '".$year."-01-01' AND visa <= '".$year."-12-31')  ORDER BY p_id DESC";
        //echo $query;
        $op = DB::table('operations')->where('id',$id)->first();

        $pays = DB::select(DB::raw($query));
  
        //var_dump($pays);

        

        $tot_pay = array_sum(array_column($pays,'to_pay'));

        
        return view('comptabilite.fiche_consom',["op"=>$op,"pays"=>$pays,"tot_pay"=>$tot_pay]);

    }    
    public function get_last($id_op){
        $query = "SELECT * from engagements WHERE id_op =".$id_op." AND (type = 'inscription' OR type='decision' OR type='comptable') ORDER BY id DESC LIMIT 1 ";
        return DB::select( DB::raw($query));
    }
   
    public function ajouter_cumul()
    {   
        $user = Auth::user();
        $query = "SELECT id,numero,intitule_ar FROM operations WHERE date_cloture IS NULL AND id NOT IN (SELECT op_id FROM cumul ) AND numero != 'N?' ";
        $operations = DB::select(DB::raw($query));
        //$operations = DB::table('operations')->select('id','numero')->where('numero','!=','N?')->get();
        return view('comptabilite.add_cumul',["user"=>$user,"operations"=>$operations]);
    }
    public function modifier_cumul($id_op)
    {   
        $user = Auth::user();
        $c = DB::table('cumul')->join('operations','operations.id','=','cumul.op_id')->where('cumul.op_id',$id_op)->first();
        return view('comptabilite.edit_cumul',["user"=>$user,'id'=>$id_op,'c'=>$c]);
        
    }
    public function add_cumul(Request $request)
    {   
        $user = Auth::user();
        $op_id = $request['id_op'];
        $pay = $request['pay'];
        $eng = $request['eng'];
        if($pay == NULL){
            $pay = 0;
        }
        if($eng == NULL){
            $eng = 0;
        }

        $id = DB::table('cumul')->insertGetId(['op_id'=>$op_id,'pay'=>$pay,'eng'=>$eng,"user_id"=>$user->id]);
        
        return Redirect::to('/cumul/all');
        
    }
    public function update_cumul(Request $request)
    {   
        $op_id = $request['id'];
        $pay = $request['pay'];
        $eng = $request['eng'];
        if($pay == NULL){
            $pay = 0;
        }
        if($eng == NULL){
            $eng = 0;
        }
        DB::table('cumul')->where('op_id',$op_id)->update(['pay'=>$pay,'eng'=>$eng]);
        return Redirect::to('/cumul/all');
        
    }
    public function cumul($type)
    {   
        $user = Auth::user();

        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id in (SELECT DISTINCT id_op FROM engagements) OR id in (SELECT DISTINCT op_id FROM cumul) OR id IN (SELECT DISTINCT op FROM reb_pay ) ";
        $operations = DB::select( DB::raw($query));
        return view('comptabilite.cumul',["user"=>$user,"operations"=>$operations,"type"=>$type,"user_id"=>$user->id]);
    }
    public function get_cumul($type,$op="")
    {   
        
        $user = Auth::user();
        if($op ==""){
            //$query="SELECT id_op,intitule_ar,numero,SUM(to_pay)as somme_pay, SUM(total) as somme FROM engagements LEFT JOIN payments ON payments.id_eng = engagements.id INNER JOIN operations ON engagements.id_op = operations.id WHERE (engagements.type='juridique' OR engagements.type='FSDRS' OR engagements.type='decision' or engagements.type='mixte') AND engagements.date_visa IS NOT NULL GROUP BY engagements.id_op;";
            $query="SELECT id_op,intitule_ar,numero,real_sujet, SUM(total) as somme FROM engagements INNER JOIN operations ON engagements.id_op = operations.id WHERE (engagements.type='juridique' OR engagements.type='FSDRS' OR   engagements.type='mixte') AND engagements.date_visa IS NOT NULL AND  engagements.real_sujet NOT LIKE '%ناتجة%' GROUP BY engagements.id_op";
            $cumul = DB::table('cumul')->select('user_id',"op_id","numero","intitule_ar","eng as somme_eng_cumul","pay as somme_pay_cumul")->join("operations","operations.id","=","cumul.op_id")->get()->toArray();
        }else{
            $query="SELECT id_op,intitule_ar,numero,real_sujet, SUM(total) as somme FROM engagements INNER JOIN operations ON engagements.id_op = operations.id WHERE (engagements.type='juridique' OR engagements.type='FSDRS' OR   engagements.type='mixte') AND engagements.date_visa IS NOT NULL AND  engagements.real_sujet NOT LIKE '%ناتجة%' AND engagements.id_op = ".$op." GROUP BY engagements.id_op";
            $cumul = DB::table('cumul')->select('user_id',"op_id","numero","intitule_ar","pay as somme_pay_cumul","eng as somme_eng_cumul")->where('op_id','=',$op)->join("operations","operations.id","=","cumul.op_id")->get()->toArray();
        }
        
        $cumul_net = DB::select( DB::raw($query));
        $cumul_total = array();
        $cumul_total = $cumul_net;
        foreach($cumul_total as $c_tot){
            $c_tot->somme_total_eng = $c_tot->somme ;
            $c_tot->somme_eng_cumul = 0;

            // $q = "SELECT cumul_new FROM reb_pay WHERE id = 
            // (SELECT MAX(r.id) FROM 
            // (SELECT reb_pay.id FROM reb_pay INNER JOIN 
            // payments ON reb_pay.id = payments.rebrique WHERE 
            // payments.visa IS NOT NULL AND reb_pay.op = ".$c_tot->id_op.") r )";
            #$q = "SELECT cumul_new  FROM reb_pay WHERE id =(SELECT MAX(id) FROM reb_pay WHERE op =".$c_tot->id_op.")";
            $q = "SELECT SUM(to_pay) as cumul_new FROM payments INNER JOIN reb_pay ON reb_pay.id = payments.rebrique WHERE payments.visa IS NOT NULL AND reb_pay.op = ".$c_tot->id_op;
            $somme_pay = DB::select( DB::raw($q));
            if($somme_pay != null){
                $somme_pay = $somme_pay[0]->cumul_new;
            }else{
                $somme_pay = 0;
            }
            
            $c_tot->somme_pay = $somme_pay;
            $c_tot->somme_total_pay = $c_tot->somme_pay ;
            $c_tot->somme_pay_cumul = 0;
   
        }
        
        foreach($cumul as $c){
            foreach($cumul_total as $c_tot){
                if($c->op_id == $c_tot->id_op){
                    $c_tot->somme_total_eng += $c->somme_eng_cumul;
                    $c_tot->somme_eng_cumul = $c->somme_eng_cumul;
                    $c_tot->somme_total_pay += $c->somme_pay_cumul;
                    $c_tot->somme_pay_cumul = $c->somme_pay_cumul;
                    $c_tot->user_id = $c->user_id;
                    $c_tot->op_id = $c->op_id;
                }
                
            }
        }

        foreach($cumul as $c){
            $needleField = 'id_op';
            $needleValue = $c->op_id;
            $check = in_array($needleValue, array_column($cumul_total, $needleField));
            if($check == false){
                $c->somme_total_eng = $c->somme_eng_cumul;
                $c->somme = 0;
                $c->somme_total_pay = $c->somme_pay_cumul;
                $c->somme_pay = 0;
                
                array_push($cumul_total,$c);
            }
        }

        // foreach($cumul as $c){
        //     foreach($cumul_net as $c_net){
        //         if($c->op_id == $c_net->id_op){
        //             $c_net->somme_total_eng = $c_net->somme + $c->somme_eng_cumul;
        //             $c_net->somme_total_pay = $c_net->somme_pay + $c->somme_pay_cumul;
        //         }
        //     }
        // }

        return $cumul_total;   
        
            
        
    }
}
