<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //定义与模型关联的数据表
	protected $table="orders";
	//主键
	protected $primaryKey="id";
	//设置是否需要自动维护时间戳 created_at updated_at
	public $timestamps =false;
	//修改器的方法
	//对完成的数据(状态 status)做自动处理
	public function getStatusAttribute($value){
		$status=[1=>"已支付",2=>"未支付"];
		return $status[$value];
	}


	//关联方法 关联Userss和Userinfo模型类=>获取关联数据
    // "App\Models\Userinfo" 要关联的模型类  users_id 关联字段
    public function goods(){
    	return $this->hasOne("App\Models\ordersgoods","order_id");
    }

}
