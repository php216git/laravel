<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Config;
// 导入MarkDown
use Markdown;
use App\Models\Shops;
use App\Http\Controllers\Admin\CatesController;
class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 商品显示
    public function index(Request $request)
    {
        // $shop=DB::table("shops")->get();
        // 两表关联
        $shop=DB::table("shops")->join("cates","shops.cate_id","=","cates.id")->select("shops.name as sname","shops.id as sid","shops.descr","shops.pic","shops.num","shops.price","cates.id as cid","cates.name as cname")->paginate(2);
        // dd($shop);
        return view("Admin.Shops.index",['shop'=>$shop,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 商品添加
    public function create()
    {
       // 获取所有的类别 通过 类::方法 调用静态方法
       $cate=CatesController::getCates();
       // dd($cate);


       return view("Admin.Shops.add",['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 执行商品添加
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except("_token");
        // 使用Markdom 转换数据
        $data['descr']=Markdown::convertToHtml($data['descr']);
        
        // 文件上传
        if($request->hasFile("pic")){
            $name=time();
            // 获取后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            // 移动
            $request->file("pic")->move(Config::get('app.app_uploads'),$name.".".$ext);
            // 封装pic
            $data['pic']=Config::get("app.app_uploads").$name.".".$ext;
            // 插入到数据库
            $data['pic']=trim(Config::get("app.app_uploads").$name.".".$ext,".");
          }else{
          	return back()->with('error','请选择图片');
          }
            if(DB::table("shops")->insert($data)){
                return redirect("/adminshops")->with("success","添加成功");
            }
                return back()->with("error","添加失败");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // 调用关联数据 调用模型里info()方法语法规则弃掉括号
       $info=Shops::find($id)->info;
       return view("Admin.Shops.info",['info'=>$info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 开始商品修改
    public function edit($id)
    {
        // 关联表
        //   $data=DB::table("shops")->join("cates","shops.cate_id","=","cates.id")->select("shops.name as sname","shops.id as sid","shops.descr","shops.pic","shops.num","shops.price","cates.id as cid","cates.name as cname")->get();
        // dd($data);
        // 获取需要修改的数据
         $data=DB::table("shops")->where("id","=",$id)->first();
        return view("Admin.Shops.edit",['data'=>$data,'cate'=>CatesController::getCates()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 执行修改
    public function update(Request $request, $id)
    {
        //去除别的
       $data=$request->except(['_token','_method']);
       $data['descr']=Markdown::convertToHtml($data['descr']);
       // dd($data);
        if($request->hasFile("pic")){
            $name=time();
            // 获取后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            // 移动
            $request->file("pic")->move(Config::get('app.app_uploads'),$name.".".$ext);
        	}else{
        		return back()->with('error','请选择图片');
        	}
            $data['pic']=trim(Config::get("app.app_uploads").$name.".".$ext,".");
       //修改到数据库
           if(DB::table("shops")->where("id","=",$id)->update($data)){
                 return redirect("/adminshops")->with("success","修改成功");
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
        if(DB::table("shops")->where("id","=",$id)->delete()){
             return redirect("/adminshops")->with("success","删除成功");
        }else{
             return back()->with("error","修改失败");
        }
    }
}
