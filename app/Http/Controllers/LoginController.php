<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    
    public function loginkeep(Request $request){   //ログイン機能
        
        $userdata = Userdata::
        where([
        ['username', '=', $request['username']],
        ['password', '=', $request['password']]])
        ->get();
        
        if(!empty($userdata[0]->id)){  
            $request->session()->put(['userid'=>$userdata[0]->id]);
            $request->session()->put(['username'=>$userdata[0]->username]);
            return redirect('home');
        }else{
            //エラーメッセージ
            return redirect('login');
        }
    }
}
