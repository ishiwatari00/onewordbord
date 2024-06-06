<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserdataController;

Route::controller(ThreadController::class)->middleware(['auth'])->group(function(){

    Route::get('/home', 'index');                     //一覧表示
    Route::get('/mypage', 'mypage');                //マイページ一覧表示
    Route::get('/mycmt', 'mycmt');                //マイページ一覧表示　コメント
    Route::get('/search', 'search');                  //一覧検索表示
    Route::post('/tweet', 'tweets');                  //投稿
    Route::post('/comment', 'comment');               //コメント投稿
    Route::get('/edit', 'edit');                      //編集確認
    Route::get('/editcmt', 'editcmt');                //編集確認 コメント
    Route::post('/editcomp', 'editcomp');             //編集
    Route::post('/editcmtcomp', 'editcmtcomp');       //編集コメント
    Route::get('/deletecheck', 'deletecheck');        //削除前確認
    Route::get('/deletecmtcheck', 'deletecmtcheck');  //削除前確認　コメント
    Route::post('/delete', 'delete');                 //削除
    Route::post('/deletecmt', 'deletecmt');           //削除

});

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


Route::controller(UserdataController::class)->group(function(){

Route::post('/insert', 'register');                         //アカウントDB登録
Route::post('/loginkeep', 'loginkeep');                     //ログイン
Route::get('/logout', 'logout');                            //ログアウト
Route::post('/useredit', 'useredit')->middleware('auth');   //編集
Route::post('/leave', 'leave')->middleware('auth');         //削除

});