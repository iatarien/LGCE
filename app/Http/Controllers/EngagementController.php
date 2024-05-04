<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use stdClass;
class EngagementController extends Controller
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

     public function ajouter($type,$id=""){
        $user = Auth::user();
        #$chapitre = explode(",",$user->chapitre);
        $operations = DB::table('operations')->
        select('id','numero','intitule_ar',"intitule")->where("user_id",$user->id)->
        whereNull("date_cloture")->orderBy('id',"DESC")->get();

        $retrait = "";
        $the_op = "";

        $deal = null;
        $parent = null;
        if($id != ""){
            $deal = DB::table("deals")->
            join("operations","deals.id_op","=","operations.id")->
            leftjoin("entreprises","entreprises.id","=","deals.entreprise")->
            where('id_deal',$id)->first();
            if($deal->deal_type == "ملحق" || $deal->deal_type == "avenant"){
                $parent = DB::table("deals")->where('id_deal',$deal->parent)->first();
            }

        }

        $view ='engs.ajouter_eng';
        if($this->lang =="fr"){
            $view ='engs.ajouter_eng_fr';
        }
        $titres = DB::table("titres")->where("type","=","parent")->orderBy("id_titre","ASC")->get();
        for($i =0; $i< count($titres); $i++){
            $titres[$i]->sous_titres = DB::table("titres")->where("father","=",$titres[$i]->id_titre)->orderBy("id_titre")->get();
        }
        
        return view($view,['user'=>$user,"type"=>$type,"deal"=>$deal,
        'operations'=>$operations,"id_retrait"=>$retrait,"the_op"=>$the_op,
        "titres"=>$titres,"parent"=>$parent]);
    }
    public function modifier($id){
        $user = Auth::user();
        $eng = DB::table('engagements')->where('id',$id)->first();
        $the_op = $eng->id_op;
        $type = $eng->type;
        $deal = null;
        $parent = null;
        if($type =="eng"){
            $deal = DB::table("deals")->
            join("operations","deals.id_op","=","operations.id")->
            leftjoin("entreprises","entreprises.id","=","deals.entreprise")->
            where('id_deal',$eng->deal)->first();
            if($deal->deal_type == "ملحق" || $deal->deal_type == "avenant"){
                $parent = DB::table("deals")->where('id_deal',$deal->parent)->first();
            }

        }else{
            $del = "SELECT *, id as id_op FROM operations WHERE id = ".$eng->id_op;
            $deal = DB::select(DB::raw($del))[0];
        }

        $q_titres = "SELECT * FROM titres WHERE type ='parent' AND id_titre IN 
        (SELECT father FROM titres WHERE id_titre IN 
        (SELECT sous_titre FROM rebriques WHERE id_eng =".$id." 
          ) ) ORDER BY id_titre ASC";
        $eng->titres = DB::select(DB::raw($q_titres));
        for($i =0; $i<count($eng->titres); $i = $i +1){
            $qq = "SELECT *,rebriques.type as type
            from rebriques INNER JOIN titres ON
            titres.id_titre = rebriques.sous_titre WHERE  
            father = ".$eng->titres[$i]->id_titre."  
            AND id_eng = ".$id." ORDER BY sous_titre ASC ";
            $rebriques = DB::select(DB::raw($qq));
            // $rebriques = $this->unique_multidimensional_array( $rebriques, 
            // "sous_titre");
            $eng->titres[$i]->rebriques = $rebriques;
            $eng->titres[$i]->sums = array(
               "AP" => array_sum(array_column($rebriques, 'sous_AP')),
               "cumul" => array_sum(array_column($rebriques, 'sous_cumul')),
               "montant" => array_sum(array_column($rebriques, 'sous_montant')),
               "montant_1" => array_sum(array_column($rebriques, 'sous_montant_1')),
               "montant_2" => array_sum(array_column($rebriques, 'sous_montant_2')),
            ); 
        }
        
        
        $view ='engs.modifier_eng';
        if($this->lang =="fr"){
            $view ='engs.modifier_eng_fr';
        }
        $titres = DB::table("titres")->where("type","=","parent")->orderBy("id_titre","ASC")->get();
        for($i =0; $i< count($titres); $i++){
            $titres[$i]->sous_titres = DB::table("titres")->where("father","=",$titres[$i]->id_titre)->get();
        }
        
        return view($view,['user'=>$user,"type"=>$type,"deal"=>$deal,"eng"=>$eng,
        "titres"=>$titres,"parent"=>$parent,'the_op'=>$the_op]);
    }
    public function fiche_eng($id){
        $user = Auth::user();
        $eng = DB::table('engagements')->select("*","engagements.id as id_eng")
        ->join("operations",'engagements.id_op','=','operations.id')->
        where('engagements.id',$id)->first();
        
        $e = "";
        $type = $eng->type;
        if($type =='eng' ){
            $ze_deal = DB::table('deals')->where('id_deal',$eng->deal)->first();
            $e = DB::table('entreprises')->select('name')->
            where('id',$ze_deal->entreprise)->first();
            $e = $e->name;
            $deal = $ze_deal->deal_type;
            $deal_num = $ze_deal->deal_num;
            $deal_date = $ze_deal->deal_date;
        }
        $sujet = $eng->real_sujet; 
        $sous = DB::table("programme")->where("id",$eng->sous_programme)->first();
        if($sous == NULL){
            $sous = (object) [];
            $sous->code = "";
            $sous->designation = "";
            
        }
        $q_titres = "SELECT * FROM titres WHERE type ='parent' AND id_titre IN 
        (SELECT father FROM titres WHERE id_titre IN 
        (SELECT sous_titre FROM rebriques WHERE id_eng =".$id." 
         ) ) ORDER BY id_titre ASC";
        $titres = DB::select(DB::raw($q_titres));

        $q_titres1 = "SELECT * FROM titres WHERE type ='parent' AND id_titre IN 
        (SELECT father FROM titres WHERE id_titre IN 
        (SELECT sous_titre FROM rebriques WHERE id_eng =".$id." AND sous_montant != 0
         ) ) AND id_titre != 128 ORDER BY id_titre ASC";

        $titres1 = DB::select(DB::raw($q_titres1));

        //$rebriques = DB::table('rebriques')->where('id_eng',$id)->get();
        $tots = new stdClass();
        $tots->AP = 0;
        $tots->cumul = 0;
        $tots->montant = 0;
        $tots->montant_1 = 0;
        $tots->montant_2 = 0;
        
        for($i =0; $i<count($titres); $i = $i +1){
            $qq = "SELECT *
            from rebriques INNER JOIN titres ON
            titres.id_titre = rebriques.sous_titre WHERE  
            father = ".$titres[$i]->id_titre."  
            AND id_eng = ".$id." ORDER BY sous_titre ASC ";
            $rebriques = DB::select(DB::raw($qq));
            // $rebriques = $this->unique_multidimensional_array( $rebriques, 
            // "sous_titre");
            $titres[$i]->rebriques = $rebriques;
            $sum_AP = array_sum(array_column($rebriques, 'sous_AP'));
            $sum_cumul = array_sum(array_column($rebriques, 'sous_cumul'));
            $sum_montant = array_sum(array_column($rebriques, 'sous_montant'));
            $sum_montant_1 = array_sum(array_column($rebriques, 'sous_montant_1'));
            $sum_montant_2 = array_sum(array_column($rebriques, 'sous_montant_2'));
            $titres[$i]->sums = array(
               "AP" => $sum_AP,
               "cumul" => $sum_cumul,
               "montant" => $sum_montant,
               "montant_1" => $sum_montant_1,
               "montant_2" => $sum_montant_2,
            ); 
            $tots->AP += $sum_AP;
            $tots->cumul += $sum_cumul;
            $tots->montant += $sum_montant;
            $tots->montant_1 += $sum_montant_1;
            $tots->montant_2 += $sum_montant_2;
        }

        for($i =0; $i<count($titres1); $i = $i +1){
            $qq = "SELECT *
            from rebriques INNER JOIN titres ON
            titres.id_titre = rebriques.sous_titre WHERE id_eng = ".$id." 
            AND father = ".$titres1[$i]->id_titre."
            ORDER BY sous_titre ASC ";
            $rebriques = DB::select(DB::raw($qq));
            // $rebriques = $this->unique_multidimensional_array( $rebriques, 
            // "sous_titre");
            $titres1[$i]->rebriques = $rebriques;

            $titres1[$i]->sums = array(
               "AP" => array_sum(array_column($rebriques, 'sous_AP')),
               "cumul" => array_sum(array_column($rebriques, 'sous_cumul')),
               "montant" => array_sum(array_column($rebriques, 'sous_montant')),
               "montant_1" => array_sum(array_column($rebriques, 'sous_montant_1')),
               "montant_2" => array_sum(array_column($rebriques, 'sous_montant_2')),
            ); 
        }
        $les_nums = explode("/",$eng->numero_fiche); if(count($les_nums) > 1){ $le_num = $les_nums[1]; }else{ $le_num = $les_nums[0]; } 
		$is_first = "false";
		if((int) $le_num == 1 && $eng->type =="decision"){
			$is_first = "true";
		}
        $previous = DB::table('engagements')->where('id_op',$eng->id_op)->where('id',"<",$id)->first();
        $insc = "false";
        if($previous == NULL && $is_first =="true"){
            $insc = "true";
        }
        
        $the_view = 'engs.fiche_eng';
        if($this->lang =="fr"){
            $the_view = 'engs.fiche_eng_fr';
        }
        if($this->ville_fr =="Djanet" || $this->ville_fr =="djanet" ||
        $this->ville_fr =="Illizi" || $this->ville_fr =="illizi"){
            $the_view = 'engs.djanet';
        }
        if($this->direction_fr =="Direction des Travaux Publics" && $this->ville_fr =="Ouled Djellal"){
            $the_view = 'engs.dtp51';
        }
        // var_dump($tots);
        // return "";
        return view($the_view,['user'=>$user,"type"=>$eng->type,"insc"=>$insc,"tots"=>$tots,
        "eng"=>$eng,'id'=>$id,"sous"=>$sous,"titres"=>$titres,"titres1"=>$titres1]);
        
    }
    public function engagements($type="")
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND 
        id IN (SELECT DISTINCT id_op from engagements) ORDER BY id DESC";
        $q = "SELECT * FROM entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals )";
        if($type == ""){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
            (SELECT DISTINCT id_op from engagements WHERE 
            engagements.user_id =".$user->id." ) ORDER BY id DESC";
            $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals WHERE deals.user_id =".$user->id." )";
        }
        
        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = 'engs.engagements';
        if($this->lang =="fr"){
            $view = 'engs.engagements_fr';
        }
        return view($view,["user"=>$user,"type"=>$type,"operations"=>$operations,"es"=>$es]);
    }
    public function delais($type="")
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND 
        id IN (SELECT DISTINCT id_op from engagements) ORDER BY id DESC";
        $q = "SELECT * FROM entreprises";
        if($type == ""){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
            (SELECT DISTINCT id_op from engagements WHERE 
            engagements.user_id =".$user->id." ) ORDER BY id DESC";
            $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals WHERE deals.user_id =".$user->id." )";
        }
        
        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = 'engs.delais';
        if($this->lang =="fr"){
            $view = 'engs.delais_fr';
        }
        return view($view,["user"=>$user,"type"=>$type,"operations"=>$operations,"es"=>$es]);
    }
    public function get_engs_delai($type="",$filters=""){
        $user = Auth::user();
        $first_type = $type;
        if($type == "" or $type == "all" or $type=="borderau" or $type=="ajouter_pay" ){
            $type = "'eng','juridique','comptable','inscription','decision','fiche_eco','FSDRS','mixte'";
        }else if($type == "juridique,FSDRS,mixte"){
            $type = "'juridique','FSDRS','mixte'";
        }else if($type == "juridique,mixte"){
            $type = "'juridique','mixte'";
        }else{
            $type = "'".$type."'";
        }
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $year = $filters[2];
            $type = $filters[3];
            $user_id = "";
            if(isset($filters[4])){
                $user_id = $filters[4];
            }
            if($type =="" or $type=="all"){
                if($first_type =="eng" || $first_type =="ajouter_pay"){
                    $type = "'eng'";
                }else{
                    $type = "'eng','decision','reevaluation'";
                }
                
            }else{
                $type = "'".$type."'";
            }
            
            $query = "SELECT *,e.montant as montant, e.user_id as user_id, e.id 
            as eng_id FROM engagements e INNER JOIN 
            operations ON e.id_op = operations.id INNER JOIN 
            deals ON e.deal = deals.id_deal
            INNER JOIN entreprises ON deals.entreprise = entreprises.id 
            WHERE type IN (".$type.") AND ( deals.parent IS NULL OR deals.parent =0) AND ";
            if($first_type =="ajouter_pay"){
                $query = $query." ( deals.parent IS NULL OR deals.parent =0) AND";
            }
            

            if($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND";
            }
            if($e != ""){
                $query = $query." deals.entreprise ='".$e."' AND";
            }
            if($year != ""){
                $query = $query." e.numero_fiche LIKE '%".$year."%' AND";
            }
            if($user_id != ""){
                $query = $query." e.user_id ='".$user_id."' AND";
            }
            if($first_type == "borderau"){
                $query= $query." e.date_visa IS NULL ORDER BY eng_id DESC LIMIT 100";
            }else{
                if($user->service !="Comptabilité"){
                    $query= $query." e.date_visa IS NOT NULL ORDER BY eng_id DESC LIMIT 200";
                }else{
                    $query= $query." 1 ORDER BY eng_id DESC LIMIT 100";
                }
            }
            //echo $real_type;
            //return $query;
            $engs =  DB::select( DB::raw($query));
            foreach($engs as $eng){
                $eng->delai = app('App\Http\Controllers\ODSController')->delai($eng->eng_id);
            }
            return $engs;
        }else{
            if($user->service !="Comptabilité"){
                $query = "SELECT *, e.id as eng_id FROM engagements e 
                INNER JOIN operations ON e.id_op = operations.id 
                INNER JOIN deals ON e.deal = deals.id_deal
                INNER JOIN entreprises ON deals.entreprise = entreprises.id 
                WHERE type IN (".$type.") AND ( deals.parent IS NULL OR deals.parent =0) AND 
                e.date_visa IS NOT NULL ORDER BY eng_id DESC LIMIT 50";
            }else{
                if($first_type =="borderau"){
                    $query = "SELECT *, e.id as eng_id FROM engagements e 
                    INNER JOIN operations ON e.id_op = operations.id 
                    INNER JOIN deals ON e.deal = deals.id_deal
                    INNER JOIN entreprises ON deals.entreprise = entreprises.id 
                    WHERE type IN (".$type.") AND ( deals.parent IS NULL OR deals.parent =0) AND 
                    e.date_visa IS NULL ORDER BY eng_id DESC LIMIT 50";
                }else{
                    $query = "SELECT *, e.id as eng_id FROM engagements e 
                    INNER JOIN operations ON e.id_op = operations.id 
                    INNER JOIN deals ON e.deal = deals.id_deal
                    INNER JOIN entreprises ON deals.entreprise = entreprises.id 
                    WHERE type IN (".$type.") AND ( deals.parent IS NULL OR deals.parent =0) AND 1
                    ORDER BY eng_id DESC LIMIT 50";
                }
                
            }
            
            $engs =  DB::select( DB::raw($query));
            foreach($engs as $eng){
                $eng->delai = app('App\Http\Controllers\ODSController')->delai($eng->eng_id);
            }
            return $engs;
        }
    }
    public function get_engs($type="",$filters=""){
        $user = Auth::user();
        $first_type = $type;
        if($type == "" or $type == "all" or $type=="borderau" or $type=="ajouter_pay" or $first_type =="add_att" ){
            $type = "'eng','decision','reevaluation'";
        }else if($type == "juridique,FSDRS,mixte"){
            $type = "'juridique','FSDRS','mixte'";
        }else if($type == "juridique,mixte"){
            $type = "'juridique','mixte'";
        }else{
            $type = "'".$type."'";
        }
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $year = $filters[2];
            $type = $filters[3];
            $user_id = "";
            if(isset($filters[4])){
                $user_id = $filters[4];
            }
            if($type =="" or $type=="all"){
                if($first_type =="eng" || $first_type =="ajouter_pay" || $first_type =="add_att"){
                    $type = "'eng'";
                }else{
                    $type = "'eng','decision','reevaluation'";
                }
                
            }else{
                $type = "'".$type."'";
            }
            
            $query = "SELECT *,e.montant as montant, e.user_id as user_id, e.id 
            as eng_id FROM engagements e INNER JOIN 
            operations ON e.id_op = operations.id LEFT JOIN 
            deals ON e.deal = deals.id_deal
            LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
            WHERE type IN (".$type.") AND";
            if($first_type =="ajouter_pay" || $first_type =="add_att"){
                $query = $query." ( deals.parent IS NULL OR deals.parent =0) AND";
            }
            

            if($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND";
            }
            if($e != ""){
                $query = $query." deals.entreprise ='".$e."' AND";
            }
            if($year != ""){
                $query = $query." e.numero_fiche LIKE '%".$year."%' AND";
            }
            if($user_id != ""){
                $query = $query." e.user_id ='".$user_id."' AND";
            }
            if($first_type == "borderau"){
                $query= $query." e.date_visa IS NULL ORDER BY eng_id DESC LIMIT 100";
            }else{
                if($user->service !="Comptabilité"){
                    $query= $query." e.date_visa IS NOT NULL ORDER BY eng_id DESC LIMIT 200";
                }else{
                    $query= $query." 1 ORDER BY eng_id DESC LIMIT 100";
                }
            }
            //echo $real_type;
            //return $query;
            return DB::select( DB::raw($query));
        }else{
            if($user->service !="Comptabilité"){
                $query = "SELECT *, e.id as eng_id,e.user_id as user_id, e.montant as montant FROM engagements e 
                INNER JOIN operations ON e.id_op = operations.id 
                LEFT JOIN deals ON e.deal = deals.id_deal
                LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
                WHERE type IN (".$type.") AND e.date_visa IS NOT NULL ORDER BY eng_id DESC LIMIT 50";
            }else{
                if($first_type =="borderau"){
                    $query = "SELECT *, e.id, as eng_id,e.user_id as user_id, e.montant as montant FROM engagements e 
                    INNER JOIN operations ON e.id_op = operations.id 
                    LEFT JOIN deals ON e.deal = deals.id_deal
                    LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
                    WHERE type IN (".$type.") AND e.date_visa IS NULL ORDER BY eng_id DESC LIMIT 50";
                }else{
                    $query = "SELECT *, e.id as eng_id,e.user_id as user_id, e.montant as montant  FROM engagements e 
                    INNER JOIN operations ON e.id_op = operations.id 
                    LEFT JOIN deals ON e.deal = deals.id_deal
                    LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
                    WHERE type IN (".$type.") ORDER BY eng_id DESC LIMIT 50";
                }
                
            }
            //return $query;
            return DB::select( DB::raw($query));
        }
    }
    public function delete($id){
        $q = "DELETE FROM reb_pay WHERE id IN ( SELECT rebrique FROM payments WHERE id_eng =".$id." )";
        DB::delete( DB::raw($q));
        DB::table("payments")->where("id_eng",$id)->delete();
        DB::table("engagements")->where("id",$id)->delete();
        DB::table("rebriques")->where("id_eng",$id)->delete();
        
        return redirect('/engagements');
    }
    function unique_multidimensional_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
        
        foreach($array as $val) {
            //var_dump($val->sous_titre);
            if (!in_array($val->sous_titre, $key_array)) {
                $key_array[$i] = $val->sous_titre;
                $temp_array[$i] = $val;
                $i++;
            }
            
        }
        return $temp_array;
    }
    public function get_last($id_op){
        $query = "SELECT *, engagements.id as eng_id from engagements RIGHT JOIN operations ON
        engagements.id_op = operations.id
        WHERE operations.id =".$id_op." ORDER BY engagements.id DESC LIMIT 1 ";
        $eng = DB::select( DB::raw($query));
        $eng = (array) $eng;
        if(isset($eng[0]->eng_id) && $eng[0]->eng_id != NULL){
            $rebriques = DB::table('rebriques')->
            where('id_eng',$eng[0]->eng_id)->orderBy('id_reb',"DESC")->get();
            // $rebriques = $this->unique_multidimensional_array( $rebriques, 
            // "sous_titre");
 
            foreach($rebriques as $reb){
                $q = "SELECT SUM(sous_montant) as real_cumul from rebriques WHERE type ='eng'
                AND id_op =".$id_op." AND sous_titre = ".$reb->sous_titre;
                $reb->real_cumul = DB::select( DB::raw($q))[0]->real_cumul;
            }
        }else{
            $rebriques = null;
        }
        
        $eng[0]->rebriques = $rebriques;
        return $eng;
    }
    public function get_last_fiche($id_op){
        $query = "SELECT numero_fiche from engagements WHERE id_op =".$id_op." ORDER BY id DESC LIMIT 1 ";
        
        return DB::select( DB::raw($query));
    }
   

    public function get_engs_vise($type="",$filters=""){
        $query = "SELECT *, e.id as eng_id, e.montant as montant FROM engagements e 
            INNER JOIN operations ON e.id_op = operations.id 
            INNER JOIN deals ON deals.id_deal = e.deal
            LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
            WHERE num_visa IS NOT NULL AND ( ( deals.parent IS NULL OR deals.parent =0) OR deals.parent = 0 ) AND ";
             
        if($type == "" or $type == "all"){
            $type = "'eng','decision','reevaluation'";
        }else{
            $type = "'".$type."'";
        } 
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $query = $query." type IN (".$type.") AND";
            if($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND";
            }
            if($e != ""){
                $query = $query." deals.entreprise ='".$e."' AND";
            }
            $query= $query." 1 ORDER BY eng_id DESC LIMIT 100";
            //return $query;
            return DB::select( DB::raw($query));
        }else{
            $query =$query." 1 ORDER BY eng_id DESC LIMIT 100";
            //return $query;
            return DB::select( DB::raw($query));
        }
    }

    

    public function add_eng(Request $request){
        $id_op = $request['id_op'];
        $numero_fiche = $request['numero_fiche'];
        $real_sujet = $request['real_sujet'];
        $type = $request['type'];
        if($type =="decision" || $type == "reevaluation"){
            $deal =null;
        }else{
            $deal = $request["deal"];
        }

        $montant = 0;

        $num_visa = $request['num_visa'];
        $date_visa = $request['date_visa'];
        $user_id = Auth::user()->id;

        $id = DB::table('engagements')->insertGetId(['id_op'=>$id_op,
        "numero_fiche"=>$numero_fiche,"real_sujet"=>$real_sujet,
        "type"=>$type,"deal"=>$deal,"montant"=>$montant,
        "num_visa"=>$num_visa,"date_visa"=>$date_visa,
        "user_id"=>$user_id,"inserted_at"=>Date('Y-m-d'),"updated_at"=>NULL]);
    
        $titres = DB::table('titres')->where('type',"")->get();
        foreach($titres as $sous_titre){
            $sous_AP = $request['AP_sous_'.$sous_titre->id_titre];
            $sous_cumul = $request['cumul_sous_'.$sous_titre->id_titre];
            $sous_montant_1 = $request['montant_1_sous_'.$sous_titre->id_titre];
            $sous_montant = $request['montant_sous_'.$sous_titre->id_titre];
            $sous_montant_2 = $request['montant_2_sous_'.$sous_titre->id_titre];

            if($sous_montant != NULL && $sous_montant != ""){
                if($sous_montant_1 != NULL && $sous_montant_2 != NULL
                && $sous_AP != NULL && $sous_cumul != NULL){
                DB::table('rebriques')->insert([
                    "id_op"=>$id_op,"id_eng"=>$id,"type"=>$type,
                    "sous_titre"=>$sous_titre->id_titre,
                    "sous_AP"=>$sous_AP,"sous_cumul"=>$sous_cumul,
                    "sous_montant_1"=>$sous_montant_1,
                    "sous_montant"=>$sous_montant,
                    "sous_montant_2"=>$sous_montant_2,
                ]);
                }
                $montant = $montant + $sous_montant;
            }
        }
        DB::table('engagements')->where('id',$id)->update(['montant'=>$montant]);
        if($type =='reevaluation'){
            DB::table('operations')->where('id',$id_op)->
            increment("AP_act",$montant);
        }

        return Redirect::to('/fiche_eng/'.$id);
    }
    public function update_eng(Request $request){
        $id_op = $request['id_op'];
        $id = $request['id'];
        $numero_fiche = $request['numero_fiche'];
        $real_sujet = $request['real_sujet'];
        $type = $request['type'];

        $num_visa = $request['num_visa'];
        $date_visa = $request['date_visa'];
        $montant = 0;
        $eng0 = DB::table('engagements')->where("id",$id)->first();
        DB::table('engagements')->where("id",$id)->
        update(["numero_fiche"=>$numero_fiche,"real_sujet"=>$real_sujet,
        "type"=>$type,"montant"=>$montant,
        "num_visa"=>$num_visa,"date_visa"=>$date_visa,"updated_at"=>Date('Y-m-d')]);
        DB::table('rebriques')->where('id_eng',$id)->delete();
        $titres = DB::table('titres')->where('type',"")->get();
        foreach($titres as $sous_titre){
            $sous_AP = $request['AP_sous_'.$sous_titre->id_titre];
            $sous_cumul = $request['cumul_sous_'.$sous_titre->id_titre];
            $sous_montant_1 = $request['montant_1_sous_'.$sous_titre->id_titre];
            $sous_montant = $request['montant_sous_'.$sous_titre->id_titre];
            $sous_montant_2 = $request['montant_2_sous_'.$sous_titre->id_titre];
            
            
            if($sous_montant != NULL && $sous_montant != ""){
                if($sous_montant_1 != NULL && $sous_montant_2 != NULL
                && $sous_AP != NULL && $sous_cumul != NULL){
                DB::table('rebriques')->insert([
                    "id_op"=>$id_op,"id_eng"=>$id,"type"=>$type,
                    "sous_titre"=>$sous_titre->id_titre,
                    "sous_AP"=>$sous_AP,"sous_cumul"=>$sous_cumul,
                    "sous_montant_1"=>$sous_montant_1,
                    "sous_montant"=>$sous_montant,
                    "sous_montant_2"=>$sous_montant_2,
                ]);
                // var_dump($sous_titre->id_titre);
                // var_dump($sous_montant);
                }
                $montant = $montant + $sous_montant;
            }
        }
        DB::table('engagements')->where('id',$id)->update(['montant'=>$montant]);
        if($type =='reevaluation'){
            $mont = $eng0->montant * -1;
            DB::table('operations')->where('id',$id_op)->
            increment("AP_act",$mont);
            DB::table('operations')->where('id',$id_op)->
            increment("AP_act",$montant);
        }
        return Redirect::to('/updating_fiches/'.$id);
    }

    public function get_eng($id){
        
        // $eng =  DB::table('engagements')->join('entreprises',"engagements.entreprise_id","=","entreprises.id")->join('banks',"banks.id","=","engagements.bank_id")->where('engagements.id',$id)->first();
        // return json_encode($eng);
        $query ="SELECT *,engagements.montant as montant_eng FROM engagements 
        INNER JOIN operations ON engagements.id_op = operations.id 
        LEFT JOIN deals ON engagements.deal = deals.id_deal
        LEFT JOIN entreprises ON entreprises.id = deals.entreprise 
        LEFT JOIN banks ON deals.bank = banks.id 
        WHERE engagements.id = ".$id;
        return DB::select(DB::raw($query));  
    }
    public function whatever($array, $key, $val) {
        // var_dump($array);
        // var_dump($val);
        foreach ($array as $item){
            $item = (array) $item;
            if (isset($item[$key]) && $item[$key] == $val){
                //var_dump($item[$key]);
                return true;
            }
        } 
        return false;
    }
    public function merge_rebs($array1, $array2){
        
        foreach($array2->reb as $ele){
            if(!$this->whatever($array1->reb,"sous_titre",$ele->sous_titre)){
                $ele->sous_montant_1 = $ele->sous_montant_2;
                $ele->sous_montant = 0;
                array_push($array1->reb,$ele);
            }
        }
        return $array1;
    }
    public function updating_fiches($id){
        $user = Auth::user();
        $eng = DB::table('engagements')->where('engagements.id',$id)->first();
        //echo " i : 0, etude_ 2 : ".$eng->etude_2.", etude : ".$eng->etude."<tr><br>";
        
        $engs= DB::table('engagements')->where('id_op',$eng->id_op)->where('engagements.id',">=",$id)->orderBy("id","ASC")->get();
        if(count($engs) < 2){
            return Redirect::to('/fiche_eng/'.$id);   
        }

        
        for($j = 0; $j< count($engs); $j++){

            $reb_q = "SELECT *, rebriques.type as type FROM rebriques 
            WHERE id_op = ".$eng->id_op." AND id_eng = ".$engs[$j]->id." AND
            (  sous_montant_2 <> 0 or sous_montant <> 0 or sous_montant_1 <> 0 ) ORDER BY sous_titre ASC";
            
            $engs[$j]->reb = DB::select(DB::raw($reb_q));
        }
        for($j = 1; $j< count($engs); $j++){
            $engs[$j] = $this->merge_rebs($engs[$j],$engs[$j-1]);
            DB::table('rebriques')->where('id_eng',$engs[$j]->id)->delete();
            for($i=0; $i<count($engs[$j]->reb); $i++ ){

                if(isset($engs[$j-1]->reb[$i])){
                    if($engs[$j]->reb[$i]->type == "eng"  ){

                        $engs[$j]->reb[$i]->sous_montant_2 = floatval($engs[$j-1]->reb[$i]->sous_montant_2) - floatval($engs[$j]->reb[$i]->sous_montant); 
                        $engs[$j]->reb[$i]->sous_montant_1 = floatval($engs[$j-1]->reb[$i]->sous_montant_2); 
                        $engs[$j]->reb[$i]->sous_AP = floatval($engs[$j-1]->reb[$i]->sous_AP); 
                        if($engs[$j-1]->reb[$i]->type =="eng"){
                            $engs[$j]->reb[$i]->sous_cumul = floatval($engs[$j-1]->reb[$i]->sous_cumul) + floatval($engs[$j-1]->reb[$i]->sous_montant); 
                        }else{
                            $engs[$j]->reb[$i]->sous_cumul = floatval($engs[$j-1]->reb[$i]->sous_cumul); 
                        }
                        

                    }else{
                        
                        $engs[$j]->reb[$i]->sous_montant_2 = floatval($engs[$j-1]->reb[$i]->sous_montant_2) + floatval($engs[$j]->reb[$i]->sous_montant); 
                        $engs[$j]->reb[$i]->sous_montant_1 = floatval($engs[$j-1]->reb[$i]->sous_montant_2); 
                        $engs[$j]->reb[$i]->sous_AP = floatval($engs[$j-1]->reb[$i]->sous_AP) + floatval($engs[$j]->reb[$i]->sous_montant);; 

                        //var_dump($engs[$j-1]->reb[$i]->sous_AP);

                        if($engs[$j-1]->reb[$i]->type =="eng"){

                            $engs[$j]->reb[$i]->sous_cumul = floatval($engs[$j-1]->reb[$i]->sous_cumul) + floatval($engs[$j-1]->reb[$i]->sous_montant); 
                        }else{
                            $engs[$j]->reb[$i]->sous_cumul = floatval($engs[$j-1]->reb[$i]->sous_cumul); 
                        }
                    }

        
                    DB::table('rebriques')->insert([
                        "id_op"=>$eng->id_op,"id_eng"=>$engs[$j]->id,"type"=>$engs[$j]->type,
                        "sous_titre"=>$engs[$j]->reb[$i]->sous_titre,
                        "sous_montant_2"=>$engs[$j]->reb[$i]->sous_montant_2,
                        "sous_montant"=>$engs[$j]->reb[$i]->sous_montant,
                        "sous_montant_1"=>$engs[$j]->reb[$i]->sous_montant_1,
                        "sous_cumul"=>$engs[$j]->reb[$i]->sous_cumul,
                        "sous_AP"=>$engs[$j]->reb[$i]->sous_AP
                    ]);
                }    
            }
        //     var_dump($engs[$j-1]->reb);
        //     echo"<br><br><br>";
        }
        // var_dump($engs[$j-1]->reb);
        // echo"<br><br><br>";
        //return;
        return Redirect::to('/fiche_eng/'.$id);     
    }


    public function print_engs($filters){
        $user = Auth::user();
        $type = "'eng','decision','reevaluation'";
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[0]);
            $e = $filters[1];
            $year = $filters[2];
            $type = $filters[3];
            $user_id = "";
            if(isset($filters[4])){
                $user_id = $filters[4];
            }
            
            if($type =="" or $type=="all"){
                $type = "'eng','decision','reevaluation'";
            }else{
                $type = "'".$type."'";
            }
            $query = "SELECT *,e.montant as montant, e.user_id as user_id, e.id 
            as eng_id FROM engagements e INNER JOIN 
            operations ON e.id_op = operations.id LEFT JOIN 
            deals ON e.deal = deals.id_deal
            LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
            WHERE type IN (".$type.") AND";
            
            if($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND";
            }
            if($e != ""){
                $query = $query." deals.entreprise ='".$e."' AND";
            }
            if($year != ""){
                $query = $query." e.numero_fiche LIKE '%".$year."%' AND";
            }
            if($user_id != ""){
                $query = $query." e.user_id ='".$user_id."' AND";
            }
            $query= $query." 1 ORDER BY eng_id DESC LIMIT 100";
            //echo $real_type;
            //return $query;
            $engs = DB::select( DB::raw($query));
        }else{

                    $query = "SELECT *, e.id as eng_id FROM engagements e 
                    INNER JOIN operations ON e.id_op = operations.id 
                    LEFT JOIN deals ON e.deal = deals.id_deal
                    LEFT JOIN entreprises ON deals.entreprise = entreprises.id 
                    WHERE type IN (".$type.") ORDER BY eng_id DESC LIMIT 50";


            $engs = DB::select( DB::raw($query));
        }
        $n = ceil(count($engs)/7);
        //echo count($engs);
        //echo $n;
        //return $query;
        $view = 'engs.print_engs';
        if($this->lang =="fr"){
            $view ='engs.print_engs_fr';
        }
        return view($view,["engs"=>$engs,"n"=>$n]);

    }  
    
}
