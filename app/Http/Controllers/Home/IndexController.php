<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use App\Http\Model\Category;
use App\Http\Model\Article;
use App\Http\Model\Say;
use App\Http\Model\Nav;

class IndexController extends CommonController
{

    public function index(){

        $input = Input::all();

        $page = isset($input['page']) ? $input['page'] : 1;

        $where = isset($input['where']) ? $input['where'] : '';

        //读取一级分类
        $categorys = (new Category)->treeii();

        //说说
        $say = Say::orderBy('say_order','desc')->orderBy('say_id','desc')->first();

        //读取所有文章
        $article = Article::where('art_status',1)->where('art_title','like','%'.$where.'%')->orderBy('art_order','desc')->orderBy('art_id','desc')->paginate(7);
        //文章时间格式化
        $article = (new Article)->clearTime($article,'art_updatetime',2,8,true);     

        return view('home/index',compact('where','page','categorys','say','article'));
    }

    public function cate($cate_id){

        $input = Input::all();

        $page = isset($input['page']) ? $input['page'] : 1;
        
        $where = isset($input['where']) ? $input['where'] : '';

        //读取一级分类
        $categorys = (new Category)->treeii();

        //读取所有该一级分类下的文章
        $article = Article::where('cate_id',$cate_id)->where('art_title','like','%'.$where.'%')->orderBy('art_order','desc')->orderBy('art_id','desc')->paginate(7);
        //文章时间格式化
        $article = (new Article)->clearTime($article,'art_updatetime',2,8,true);

        //获得当前分类的name\keywords\description
        $cate = Category::where('cate_id',$cate_id)->first();

        return view('home/cate',compact('where','page','categorys','article','cate_id','cate'));

    }

    public function article($art_id){
    	
        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
                
        $field = Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();

        //一级分类名称
        $cate = Category::where('cate_id',$field -> cate_pid)->first();    
        $cate_name = $cate['cate_name'];

        $article['pre'] = Article::where('art_status',1)->where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_status',1)->where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

        $data = Article::where('art_status',1)->where('cate_id',$field -> cate_id)->orderBy('art_id','desc')->take(6)->get();   

        return view('home/article',compact('field','cate_name','article','data'));

    }    

    public function tool(){

        $tool = Nav::where('nav_status',1)->orderBy('nav_order','desc')->orderBy('nav_id','desc')->get();

        return view('home/nav/tool',compact('tool'));
    }

    public function say(){

        $say = Say::orderBy('say_order','desc')->orderBy('say_id','desc')->paginate(7);

        return view('home/nav/say',compact('say'));
    }    

    public function store(){

        $store = null;  

        return view('home/nav/store',compact('store'));
    }        

    public function diaryList(){

        $input = Input::all();
        
        $page = isset($input['page']) ? $input['page'] : 1;
        
        $where = isset($input['where']) ? $input['where'] : '';

        //读取所有文章
        $article = Article::where('art_status',0)->where('art_title','like','%'.$where.'%')->orderBy('art_order','desc')->orderBy('art_id','desc')->paginate(7);
        //文章时间格式化
        $article = (new Article)->clearTime($article,'art_updatetime',2,8,true);  

        return view('home/diary/diaryList',compact('where','page','article'));
    }

    public function diary($art_id){
        
        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
                
        $field = Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();

        //一级分类名称
        $cate = Category::where('cate_id',$field -> cate_pid)->first();    
        $cate_name = $cate['cate_name'];

        $article['pre'] = Article::where('art_status',0)->where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_status',0)->where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

        $data = Article::where('art_status',0)->where('cate_id',$field -> cate_id)->orderBy('art_id','desc')->take(6)->get();      

        return view('home/diary/diary',compact('field','cate_name','article','data'));

    }        
}
