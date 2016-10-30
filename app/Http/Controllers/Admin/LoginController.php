<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;

require_once 'org/code/Code.class.php';

class LoginController extends CommonController
{

    public function login(){//登录 与 提交登录信息

    	if($input = Input::all()){

    		//验证验证码
    		$code = new \Code();
    		$_code = $code -> get();
    		if(strtoupper($input['code']) != $_code){
    			return back() -> with('msg','验证码错误！');
    		}
    		
    		//验证用户名和密码
    		$user = User::where('user_name',$input['user_name'])->first();
    		if(!$user || Crypt::decrypt($user->user_pass) != $input['user_pass']){
    			return back() -> with('msg','用户名 或者 密码错误！');
    		}
                      if($user->user_name == 'zengzy'){
                        session(['changePass'=>$user]);
                      }
    		session(['user'=>$user]);
    		
    		return redirect('admin/index');
    	}else{
	    	return view('admin/login');    	
    	}
    }

    //在登录页面显示验证图案
    public function code(){

    	$code = new \Code();
    	$code -> make();
    }

}
