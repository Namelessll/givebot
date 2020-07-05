<?php

use Illuminate\Support\Facades\Route;

$_token = "1288861330:AAEGaumQ73tjt0uKArMVikap_xbMVkU91SU";
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

Route::post('/' . $_token . '/webhook', 'Bot\UpdateController@getWebhookUpdates')->name('getWebhookUpdates');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/save/rules', 'HomeController@saveRules')->name('saveRules');
    Route::get('/competition/create', 'HomeController@getCompetitionCreatePage')->name('getCompetitionCreatePage');
    Route::get('/competition/list', 'HomeController@getCompetitionListPage')->name('getCompetitionListPage');


    /*post*/
    Route::post('/dashboard/setting/domain/set', 'Dashboard\ServicesController@setApiDomain')->name('setApiDomain');
    Route::post('/setwebhook', 'Dashboard\ServicesController@setWebhook')->name('setWebhook');
    Route::post('/removewebhook', 'Dashboard\ServicesController@removeWebhook')->name('removeWebhook');
    Route::post('/competition/create', 'Dashboard\ServicesController@createCompetition')->name('createCompetition');
});




