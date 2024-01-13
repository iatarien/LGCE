<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Bcrypt;
use Redirect;
class EntrepriseController extends Controller
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
    public function index()
    {
        $user = Auth::user();
        return view('comptabilite.entreprise',['user'=>$user]);
    }
    public function get()
    {
        $user = Auth::user();
        $es = DB::table('entreprises')->get();
        return view('comptabilite.entreprises',['user'=>$user,"es"=>$es]);
    }
    public function modifier($id)
    {
        $user = Auth::user();
        $e = DB::table('entreprises')->where('id',$id)->first();
        return view('comptabilite.modifier_e',['user'=>$user,"e"=>$e]);
    }
    
    public function close(){
        return view('close');
    }
    public function entreprises_get($name){
        return DB::table('entreprises')->where('name',"like","%".$name."%")->get();
    }
    public function e_get(){
        return DB::table('entreprises')->orderBy('id','DESC')->get();
    }
    public function add_e(Request $request){
        $name = $request['name'];
        $nature = $request['nature'];
        $id = DB::table('entreprises')->insertGetId(['name'=>$name,"nature"=>$nature]);
        return Redirect::to('/close');
    }
    public function update(Request $request){
        $name = $request['name'];
        $nature = $request['nature'];
        $id = $request['id'];
        
        DB::table('entreprises')->where('id',$id)->update(['name'=>$name,"nature"=>$nature]);
        return Redirect::to('/close');
    }
}
