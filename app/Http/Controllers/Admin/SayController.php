<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Say;

class SayController extends CommonController
{
    
    //get.admin/category  全部分类列表
    //解析：
    //get：Method,行为方式
    //admin/category：URI,调用的url地址
    //index()：Action(方法),访问的方法
    public function index(){
        $data = Say::orderBy('say_order','desc')->orderBy('say_id','desc')->paginate(7);
        return view('admin/say/index',compact('data'));
    }

    //修改排序
    public function changeOrder(){
        $input = Input::all();
        $say = Say::find($input['say_id']);
        $say->say_order = $input['say_order'];
        $re = $say->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '说说排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '说说排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //post.admin/category 分类提交方法 | 新增（操作执行）
    public function store(){
        $input = Input::except('_token');

        $rules = [
            'say_author'=>'required',
            'say_content'=>'required',
        ];

        $message = [
            'say_author.required'=>'说说作者不能为空！',
            'say_content.required'=>'说说内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Say::create($input);
            if($re){
                return redirect('admin/say');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/category/create   添加分类 | 新增（显示模板）
    public function create(){

    	// $data = (new Category) -> tree();
    	// return view('admin/article/add',compact('data'));
    	
    	return view('admin/say/add');

    }
    //get.admin/category/{category}  显示单个分类信息
    public function show(){

    }
    //delete.admin/category/{category}   删除单个分类
    public function destroy($say_id){
        $re = Say::where('say_id',$say_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '说说删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '说说删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
    //put.admin/category/{category}    更新分类 | 编辑（编辑操作）
    public function update($say_id){
        $input = Input::except('_token','_method');

        $rules = [
            'say_author'=>'required',
            'say_content'=>'required',
        ];

        $message = [
            'say_author.required'=>'说说作者不能为空！',
            'say_content.required'=>'说说内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Say::where('say_id',$say_id)->update($input);
            if($re){
                return redirect('admin/say');
            }else{
                return back()->with('errors','说说更新失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }

        // $re = Say::where('say_id',$say_id)->update($input);
        // if($re){
        //     return redirect('admin/say');
        // }else{
        //     return back()->with('errors','说说更新失败，请稍后重试！');
        // }
    }

    //get.admin/category/{category}/edit  编辑分类 | 编辑（显示模板）
    public function edit($say_id){
        // $data = (new Category)->tree();
        $field = Say::find($say_id);
        return view('admin/say/edit',compact('field'));
        // return view('admin/article/edit',compact('data','field'));
    }    
}
