<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DizhiController extends Controller
{
    // 显示地址页面
    public function index()
    {
    	  //获取当前登录用户的所有收货地址
        $address=DB::table("address")->where("user_id","=",session('user_id'))->orderBy("id","asc")->get();
        //获取默认的第一条收货地址数据
        $addresss=DB::table("address")->where("user_id","=",session('user_id'))->first();
    	// echo 'kjdfkhdsjhfj h';
    	return view('Home.Geren.dizhi',['address'=>$address,'addresss'=>$addresss]);
    }
 

    public function create(Request $request)
    {
  		// 调用一级城市
    	$upid=$request->input("upid");
    	$data=DB::table("district")->where("upid","=",$upid)->get();
    	echo json_encode($data);
    }

      // 插入收货地址
    public function insert(Request $request)
    {
    	//dd($request->all());
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
    		return back();
    	}
    }


    public function shanchu($id)
    {
    	// dd($id);
    	 //直接删除
        if(DB::table('address')->where("id","=",$id)->delete()){

    		return back();
    	}
    }
}
