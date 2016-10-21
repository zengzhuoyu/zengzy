<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded=[];

    //后台调取
    public function tree(){
        $categorys = $this-> orderBy('cate_order','desc') ->get();
        return $this->_getTree($categorys,'cate_name','cate_id','cate_pid');
    }

    //前台调取
    public function treeii(){
        $categorys = $this-> where('cate_status',1)-> orderBy('cate_order','desc') ->get();
        return $this->_getTree($categorys,'cate_name','cate_id','cate_pid');
    }

    private function _getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0){
        $arr = [];
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }         

    public function getCate($data){

        foreach($data as $v){
            $cate = $this -> where('cate_id',$v->cate_id)->first();    
            $v['cate_name'] = $cate['cate_name'];             
        }

        return $data;
       
    }
}
