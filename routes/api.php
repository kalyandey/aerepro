<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');



Route::group(array('namespace'=>'api'), function (){
    Route::any('/cdn-authenticate',             array('as' => 'cdn-authenticate', 'uses'=>'CdnController@index' ));
    Route::any('/cdn-fileupload',               array('as' => 'cdn-fileupload', 'uses'=>'CdnController@fileupload' ));
});