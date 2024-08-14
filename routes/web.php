<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'SamController@index');
Route::get('/home', 'Auth\LoginController@logout');
Route::get('/profile', 'ProfileController@profile');
Route::get('/backup', 'ProfileController@backup');
Route::post('/update_password', 'ProfileController@update_password');

/** USER ROUTES **/
Route::get('/users', 'UsersController@users');
Route::post('/add_user', 'UsersController@add_user');
Route::get('/modify_user/{id}', 'UsersController@modify_user');
Route::post('/update_user', 'UsersController@update_user');
Route::post('/delete_user', 'UsersController@delete_user');
Route::post('/chnage_profile_photo','UsersController@chnage_profile_photo');

/** OPERATIONS ROUTES */
Route::get('/get_operations/{value?}','OperationsController@operations_orderby');
Route::get('/ops/{secteur}/{filters?}','OperationsController@ops');

Route::get('/ops_clotures/{secteur}/{filters?}','OperationsController@ops_clotures');

Route::get('/view_operation/{id}','OperationsController@view_operation');
Route::get('/operations_ar/{secteur}','OperationsController@operations_ar');

Route::get('/operations_clotures/{secteur}','OperationsController@operations_clotures');

Route::get('/ajouter_operation_ar','OperationsController@ajouter_ar');
Route::get('/modifier_operation_ar/{id}','OperationsController@modifier_ar');

Route::post('/add_op','OperationsController@add_op');
Route::post('/add_op_ar','OperationsController@add_op_ar');
Route::post('/update_op','OperationsController@update_op');
Route::post('/update_op_ar','OperationsController@update_op_ar');


/** DEAL ROUTES */
Route::get('/get_deals/{value?}','DealController@get_deals');
Route::get('/deals/{type?}','DealController@deals');

Route::get('/select_deals/{type?}','DealController@select_deals');
Route::get('/ajouter_avenant/{id}','DealController@ajouter_avenant');

Route::get('/ajouter_deal/{type}/{number?}','DealController@ajouter');
Route::get('/modifier_deal/{id}','DealController@modifier');
Route::get('/delete_deal/{id}','DealController@delete');

Route::post('/add_deal','DealController@add_deal');
Route::post('/add_avenant','DealController@add_avenant');
Route::post('/update_deal','DealController@update_deal');

/** ENGAGEMENTS ROUTES **/
Route::get('/engs/{type?}/{filters?}','EngagementController@get_engs');
Route::get('/engs_delai/{type?}/{filters?}','EngagementController@get_engs_delai');
Route::get('/engs_vise/{type?}/{filters?}','EngagementController@get_engs_vise');
Route::get('/get_eng/{id}','EngagementController@get_eng');

Route::get('/delais/{type?}','EngagementController@delais');
Route::get('/engagements/{type?}','EngagementController@engagements');
Route::get('/ajouter_engagement/{type}/{id?}','EngagementController@ajouter');
Route::get('/modifier_engagement/{id}','EngagementController@modifier');
Route::get('/fiche_eng/{id}','EngagementController@fiche_eng');
Route::get('/get_last/{id_op}','EngagementController@get_last');
Route::get('/get_last_fiche/{id_op}','EngagementController@get_last_fiche');

Route::get('/print_engs/{args?}','EngagementController@print_engs');



Route::get('/delete_eng/{id}','EngagementController@delete');
Route::post('/add_eng','EngagementController@add_eng');
Route::post('/update_eng','EngagementController@update_eng');
Route::get('/updating_fiches/{id}','EngagementController@updating_fiches');


/** PAYMENT ROUTES **/
Route::get('select/{type}/{n?}','PaymentController@select');
Route::get('/payments/{type?}','PaymentController@index');
Route::get('/pays/{filters?}','PaymentController@pays');
Route::get('/pays_bord/{filters?}','PaymentController@pays_bord');
Route::get('/get_pay/{id?}','PaymentController@get_pay');
Route::get('/ajouter_pay/{id_eng}/{n?}','PaymentController@ajouter');
Route::get('/modifier_pay/{id}','PaymentController@modifier');
Route::get('/fiche_pay/{id}','PaymentController@fiche_pay');
Route::get('/edit_fiche_payment/{id}','PaymentController@edit_fiche_pay');
Route::get('/get_last_fiche_pay/{id_op}','PaymentController@get_last_fiche');
Route::get('/maitre_ouvrage/{id}','PaymentController@maitre_ouvrage');

Route::get('/edit_bank/{id}','PaymentController@edit_bank');
Route::post('/update_bank','PaymentController@update_bank');


Route::get('/mondat/{id}','PaymentController@mondat');
Route::get('/mondat1/{id}','PaymentController@mondat1');
Route::get('/avancement/{id}','PaymentController@avancement');
Route::get('/attestation_payment/{id}','PaymentController@attestation');
Route::get('/attestation_payment_2/{id}','PaymentController@attestation_2');
Route::get('/fiche_payment/{id}','PaymentController@fiche');
Route::get('/order_pay/{id}','PaymentController@order');
Route::get('/declaration_pay/{id}','PaymentController@declaration');
Route::get('/resume_pay/{id}','PaymentController@resume_pay');

Route::post('/add_pay','PaymentController@add_pay');
Route::get('/delete_pay/{id}','PaymentController@delete');
Route::post('/update_pay','PaymentController@update_pay');
Route::post('/update_fiche_pay','PaymentController@update_fiche');

Route::get('/print_pays/{filters?}','PaymentController@print_pays');
Route::get('/print_pays2/{filters?}','PaymentController@print_pays2');

Route::get('/ajouter_penalite/{type?}','AttController@ajouter_penalite');

/** ODS ROUTES **/

Route::get('/odss','ODSController@odss');
Route::get('/get_odss/{filters?}','ODSController@get_odss');
Route::get('/ods/{id}','ODSController@ods');
Route::get('/select_ods','ODSController@select');
Route::get('/ajouter_ods/{id}','ODSController@ajouter_ods');
Route::get('/modifier_ods/{id}','ODSController@modifier_ods');
Route::get('/calcul_delai','ODSController@calcul_delai');
Route::get('/delai/{id}','ODSController@delai');
Route::get('/somme_arret/{id}/{id_eng}','ODSController@somme_arret');



Route::post('/add_ods','ODSController@add_ods');
Route::post('/update_ods','ODSController@update_ods');
Route::get('/delete_ods/{id}','ODSController@delete_ods');

Route::get('/penalite/{id_pay}','ODSController@penalite');
Route::get('/penalite1/{id}','AttController@penalite1');

/** ENREPRISE ROUTES **/
Route::get('/entreprise','EntrepriseController@index');
Route::get('/e_get','EntrepriseController@e_get');
Route::get('/close','EntrepriseController@close');
Route::get('/entreprises','EntrepriseController@get');
Route::get('/entreprises_get/{name}','EntrepriseController@entreprises_get');

Route::get('/modifier_e/{id}','EntrepriseController@modifier');

Route::post('/add_e','EntrepriseController@add_e');
Route::post('/update_e','EntrepriseController@update');


/** COMPTABILITE ROUTES **/

Route::get('/comptabilite','ComptabiliteController@index');
Route::get('cumul/{type}','ComptabiliteController@cumul');
Route::get('get_cumul/{type}/{op?}','ComptabiliteController@get_cumul');
Route::get('ajouter_cumul','ComptabiliteController@ajouter_cumul');
Route::get('modifier_cumul/{id?}','ComptabiliteController@modifier_cumul');
Route::get('/historique','ComptabiliteController@historique');
Route::get('/fiche_comptable/{id_op}','ComptabiliteController@fiche_comptable');
Route::get('/fiche_consom/{id_op}','ComptabiliteController@fiche_consom');

Route::get('/psc_stuff','ComptabiliteController@psc');
Route::get('/nc13/{year}/{month?}','ComptabiliteController@nc13');
Route::get('/consommation/{start?}/{end?}','ComptabiliteController@consommation');
Route::get('/situation_psc/{year?}','ComptabiliteController@situation_psc');

Route::get('anep_ctc/','ComptabiliteController@anep_ctc');
Route::get('get_ctc/{type?}/{year?}','ComptabiliteController@get_ctc');
Route::get('print_ctc/{type?}/{year?}','ComptabiliteController@print_ctc');


Route::post('add_cumul/','ComptabiliteController@add_cumul');
Route::post('update_cumul/','ComptabiliteController@update_cumul');



/** SAM ROUTES **/
Route::get('/sam','SamController@index');
Route::get('/get_sous_titres/{id}','SamController@get_sous_titres');
Route::get('/get_last_sous/{op}/{sous}','SamController@get_last_sous');
Route::get('/sam/{secteur}','SamController@operations');
Route::get('/sam_cumul/{portefeuille}/{filters?}/{op?}','SamController@get_cumul');

Route::get('/sam_cumul_clotures/{portefeuille}/{filters?}/{op?}','SamController@get_cumul_clotures');


/** SUIVI ROUTES **/
Route::get('/suivi','SuiviController@all');
Route::get('/get_all','SuiviController@get_all');
Route::get('/suivi_e/{e}','SuiviController@suivi_e');
Route::get('/get_suivis','SuiviController@get_suivis');
Route::get('/get_suivi_e/{e}','SuiviController@get_suivi_e');
Route::get('/situations/{e}','SuiviController@situations');
Route::get('/get_situations/{e}','SuiviController@get_situations');
Route::get('/op_detail/{id}','SuiviController@op_detail');



Route::post('/update_op_taux','SuiviController@update_op_taux');



/** BORDERAU ROUTES */

Route::get('/borderau/{id}','BorderauController@borderau');
Route::get('/borderau1/{id}','BorderauController@borderau1');
Route::get('/borderaux/','BorderauController@all');
Route::get('/add_borderau/{type}','BorderauController@add_borderau');
Route::get('/edit_borderau/{id}/{type}','BorderauController@edit');
Route::get('/delete_borderau/{id}','BorderauController@delete_bord');
Route::get('/select_bord/{type}','BorderauController@select');
Route::get('/redirect_bord/{id}','BorderauController@bord_red');

Route::post('/insert_borderau', 'BorderauController@insert');
Route::post('/update_borderau', 'BorderauController@update');

/** AUTH ROUTES **/
Auth::routes();
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

/** ATTESTATIONS ROUTES */
Route::get('/attestations/{type}','AttController@attestations');
Route::get('/select_att/{type}','AttController@select');
Route::get('/add_att/{id_eng}','AttController@add_att');
Route::get('/add_att_all/{type}/{id_pay}','AttController@add_att_all');
Route::get('/edit_att/{id}','AttController@edit_att');
Route::get('/att_admin/{id}','AttController@att');
Route::get('/delete_att/{id}','AttController@delete_att');

Route::post('/insert_att','AttController@insert_att');
Route::post('/update_att','AttController@update_att');

Route::get('/add_leve/{id_eng}','AttController@add_leve');
Route::get('/leve_main/{id}','AttController@leve_main');
Route::get('/edit_leve/{id}','AttController@edit_leve');
Route::get('/delete_leve/{id}','AttController@delete_leve');

Route::get('/att_all/{type}/{id_pay}','AttController@att_all');
Route::get('/delete_att_all/{type}/{id}','AttController@delete_att_all');

Route::post('/insert_leve_main','AttController@insert_leve');
Route::post('/update_leve','AttController@update_leve');

Route::get('/delete_pen/{id}','AttController@delete_pen');
Route::post('/insert_pen','AttController@insert_pen');

Route::post('/insert_att_all','AttController@insert_att_all');

/** BANQUES ROUTES */
Route::get('/banques/','ComptabiliteController@banques');
Route::get('/banques_get/','ComptabiliteController@banques_get');

Route::get('/ajouter_banque/','ComptabiliteController@ajouter_banque');
Route::get('/modifier_banque/{id}','ComptabiliteController@modifier_banque');

Route::post('/update_banque/','ComptabiliteController@update_banque');
Route::post('/insert_banque/','ComptabiliteController@insert_banque');

Route::get('/select_att/{type}','AttController@select');


/** PROGRAMME ROUTES **/

Route::get('/get_progs/{porte}', 'ProgrammeController@get_progs');
Route::get('/get_sous/{code}', 'ProgrammeController@get_sous');

Route::get('/home', 'SamController@index')->name('home');

Route::get('/settings', 'UsersController@settings');
Route::get('/update_pref_eng/{value}', 'UsersController@update_pref_eng');
Route::post('/update_settings/','UsersController@update_settings');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});