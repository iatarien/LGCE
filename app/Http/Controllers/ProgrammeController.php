<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Bcrypt;
use Redirect;
class ProgrammeController extends Controller
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
    public function get_progs($porte){
        $q = "SELECT * FROM programme WHERE portefeuille = '".$porte."' AND 
        ( parent IS NULL OR parent = '') ";
        return DB::select(DB::raw($q));
        return DB::table("programme")->where("portefeuille",$porte)
        ->where("parent","")->orWhereNull("parent")->get();

    }
    public function get_sous($code){

        return DB::table("programme")->where("parent",$code)->get();

    }

    
    
}
