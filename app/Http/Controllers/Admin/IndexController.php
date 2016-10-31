<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;

use App\Http\Model\User;

use Illuminate\Support\Facades\Crypt;

class IndexController extends CommonController
{
	public function index(){
		
		return view('admin/index');
	}

	public function info(){

		return view('admin/info');
	}	

	//退出
	public function quit(){

		session(['user' => null]);
		return redirect('admin/boomshakalaka/login');
	}	

	//修改密码
	public function pass(){

	        if($input = Input::all()){

	            $rules = [
	                'password'=>'required|between:6,20|confirmed',
	            ];

	            $message = [
	                'password.required'=>'新密码不能为空！',
	                'password.between'=>'新密码必须在6-20位之间！',
	                'password.confirmed'=>'新密码和确认密码不一致！',
	            ];

	            $validator = Validator::make($input,$rules,$message);

	            if($validator->passes()){
	                $user = User::first();

	                $_password = Crypt::decrypt($user->user_pass);

	                if($input['password_o']==$_password){

	                    $user->user_pass = Crypt::encrypt($input['password']);

	                    $user->update();

	                    return back()->with('errors','密码修改成功！');
	                }else{
	                    return back()->with('errors','原密码错误！');
	                }
	            }else{
	                return back()->withErrors($validator);
	            }
	        }else{
	            return view('admin.pass');
	        }

	}

	//新增用户
	public function user(){

	        $input = Input::except('_token');

	        if($input){

	            $rules = [
	                'user_name'=>'required|between:4,10',
	                'user_pass'=>'required|between:6,20|confirmed',
	            ];

	            $message = [
	                'user_name.required'=>'用户名不能为空！',	    
	                'user_name.between'=>'用户名必须在4-10位之间！',	                        
	                'user_pass.required'=>'密码不能为空！',
	                'user_pass.between'=>'密码必须在6-20位之间！',
	                'user_pass.confirmed'=>'密码和确认密码不一致！',
	            ];

	            $validator = Validator::make($input,$rules,$message);

	            if($validator->passes()){

	                      $input['user_pass'] = Crypt::encrypt($input['user_pass']);	
	                      unset($input['user_pass_confirmation']);
			$re = User::create($input);
			if($re){
				return back()->with('errors','新用户增加成功！');				
			}else{
				return back()->with('errors','新用户增加失败，请稍后重试！');
			}	        
	            }else{
	                return back()->withErrors($validator);
	            }
	        }else{
	            return view('admin/user/user');
	        }

	}	

	//用户列表
	public function userList(){

	        $data = User::paginate(7);

	        return view('admin/user/index',compact('data'));		
	}

	//修改前台权限状态
	public function changeHomeStatus(){
	    $input = Input::all();
	    $user = User::find($input['user_id']);        
	    $user->h_status = $input['h_status'] == 0 ? 1: 0;
	    $text = $input['h_status'] == 0 ? '关闭': '打开';        

	    $re = $user->update();

	    if($re){

	        $data = [
	            'status' => 0,
	            'msg' => '状态更新成功！',
	            'text' => $text,
	            'statusVal' => $user->h_status,
	        ];
	    }else{
	        $data = [
	            'status' => 1,
	            'msg' => '状态更新失败，请稍后重试！',
	        ];
	    }

	    return $data;
	}	

	//修改后台权限状态
	public function changeAdminStatus(){
	    $input = Input::all();
	    $user = User::find($input['user_id']);        
	    $user->a_status = $input['a_status'] == 0 ? 1: 0;
	    $text = $input['a_status'] == 0 ? '关闭': '打开';        

	    $re = $user->update();

	    if($re){

	        $data = [
	            'status' => 0,
	            'msg' => '状态更新成功！',
	            'text' => $text,
	            'statusVal' => $user->a_status,
	        ];
	    }else{
	        $data = [
	            'status' => 1,
	            'msg' => '状态更新失败，请稍后重试！',
	        ];
	    }

	    return $data;
	}		
}
