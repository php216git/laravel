<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AddressController extends Controller
{ 
    // 获取城市数据
    public function address(Request $request)
    {
    	// 调用一级城市
    	$upid=$request->input("upid");
    	$data=DB::table("district")->where("upid","=",$upid)->get();
    	echo json_encode($data);
    } 

    // 插入收货地址
    public function insert(Request $request)
    {
    	$data=$request->except("_token"); 
    	// b把huo特殊字符去掉 返回$m数组
    	preg_match_all('/[\x{4e00}-\x{9fff}]+/u',$data['huo'],$m);
    	// 转换为join字符串
    	$str=join("",$m[0]);
    	$data['huo']=$str;
    	// 获取在longin控制器存储的id 即登录时
    	$data['user_id']=session('user_id');
    	// 把数据$data入库
    	if(DB::table("address")->insert($data)){
    		// 插入成功跳转到结算页
    		return redirect('/order/insert');
    	}
    	
    }
    public function choose(Request $request)
    {
    	$address_id=$request->input("address_id");
    	
    	$data=DB::table("address")->where("id","=",$address_id)->first();
    	echo json_encode($data);
    }


}
