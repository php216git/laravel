<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//导入模型类  Userss
use App\Models\Orders;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取搜索的参数
        $k = $request->input("keyword");
        $kk = $request->input("keywords");

        // 获取数据
        $data = orders::join("userss","orders.user_id","=","userss.id")->join("address","orders.address_id","=","address.id")->select("orders.id as oid","orders.order_num as onum","userss.username as uname","address.huo","orders.status as ostatus")->where("order_num","like","%".$k."%")->where("username","like","%".$kk."%")->paginate(4);
        // dd($data);
        return view("Admin.Orders.index",['data'=>$data,'request'=>$request->all()]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //调用关联数据
        $goods=Orders::find($id)->goods;
        //dd($goods);
        //加载模板
        return view("Admin.Orders.show",['goods'=>$goods]);
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
        //
    }
}
