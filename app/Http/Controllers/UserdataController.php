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

        $validated = $request->validate([
            'username' => 'required|unique:userdatas|max:30',
            'password' => 'required|min:4|max:30'
        ]);

        if (!$validated) {
            return redirect('register');
        }

        $userdata = Userdata::query()->create([
            'username'=>$request['username'],
            'password'=>Hash::make($request['password']),
        ]);

        Auth::login($userdata);
        return redirect('home');
    }

    public function logout(){  //ログアウト（セッション削除
        session()->flush();
        Auth::logout();
        return redirect('home');
    }

}
