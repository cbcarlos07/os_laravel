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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',['as' => 'login','uses' => 'UserController@telaLogin']);
Route::post('/empresa',['as' => 'empresa', 'uses' => 'UserController@getEmpresa']);
Route::post('/logar',['as' => 'logar', 'uses' => 'UserController@logar']);

Route::group(['as' => 'os.','prefix' => '/',], function (){
    Route::get('solicitar',['as' => 'solicitar', 'uses' => 'OsController@telaSolicitar']);


});

Route::group(['as' => 'ordem.', 'prefix' => 'os'], function (){
    Route::post('os',['as' => 'getOs', 'uses' => 'OsController@getOs']);
    Route::post('solicitada',['as' => 'solicitada', 'uses' => 'OsController@getOsSolicitadas']);
    Route::post('nova',['as' => 'novaSolicitacao', 'uses' => 'OsController@salvar']);
});

Route::group(['as' => 'user.', 'prefix' => 'user'], function (){
   Route::post('/',['as' => 'lista','uses' => 'UserController@getListaUsuarios']);
});

Route::group(['as' => 'setor.', 'prefix' => 'setor'], function (){
    Route::post('',['as' => 'lista','uses' => 'SetorController@getListaSetor']);
    Route::post('ultimo',['as' => 'ultimo','uses' => 'SetorController@getDadosUltimoSolicitante']);
});

Route::group(['as' => 'template.', 'prefix' => 'template'], function (){
   Route::post('',['as' => 'lista', 'uses' => 'TemplateController@getListTemplate']);
});