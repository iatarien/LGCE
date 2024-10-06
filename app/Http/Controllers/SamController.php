<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Bcrypt;
use Redirect;
class SamController extends Controller
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
    
    public function index()
    {   
        return Redirect('/operations_ar/all');
    }

    public function get_sous_titres($id)
    {   
        return DB::table("titres")->where('type',"")->where('father',$id)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function operations($secteur)
    {   
        $user = Auth::user();

        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND secteur ='".$secteur."' AND ( id in (SELECT DISTINCT id_op FROM engagements) OR id in (SELECT DISTINCT op_id FROM cumul) OR id IN (SELECT DISTINCT op FROM reb_pay )) ";
        $operations = DB::select( DB::raw($query));
    
        #$data = DB::table('operations')->where('secteur',$secteur)->select('chapitre','source','commune')->get();
        $data = json_decode(json_encode($operations), true);
        $chapitres = array_unique(array_column($data,"chapitre"));
        #var_dump($operations);
        $sources = array_unique(array_column($data,"source"));
        #$communes = array_unique(array_column($data,"commune"));
        return view('sam.operations',['user' => $user,'chapitres'=>$chapitres,'sources'=>$sources,'secteur'=>$secteur,"operations"=>$operations]);  
    }

    public function get_cumul($portefeuille,$filters="",$op="")
    {   
        $query="SELECT *,id as oper_id FROM operations WHERE date_cloture IS NULL AND ";
        if ($portefeuille != "" && $portefeuille != "all" ){
            $query = $query." operations.portefeuille = '".$portefeuille."' AND "; 
        }
        if($op ==""){

            if($filters != "" && $filters != "empty"){
                $filters = explode("*1989*",$filters);
                $programme = $filters[0];
                $source = $filters[1];
                $year = $filters[2];

                if ($programme != ""){
                    $query = $query." operations.programme ='".$programme."' AND"; 
                }
                if($source != ""){
                    $query = $query." operations.source ='".$source."' AND";
                }
                if($year != ""){
                    $query = $query." ( date <='".$year."-12-31' AND date >='".$year."-01-01') AND";
                }
            }
            //return $query;
            $query= $query." 1 ORDER BY id DESC ";
            //echo $query."\n\n";

        }else{

            $query = $query." operations.id = ".$op." ORDER BY id DESC ";
        }
        //echo $query;
        $cumul_net = DB::select( DB::raw($query));
        $cumul_total = array();
        $cumul_total = $cumul_net;
        foreach($cumul_total as $c_tot){
            
            $c_tot->somme_eng_cumul = 0;

            $q0 ="SELECT sum(montant) as somme FROM engagements 
            WHERE engagements.type='eng' AND engagements.date_visa IS NOT NULL 
            AND id_op = ".$c_tot->oper_id;


            $q = "SELECT SUM(to_pay) as cumul_new FROM payments 
            INNER JOIN reb_pay ON reb_pay.id = payments.rebrique 
            WHERE payments.visa IS NOT NULL AND reb_pay.op = ".$c_tot->oper_id;
            $q2 ="SELECT sum(montant) as eng_2023 FROM engagements 
            WHERE engagements.type='eng'  
            AND engagements.date_visa <= '2023-12-31' AND engagements.date_visa >= '2023-01-01' AND id_op = ".$c_tot->oper_id;

            $q3 = "SELECT SUM(to_pay) as pay_2023 FROM payments INNER JOIN 
            reb_pay ON reb_pay.id = payments.rebrique WHERE 
            payments.visa <= '2023-12-31' and payments.visa >= '2023-01-01' 
            AND reb_pay.op = ".$c_tot->oper_id;
            
            $qe2023 ="SELECT real_sujet, sum(montant) as eng_2024 FROM engagements 
            WHERE engagements.type='eng' 
            AND engagements.date_visa <= '2024-12-31' 
            AND engagements.date_visa >= '2024-01-01' AND id_op = ".$c_tot->oper_id;

            $qp2023 = "SELECT SUM(to_pay) as pay_2024 FROM payments INNER JOIN 
            reb_pay ON reb_pay.id = payments.rebrique WHERE 
            payments.visa <= '2024-12-31' and payments.visa >= '2024-01-01' 
            AND reb_pay.op = ".$c_tot->oper_id;
            
            /* cumul_eng total */
            $somme = DB::select( DB::raw($q0));
            if($somme != null){
                $somme = $somme[0]->somme;
            }else{
                $somme = 0;
            }

            /* cumul_pay total */
            $somme_pay = DB::select( DB::raw($q));
            if($somme_pay != null){
                $somme_pay = $somme_pay[0]->cumul_new;
            }else{
                $somme_pay = 0;
            }
            $c_tot->somme = $somme;
            $c_tot->somme_total_eng = $c_tot->somme ;
            $c_tot->somme_pay = $somme_pay;
            $c_tot->somme_total_pay = $c_tot->somme_pay ;
            $c_tot->somme_pay_cumul = 0;

            // /* cumul_eng 2023 */
            // $eng_2023 = DB::select( DB::raw($q2));
            // if($eng_2023 != null){
            //     $eng_2023 = $eng_2023[0]->eng_2023;
            // }else{
            //     $eng_2023 = 0;
            // }

            // //echo $eng_2023;
            // $c_tot->eng_2023 = $eng_2023;

            //  /* cumul_eng 2024 */
            // $eng_2024 = DB::select( DB::raw($qe2023));
            // if($eng_2024 != null){
            //     $eng_2024 = $eng_2024[0]->eng_2024;
            // }else{
            //     $eng_2024 = 0;
            // }

            // //echo $eng_2023;
            // $c_tot->eng_2024 = $eng_2024;

            // /* cumul_pay 2022 */
            // $pay_2023 = DB::select( DB::raw($q3));
            // if($pay_2023 != null){
            //     $pay_2023 = $pay_2023[0]->pay_2023;
            // }else{
            //     $pay_2023 = 0;
            // }
            // $c_tot->pay_2023 = $pay_2023;

            // /* cumul_pay 2024 */
            // $pay_2024 = DB::select( DB::raw($qp2023));
            // if($pay_2024 != null){
            //     $pay_2024 = $pay_2024[0]->pay_2024;
            // }else{
            //     $pay_2024 = 0;
            // }
            // $c_tot->pay_2024 = $pay_2024;
   
        }
        
  

 
        $eng = array_sum(array_column($cumul_total,'somme_total_eng'));
        $pay = array_sum(array_column($cumul_total,'somme_total_pay'));
        $ap = array_sum(array_column($cumul_total,'AP_act'));
        $eng2023 = array_sum(array_column($cumul_total,'eng_2023'));
        $pay2023 = array_sum(array_column($cumul_total,'pay_2023'));
        $eng2024 = array_sum(array_column($cumul_total,'eng_2024'));
        $pay2024 = array_sum(array_column($cumul_total,'pay_2024'));
        array_push($cumul_total,$ap);
        array_push($cumul_total,$eng);
        array_push($cumul_total,$pay);

        // array_push($cumul_total,$eng2023);
        // array_push($cumul_total,$pay2023);
        // array_push($cumul_total,$eng2024);
        // array_push($cumul_total,$pay2024);
        return $cumul_total;
    }
    public function get_cumul_clotures($portefeuille,$filters="",$op="")
    {   
        $query="SELECT *,id as oper_id FROM operations WHERE date_cloture IS NOT NULL AND ";
        if ($portefeuille != "" && $portefeuille != "all" ){
            $query = $query." operations.portefeuille = '".$portefeuille."' AND "; 
        }
        if($op ==""){

            if($filters != "" && $filters != "empty"){
                $filters = explode("*1989*",$filters);
                $programme = $filters[0];
                $source = $filters[1];

                if ($programme != ""){
                    $query = $query." operations.programme ='".$programme."' AND"; 
                }
                if($source != ""){
                    $query = $query." operations.source ='".$source."' AND";
                }
            }
            
            $query= $query." 1 ORDER BY id DESC ";
            //echo $query."\n\n";

        }else{

            $query = $query." operations.id = ".$op." ORDER BY id DESC ";
        }
        //echo $query;
        $cumul_net = DB::select( DB::raw($query));
        $cumul_total = array();
        $cumul_total = $cumul_net;
        foreach($cumul_total as $c_tot){
            
            $c_tot->somme_eng_cumul = 0;

            $q0 ="SELECT sum(montant) as somme FROM engagements 
            WHERE engagements.type='eng' AND engagements.date_visa IS NOT NULL 
            AND id_op = ".$c_tot->oper_id;


            $q = "SELECT SUM(to_pay) as cumul_new FROM payments 
            INNER JOIN reb_pay ON reb_pay.id = payments.rebrique 
            WHERE payments.visa IS NOT NULL AND reb_pay.op = ".$c_tot->oper_id;
            $q2 ="SELECT sum(montant) as eng_2023 FROM engagements 
            WHERE engagements.type='eng'  
            AND engagements.date_visa <= '2023-12-31' AND engagements.date_visa >= '2023-01-01' AND id_op = ".$c_tot->oper_id;

            $q3 = "SELECT SUM(to_pay) as pay_2023 FROM payments INNER JOIN 
            reb_pay ON reb_pay.id = payments.rebrique WHERE 
            payments.visa <= '2023-12-31' and payments.visa >= '2023-01-01' 
            AND reb_pay.op = ".$c_tot->oper_id;
            
            $qe2023 ="SELECT real_sujet, sum(montant) as eng_2024 FROM engagements 
            WHERE engagements.type='eng' 
            AND engagements.date_visa <= '2024-12-31' 
            AND engagements.date_visa >= '2024-01-01' AND id_op = ".$c_tot->oper_id;

            $qp2023 = "SELECT SUM(to_pay) as pay_2024 FROM payments INNER JOIN 
            reb_pay ON reb_pay.id = payments.rebrique WHERE 
            payments.visa <= '2024-12-31' and payments.visa >= '2024-01-01' 
            AND reb_pay.op = ".$c_tot->oper_id;
            
            /* cumul_eng total */
            $somme = DB::select( DB::raw($q0));
            if($somme != null){
                $somme = $somme[0]->somme;
            }else{
                $somme = 0;
            }

            /* cumul_pay total */
            $somme_pay = DB::select( DB::raw($q));
            if($somme_pay != null){
                $somme_pay = $somme_pay[0]->cumul_new;
            }else{
                $somme_pay = 0;
            }
            $c_tot->somme = $somme;
            $c_tot->somme_total_eng = $c_tot->somme ;
            $c_tot->somme_pay = $somme_pay;
            $c_tot->somme_total_pay = $c_tot->somme_pay ;
            $c_tot->somme_pay_cumul = 0;

            // /* cumul_eng 2023 */
            // $eng_2023 = DB::select( DB::raw($q2));
            // if($eng_2023 != null){
            //     $eng_2023 = $eng_2023[0]->eng_2023;
            // }else{
            //     $eng_2023 = 0;
            // }

            // //echo $eng_2023;
            // $c_tot->eng_2023 = $eng_2023;

            //  /* cumul_eng 2024 */
            // $eng_2024 = DB::select( DB::raw($qe2023));
            // if($eng_2024 != null){
            //     $eng_2024 = $eng_2024[0]->eng_2024;
            // }else{
            //     $eng_2024 = 0;
            // }

            // //echo $eng_2023;
            // $c_tot->eng_2024 = $eng_2024;

            // /* cumul_pay 2022 */
            // $pay_2023 = DB::select( DB::raw($q3));
            // if($pay_2023 != null){
            //     $pay_2023 = $pay_2023[0]->pay_2023;
            // }else{
            //     $pay_2023 = 0;
            // }
            // $c_tot->pay_2023 = $pay_2023;

            // /* cumul_pay 2024 */
            // $pay_2024 = DB::select( DB::raw($qp2023));
            // if($pay_2024 != null){
            //     $pay_2024 = $pay_2024[0]->pay_2024;
            // }else{
            //     $pay_2024 = 0;
            // }
            // $c_tot->pay_2024 = $pay_2024;
   
        }
        
  

 
        $eng = array_sum(array_column($cumul_total,'somme_total_eng'));
        $pay = array_sum(array_column($cumul_total,'somme_total_pay'));
        $ap = array_sum(array_column($cumul_total,'AP_act'));
        $eng2023 = array_sum(array_column($cumul_total,'eng_2023'));
        $pay2023 = array_sum(array_column($cumul_total,'pay_2023'));
        $eng2024 = array_sum(array_column($cumul_total,'eng_2024'));
        $pay2024 = array_sum(array_column($cumul_total,'pay_2024'));
        array_push($cumul_total,$ap);
        array_push($cumul_total,$eng);
        array_push($cumul_total,$pay);

        // array_push($cumul_total,$eng2023);
        // array_push($cumul_total,$pay2023);
        // array_push($cumul_total,$eng2024);
        // array_push($cumul_total,$pay2024);
        return $cumul_total;
    }

    public function situation($date="",$portefeuille,$filters="",$op=""){
        $user = Auth::user();
        $year = explode("-",$date)[0];


        $ops = $this->get_cumul($portefeuille,$filters,$op);
     
        $ops = array_splice($ops, 0, -3);
        $n = count($ops);

        for ($i = 0; $i < $n; $i++) {
            
            $q = "SELECT *,SUM(montant) as depenses FROM engagements WHERE id_op =".$ops[$i]->id." AND
            type IN ('eng') AND  date_visa <= '".$date."' ";
            $ops[$i]->depenses = DB::select(DB::raw($q))[0]->depenses;
            $q1 = "SELECT SUM(to_pay) as pays FROM payments INNER JOIN reb_pay ON reb_pay.id = payments.rebrique 
            WHERE payments.visa <= '".$date."' and payments.visa >= '".$year."-01-01'
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
        $tots = new \stdClass();
        $tots->montant_cp = array_sum(array_column($ops,'montant_cp'));
        $tots->AP_act = array_sum(array_column($ops,'AP_act'));
        $tots->depenses = array_sum(array_column($ops,'depenses'));
        $tots->pays = array_sum(array_column($ops,'pays'));
        //var_dump($chaps);
       return view('sam.situation',
       ["year"=>$year,'ops'=>$ops,"date"=>$date,'tots'=>$tots]);

    }

}
