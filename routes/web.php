<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationSearcherController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(["register" => false]);
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/form', "ReservationFormController@show")->name("form.show");
Route::post('/form', "ReservationFormController@post")->name("form.post");

Route::get('/form/confirm', "ReservationFormController@confirm")->name("form.confirm");
Route::post('/form/confirm', "ReservationFormController@send")->name("form.send");

Route::get('/form/thanks', "ReservationFormController@complete")->name("form.complete");
Route::post('/form/thanks', "ReservationFormController@import")->name("form.send");

//管理側
Route::group(['middleware' => ['auth.admin']], function () {
	
	//管理側トップ
	Route::get('/admin', 'admin\AdminTopController@show');
	//ログアウト実行
	Route::post('/admin/logout', 'admin\AdminLogoutController@logout');
	//予約一覧
	Route::get('/admin/list', "admin\ManagePlanController@showlist")->name("showlist");
	Route::get('/admin/list/csv', "admin\ManagePlanController@outputCsv")->name("output_csv");
	//予約検索
//	Route::post('admin/search', 'admin\ReservationSearcherController@search')->name("search");
//	Route::get('admin/search', 'admin\ReservationSearcherController@searchresult')->name("searchresult");
	Route::get('admin/search', [App\Http\Controllers\admin\ReservationSearcherController::class, "search"])->name("searchresult");
	
});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');