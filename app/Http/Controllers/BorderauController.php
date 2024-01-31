<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class BorderauController extends Controller
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

    public function all()
    {   
        $user = Auth::user();
        $query = "SELECT *, borderau.id as b_id FROM borderau 
        INNER JOIN bord_eng ON borderau.id = bord_eng.id_bord
        GROUP BY b_id ORDER BY b_id DESC LIMIT 50";
        $bords = DB::select(DB::raw($query));
        //return $bords;

        $view = "borderau.all";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"bords"=>$bords]);
    }

    public function borderau($id)
    {   
        $type = DB::table('borderau')->where('id',$id)->first()->type;
        if($type == "eng"){
            $user = Auth::user();
            $year = $this->year;
            $query = "SELECT *, engagements.montant as montant_eng from engagements 
            LEFT JOIN operations ON operations.id = engagements.id_op
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises 
            ON deals.entreprise = entreprises.id
            WHERE engagements.id 
            IN (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
            $engs = DB::select( DB::raw($query));
            $n = count($engs);
            //echo $query;
            $view = "borderau.borderau";
            if($this->lang =="fr"){
                $view = $view."_fr";
            }
            return view($view,["user"=>$user,"year"=>$year,"engs"=>$engs,"n"=>$n]);
        }else{
            $user = Auth::user();
            $year = $this->year;
            $query = "SELECT * FROM payments INNER JOIN engagements 
            ON payments.id_eng = engagements.id 
            INNER JOIN operations ON operations.id = engagements.id_op
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises 
            ON deals.entreprise = entreprises.id
            WHERE payments.id IN (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
            $engs = DB::select( DB::raw($query));
            $n = count($engs);
            //echo $query;
            $view = "borderau.borderau_pay";
            if($this->lang =="fr"){
                $view = $view."_fr";
            }
            return view($view,["user"=>$user,"year"=>$year,"engs"=>$engs,"n"=>$n]);
        }
        
    }
    public function borderau1($id)
    {   
        $type = DB::table('borderau')->where('id',$id)->first()->type;
        if($type == "eng"){
            $user = Auth::user();
            $year = $this->year;
            $query = "SELECT *, engagements.montant as montant_eng from engagements 
            INNER JOIN operations on engagements.id_op = operations.id 
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises 
            ON deals.entreprise = entreprises.id
            WHERE engagements.id 
            IN (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
            $engs = DB::select( DB::raw($query));
            $n = count($engs);
            //echo $query;
            $view = "borderau.borderau";
            if($this->lang =="fr"){
                $view = $view."_fr";
            }
            return view($view,["user"=>$user,"year"=>$year,"engs"=>$engs,"n"=>$n]);
        }else{
            $user = Auth::user();
            $year = $this->year;
            $query = "SELECT * FROM payments INNER JOIN engagements 
            ON payments.id_eng = engagements.id 
            INNER JOIN operations ON operations.id = engagements.id_op
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises 
            ON deals.entreprise = entreprises.id
            WHERE payments.id IN (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
            $engs = DB::select( DB::raw($query));
            $op = (object) null;  
            $op->programme = DB::table("programme")->where('code',$engs[0]->programme)->first();
            $op->sous_programme = DB::table("programme")->where('id',$engs[0]->sous_programme)->first();
            if($op->sous_programme == NULL){
                $op->sous_programme = (object) [];
                $op->sous_programme->code = "";
                $op->sous_programme->designation = "";   
            }
            $op->portefeuille = DB::table("portefeuille")->where('code',$engs[0]->portefeuille)->first();
            for($i = 0; $i<count($engs); $i++){
                $engs[$i]->sous_programme0 = DB::table("programme")->where('id',$engs[$i]->sous_programme)->first();
                if($engs[$i]->sous_programme0 == NULL){
                    $engs[$i]->sous_programme0 = (object) [];
                    $engs[$i]->sous_programme0->code = "";
                    $engs[$i]->sous_programme0->designation = "";   
                }
                $engs[$i]->sous_titre = DB::table('rebriques')->where('id_eng',$engs[$i]->id_eng)->where("sous_montant","!=",0)->first();
                $engs[$i]->sous_titre = DB::table('titres')->where('id_titre',$engs[$i]->sous_titre->sous_titre)->first();
                $engs[$i]->titre = DB::table('titres')->where('id_titre',$engs[$i]->sous_titre->father)->first();
            }
            //return $engs;
            $n = count($engs);
            //echo $query;
            $view = "borderau.borderau_pay1";
            if($this->lang =="fr"){
                $view = $view."_fr";
            }
            return view($view,["user"=>$user,"year"=>$year,"engs"=>$engs,"n"=>$n,"op"=>$op]);
        }
        
    }
    public function edit($id,$type)
    {   
        $user = Auth::user();
        $year = $this->year;
        if($type =="eng"){
            $query = "SELECT *,engagements.id as id_eng, engagements.montant as montant_eng
            from engagements 
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises ON deals.entreprise = entreprises.id
            WHERE engagements.id IN 
            (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
        }else{
            $query = "SELECT *,payments.id as id_eng FROM payments 
            INNER JOIN engagements ON payments.id_eng = engagements.id 
            INNER JOIN operations ON operations.id = engagements.id_op
            LEFT JOIN deals ON engagements.deal = deals.id_deal
            LEFT JOIN entreprises ON deals.entreprise = entreprises.id
            WHERE payments.id IN (SELECT id_eng FROM bord_eng WHERE id_bord =".$id." )";
        }
        
        $engs = DB::select( DB::raw($query));
        //echo $query;
        $view = "borderau.edit_borderau";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"year"=>$year,"engs"=>$engs,"id"=>$id,"type"=>$type]);
    }
    public function bord_red($id){
        session(['id_bord' => $id]);
        return Redirect::to('/close');
       
    }
    public function delete_bord($id){
        DB::table('borderau')->where('id',$id)->delete();
        DB::table('bord_eng')->where('id_bord',$id)->delete();
        return Redirect::to('/borderaux');
       
    }
    public function add_borderau($type)
    {   
        $user = Auth::user();
        $view = "borderau.add_borderau";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"type"=>$type]);

    }
    public function insert(Request $request)
    {   
        $type = $request['type'];

        $engs =$request->all();
        array_shift($engs);
        array_shift($engs);
        $id = DB::table('borderau')->insertGetId(['type'=>$type]);
        foreach($engs as $eng){
            DB::table('bord_eng')->insertGetId(['id_bord'=>$id,"id_eng"=>$eng]);
            
        }
        return Redirect::to('/borderau1/'.$id);
    }
    public function update(Request $request)
    {   
        //$type = $request['type'];
        $id = $request['id'];
        DB::table('bord_eng')->where('id_bord',$id)->delete();
        $engs =$request->all();
        //var_dump($engs);
        array_shift($engs);
        array_shift($engs);
        //$id = DB::table('borderau')->insertGetId(['type'=>$type]);
        foreach($engs as $eng){
            DB::table('bord_eng')->insertGetId(['id_bord'=>$id,"id_eng"=>$eng]);
            
        }
        return Redirect::to('/borderau1/'.$id);
    }
    public function select($type)
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL";
        $operations = DB::select( DB::raw($query));
        $q = "SELECT * from entreprises WHERE id IN 
        (SELECT DISTINCT entreprise FROM deals)";
        $es = DB::select( DB::raw($q));
        $view = "borderau.select";
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"operations"=>$operations,"type"=>$type,'es'=>$es]);
    }

}
