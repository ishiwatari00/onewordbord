<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Threadcmt;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Exception;

class ThreadController extends Controller
    {
        
    public function index() {       //home表示
        
            $threads = Thread::sortable()->
                where([ ['bordname', '!=', null]])
                ->orderBy('id', 'desc')
                ->paginate(10);
    
            $threadcmts = Threadcmt::all();

            $memos = Memo::where([['userid', '=', Auth::id()]])->orderBy('hostid', 'desc')->get();
            
            return view('home', ['threads' => $threads,'threadcmts' => $threadcmts,'memos' => $memos]);

        }

    public function mypage() {       //マイページ表示のためのスレッド部分取得

            $threads = Thread::
                where([['userid', '=', Auth::id()]])
                ->orderBy('id', 'desc')
                ->paginate(10);

            $threadcmts = Threadcmt::all();

            return view('mypage', ['threads' => $threads],['threadcmts' => $threadcmts])->with('action','tweet');
        }

    public function mycmt() {       //マイページ表示のためのコメントのみ部分取得

            $threads = Threadcmt::
                where([['userid', '=', Auth::id()]])
                ->orderBy('id', 'desc')
                ->paginate(10);

            return view('mypage', ['threads' => $threads])->with('action','cmt');
        }


    public function search(Request $request) {       //スレッド検索

            $request->validate([
                'bordname' => 'max:30',
                'gender' => 'integer',
                'address' => 'nullable',
                'oneword' => 'max:100'
            ]);

            $request->session()->flash('_old_input',[
                'bordname' => $request['bordname'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'oneword' => $request['oneword'],
            ]);

            try{
                
                $threadQuery = Thread::query();

                if(!empty($request['bordname'])){
                    $threadQuery->where('bordname', 'LIKE', "%{$request['bordname']}%");
                }

                if(!empty($request['gender'])){
                    $threadQuery->where('gender', '=', $request['gender']);
                }

                if(!empty($request['address'])){
                    $threadQuery->where('address', '=', $request['address']);
                }

                if(!empty($request['oneword'])){
                    $threadQuery->where('oneword', 'LIKE', "%{$request['oneword']}%");
                }

                $threads = $threadQuery->sortable()->orderBy('id', 'desc')->paginate(10);
                $threadcmts = Threadcmt::all();


                }catch(Exception $e){
                    abort(404);
                }
                return view('home', ['threads' => $threads,'threadcmts' => $threadcmts]);
            
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

    public function comment(Request $request){ //コメント投稿した時のDB登録

            $request->validate([
                'bordname' => 'required|max:30|String',
                'hostid' => 'required|exists:threads,id|integer',
                'oneword' => 'required|max:100|String',
            ]);
            
            $tweet = new Threadcmt();
            $tweet->bordname = $request->input('bordname');
            $tweet->oneword = $request->input('oneword');
            $tweet->hostid = $request->input('hostid');
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

public function addmemo(Request $request){ //メモ登録した時のDB登録

            $request->validate([
                'hostid' => 'required|exists:threads,id|unique:memos,hostid|integer',
                'oneword' => 'required|max:100|String',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);
            
            $memo = new Memo();
            $memo->hostid = $request->input('hostid');
            $memo->oneword = $request->input('oneword');
            $memo->userid = Auth::id();

            try{
            $result = $memo->save();
            }catch(Exception $e){
                abort(404);
            }

            if($result){
                $id = $memo->id;
                $hostid = $request->input('hostid');
                $oneword = $request->input('oneword');
                $userid = $request->input('userid');
                return response()->json(['id' => $id,'hostid' => $hostid,'oneword' => $oneword,'id' => $id,'userid' => $userid]);   
            }
        }

            
            

    public function edit(Request $request){  //編集画面にIDを送る

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
            ]);

            $threads = Thread::where([['id', '=', $request['id']]])->get();;
            return view('edit',['threads' => $threads]);
        }


    public function editcmt(Request $request){  //編集画面にIDを送る コメント

            $request->validate([
                'id' => 'required|integer|exists:threadcmts,id',
            ]);

            $threads = Threadcmt::where([['id', '=', $request['id']]])->get();;
            return view('edit',['threads' => $threads]);
        }
    

    public function editcomp(Request $request){  //編集(DBへアップデート)
            
            $request->validate([
                'id' => 'required|integer|exists:threads,id',
                'bordname' => 'required|max:30|String',
                'gender' => 'required|integer',
                'address' => 'required|integer',
                'oneword' => 'required|max:100|String',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);

            if($request['userid'] == Auth::id()){

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
            
            }else{
                abort(404);
            }
        }


    public function editcmtcomp(Request $request){  //編集(DBへアップデート) コメント
            
            $request->validate([
                'id' => 'required|integer|exists:threadcmts,id',
                'bordname' => 'required|max:30|String',
                'oneword' => 'required|max:100|String',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);

            if($request['userid'] == Auth::id()){

                try{
                $result = Threadcmt::where('id', '=', $request['id'])
                ->update([
                    'bordname' => $request['bordname'],
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
            
            }else{
                abort(404);
            }
        }

        public function memoedit(Request $request){  //メモ編集(DBへアップデート)
            
            $request->validate([
                'id' => 'required|integer|exists:memos,id',
                'oneword' => 'required|max:100|String',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);

            if($request['userid'] == Auth::id()){

                try{
                $result = Memo::where('id', '=', $request['id'])
                ->update([
                    'oneword' => $request['oneword']
                ]);
                }catch(Exception $e){
                    abort(404);
                }

                if($result != 0){
                    return response()->json(['oneword' => $oneword]);
                }
            
            }else{
                abort(404);
            }
        }

        
    public function deletecheck(Request $request){ //削除データ確認画面

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
            ]);

            $threads = Thread::where([['id', '=', $request['id']]])->get();;
            return view('deletecheck', ['threads' => $threads]);
        }


    public function deletecmtcheck(Request $request){ //削除データ確認画面 コメント

            $request->validate([
                'id' => 'required|integer|exists:threadcmts,id',
            ]);

            $threads = Threadcmt::where([['id', '=', $request['id']]])->get();;
            return view('deletecheck', ['threads' => $threads]);
        }


    public function delete(Request $request){ //削除

            $request->validate([
                'id' => 'required|integer|exists:threads,id',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);
            
            if($request['userid'] == Auth::id()){

                try{
                $result = Thread::destroy($request['id']);

                }catch(Exception $e){
                    abort(404);
                }

                if($result = 1){
                return redirect('mypage');
                }else{
                    return redirect('mypage')->with('message', '削除出来ませんでした');
                }

            }else{
                abort(404);
            }
        }

        
    public function deletecmt(Request $request){ //削除コメント

            $request->validate([
                'id' => 'required|integer|exists:threadcmts,id',
                'userid' => 'required|integer|exists:userdatas,id',
            ]);
            
            if($request['userid'] == Auth::id()){

                try{
                $result = Threadcmt::destroy($request['id']);

                }catch(Exception $e){
                    abort(404);
                }

                if($result = 1){
                return redirect('mypage');
                }else{
                    return redirect('mypage')->with('message', '削除出来ませんでした');
                }

            }else{
                abort(404);
            }
        }

public function memodelete(Request $request){ //削除メモ

            $request->validate([
                'id' => 'required|integer|exists:memos,id',
            ]);

            if($request['userid'] == Auth::id()){

                $id = $request['id'];

                try{
                $result = Memo::destroy($request['id']);

                }catch(Exception $e){
                    abort(404);
                }

                if($result = 1){
                    return response()->json(['id' => $id]);   
                }else{

                }

            }else{
                abort(404);
            }
        }
    
}
