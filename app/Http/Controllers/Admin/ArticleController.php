<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Article;

class ArticleController extends CommonController
{
    //get.admin/category  全部分类列表
    //解析：
    //get：Method,行为方式
    //admin/category：URI,调用的url地址
    //index()：Action(方法),访问的方法
    public function index(){
        $data = Article::orderBy('art_order','desc')->paginate(7);

        //遍历出所属分类
        $data = (new Category)->getCate($data);

        return view('admin/article/index',compact('data'));
    }

    //修改排序
    public function changeOrder()
    {
        $input = Input::all();
        $article = Article::find($input['art_id']);
        $article->art_order = $input['art_order'];
        $re = $article->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '文章排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '文章排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //修改状态
    public function changeStatus(){
        $input = Input::all();
        $art = Article::find($input['art_id']);        
        $art->art_status = $input['art_status'] == 0 ? 1: 0;
        $text = $input['art_status'] == 0 ? '关闭': '打开';        

        $re = $art->update();

        if($re){

            $data = [
                'status' => 0,
                'msg' => '状态更新成功！',
                'text' => $text,
                'statusVal' => $art->art_status,
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
        // $input['art_time'] = time();

        $rules = [
            'art_title'=>'required',
            'art_content'=>'required',
        ];

        $message = [
            'art_title.required'=>'文章标题不能为空！',
            'art_content.required'=>'文章内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Article::create($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/category/create   添加分类 | 新增（显示模板）
    public function create(){

    	$data = (new Category) -> tree();
    	return view('admin/article/add',compact('data'));

    }
    //get.admin/category/{category}  显示单个分类信息
    public function show(){

    }
    //delete.admin/category/{category}   删除单个分类
    public function destroy($art_id){
        $re = Article::where('art_id',$art_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '文章删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
    //put.admin/category/{category}    更新分类 | 编辑（编辑操作）
    public function update($art_id){
        $input = Input::except('_token','_method');
        $rules = [
            'art_title'=>'required',
            'art_content'=>'required',
        ];

        $message = [
            'art_title.required'=>'文章标题不能为空！',
            'art_content.required'=>'文章内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Article::where('art_id',$art_id)->update($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','文章更新失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }        

    }

    //get.admin/category/{category}/edit  编辑分类 | 编辑（显示模板）
    public function edit($art_id){
        $data = (new Category)->tree();
        $field = Article::find($art_id);
        return view('admin/article/edit',compact('data','field'));
    }    
}
