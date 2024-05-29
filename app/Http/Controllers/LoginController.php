<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function loginkeep(Request $request){   //ログイン機能 

        $validated = $request->validate([
            'username' => 'required|max:30',
            'password' => 'required|min:4|max:30'
        ]);

        if (!$validated) {
            return redirect('login');
        }
 
        $logindata = $request->only('username', 'password');

        if(Auth::attempt($logindata)){
            if(Auth::check()){
                return redirect('home');
            }else{
                return redirect('login')->with('message', 'ログイン出来ませんでした');
            }
        }else{
            return redirect('login')->with('message', 'ログイン出来ませんでした');
        }

    }

}
