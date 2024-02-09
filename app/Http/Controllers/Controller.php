<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $ville;
    protected $ville_fr;
    protected $direction;
    protected $direction_fr;
    protected $code_ville;
    
    
    public function __construct() 
    {
        // Fetch the Site Settings object
        $settings = DB::table('company')->where('id_comp',1)->first();
        $this->ville = $settings->ville;
        $this->ville_fr = $settings->ville_fr;
        $this->ministere_fr = $settings->ministere_fr;
        $this->ministere = $settings->ministere;
        $this->direction = $settings->direction;
        $this->direction_fr = $settings->direction_fr;
        $this->order = $settings->order_ville;
        $this->code_ville = $settings->code_ville;
        $this->compte_tresor = $settings->compte_tresor;
        $this->year = $settings->year;
        $this->pref_eng = $settings->pref_eng;
        $this->license = $settings->license;
        $this->lang = "";
        if(isset($settings->lang)){
            $this->lang = $settings->lang;
           // $this->lang = "";
        }
        

        View::share('ville', $this->ville);
        View::share('ville_fr', $this->ville_fr);
        View::share('direction', $this->direction);
        View::share('direction_fr', $this->direction_fr);
        View::share('ministere', $this->ministere);
        View::share('ministere_fr', $this->ministere_fr);
        View::share('ordre', $this->order);
        View::share('code_ville', $this->code_ville);
        View::share('compte_tresor', $this->compte_tresor);
        View::share('the_year', $this->year);
        View::share('pref_eng', $this->pref_eng);
        View::share('license', $this->license);
        View::share('pref_eng', $this->pref_eng);
        View::share('lang', $this->lang);
    }
}
