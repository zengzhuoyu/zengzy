<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Say extends Model
{
    protected $table = 'say';
    protected $primaryKey = 'say_id';
    public $timestamps = false;
    protected $guarded=[];
}
