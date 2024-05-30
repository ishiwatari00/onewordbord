<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserdataController extends Controller
{
    public function register(Request $request){   //アカウント登録 idとpw渡し

        $request->validate([
            'username' => 'required|unique:userdatas|max:30|String',
            'password' => 'required|min:4|max:30|String'
        ]);

        $userdata = Userdata::query()->create([
            'username'=>$request['username'],
            'password'=>Hash::make($request['password']),
        ]);


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

    public function logout(){  //ログアウト（セッション削除

        if (Auth::logout()) {
            return redirect('login');
        }else{
            return redirect('home')->with('message', 'ログアウト出来ませんでした');
        }
    }

}
