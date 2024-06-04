<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'App\Http\Controllers\ThreadController@index')->middleware('auth'); //一覧表示

Route::get('/mypage', 'App\Http\Controllers\ThreadController@mythread')->middleware('auth'); //一覧一部表示

Route::get('/search', 'App\Http\Controllers\ThreadController@search')->middleware('auth'); //一覧検索表示

Route::post('/tweet', 'App\Http\Controllers\ThreadController@tweets')->middleware('auth'); //投稿

Route::post('/comment', 'App\Http\Controllers\ThreadController@comment')->middleware('auth'); //コメント投稿

Route::get('/edit', 'App\Http\Controllers\ThreadController@edit')->middleware('auth'); //編集確認

Route::get('/editcmt', 'App\Http\Controllers\ThreadController@editcmt')->middleware('auth'); //編集確認 コメント

Route::post('/editcomp', 'App\Http\Controllers\ThreadController@editcomp')->middleware('auth'); //編集

Route::post('/editcmtcomp', 'App\Http\Controllers\ThreadController@editcmtcomp')->middleware('auth'); //編集コメント

Route::get('/deletecheck', 'App\Http\Controllers\ThreadController@deletecheck')->middleware('auth'); //削除前確認

Route::get('/deletecmtcheck', 'App\Http\Controllers\ThreadController@deletecmtcheck')->middleware('auth'); //削除前確認　コメント

Route::post('/delete', 'App\Http\Controllers\ThreadController@delete')->middleware('auth'); //削除

Route::post('/deletecmt', 'App\Http\Controllers\ThreadController@deletecmt')->middleware('auth'); //削除


//--------↑スレッド関連------------------------------
//--------↓アカウント関連----------------------------


Route::get('/login', function () {  //ログイン画面
    return view('login');
})->name('login');

Route::get('/register', function () { //登録画面
    return view('register');
});

Route::get('/usereditcheck', function () {
    return view('usereditcheck');
})->middleware('auth');             //編集画面

Route::get('/leavecheck', function () {
    return view('leavecheck');
})->middleware('auth');            //削除確認

Route::post('/insert', 'App\Http\Controllers\UserdataController@register'); //アカウントDB登録

Route::post('/loginkeep', 'App\Http\Controllers\UserdataController@loginkeep'); //ログイン

Route::get('/logout', 'App\Http\Controllers\UserdataController@logout'); //ログアウト

Route::post('/useredit', 'App\Http\Controllers\UserdataController@useredit')->middleware('auth'); //編集

Route::post('/leave', 'App\Http\Controllers\UserdataController@leave')->middleware('auth'); //削除