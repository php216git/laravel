<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    //定义与模型关联的数据表
	protected $table="userss";
	//主键
	protected $primaryKey="id";
	//设置是否需要自动维护时间戳 created_at updated_at
	public $timestamps =true;
	/**
	* 可以被批量赋值的属性。
	*
	* @var array
	*/
	protected $fillable = ['username','password','url','email','status','token','phone',"created_at","updated_at"];
	//修改器的方法
	//对完成的数据(状态 status)做自动处理
	public function getStatusAttribute($value){
		$status=[0=>'禁用',1=>'激活'];
		return $status[$value];
	}


	//关联方法 关联Userss和Userinfo模型类=》获取关联数据
    // "App\Models\Userinfo" 要关联的模型类  users_id 关联字段
    public function info(){
    	return $this->hasOne("App\Models\Userinfo","users_id");
    }

    //关联Userss和Useraddress模型类=>获取会员下的所有地址
    public function address(){
    	return $this->hasMany("App\Models\address","user_id");
    }
}
