<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;
use Illuminate\Support\Facades\DB;

class UserdataController extends Controller
{
    public function register(Request $request){   //アカウント登録 idとpw渡し
        $user = new Userdata();
        $user->username = $request->input('username');
        $user->pass = $request->input('pass');
        $user->save();

        return redirect('home');
    }

    public function loginkeep(Request $request){   //ログイン機能

        $userdata = Userdata::
        where([
        ['username', '=', $request['username']],
        ['pass', '=', $request['pass']]])
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

    public function logout(){  //ログアウト（セッション削除
        session()->flush();
        return redirect('home');
    }

}
