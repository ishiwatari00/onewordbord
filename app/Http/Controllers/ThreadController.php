<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index() {       //スレッド一覧表示のための全取得
        $threads = Thread::paginate(10);
        return view('home', ['threads' => $threads]);
    }

    public function mythread() {       //スレッド一部表示のための部分取得
        $threads = Thread::where([
            ['userid', '=', Auth::id()]])
            ->paginate(10);
        return view('mypage', ['threads' => $threads]);
    }


    public function tweets(Request $request){ //スレッド投稿した時のDB登録

        $request->validate([
            'bordname' => 'required|max:30|String',
            'gender' => 'required|integer',
            'address' => 'required|integer',
            'oneword' => 'required|max:100|String'
        ]);
        

        $tweet = new Thread();
        $tweet->bordname = $request->input('bordname');
        $tweet->gender = $request->input('gender');
        $tweet->address = $request->input('address');
        $tweet->oneword = $request->input('oneword');
        $tweet->userid = Auth::id();

        if( $tweet->save()){
            return redirect('home');
        }else{
            return redirect('home')->with('message', '投稿出来ませんでした');
             }
        }

    public function edit(Request $request){  //編集画面にIDを送る

        $request->validate([
            'id' => 'required|integer',
        ]);
        
        return view('edit',['id' => $request->input('id')]);
    }

    public function editcomp(Request $request){  //編集
        
        $request->validate([
            'id' => 'required|integer',
            'bordname' => 'required|max:30|String',
            'gender' => 'required|integer',
            'address' => 'required|integer',
            'oneword' => 'required|max:100|String'
        ]);



        if(Thread::where('id', '=', $request['id'])
        ->update([
            'bordname' => $request['bordname'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'oneword' => $request['oneword']
            ])){
            return redirect('mypage');
        }else{
            return redirect('mypage')->with('message', '編集出来ませんでした');
             }

    }

    public function delete(Request $request){ //削除

        $request->validate([
            'id' => 'required|integer',
        ]);

        $id = $request->input('id');
        Thread::destroy($id);
        return redirect('mypage');
    }

    public function deletecheck(Request $request){ //削除チェック

        $request->validate([
            'id' => 'required|integer',
        ]);

        $id = $request->input('id');  
        $threads = Thread::where([['id', '=', $request['id']]])->get();;
        return view('deletecheck', ['threads' => $threads]);
        
    }
}
