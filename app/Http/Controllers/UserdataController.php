<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\DB;

class UserdataController extends Controller
{
    public function register(Request $request){   //アカウント登録 idとpw渡し

        $validated = $request->validate([
            'username' => 'required|unique:userdatas|max:30',
            'password' => 'required|min:7|max:30'
        ]);

        if ($validated->fails()) {
            return redirect('register');
        }


        $user = new Userdata();
        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->save();

        return redirect('home');
    }

    public function logout(){  //ログアウト（セッション削除
        session()->flush();
        return redirect('home');
    }

}
