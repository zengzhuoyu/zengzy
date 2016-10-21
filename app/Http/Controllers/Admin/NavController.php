<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavController extends CommonController
{
    //get.admin/nav  全部自定义导航列表
    public function index()
    {
        $data = Nav::orderBy('nav_order','desc')->get();
        return view('admin/nav/index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Nav::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '自定义导航排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '自定义导航排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/nav/create   添加自定义导航
    public function create()
    {
        return view('admin/nav/add');
    }

    //post.admin/nav  添加自定义导航提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];

        $message = [
            'nav_name.required'=>'导航名称不能为空！',         
            'nav_url.required'=>'导航URL不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Nav::create($input);
            if($re){
                return redirect('admin/nav');
            }else{
                return back()->with('errors','导航失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/nav/{nav}/edit  编辑自定义导航
    public function edit($nav_id)
    {
        $field = Nav::find($nav_id);
        return view('admin/nav/edit',compact('field'));
    }

    //put.admin/nav/{nav}    更新自定义导航
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');

        $rules = [
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];

        $message = [
            'nav_name.required'=>'导航名称不能为空！',         
            'nav_url.required'=>'导航URL不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Nav::where('nav_id',$nav_id)->update($input);
            if($re){
                return redirect('admin/nav');
            }else{
                return back()->with('errors','导航更新失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
                        
    }

    //delete.admin/nav/{nav}   删除自定义导航
    public function destroy($nav_id)
    {
        $re = Nav::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '导航删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '导航删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

}
