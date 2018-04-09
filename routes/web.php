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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/searchusers', 'ProfileController@searchperfil')->name('searchusers');
Route::get('profile/get_message', 'ProfileController@get_message')->name('profile.get_message');
Route::get('profile/private_message', 'ProfileController@send_message')->name('profile.private_message');

Route::get('newelo', 'ProfileController@create_elo')->name('newelo');

Route::get('searchusers', 'ProfileController@searchperfil')->name('searchusers');
Route::get('/', 'IndexController@Index');

Route::get('inscription', 'InscriptionController@Index');

Route::get('/error', function () {
    return view('error');
});

Route::get('home/menu', 'MenuController@menu');
Route::post('home/menu/saveconfig','MenuController@saveconfig');

Route::get('home', 'HomeController@Index');

Route::group(['middleware'=>['web']], function(){
	Route::resource('memoirfeed','MemoirFeedController');
});

Route::post('savememoir','MemoirFeedController@savememoir');

Route::get('logout', 'Auth\LoginController@logout');


Route::get('/{alias?}', 'ProfileController@perfil');




