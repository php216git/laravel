<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class BannerController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取列表数据
        $data = DB::table('Banners')->get();
        // 显示轮播表页面
        return view('Admin.Banner.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示添加页面
        return view('Admin.Banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 执行添加方法
        // 检测文件上传
         // dd($request->all());
        // $data=$request->except(['_token']);
		//判断是否具有文件上传
		// 检测文件上传
        if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
        }


    	// 接收数据
    	
    	$data['title'] = $request->input('title','');
    	$data['url'] = $url;
    	$data['status'] = $request->input('status','');

    	// 执行 添加到数据库
    	$res = DB::table('banners')->insert($data);
    	if($res){
    		return redirect('/adminbanner')->with('success','添加成功');
    	}else{
    		return back()->with('error','添加失败');


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
        /// 获取需要修改的数据
        $data = DB::table('banners')->where('id','=',$id)->first();
        // 显示修改页面
        return view('Admin.Banner.edit',['data'=>$data]);
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
        // dd($request->all());
        // 执行修改方法
        // $data = $request->except('_token');
        if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
        }


        // 接收数据
        
        $data['title'] = $request->input('title','');
        $data['url'] = $url;
        $data['status'] = $request->input('status','');

        // dd($data);
        $data = DB::table('banners')->where('id','=',$id)->update($data);
            if($data){
                return redirect('/adminbanner')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
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
        // echo $id;
        if(DB::table("banners")->where("id","=",$id)->delete()){
            return redirect("/adminbanner")->with("success","删除成功");
        }else{
            return back()->with('error','删除失败');
        }
    }

}
