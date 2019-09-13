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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'Controller@index');
Route::post('/', 'Controller@index');
Route::post('convert', 'ConvertController@index');
Route::post('/convert/luckyName', 'ConvertController@luckyName');
Route::post('/convert/kanjiSelect', 'ConvertController@kanjiSelect');
Route::post('/ajax/getLuckyName', 'Ajax\ConvertController@getLuckyName');
Route::post('/ajax/convertKanji', 'Ajax\ConvertController@convertKanji');
Route::post('/convert/selectDesign', 'ConvertController@selectDesign');
Route::post('/convert/purchase', 'ConvertController@purchase');
Route::post('/complete', 'ConvertController@createData');

Route::get('/biz/', 'Controller@index');
Route::post('/biz/', 'Controller@index');
Route::post('/biz/convert', 'ConvertController@index');
Route::post('/biz/convert/luckyName', 'ConvertController@luckyName');
Route::post('/biz/convert/kanjiSelect', 'ConvertController@kanjiSelect');
Route::post('/biz/ajax/getLuckyName', 'Ajax\ConvertController@getLuckyName');
Route::post('/biz/ajax/convertKanji', 'Ajax\ConvertController@convertKanji');
Route::post('/biz/convert/selectDesign', 'ConvertController@selectDesign');
Route::post('/biz/convert/purchase', 'ConvertController@purchase');
Route::post('/biz/complete', 'ConvertController@createData');

Route::get('/shop/', 'Controller@index');
Route::post('/shop/', 'Controller@index');
Route::post('/shop/convert', 'ConvertController@index');
Route::post('/shop/convert/luckyName', 'ConvertController@luckyName');
Route::post('/shop/convert/kanjiSelect', 'ConvertController@kanjiSelect');
Route::post('/shop/ajax/getLuckyName', 'Ajax\ConvertController@getLuckyName');
Route::post('/shop/ajax/convertKanji', 'Ajax\ConvertController@convertKanji');
Route::post('/shop/convert/selectDesign', 'ConvertController@selectDesign');
Route::post('/shop/convert/purchase', 'ConvertController@purchase');
Route::post('/shop/complete', 'ConvertController@createData');
Route::post('/shop/ajax/getZipFile', 'Ajax\ConvertController@getZipFile');

Route::get('/sample', 'StaticController@sample');
Route::get('/howto', 'StaticController@howto');
Route::get('/error', 'StaticController@error');
Route::get('/maintenance', 'MaintenanceController@maintenance');
Route::post('/maintenance', 'MaintenanceController@maintenance');
Route::post('/maintenance/facilityManagement', 'FacilityController@facilityList');
Route::post('/maintenance/facilityManagement/detail', 'FacilityController@facilityDetail');
Route::post('/maintenance/facilityManagement/saveDetail', 'FacilityController@saveDetail');

