<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    //定义模型关联的数据表
    protected $table="shops";
    //主键
    protected $primaryKey="id";
    //是否开启自动维护时间戳 false 不开启 true 开启
    public $timestamps = false;
    // 一对一 关联shopinfo模型类
    public function info()
    {
    	return $this->hasOne("App\Models\Shopinfo","shop_id");
    }
}
