<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='article';
    protected $primaryKey='art_id';
    public $timestamps=false;
    protected $guarded=[];

    public function clearTime($data,$field,$start,$end,$status = false){

        foreach($data as $v){
        	$v[$field] = substr($v[$field],$start,$end);

        	if($status){
        		$v[$field] = str_replace('-',' / ',$v[$field]);
        	}
        }

        return $data;
    }    

    public function changeStatus($article,$statusVal){

        foreach($article as $v){
            $v->art_status = $statusVal;
            $v->update();
        }
        return;
    }
}
