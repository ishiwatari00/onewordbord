<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Validator;

class ThreadController extends Controller
{
    public function index() {       //スレッド一覧表示のための全取得
        $threads = Thread::paginate(10);
        return view('home', ['threads' => $threads]);
    }

    public function mythread() {       //スレッド一部表示のための部分取得
        $threads = Thread::where([
            ['userid', '=', session('userid')]])
            ->paginate(10);
        return view('mypage', ['threads' => $threads]);
    }


    public function tweets(Request $request){ //スレッド投稿した時のDB登録

    $tweet = new Thread();
    $tweet->oneword = $request->input('oneword');
    $tweet->userid = $request->input('userid');
    $tweet->save();

    return redirect('home');
    }

    public function edit(Request $request){  //セッションにＩＤ入れる
        $id = $request->input('id');
        $request->session()->put(['id'=>$request->id]);  
        return view('edit');
    }

    public function editcomp(Request $request){  //編集ページにID入れる
        
        Thread::
            where([['id', '=', $request['id']]])
            ->update(['oneword' => $request['oneword']]);

        return redirect('mypage');
    }

    public function delete(Request $request){ //削除
        $id = $request->input('id');  
        Thread::destroy($id);
        return redirect('mypage');
    }

    public function deletecheck(Request $request){ //削除チェック
        $id = $request->input('id');  
        $threads = Thread::where([['id', '=', $request['id']]])->get();;
        return view('deletecheck', ['threads' => $threads]);
        
    }
}
