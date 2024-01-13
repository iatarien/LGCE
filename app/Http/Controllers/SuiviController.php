<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class SuiviController extends Controller
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
    public function all()
    {   
        $user = Auth::user();
        return view('suivi.all',["user"=>$user]);
    }
    
    public function suivi_e($e)
    {   
        $user = Auth::user();
        return view('suivi.suivi_e',["user"=>$user,"e"=>$e]);
    }
    public function get_suivis($value="")
    {   
        $q = "SELECT *,suivi.id as id_s FROM suivi INNER JOIN operations ON operations.id = suivi.id_op";
        $all = DB::select(DB::raw($q));
        for($i=0; $i< count($all); $i++){
            $all[$i]->bets = array();
            $all[$i]->es = array();
            
        }
        for($i=0; $i< count($all); $i++){
            $bets = DB::table('entreprises')->join("entrepreneurs","entreprises.id","=","entrepreneurs.id_e")->
            where('id_suiv',$all[$i]->id_s)->where('type',"bet")->get()->toArray();

            $all[$i]->bets = $bets;
            $es = DB::table('entreprises')->join("entrepreneurs","entreprises.id","=","entrepreneurs.id_e")->
            where('id_suiv',$all[$i]->id_s)->where('type',"entrepreneur")->get()->toArray();
            $all[$i]->es = $es; 
        }
        return $all;
    }
    public function get_suivi_e_old($e)
    {   
        $q = "SELECT *,entrepreneurs.id as id_eur FROM entrepreneurs INNER JOIN entreprises ON entreprises.id = entrepreneurs.id_e
        INNER JOIN durees ON durees.id = entrepreneurs.duree WHERE entrepreneurs.id = ".$e;
        $suivi = DB::select(DB::raw($q));
        $suivi[0]->odss = array();
        $suivi[0]->situations = array();

   
        $odss = DB::table('ods')->where("ods.id_entrepreneur","=",$suivi[0]->id_eur)->
        get()->toArray();
        $suivi[0]->odss = $odss;
        $situations = DB::table('situations')->where("situations.id_entrepreneur","=",$suivi[0]->id_eur)->
        get()->toArray();
        $suivi[0]->situations = $situations;

        

        return $suivi;
    }
    public function get_situations($value="")
    {   
        $q = "SELECT *,situations.id as id_s FROM situations INNER JOIN entrepreneurs 
        ON situations.id_entrepreneur = entrepreneurs.id WHERE id_entrepreneur = ".$value;
        $all = DB::select(DB::raw($q));
        for($i=0; $i< count($all); $i++){
            $all[$i]->conc  = NULL;
            $all[$i]->conc_c_b = NULL;
            $all[$i]->conc_c_s = NULL;
            $all[$i]->conc_f = NULL;
            
            
        }
        for($i=0; $i< count($all); $i++){
            $all[$i]->conc_e = DB::table('conclusions')->where('id',$all[$i]->conc_emp)->first();
            $all[$i]->conc_c_b = DB::table('conclusions')->where('id',$all[$i]->conc_bur)->first();
            $all[$i]->conc_c_s = DB::table('conclusions')->where('id',$all[$i]->conc_service)->first();
            $all[$i]->conc_f = DB::table('conclusions')->where('id',$all[$i]->conc_final)->first();
        }
        return $all;
    }
    public function situations($value="")
    {   
        $user = Auth::user();
        return view('suivi.situations',["user"=>$user,"e"=>$value]);
    }
    

    public function get_all(){
        $user = Auth::user();
        $all = DB::table('suivi')->select('operation',"user")->where('user',$user->id)->get();
        $i = -1;
        foreach($all as $op){
            $i = $i +1;
            $all[$i]->id_op = $op->operation;
            $ze_op = DB::table('operations')->where('id',$op->operation)->first();
            $all[$i]->operation = $ze_op;
            $q = "SELECT *,engagements.id as id_eng FROM engagements INNER JOIN entreprises 
            ON engagements.entreprise_id = entreprises.id WHERE id_op = ".$all[$i]->id_op." AND 
            type IN ('juridique','FSDRS','mixte') AND nature ='company'";
            $engs_comp = DB::select(DB::raw($q));
            $all[$i]->max = count($engs_comp);
            $all[$i]->engs_comp = $engs_comp;
            $q1 = "SELECT *,engagements.id as id_eng FROM engagements INNER JOIN entreprises 
            ON engagements.entreprise_id = entreprises.id WHERE id_op = ".$all[$i]->id_op." AND 
            type IN ('juridique','FSDRS','mixte') AND nature ='bet'";
            $engs_bets = DB::select(DB::raw($q1));
            $all[$i]->engs_bets = $engs_bets;
            
        }
        return $all;
    }

    public function get_suivi_e($e)
    {   
        $q = "SELECT *,engagements.id as id_eng FROM engagements INNER JOIN entreprises 
        ON engagements.entreprise_id = entreprises.id WHERE engagements.id=".$e;
        $suivi = DB::select(DB::raw($q));
        $suivi[0]->odss = array();
        //$suivi[0]->situations = array();

   
        $odss = DB::table('ods')->where("ods.id_eng","=",$e)->
        get()->toArray();
        $suivi[0]->odss = $odss;
        // $situations = DB::table('situations')->where("situations.id_entrepreneur","=",$suivi[0]->id_eur)->
        // get()->toArray();
        // $suivi[0]->situations = $situations;

        

        return $suivi;
    }
    public function op_detail($id)
    {   
        $user = Auth::user();
        $op = DB::table('operations')->where('id',$id)->first();
        $q = "SELECT * FROM engagements INNER JOIN entreprises ON engagements.entreprise_id = entreprises.id 
        WHERE id_op = ".$id." AND type IN ('juridique','FSDRS','mixte') AND engagements.date_visa IS NOT NULL
        group by engagements.entreprise_id";
        $engs = DB::select(DB::raw($q));
        $n = ceil(count($engs)/5);
        return view('suivi.op_detail',["op"=>$op,"engs"=>$engs,"n"=>$n]);
    }

    public function update_op_taux(Request $response)
    {   
        DB::table('operations')->where('id',$response["id"])->update(['taux'=>$response['taux']]);
        return "success";
    }
   
}
