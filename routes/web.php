<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'App\Http\Controllers\ThreadController@index')->middleware('auth'); //一覧表示

Route::get('/mypage', 'App\Http\Controllers\ThreadController@mythread')->middleware('auth'); //一覧一部表示

Route::post('/tweet', 'App\Http\Controllers\ThreadController@tweets')->middleware('auth'); //投稿

Route::get('/edit', 'App\Http\Controllers\ThreadController@edit')->middleware('auth'); //編集画面行

Route::post('/editcomp', 'App\Http\Controllers\ThreadController@editcomp')->middleware('auth'); //編集

Route::post('/delete', 'App\Http\Controllers\ThreadController@delete')->middleware('auth'); //削除

Route::get('/deletecheck', 'App\Http\Controllers\ThreadController@deletecheck')->middleware('auth'); //削除ダイアログ

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::post('/insert', 'App\Http\Controllers\UserdataController@register'); //アカウントDB登録

Route::post('/loginkeep', 'App\Http\Controllers\LoginController@loginkeep'); //ログイン

Route::get('/logout', 'App\Http\Controllers\UserdataController@logout'); //ログアウツ