<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Exception;

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

            try{
            $result = $tweet->save();
            }catch(Exception $e){
                abort(404);
            }

            if($result){
                return redirect('home');
            }else{
                return redirect('home')->with('message', '投稿出来ませんでした');
                }
            }
            

    public function edit(Request $request){  //編集画面にIDを送る

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
            ]);

            $threads = Thread::where([['id', '=', $request['id']]])->get();;
            return view('edit',['threads' => $threads]);
        }


    public function editcomp(Request $request){  //編集
            
            $request->validate([
                'id' => 'required|integer|exists:threads,id',
                'bordname' => 'required|max:30|String',
                'gender' => 'required|integer',
                'address' => 'required|integer',
                'oneword' => 'required|max:100|String'
            ]);

           try{
            $result = Thread::where('id', '=', $request['id'])
            ->update([
                'bordname' => $request['bordname'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'oneword' => $request['oneword']
            ]);
            }catch(Exception $e){
                abort(404);
            }

            if($result != 0){
                return redirect('mypage');
            }else{
                return redirect('mypage')->with('message', '編集出来ませんでした');
                }

        }

    public function delete(Request $request){ //削除

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
            ]);
            
            try{
            $result = Thread::destroy($request['id']);

            }catch(Exception $e){
                abort(404);
            }

            if($result = 1){ //修正
            return redirect('mypage');
            }else{
                return redirect('mypage')->with('message', '削除出来ませんでした');
            }
        }

    public function deletecheck(Request $request){ //削除チェック

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
            ]);

            $threads = Thread::where([['id', '=', $request['id']]])->get();;
            return view('deletecheck', ['threads' => $threads]);
            
        }
}
