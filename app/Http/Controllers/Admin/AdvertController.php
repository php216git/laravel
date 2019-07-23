<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdvertController extends Controller
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

    	$data = DB::table("advert")->where("name","like","%".$k."%")->where("title","like","%".$kk."%")->paginate(4);

    	// 加载模板
        return view("Admin.Advert.index",['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	//加载添加模板
        return view("Admin.Advert.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except(['_token']);

        // 执行数据库插入操作
        if(DB::table("advert")->insert($data)){
        	return redirect("/adminadvert")->with("success","添加成功");
        }else{
        	return back()->with("error","添加失败");
        }
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
        //获取数据
        $data = DB::table("advert")->where("id","=",$id)->first();
        //加载模板
        return view("Admin.Advert.edit",['data'=>$data]);
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
        // 获取修改的数据
        $data = $request->except(['_token','_method']);
         
        if(DB::table("advert")->where("id","=",$id)->update($data)){
            return redirect("/adminadvert")->with("success","修改成功");
        }else{
            return back()->with("error","修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //直接删除
        if(DB::table("advert")->where("id","=",$id)->delete()){
        	return redirect("adminadvert")->with("success","删除成功");
        }else{
        	return back()->with("error","删除失败");
        }
    }
}
