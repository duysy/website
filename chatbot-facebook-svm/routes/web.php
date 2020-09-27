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
// Data
Route::get('/data',"Web\MyController@data");
Route::post('/data/{todo}','Web\Api@Api_data_post');
Route::get('/data/{todo}','Web\Api@Api_data_get');
Route::delete('/data/{todo}','Web\Api@Api_data_delete');
Route::put('/data/{todo}','Web\Api@Api_data_put');
// show-all-mes
Route::get('/show_all_mes', "Web\MyController@show_all_mes");
// setting
Route::get('/setting', "Web\MyController@setting");
//fun_tem_mes
Route::get('/fun_tem_mes', "Web\MyController@fun_tem_mes");
// webhook
Route::get('/webhook/{id_page}', "Web\webhook@get");
Route::post('/webhook/{id_page}', "Web\webhook@post");

// login
Route::get('/login', "Web\Authentication@getLogin")->name('login');
Route::post('/login', "Web\Authentication@postLogin");

Route::get('/register', "Web\Authentication@getRegister");
Route::post('/register', "Web\Authentication@postRegister");

Route::get('/logout', "Web\Authentication@logout");



// Đăng xuất

Route::get('/test-copy', function () {
    return view('test-copy');
});
Route::get('/test', function () {
    return view('test');
});

