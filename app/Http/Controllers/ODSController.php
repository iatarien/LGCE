<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class ODSController extends Controller
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

    public function somme_arret($id,$id_ods){
        $id_ods = intVal($id_ods);
        $eng = DB::table('engagements')
        ->join('deals',"engagements.deal","=","deals.id_deal")
        ->where('engagements.id',$id)->first();
        if($eng == null){
            return "";
        }
        $q = "SELECT SUM(duree) as ze_durees FROM deals WHERE id_deal IN 
        (SELECT deal FROM engagements WHERE num_visa IS NOT NULL) AND
        parent = ".$eng->deal;
        $ze_duress = DB::select(DB::raw($q))[0]->ze_durees;
        $odss = DB::table("ods")->where('id_eng',$id)->where("id","<=",$id_ods)->orderBy('id','ASC')->get();

        $duree = intval($eng->duree) + intval($ze_duress);
        if(count($odss) == 0){
            return "";
        }
        $d_odss = array();
        $a_odss = array();
        $r_odss = array();
        foreach($odss as $ods){
            if($ods->real_type =="d"){
                array_push($d_odss,$ods);
            }
            if($ods->real_type =="a"){
                array_push($a_odss,$ods);
            }
            if($ods->real_type =="r"){
                array_push($r_odss,$ods);
            }
        }
        if(count($d_odss) < 0){
            return "";
        }

        if(count($a_odss) < count($r_odss)){
            $n = count($a_odss);
        }else{
            $n = count($r_odss);
        }
        $start_date = $d_odss[0]->ods_date;


		$days = intval($duree);
        $arret_days = $this->calculer_ods($n,$a_odss,$r_odss);
        $days1 = $days + $arret_days;

        $years = 0;
		$months = 0; 
		$yy = intval(explode("-",$start_date)[0]);
		$mm = intval(explode("-",$start_date)[1]);
		$dd = intval(explode("-",$start_date)[2]);

		if ($dd + $days > 30) {
			$div = intval($days / 30);
			$dd += $days % 30;
			$months += $div; 
		}else{
			$dd += $days;
		}
		if($dd > 30){
			$months +=1;
			$dd -= 30;
		}
		if ($mm + $months > 12) {
			$m_div = intval($months / 12);
			$mm += $months % 12;
			$years+= $m_div;
		}else{
			$mm+= $months;
		}
		if($mm > 12){
			$years +=1;
			$mm -= 12;
		}
		$yy+= $years;
		$mm = $mm;
		$dd = $dd;
		if (strlen($mm) == 1){
			$mm  = "0".$mm;
		}
		if(strlen($dd) == 1){
			$dd = "0".$dd;
		}
		$first_date = $yy."-".$mm."-".$dd;
        $days = $days1;
        $years = 0;
		$months = 0; 
		$yy = intval(explode("-",$start_date)[0]);
		$mm = intval(explode("-",$start_date)[1]);
		$dd = intval(explode("-",$start_date)[2]);

		if ($dd + $days > 30) {
			$div = intval($days / 30);
			$dd += $days % 30;
			$months += $div; 
		}else{
			$dd += $days;
		}
		if($dd > 30){
			$months +=1;
			$dd -= 30;
		}
		if ($mm + $months > 12) {
			$m_div = intval($months / 12);
			$mm += $months % 12;
			$years+= $m_div;
		}else{
			$mm+= $months;
		}
		if($mm > 12){
			$years +=1;
			$mm -= 12;
		}
		$yy+= $years;
		$mm = $mm;
		$dd = $dd;
		if (strlen($mm) == 1){
			$mm  = "0".$mm;
		}
		if(strlen($dd) == 1){
			$dd = "0".$dd;
		}
		$end_date = $yy."-".$mm."-".$dd;
        
        return array($arret_days,$first_date,$end_date);
    }

    public function ods($id)
    {   
        $user = Auth::user();
        $ods = DB::table('ods')->join('engagements',"ods.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('ods.id',$id)->first();
        $prog = DB::table('programme')->where('code',$ods->programme)->first();
        $d = DB::table('ods')->where('id_eng',$ods->id_eng)->where('real_type',"d")->first();
        $year = explode('-',$ods->ods_date)[0];
        //$delai = $this->delai($ods->id_eng);
        
        if($this->ville_fr =="Ouled Djellal" || $this->ville_fr =="Ouled djellal" || $this->ville_fr =="ouled djellal" ){
            $sommes = $this->somme_arret($ods->id_eng,$id);
            $arret_days = $sommes[0];
            $first_end = $sommes[1];
            $delai = $sommes[2];
            $view = 'ods.djellal';
            if($this->lang =="fr"){
                $view = "ods.ods_fr";
            }
            return view($view,["delai"=>$delai,"ods"=>$ods,'year'=>$year,"user"=>$user,
            "arret_days"=>$arret_days,"first_end"=>$first_end,"d"=>$d]);
        }
        $view = 'ods.ods';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        if($this->ville_fr =="Biskra"){
            $view = "ods.ods07";
            if($this->direction_fr =="Direction de l'Urbanisme de l'Architecture et de la Construction"){
                $view = "ods.duac07";
            }
        }
        if($this->ville_fr =="Mila"){
            $view = "ods.mila";
        }
        if($this->ville_fr =="Ouargla" && !$this->cdars){
            $view = "ods.ouargla";
        }
        return view($view,["user"=>$user,"ods"=>$ods,'year'=>$year,"prog"=>$prog]);
    }
    public function odss()
    {   
        $user = Auth::user();
        $query = "SELECT id,numero FROM operations 
        WHERE date_cloture IS NULL AND id IN 
        (SELECT id_op FROM engagements WHERE id IN 
        (SELECT id_eng FROM ods))";
        $operations = DB::select( DB::raw($query));
        $query = "SELECT id,name FROM entreprises WHERE id IN 
        (SELECT entreprise FROM deals WHERE id_deal IN 
        (SELECT deal from engagements WHERE engagements.id IN
        (SELECT id_eng FROM ods)))";
        $entreprises = DB::select( DB::raw($query));
        $view = 'ods.odss';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"operations"=>$operations,"entreprises"=>$entreprises]);
    }
    public function get_odss($filters=""){
        $query = "SELECT *,ods.id as o_id FROM ods INNER JOIN engagements 
            ON ods.id_eng = engagements.id 
            INNER JOIN deals ON engagements.deal = deals.id_deal
            INNER JOIN operations ON operations.id = engagements.id_op 
            INNER JOIN entreprises ON deals.entreprise = entreprises.id"; 
        if($filters != ""){
            $filters = explode("*1989*",$filters);
            $numero = str_replace("__","/",$filters[1]);
            $e = $filters[0];

            
            $query = $query." WHERE 1 AND";
            
            if ($numero != ""){
                $query = $query." operations.numero ='".$numero."' AND"; 
            }
            if($e != ""){
                $query = $query." entreprises.id ='".$e."' AND";
            }
            
            $query= $query." 1 ORDER BY ods.id DESC LIMIT 100";
            //return $query;
            return DB::select( DB::raw($query));
        }else{
            $query = $query." ORDER BY ods.id DESC LIMIT 100";
            return DB::select( DB::raw($query));
        }
    }
    public function ajouter_ods($id)
    {   
        $user = Auth::user();
        $ods = DB::table('engagements')->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$id)->first();
        $last = DB::table("ods")->where("id_eng",$id)->orderBy("id","DESC")->first();
        if($last != NULL){
            $last = $last->real_type;
        }
        $view = 'ods.ajouter_ods';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,
        ["last"=>$last,"user"=>$user,"ods"=>$ods,"id_eng"=>$id]);
    }
    public function modifier_ods($id)
    {   
        $user = Auth::user();
        $ods = DB::table('ods')->
        join('engagements',"ods.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        where('ods.id',$id)->first();
        $deal = DB::table('deals')->
        join('engagements','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$ods->id_eng)->first();
        $year = explode('-',$ods->ods_date)[0];
        $ods->the_type = str_replace($ods->extra_type, "",$ods->type_ods);

        $view = 'ods.modifier_ods';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"deal"=>$deal,
        "ods"=>$ods,"id"=>$id]);
    }
    public function delete_ods($id)
    {   
        $user = Auth::user();
        $ods = DB::table('ods')->where('id',$id)->delete();
        return Redirect::to('/odss');
    }

    public function add_ods(Request $request){
        $id_eng = $request['id_eng'];
        $ods_num = $request['ods_num'];
        $ods_date = $request['ods_date'];
        $cause = $request['cause'];
        $duree = "";
        $real_type = $request['real_type'];
        $extra_type = $request['extra_type'];
        if($real_type =="d0"){
            $real_type = "d";
            $type_ods = "الخدمة و الإنطلاق في ".$request['extra_type'];
            if($this->lang =="fr"){
                $type_ods = "Démarrage ".$request['extra_type'];
            }
        }
        elseif($real_type =="d"){
            $type_ods = "إنطلاق ".$request['extra_type'];
            if($this->ville_fr =="Biskra" && $this->direction_fr =="Direction de l'Urbanisme de l'Architecture et de la Construction"){
                $type_ods = "الإنطلاق في ".$request['extra_type']; 
            }
            if($this->lang =="fr"){
                $type_ods = "Démarrage ".$request['extra_type'];
            }
        }elseif($real_type =="a"){
            $type_ods = "توقف ".$request['extra_type'];
            if($ville_fr="Mila"){
                $type_ods = "وقف ".$request['extra_type'];
            }
            if($this->lang =="fr"){
                $type_ods = "Arret ".$request['extra_type'];
            }
        }
        elseif($real_type =="r"){
            $type_ods = "استئناف ".$request['extra_type'];
            if($this->lang =="fr"){
                $type_ods = "Reprise ".$request['extra_type'];
            }
        }
        elseif($real_type =="other"){
            $type_ods = $request['extra_type'];
        }
        else{
            if($this->ville_fr =="Mila"){
                $type_ods = $request['real_type'];
            }
        }
        $user = Auth::user()->id;

        $id = DB::table('ods')->insertGetId(['id_eng'=>$id_eng,'ods_num'=>$ods_num,
        'ods_date'=>$ods_date,'duree'=>$duree,'cause'=>$cause,"extra_type"=>$extra_type,
        'type_ods'=>$type_ods,"user"=>$user,"real_type"=>$real_type]);

        if($this->ville_fr =="Ouargla"){
            $ods_date0 = $request['ods_date0'];
            DB::table('ods')->where('id',$id)->
            update(['ods_date0' => $ods_date0]);
        }
        return Redirect::to('/ods/'.$id);
        
    }
    public function update_ods(Request $request){
        $id = $request['id'];
        $ods_num = $request['ods_num'];
        $ods_date = $request['ods_date'];
        $cause = $request['cause'];
        $duree = "";
        $real_type = $request['real_type'];
        $extra_type = $request['extra_type'];
        if($real_type =="d"){
            $type_ods = "إنطلاق ".$request['extra_type'];
            if($this->lang =="fr"){
                $type_ods = "Démarrage ".$request['extra_type'];
            }
        }elseif($real_type =="a"){
            $type_ods = "توقف ".$request['extra_type'];
            if($this->lang =="fr"){
                $type_ods = "Arret ".$request['extra_type'];
            }
        }
        elseif($real_type =="r"){
            $type_ods = "استئناف ".$request['extra_type'];
            if($this->lang =="fr"){
                $type_ods = "Reprise ".$request['extra_type'];
            }
        }
        elseif($real_type =="other"){
            $type_ods = $request['extra_type'];
        }
        else{
            if($this->ville_fr =="Mila"){
                $type_ods = $request['real_type'];
            }
        }
        DB::table('ods')->where('id',$id)->update(['ods_num'=>$ods_num,"real_type"=>$real_type,
        'ods_date'=>$ods_date,'duree'=>$duree,'cause'=>$cause,'type_ods'=>$type_ods,"extra_type"=>$extra_type,]);
        if($this->ville_fr =="Ouargla"){
            $ods_date0 = $request['ods_date0'];
            DB::table('ods')->where('id',$id)->
            update(['ods_date0' => $ods_date0]);
        }
        return Redirect::to('/ods/'.$id);
        
    }

    public function select()
    {   
        $user = Auth::user();
        $type = "ods";
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
        (SELECT DISTINCT id_op from engagements ) ORDER BY id DESC";
        $operations = DB::select( DB::raw($query));
        $es = DB::table('entreprises')->orderby('id',"DESC")->get();
        $view = 'ods.select';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"operations"=>$operations,
        "type"=>$type,"es"=>$es]);
    }
    private function soustraire($date1,$date2){
		$date =[0,0,0];
		for ($i = 0; $i <3; $i++) {
			$date[$i] = intval($date2[$i]) - intval($date1[$i]);
		}
		if($date[0] <0){
			$date[0] += 30;
			$date[1] -=1;
		}
		if($date[1]<0){
			$date[1] += 12;
			$date[2] -= 1;
		}
		return $date[0] + $date[1]*30 + $date[2]*360;
	}
    private function calculer_ods($n,$arret,$reprise){
		$diff = 0;
		for ($i = 0 ; $i < $n; $i++) {
			$date1 = array_reverse(explode("-",$arret[$i]->ods_date));
			for($k=0;$k< count($date1); $k++){ $date1[$k] = intval($date1[$k]);}
			$date2 = array_reverse(explode("-",$reprise[$i]->ods_date));
			for($k=0;$k< count($date2); $k++){ $date2[$k] = intval($date2[$k]);}
			$diff += $this->soustraire($date1,$date2);
			//console.log(diff);
		}
		//console.log(diff);
		return $diff;
	}
    
    public function delai($id)
    {   
        $user = Auth::user();
        $eng = DB::table('engagements')
        ->join('deals',"engagements.deal","=","deals.id_deal")
        ->where('engagements.id',$id)->first();
        if($eng == null){
            if($this->lang =='fr'){
                return "Il n'existe aucun ODS";
            }else{
                return "لا يوجد أي أمر مصلحي ";
            }
            
        }
        $q = "SELECT SUM(duree) as ze_durees FROM deals WHERE id_deal IN 
        (SELECT deal FROM engagements WHERE num_visa IS NOT NULL) AND
        parent = ".$eng->deal;
        $ze_duress = DB::select(DB::raw($q))[0]->ze_durees;
        $odss = DB::table("ods")->where('id_eng',$id)->orderBy('id','ASC')->get();
        
        $duree = intval($eng->duree) + intval($ze_duress);
        if(count($odss) == 0){
            if($this->lang =='fr'){
                return "Il n'existe aucun ODS ";
            }else{
                return "لا يوجد أي أمر مصلحي لل".$eng->deal_type."";
            }
            
            
        }
        $d_odss = array();
        $a_odss = array();
        $r_odss = array();
        foreach($odss as $ods){
            if($ods->real_type =="d"){
                array_push($d_odss,$ods);
            }
            if($ods->real_type =="a"){
                array_push($a_odss,$ods);
            }
            if($ods->real_type =="r"){
                array_push($r_odss,$ods);
            }
        }
        if(count($d_odss) <= 0){
            if($this->lang =='fr'){
                return "Il n'existe pas un ODS de démarrage ";
            }else{
                return "لا يوجد أمر مصلحي بالإنطلاق لل".$eng->deal_type."";
            }
            
        }
        if($odss[count($odss)-1]->real_type =="a"){
            if($this->lang =='fr'){
                return "Il n'existe pas un ODS de reprise après le dernier arret ";
            }else{
                return "لا يوجد أمر مصلحي بالاستئناف بعد أخر توقف لل".$eng->deal_type."";
            }
            
           
        }
        if(count($a_odss) < count($r_odss)){
            $n = count($a_odss);
        }else{
            $n = count($r_odss);
        }
        $start_date = $d_odss[0]->ods_date;


		$days = intval($duree);
        $days+= $this->calculer_ods($n,$a_odss,$r_odss);
        $years = 0;
		$months = 0; 
		$yy = intval(explode("-",$start_date)[0]);
		$mm = intval(explode("-",$start_date)[1]);
		$dd = intval(explode("-",$start_date)[2]);

		if ($dd + $days > 30) {
			$div = intval($days / 30);
			$dd += $days % 30;
			$months += $div; 
		}else{
			$dd += $days;
		}
		if($dd > 30){
			$months +=1;
			$dd -= 30;
		}
		if ($mm + $months > 12) {
			$m_div = intval($months / 12);
			$mm += $months % 12;
			$years+= $m_div;
		}else{
			$mm+= $months;
		}
		if($mm > 12){
			$years +=1;
			$mm -= 12;
		}
		$yy+= $years;
		$mm = $mm;
		$dd = $dd;
		if (strlen($mm) == 1){
			$mm  = "0".$mm;
		}
		if(strlen($dd) == 1){
			$dd = "0".$dd;
		}
		$end_date = $yy."-".$mm."-".$dd;
        //return date_format($delai,"Y-m-d");
        return $end_date;
        
    }
    public function penalite($id_pay)
    {   
        $user = Auth::user();
        $pay = DB::table('payments')->
        join('engagements','payments.id_eng',"=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','deals.id_deal',"=","engagements.deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('payments.id',$id_pay)->first();
        $odss = DB::table("ods")->where('id_eng',$pay->id_eng)->
        orderBy('id','DESC')->get();
        $d_odss = array();
        $a_odss = array();
        $r_odss = array();
        foreach($odss as $ods){
            if($ods->real_type =="d"){
                array_push($d_odss,$ods);
            }
            if($ods->real_type =="a"){
                array_push($a_odss,$ods);
            }
            if($ods->real_type =="r"){
                array_push($r_odss,$ods);
            }
        }
        $delai = $this->delai($pay->id_eng);
        
        $q = "SELECT SUM(duree) as ze_durees FROM deals WHERE id_deal IN 
        (SELECT deal FROM engagements WHERE num_visa IS NOT NULL) AND
        parent = ".$pay->deal;
        $ze_duress = DB::select(DB::raw($q))[0]->ze_durees;
        $pay->duree = intval($pay->duree) + intval($ze_duress);

        $date1 = array_reverse(explode("-",$pay->date_pay));
        for($k=0;$k< count($date1); $k++){ $date1[$k] = intval($date1[$k]);}
        $date2 = array_reverse(explode("-",$delai));
        for($k=0;$k< count($date2); $k++){ $date2[$k] = intval($date2[$k]);}
        $diff = $this->soustraire($date2,$date1);
        
        $view = 'attestations.penalite';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,['user'=>$user,"id_pay"=>$id_pay,
        "pay"=>$pay,"d_odss"=>$d_odss,"a_odss"=>$a_odss,"r_odss"=>$r_odss,
        "delai"=>$delai,"diff"=>$diff]);
    }
    public function calcul_delai()
    {   
        $user = Auth::user();
        $view = 'ods.calcul_delai';
        if($this->lang =="fr"){
            //$view = $view."_fr";
        }
        return view($view,["user"=>$user]);
    }
}


