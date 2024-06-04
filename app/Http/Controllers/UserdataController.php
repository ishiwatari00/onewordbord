<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserdataController extends Controller
{
    public function register(Request $request){   //アカウント登録+ログイン

        $request->validate([
            'username' => 'required|unique:userdatas|max:30|String',
            'password' => 'required|min:4|max:30|String'
        ]);

        try{
        $userdata = Userdata::query()->create([
            'username'=>$request['username'],
            'password'=>Hash::make($request['password']),
        ]);

        }catch(Exception $e){
            abort(404);
        }

        if($userdata != null){
            Auth::login($userdata);
            if(Auth::check()){
                return redirect('home');
            }else{
                return redirect('login')->with('message', 'ログイン出来ませんでした');
            }

        }else{
            return redirect('reister')->with('message', '登録出来ませんでした');
        }
    }

    public function loginkeep(Request $request){   //ログイン機能 

        $request->validate([
            'username' => 'required|max:30|String|exists:userdatas,username',
            'password' => 'required|min:4|max:30|String'
        ]);
 
        $logindata = $request->only('username', 'password');

        try{
        if(Auth::attempt($logindata)){
            return redirect('home');
        }else{
            return redirect('login')->with('message', 'ログイン出来ませんでした');
        }

        }catch(Exception $e){
            abort(404);
        }

    }

    public function logout(){  //ログアウト+セッション削除

        try{
        if (Auth::logout()) {
            return redirect('login');
        }else{
            return redirect('home')->with('message', 'ログアウト出来ませんでした');
        }
        }catch(Exception $e){
            abort(404);
        }
    }

    public function useredit(Request $request){  //編集
            
        $request->validate([
            'id' => 'integer|exists:userdatas,id',
            'username' => 'required|max:30|String|unique:userdatas,username,' . Auth::user()->username . ',username',
            'password' => 'required|min:4|max:30|String',
        ]);

        if($request['id'] == Auth::id()){

            try{
            $result = Userdata::where('id', '=', $request['id'])
            ->update([
                'username' => $request['username'],
                'password'=>Hash::make($request['password']),
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

    public function leave(Request $request){ //ユーザー退会

        $request->validate([
            'username' => 'exists:userdatas,username',
            'password' => 'required|min:4|max:30|String',
        ]);
        
        $logindata = $request->only('username', 'password');

        if(Auth::attempt($logindata)){

            try{
                $result = Userdata::destroy(Auth::id()); 
        
                }catch(Exception $e){
                    abort(404);
                }
        
                if($result = 1){
                return redirect('register')->with('message', '退会しました');
                }else{
                    return redirect('mypage')->with('message', '退会出来ませんでした');
                }

        }else{
            return redirect('leavecheck')->with('message', 'パスワードが間違っています');
        }
    }

    
}
