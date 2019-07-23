<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 结算控制器
class OrdersController extends Controller
{
    public function jiesuan(Request $request)
    {
    	// 接受arr参数
    	$arr=$_GET['arr'];  
    	// 遍历
    	foreach($arr as $key=>$value){
    		// 获取session数据
    		$cart=session("cart");
    		foreach($cart as $k=>$v){
    			if($value==$v['id']){
    				$data[$k]['num']=$cart[$k]['num'];
    				$data[$k]['id']=$value;
    			}
    		}
    	}
    	// session存储选中的数据的数组
    	$request->session()->push('goodss',$data);
    	echo json_encode($data);
    }

     public function insert(){
       
        $goodss=session("goodss");
        // dd($goodss);
       
            $tot=0;
            $d=[];
        // //遍历session数据
        foreach($goodss[0] as $key=>$value){
            //获取数据库数据
            $info=DB::table("shops")->where("id","=",$value['id'])->first();
            // 封装数据
            $temp['num']=$value['num'];
             // dd($value);
            $temp['pic']=$info->pic;
            $temp['name']=$info->name;
            $temp['price']=$info->price;
            
            // ini_set("error_reporting","E_ALL & ~E_NOTICE");
            $tot+=$temp['num']*$info->price;

            $d[]=$temp;

 
        }


        //获取当前登录用户的所有收货地址
        $address=DB::table("address")->where("user_id","=",session('user_id'))->orderBy("id","asc")->get();
        //获取默认的第一条收货地址数据
        $addresss=DB::table("address")->where("user_id","=",session('user_id'))->first();
      
        //加载结算页
        return view("Home.Orders.index",['address'=>$address,'d'=>$d,'tot'=>$tot,'addresss'=>$addresss]);
    }

    // 支付下单
    public function create(Request $request)
    {
        // 向订单表orders插入数据
        $data['address_id']=$request->input("address_id"); //获取传过来的address_id 这是收货地址id
        $data['order_num']=time();  //订单号 随便给了个时间戳
        // 将session里面的值赋给$data['user_id']
        $data['user_id']=session("user_id");
        $data['status']="1"; //未支付
        // dd($data);
        // 插入到数据库同时获取订单的id (也就是订单详情表的order_id)
        $id=DB::table("orders")->insertGetId($data);
        //向订单详情orders_goods表插入数据
        if($id){
            // 获取session数据
            $goodss=session('goodss');
            $tot=0;
            // 遍历session 获取里面内容
            foreach($goodss[0] as $key=>$value){
                // 获取商品信息
                $info=DB::table("shops")->where("id","=",$value['id'])->first();
                // 封装数据 在插入到数据库中去
                $tem['num']=$value['num']; //购物车里商品数量
                $tem['goods_id']=$value['id']; //购物车里商品id
                $tem['order_id']=$id;  //订单id
                $tem['pic']=$info->pic; //商品表里的图片
                $tem['name']=$info->name; //商品名字
                // 总计 即金额总和
                $tot+=$tem['num']*$info->price;
                // 将封装好的数据赋值给数据$d[]
                $d[]=$tem;
            }

            // 将数组$d插入到订单详情表orders_goods
            if(DB::table("orders_goods")->insert($d)){
                // $tot金额总额存储到session中
                session(['tot'=>$tot]);
                // 将收货地址id存储到session中
                session(['address_id'=>$data['address_id']]);
                // 把订单id存到session中 后面用来修改status字段值
                session(['order_id'=>$id]);
                // 支付宝支付 调用helper.php中写好的支付宝方法
                pays($data['order_num'],"shangpin",0.01,"shangping");
            }
        }
    }

    // 支付宝支付成功跳转界面
    public function returnurl()
    {
        // 把订单状态未付款变为已付款 
        // 获取session存好的订单id
        $order_id=session("order_id");
        // 获取总金额
        $tot=session("tot");
        // 获取收货地址id
        $address_id=session("address_id");
        // 通过收货地址id获取表里其它字段值
        $address=DB::table("address")->where("id","=",$address_id)->first();
        // 修改订单状态 把$data通过数据条件进行修改
        $data['status']="2";
        DB::table("orders")->where("id","=",$order_id)->update($data);
        // 加载视图 分配变量 模板遍历
        return view("Home.Orders.success",['tot'=>$tot,'address'=>$address]);
    }


   public function shanchu($id)
   {
    	if(DB::table("address")->where("id","=",$id)->delete()){
           return back();
       }
   }
}
