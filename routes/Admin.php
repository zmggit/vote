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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'middleware'=>'token'
],function (){
//评选活动
    Route::get('campaign_info/{id}','CampaignController@info');
    Route::post('campaign/{id}','CampaignController@status');
    Route::get('campaign','CampaignController@index');
    Route::post('campaign','CampaignController@store');
    Route::post('campaign/{id}/edit','CampaignController@edit');
    Route::post('campaign/{id}/delete','CampaignController@destroy');
//评选人
    Route::get('campaigner_info/{id}','CampaignerController@info');
    Route::post('campaigner/{id}','CampaignerController@status');
    Route::get('campaigner','CampaignerController@index');
    Route::post('campaigner','CampaignerController@store');
    Route::post('campaigner/{id}/edit','CampaignerController@edit');
    Route::post('campaigner/{id}/delete','CampaignerController@destroy');
//投票人
    Route::get('people_info/{id}','PeopleController@info');
    Route::post('people/{id}','PeopleController@status');
    Route::get('people','PeopleController@index');
    Route::post('people','PeopleController@store');
    Route::post('people/{id}/edit','PeopleController@edit');
    Route::post('people/{id}/delete','PeopleController@destroy');

});

