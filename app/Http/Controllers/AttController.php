<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
class AttController extends Controller
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
    public function attestations($type)
    {   
        $user = Auth::user();
        if($type=='admin'){
            $attestations = DB::table('attestations')->
            join('engagements',"attestations.id_eng","=","engagements.id")->
            join('operations','engagements.id_op',"=","operations.id")->
            join('deals','engagements.deal',"=","deals.id_deal")->
            join('entreprises','deals.entreprise',"=","entreprises.id")->orderBy('id_att','DESC')->get();
            return view('attestations.admins',["attestations"=>$attestations,"user"=>$user]);
        }else if($type=='penalite'){
            $attestations = DB::table('penalite')->
            join('payments',"penalite.the_pay","=","payments.id")->
            join('engagements',"payments.id_eng","=","engagements.id")->
            join('operations','engagements.id_op',"=","operations.id")->
            join('deals','engagements.deal',"=","deals.id_deal")->
            join('entreprises','deals.entreprise',"=","entreprises.id")->orderBy('id_pen','DESC')->get();
            $view = 'attestations.penalites';
            if($this->lang =="fr"){
                $view = $view."_fr";
            }
            return view($view,["attestations"=>$attestations,"user"=>$user]);
        }else if($type=='leve_main' || $type=='leves'){
            $attestations = DB::table('leve_main')->join('engagements',"leve_main.id_eng","=","engagements.id")->
            join('operations','engagements.id_op',"=","operations.id")->
            join('deals','engagements.deal',"=","deals.id_deal")->
            join('entreprises','deals.entreprise',"=","entreprises.id")->orderBy('id_main','DESC')->get();
            return view('attestations.leves',["attestations"=>$attestations,"user"=>$user]);
        }
        else {
            $attestations = DB::table('att_total')->
            join('payments',"att_total.ze_pay","=","payments.id")->
            join('engagements',"payments.id_eng","=","engagements.id")->
            join('operations','engagements.id_op',"=","operations.id")->
            join('deals','engagements.deal',"=","deals.id_deal")->
            join('entreprises','deals.entreprise',"=","entreprises.id")->
            where('att_total.type',$type)->
            orderBy('att_total.att_id','DESC')->get();
            return view('attestations.att_all',
            ["attestations"=>$attestations,
            "user"=>$user,"type"=>$type]);
        }
        
        //var_dump($att);
    }
    public function select($type)
    {   
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN (SELECT DISTINCT id_op 
        from engagements WHERE engagements.user_id =".$user->id." ) ORDER BY id DESC";
        $operations = DB::select( DB::raw($query));
        $q = "SELECT * from entreprises WHERE id IN (SELECT DISTINCT entreprise FROM deals WHERE deals.user_id =".$user->id." )";
        $es = DB::select( DB::raw($q));
        $view = 'attestations.select';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"operations"=>$operations,"type"=>$type,'es'=>$es]);
    }
    public function att($id)
    {   
        $att = DB::table('attestations')->join('engagements',"attestations.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('attestations.id_att',$id)->first();
        return view('attestations.att',["att"=>$att]);
        //var_dump($att);
    }
    public function add_att($id_eng)
    {   
        $user = Auth::user();
        $eng = DB::table('engagements')->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$id_eng)->first();
        return view('attestations.add_att',['user'=>$user,"id_eng"=>$id_eng,"eng"=>$eng]);
    }
    public function add_att_all($type,$id_pay)
    {   
        $user = Auth::user();
        $eng = DB::table('payments')->
        join("engagements","payments.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        leftjoin('deals','engagements.deal',"=","deals.id_deal")->
        leftjoin('entreprises','deals.entreprise',"=","entreprises.id")->
        where('payments.id',$id_pay)->first();
        return view('attestations.add_att_all',
        ['user'=>$user,"id_pay"=>$id_pay,"eng"=>$eng,"type"=>$type]);
    }
    public function edit_att($id)
    {   
        $user = Auth::user();
        $att = DB::table('attestations')->where('id_att',$id)->first();
        $id_eng = $att->id_eng;
        $att->causes = str_replace('<br />',"",$att->causes);
        $eng = DB::table('engagements')->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$id_eng)->first();
        return view('attestations.edit_att',['user'=>$user,"id"=>$id,"eng"=>$eng,"att"=>$att]);
    }
    public function delete_att($id)
    {   
        $user = Auth::user();
        $att = DB::table('attestations')->where('id_att',$id)->delete();
        return Redirect::to('/attestations/admin');
    }
    public function insert_att(Request $request)
    {   
        $id_eng = $request['id_eng'];
        $causes = $request['causes'];
        $causes =  nl2br($causes);
        $id = DB::table('attestations')->insertGetId(['id_eng'=>$id_eng,'causes'=>$causes]);
        return Redirect::to('/att_admin/'.$id);
    }
    public function update_att(Request $request)
    {   

        $id = $request['id_att'];
        $causes = $request['causes'];
        $causes =  nl2br($causes);
        DB::table('attestations')->where('id_att',$id)->update(['causes'=>$causes]);
        return Redirect::to('/att_admin/'.$id);
    }
    public function leve_main($id)
    {   
        $att = DB::table('leve_main')->join('engagements',"leve_main.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('leve_main.id_main',$id)->first();
        return view('attestations.leve_main',["att"=>$att]);
        //var_dump($att);
    }
    public function add_leve($id_eng)
    {   
        $user = Auth::user();
        $eng = DB::table('engagements')->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$id_eng)->first();
        $bank = DB::table('banks')->where('id',$eng->bank)->first();
        return view('attestations.add_leve',['user'=>$user,"id_eng"=>$id_eng,"eng"=>$eng,'bank'=>$bank]);
    }
    public function edit_leve($id)
    {   
        $user = Auth::user();
        $leve = DB::table('leve_main')->where('id_main',$id)->first();
        $leve->pvs = str_replace('<br />',"",$leve->pvs);
        $id_eng = $leve->id_eng;
        $eng = DB::table('engagements')->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('engagements.id',$id_eng)->first();
        return view('attestations.edit_leve',['user'=>$user,"id"=>$id,"eng"=>$eng,"leve"=>$leve]);
    }
    public function insert_leve(Request $request)
    {   
        $id_eng = $request['id_eng'];
        $montant = $request['montant'];
        $pvs = $request['pvs'];
        $extra = $request['extras'];
        $pvs =  nl2br($pvs);
        $id = DB::table('leve_main')->insertGetId(
            ['id_eng'=>$id_eng,'montant'=>$montant,"pvs"=>$pvs,"extra"=>$extra
        ]);
        return Redirect::to('/leve_main/'.$id);
    }
    public function update_leve(Request $request)
    {   
        $id_leve = $request['id_leve'];
        $montant = $request['montant'];
        $pvs = $request['pvs'];
        $extra = $request['extras'];
        $pvs =  nl2br($pvs);
        DB::table('leve_main')->where('id_main',$id_leve)->update(
            ['montant'=>$montant,"pvs"=>$pvs,"extra"=>$extra
        ]);
        return Redirect::to('/leve_main/'.$id_leve);
    }
    public function delete_leve($id)
    {   
        $user = Auth::user();
        $att = DB::table('leve_main')->where('id_main',$id)->delete();
        return Redirect::to('/attestations/leves');
    }
    public function ajouter_penalite($type=""){
        $user = Auth::user();
        $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN
         (SELECT DISTINCT id_op from engagements where id IN 
         (SELECT id_eng from payments) )";
        $q = "SELECT * from entreprises WHERE id IN 
        (SELECT DISTINCT entreprise FROM deals WHERE id IN 
        (SELECT deal FROM engagements WHERE id IN 
        (SELECT id_eng from payments) ))";
        if($type == ""){
            $query = "SELECT * FROM operations WHERE date_cloture IS NULL AND id IN 
            (SELECT DISTINCT id_op from engagements where id IN 
            (SELECT id_eng from payments WHERE user_id = ".$user->id.") )";
            $q = "SELECT * from entreprises WHERE id IN 
            (SELECT DISTINCT entreprise FROM deals WHERE id IN 
            (SELECT deal FROM engagements WHERE id IN 
            (SELECT id_eng from payments WHERE user_id = ".$user->id.") ))";
        }
        
        $operations = DB::select( DB::raw($query));
        $es = DB::select( DB::raw($q));
        $view = 'attestations.ajouter_penalite';
        if($this->lang =="fr"){
            $view = $view."_fr";
        }
        return view($view,["user"=>$user,"type"=>$type,
        "operations"=>$operations,'es'=>$es]);
    }
    public function penalite1($id)
    {   
        $pen = DB::table('penalite')->where('id_pen',$id)->first();
        $pen->html = str_replace('const url = "/insert_pen/";',
        'const url = "/insert_peno/";',$pen->html);
        $view = 'attestations.penalite1';
        return view($view,["pen"=>$pen]);
    }
    public function insert_pen(Request $request)
    {   
        $id_pay = $request['id_pay'];
        $html = $request['html'];
        $id = DB::table('penalite')->insertGetId(
            ['the_pay'=>$id_pay,'html'=>$html
        ]);
        return $id;
    }
    public function delete_pen($id)
    {   
        $user = Auth::user();
        $att = DB::table('penalite')->where('id_pen',$id)->delete();
        return Redirect::to('/attestations/penalite');
    }
    public function insert_att_all(Request $request)
    {   
        $id_pay = $request['id_pay'];
        $type = $request["type"];
        $mondat = null;
        $date = null;
        $compte = null;
        if($type=="att_commune"){
            $mondat = $request['mondat'];
            $date = $request['date']; 
        }else if($type=="att_retard"){

        }else if($type=="att_error"){
            $compte = $request["compte"];
            $mondat = $request['mondat'];
        }
        $id = DB::table('att_total')->insertGetId(
        ['ze_pay'=>$id_pay,'type'=>$type,"mondat"=>$mondat,
        "date"=>$date,"compte"=>$compte
        ]);
        return Redirect::to('/att_all/'.$type."/".$id);
    }
    public function delete_att_all ($type,$id)
    {   
        $att = DB::table('att_total')->where('att_total.att_id',$id)->delete();
        return Redirect::to('/attestations/'.$type);
    }
    public function att_all ($type,$id)
    {   
        $att = DB::table('att_total')->
        join('payments',"att_total.ze_pay","=","payments.id")->
        join('engagements',"payments.id_eng","=","engagements.id")->
        join('operations','engagements.id_op',"=","operations.id")->
        join('deals','engagements.deal',"=","deals.id_deal")->
        join('entreprises','deals.entreprise',"=","entreprises.id")->
        where('att_total.att_id',$id)->first();
        $sujets = explode("مقرر",$att->real_sujet);
        if(isset($sujets[1])){
            $sujet = "مقرر".$sujets[1];
        }else{
            $sujet = $att->real_sujet;
        }
        $bank = DB::table("banks")->where("id",$att->bank)->select('bank_acc')->first()->bank_acc;
        return view('attestations.ze_att_all',
        ["att"=>$att,"type"=>$type,"bank"=>$bank,"sujet"=>$sujet]);
    }
}

?>