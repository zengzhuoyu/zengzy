<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Model\Category;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;

use App\Http\Model\Article;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    //解析：
    //get：Method,行为方式
    //admin/category：URI,调用的url地址
    //index()：Action(方法),访问的方法
    public function index(){
    	
        $categorys = (new Category)->tree();
        return view('admin/category/index')->with('data',$categorys);
    }

    //修改排序
    public function changeOrder(){
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //修改状态
    public function changeStatus(){
        $input = Input::all();
        $cate = Category::find($input['cate_id']);        
        $cate->cate_status = $input['cate_status'] == 0 ? 1: 0;
        $text = $input['cate_status'] == 0 ? '关闭': '打开';        

        $re = $cate->update();

        if($re){

            $article = Article::where('cate_id',$input['cate_id'])->get();
            
            (new Article)->changeStatus($article,$cate->cate_status);

            $data = [
                'status' => 0,
                'msg' => '状态更新成功！',
                'text' => $text,
                'statusVal' => $cate->cate_status,
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '状态更新失败，请稍后重试！',
            ];
        }

        return $data;
    }

    //post.admin/category 分类提交方法 | 新增（操作执行）
    public function store(){
    	
        $input = Input::except('_token');
        $rules = [
            'cate_name'=>'required',
        ];

        $message = [
            'cate_name.required'=>'分类名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Category::create($input);//插入数据
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    
    //get.admin/category/create   添加分类 | 新增（显示模板）
    public function create(){

        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }
    //get.admin/category/{category}  显示单个分类信息
    public function show(){

    }
    //delete.admin/category/{category}   删除单个分类
    public function destroy($cate_id){

        $data = ['status' => 1,'msg' => '',];

        $field = Category::where('cate_pid',$cate_id)->first();
        if($field){
            $data['msg'] = '请先删除子分类！';        
            return $data;
        }else{
            $field = Article::where('cate_id',$cate_id)->first();
            if($field){
                $data['msg'] = '请先删除该分类下的文章！';                           
                return $data;                
            }else{

                $re = Category::where('cate_id',$cate_id)->delete();
                // Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);//如果删除的是一级分类，且该分类下有子级，那么子级都变成一级
                if($re){
                    $data = ['status' => 0,'msg' => '分类删除成功！'];
                }else{
                    $data['msg'] = '分类删除失败，请稍后重试！';                          
                }
                return $data;                
            }
        }

    }
    //put.admin/category/{category}    更新分类 | 编辑（编辑操作）
    public function update($cate_id){
        $input = Input::except('_token','_method');
        $rules = [
            'cate_name'=>'required',
        ];

        $message = [
            'cate_name.required'=>'分类名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Category::where('cate_id',$cate_id)->update($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','分类信息更新失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }        
    }

    //get.admin/category/{category}/edit  编辑分类 | 编辑（显示模板）
    public function edit($cate_id){

        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/edit',compact('field','data'));
    }
}
