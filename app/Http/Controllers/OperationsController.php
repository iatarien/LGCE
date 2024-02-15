<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Bcrypt;
use Redirect;
class OperationsController extends Controller
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

    public function ops($portefeuille,$filters=""){
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $chapitre = $filters[0];
            $source = $filters[1];
            //$year = $filters[2];

            if($portefeuille !="all"){
                $query = "SELECT * FROM operations WHERE portefeuille = '".$portefeuille."' AND";
            }else{
                $query = "SELECT * FROM operations WHERE ";
            }
            
            if ($chapitre != ""){
                $query = $query." chapitre ='".$chapitre."' AND"; 
            }
            if($source != ""){
                $query = $query." source ='".$source."' AND";
            }
            // if($year != ""){
            //     $query = $query." ( date <='".$year."'-12-31 AND date >='".$year."'-01-01) AND";
            // }
            // if($numero !=""){
            //     $query = $query." numero = '".$numero."' AND";
            // }
            $query= $query." numero !='N?' AND date_cloture IS NULL ORDER BY id DESC";
            // if($order != ""){
            //     $query = $query." ORDER BY ".$order; 
            // } 
            //echo $query;
            return DB::select( DB::raw($query));
        }else{
            if($portefeuille !="all"){
                return DB::table('operations')->where('portefeuille',$portefeuille)->whereNull("date_cloture")->orderby("id","DESC")->get();
            }else{
                return DB::table('operations')->whereNull("date_cloture")->orderby("id","DESC")->get();
            }
                       
        }
    }

    public function ops_clotures($portefeuille,$filters=""){
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $chapitre = $filters[0];
            $source = $filters[1];

            if($portefeuille !="all"){
                $query = "SELECT * FROM operations WHERE portefeuille = '".$portefeuille."' AND";
            }else{
                $query = "SELECT * FROM operations WHERE ";
            }
            
            if ($chapitre != ""){
                $query = $query." chapitre ='".$chapitre."' AND"; 
            }
            if($source != ""){
                $query = $query." source ='".$source."' AND";
            }
            // if($numero !=""){
            //     $query = $query." numero = '".$numero."' AND";
            // }
            $query= $query." numero !='N?' AND date_cloture IS NOT NULL ORDER BY id DESC";
            // if($order != ""){
            //     $query = $query." ORDER BY ".$order; 
            // }
            //echo $query;
            return DB::select( DB::raw($query));
        }else{
            if($portefeuille !="all"){
                return DB::table('operations')->where('portefeuille',$portefeuille)->whereNotNull("date_cloture")->orderby("id","DESC")->get();
            }else{
                return DB::table('operations')->whereNotNull("date_cloture")->orderby("id","DESC")->get();
            }
                       
        }
    }

    public function operations_ar($portefeuille="all")
    {   
        $user = Auth::user();
        if($portefeuille =="all"){
            $ops = DB::table('operations')->whereNull("date_cloture")->get();
            $programmes = DB::table("programme")->whereNull("parent")->orWhere("parent","")->get();
        }else{
            $ops = DB::table('operations')->where("portefeuille",$portefeuille)->
            whereNull("date_cloture")->get();
            $programmes = DB::table("programme")->where("portefeuille",$portefeuille)
            ->where(function($query) {
                $query->whereNull('parent')
                    ->orWhere("parent","");
            })->get();
            //whereNull("parent")->orWhere("parent","")->get();
        }
        $portefeuilles= DB::table('portefeuille')->orderBy("code","ASC")->get();
        $view = "operations.operations";
        if($this->lang== "fr"){
            $view = "operations.operations_fr";
        }
        return view($view,['user' => $user,"ops"=>$ops,
        "porte"=>$portefeuille,"portefeuilles"=>$portefeuilles,
        "programmes"=>$programmes
        ]);
        
    }
    public function operations_clotures($portefeuille="all")
    {   
        $user = Auth::user();
        if($portefeuille =="all"){
            $ops = DB::table('operations')->whereNotNull("date_cloture")->get();
            $programmes = DB::table("programme")->whereNull("parent")->orWhere("parent","")->get();
        }else{
            $ops = DB::table('operations')->where("portefeuille",$portefeuille)->
            whereNotNull("date_cloture")->get();
            $programmes = DB::table("programme")->where("portefeuille",$portefeuille)
            ->where(function($query) {
                $query->whereNull('parent')
                    ->orWhere("parent","");
            })->get();
        }
        $portefeuilles= DB::table('portefeuille')->orderBy("code","ASC")->get();

        $view = "operations.operations_clotures";
        if($this->lang== "fr"){
            $view = "operations.operations_clotures_fr";
        }
        return view($view,['user' => $user,"ops"=>$ops,
        "porte"=>$portefeuille,"portefeuilles"=>$portefeuilles,
        "programmes"=>$programmes
        ]);
        
    }
    public function view_operation($id){
        $user = Auth::user();
        $op = DB::table('operations')->where('id',$id)->first();
        $q = "SELECT *, engagements.montant as eng_mont, engagements.id as eng_id 
        FROM engagements INNER JOIN deals ON 
        deals.id_deal = engagements.deal INNER JOIN entreprises ON
        entreprises.id = deals.entreprise WHERE engagements.id_op =".$id."
        AND date_visa IS NOT NULL AND deals.parent IS NULL";
        $engs = DB::select(DB::raw($q));
        //return $engs;
        $i = 0;
        foreach($engs as $eng){
            $q = "SELECT SUM(to_pay) as tot_pays FROM payments WHERE id_eng = ".$eng->eng_id." AND
            visa IS NOT NULL";
            $tot_pays = DB::select(DB::raw($q));
            $q1 = "SELECT SUM(engagements.montant) as tot_av FROM engagements INNER JOIN deals
            ON deals.id_deal = engagements.deal WHERE deals.parent = ".$eng->id_deal." 
            AND date_visa IS NOT NULL";

            $tot_av = DB::select(DB::raw($q1));
            //var_dump($tot_av);
            if(isset($tot_pays[0]->tot_pays) && $tot_pays[0]->tot_pays != NULL){
                $engs[$i]->tot_pays = $tot_pays[0]->tot_pays;
            }else{
                $engs[$i]->tot_pays = 0; 
            }
            if(isset($tot_av[0]->tot_av) && $tot_av[0]->tot_av != NULL){
                
                $engs[$i]->eng_mont = $engs[$i]->eng_mont + $tot_av[0]->tot_av;
            }
            $engs[$i]->diff = $engs[$i]->eng_mont - $engs[$i]->tot_pays;
            $i = $i +1;
        }
        $sum_eng = array_sum(array_column($engs, 'eng_mont'));
        $sum_pay = array_sum(array_column($engs, 'tot_pays'));
        $sum_diff = array_sum(array_column($engs, 'diff'));
        //return $engs;
        return view('operations.view_operation',['op'=>$op,"engs"=>$engs,
        "sum_eng"=>$sum_eng,"sum_pay"=>$sum_pay,"sum_diff"=>$sum_diff]);
    }
    public function ajouter_ar(){
        $user = Auth::user();
        $portefeuilles= DB::table('portefeuille')->orderBy("code","ASC")->get();
        $titres= DB::table('titres')->where("type","parent")->orderBy("code","ASC")->get();
        $view = 'operations.ajouter_operation_ar';
        if($this->lang=="fr"){
            $view = 'operations.ajouter_operation_fr';
        }
        return view($view,
        ['user'=>$user,"portefeuilles"=>$portefeuilles,"titres"=>$titres]);
    }
    
    public function modifier_ar($id)
    {
        $user = Auth::user();
        $op = DB::table('operations')->where('id',$id)->first();
        $portefeuilles= DB::table('portefeuille')->orderBy("code","ASC")->get();
        $p = DB::table("portefeuille")->where("code",$op->portefeuille)->first();
        $programmes = DB::table("programme")->whereNull("parent")->where("portefeuille",$p->code)->get();
        $prog = DB::table("programme")->where("code",$op->programme)->first();
        $sous = DB::table("programme")->where("id",$op->sous_programme)->first();
        $sous_ps = DB::table("programme")->where("parent",$prog->code)->get();
        $titres= DB::table('titres')->where("type","parent")->orderBy("code","ASC")->get();

        $op->reevaluation = floatval($op->AP_act) - floatval($op->AP_init);
        $view = 'operations.modifier_operation_ar';
        if($this->lang=="fr"){
            $view = 'operations.modifier_operation_fr';
        }
        return view($view,
        ['user'=>$user,'op'=>$op,
        "portefeuilles"=>$portefeuilles,"p"=>$p,"sous"=>$sous,"titres"=>$titres,
        "programmes"=>$programmes,"prog"=>$prog,"sous_ps"=>$sous_ps]);
    }

    public function add_op_ar(Request $request){
        $user = Auth::user()->id;
        $portefeuille = $request['portefeuille'];
        $programme = $request['programme'];
        $sous_programme = $request['sous_id'];
        $annee = $request['annee'];
        $numero = $request['numero'];
        $intitule = $request['intitule'];
        $intitule_ar = $request['intitule_ar'];
        $date = $request['date'];
        $source = $request['source'];

        $AP_init = floatval($request['AP_init']);
        $reevaluation = 0;
        $AP_act = $AP_init;
        $activite = $request['activite'];    
        $sous_action = $request['sous_action']; 
        $num_cloture = NULL;
        $date_cloture = NULL;
        $id = DB::table('operations')->
        insertGetId(["portefeuille"=>$portefeuille,"programme"=>$programme,"sous_action"=>$sous_action,
        "sous_programme"=>$sous_programme,'numero'=>$numero,'intitule'=>$intitule,
        'intitule_ar'=>$intitule_ar,'date'=>$date,'source'=>$source,'annee'=>$annee,
        'AP_init'=>$AP_init,'reevaluation'=>$reevaluation,'AP_act'=>$AP_act,
        "activite"=>$activite,'num_cloture'=>$num_cloture,
        'date_cloture'=>$date_cloture,"user_id"=>$user]);
        return Redirect::to('/operations_ar/all');
    }

    public function update_op_ar(Request $request){
        $user = Auth::user();
        $id = $request['id_op'];
        if($user->service =="Comptabilité"){
            $portefeuille = $request['portefeuille'];
            $programme = $request['programme'];
            $sous_programme = $request['sous_id'];
            $annee = $request['annee'];
            $numero = $request['numero'];
            $intitule = $request['intitule'];
            $intitule_ar = $request['intitule_ar'];
            $date = $request['date'];
            $source = $request['source'];
            $AP_init = floatval($request['AP_init']);
            $reevaluation = floatval($request['reevaluation']);
            $AP_act = floatval($AP_init) + $reevaluation;
            $activite = $request['activite']; 
            $sous_action = $request['sous_action']; 
            $num_cloture = $request['num_cloture'];
            $date_cloture = $request['date_cloture'];
            DB::table('operations')->where('id',$id)->
            update(["portefeuille"=>$portefeuille,"programme"=>$programme,"sous_action"=>$sous_action,
            "sous_programme"=>$sous_programme,'numero'=>$numero,'intitule'=>$intitule,
            'intitule_ar'=>$intitule_ar,'date'=>$date,'source'=>$source,'annee'=>$annee,
            'AP_init'=>$AP_init,'reevaluation'=>$reevaluation,'AP_act'=>$AP_act,
            "activite"=>$activite,'num_cloture'=>$num_cloture,
            'date_cloture'=>$date_cloture]);
        }elseif($user->service =="Suivi"){
            
            $taux = $request['taux'];
            $observations = $request['observations'];   
            DB::table('operations')->where('id',$id)->
            update(['taux'=>$taux,"observations"=>$observations]);
        }elseif($user->service =="Cloture"){
            $num_cloture = $request['num_cloture'];
            $date_cloture = $request['date_cloture'];     

            DB::table('operations')->where('id',$id)->
            update(['num_cloture'=>$num_cloture,'date_cloture'=>$date_cloture]);

        }
 
        return Redirect::to('/operations_ar/all');
    }
    
}
