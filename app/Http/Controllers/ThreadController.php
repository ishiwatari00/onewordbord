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

        $validated = $request->validate([
            'bordname' => 'required|max:30',
            'gender' => 'required',
            'address' => 'required',
            'oneword' => 'required|max:100'
        ]);

        if (!$validated) {
            return redirect('home');
        }

        $tweet = new Thread();
        $tweet->bordname = $request->input('bordname');
        $tweet->gender = $request->input('gender');
        $tweet->address = $request->input('address');
        $tweet->oneword = $request->input('oneword');
        $tweet->userid = Auth::id();
        $tweet->save();

        return redirect('home');
        }

    public function edit(Request $request){  //セッションにＩＤ入れる
        $id = $request->input('id');
        $request->session()->put(['id'=>$id]);  
        return view('edit');
    }

    public function editcomp(Request $request){  //編集
        
        $validated = $request->validate([
            'bordname' => 'required|max:30',
            'gender' => 'required',
            'address' => 'required',
            'oneword' => 'required|max:100'
        ]);

        if (!$validated) {
            return redirect('edit');
        }

        Thread::where('id', '=', $request['id'])
            ->update([
                    'bordname' => $request['bordname'],
                    'gender' => $request['gender'],
                    'address' => $request['address'],
                    'oneword' => $request['oneword']
                    ]);

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
