<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function loginkeep(Request $request){   //ログイン機能 

 
        $logindata = $request->only('username', 'password');

        if(Auth::attempt($logindata)){
            return redirect('home');
        }else{
            return redirect('login');
        }

    }

}
