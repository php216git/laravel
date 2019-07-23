<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 加载购物车页面
        // 获取session数据
        $cart=session("cart");

        $data1=array();
        // 如果当前购物车有数据就执行遍历
        if(isset($cart)){
            foreach($cart as $key=>$value){
                // 获取当前商品数据
                $info=DB::table("shops")->where("id","=",$value['id'])->first();
     
                // 封装购物车数据
                $data['id']=$value['id'];
                $data['num']=$info->name;
                $data['descr']=$info->descr;
                $data['pic']=$info->pic;
                $data['price']=$info->price;
                $data['num']=$value['num'];

                $data1[]=$data;

            }
        } 
      
        // 加载购物车界面
        return view("Home.Cart.index",['data1'=>$data1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 购物车去重方法
    public function checkexists($id)
    {
        $goods=session('cart');
        // 购物车没数据
        if(empty($goods)) return false;
        foreach($goods as $key=>$value){
            if($value['id']==$id){
                // 当前购买的商品已经存在购物车
                return true;
            }
        }
        
        
    }



     // 加入购物车操作
    public function store(Request $request)
    {
        $data=$request->except("_token");
        // 防止购物车重复
        if(!$this->checkexists($data['id'])){
            // 把需要购买的商品数据加入到session
            $request->session()->push('cart',$data);
        }
        
       
        
        //跳转到购物车界面 当前index
        return redirect("/homecart");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 执行删除操作
        
        // 获取session数据
       $cart=session('cart');

        //遍历
        foreach($cart as $key=>$value){
            if($value['id']==$id){
                unset($cart[$key]);
            }
            session(['cart'=>$cart]);
        return redirect("/homecart");
        }
        // session 值重新赋值
        
    }


    //删除购物车数据
    public function alldelete(Request $request)
    {
        // echo "1111";
        // dd($request->all());

        $request->session()->pull('cart');
        return redirect("/homecart");
        
    }



    // 购物车减操作
    public function cartupdatee(Request $request)
    {
        $id=$request->input("id");
        $info=DB::table("shops")->where("id","=",$id)->first();
        $cart=session('cart');
        foreach($cart as $key=>$value){
            if($value['id']==$id){
                $cart[$key]['num']-=1;
                if($cart[$key]['num']<=1){
                    $cart[$key]['num']=1;
                }
                // 重新赋
                session(['cart'=>$cart]);
                // 减以后的值
                $data['num']=$cart[$key]['num'];
                $data['tot']=$cart[$key]['num']*$info->price;
                echo json_encode($data);
            }
        }

    }

    // 购物车加操作
    public function cartupdate(Request $request)
    {
        $id=$request->input("id");
        // 通过id获取表里其他字段
        $info=DB::table("shops")->where("id","=",$id)->first();
        // 获取session数据
        $cart=session("cart");
        // 遍历
        foreach($cart as $key=>$value){
            if($value['id']==$id){
                $cart[$key]['num']+=1;
                // 判断 $info->num是表里的库存
                if( $cart[$key]['num']>$info->num){
                    $cart[$Key]['num']=$info->num;
                }
                // session重新赋值
                session(['cart'=>$cart]);
                // 封装数组 tot金额
                $data['num']=$cart[$key]['num'];
                $data['tot']=$cart[$key]['num']*$info->price;
                echo json_encode($data);
            }
        }
    }


    // 购物城选中勾选  选中的数量和金额总计
    public function carttot()
    {
        // 获取arr参数 选中数据的id
        
        if(isset($_GET['arr'])){
            // 数量总和
            $nums=0;
            // 金额总和
            $sum=0;
            foreach($_GET['arr'] as $key=>$value1){
                $cart=session('cart'); 
                // 遍历购物车信息
                foreach($cart as $key=>$value){
                    // 判断
                    if($value1==$value['id']){
                        // 每个商品的数量
                        $num=$cart[$key]['num'];
                        // 获取数据表的数据
                        $info=DB::table("shops")->where("id","=",$value1)->first();
                        // 每个商品的金额总计
                        $tot=$num*$info->price;
                        $nums+=$num;
                        $sum+=$tot;
                    }
                }
            }

            $data['nums']=$nums;
            $data['sum']=$sum;
            echo json_encode($data);
        }else{
            $data['nums']=0;
            $data['sum']=0;
            echo json_encode($data);
        }
    }

}
