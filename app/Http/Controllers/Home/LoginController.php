<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;

class LoginController extends Controller
{

    public function login(){//登录 与 提交登录信息

        if($input = Input::all()){

            $user_name = $input['user_name'];

            $user = User::where('user_name',$input['user_name'])->first();
            if($user_name != 'zengzy' || Crypt::decrypt($user->user_pass) != $input['user_pass']){
                return back() -> with('msg','用户名 或者 密码错误！');
            }

            session(['zengzy'=>$user]);

            return redirect('d');

        }else{
            return view('home/login');    	
        }
    }

}
