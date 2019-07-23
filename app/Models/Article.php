<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     //与模型关联的数据表
    protected $table = 'articles';

    public $timestamps = false;
   	
   	protected $fillable = ['title','descr','thumb','editor'];
}
