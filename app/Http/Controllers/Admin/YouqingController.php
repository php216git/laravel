<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class YouqingController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $c = $request->input('chen');
        // 列表
        $data = DB::table('youqing')->where('title','like','%'.$c.'%')->paginate(2);;
        //加载模板
        return view('Admin.Youqing.index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加页面
        return view('Admin.Youqing.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加方法
        // dd($request->all());
        
        $data['title'] = $request->input('name');
        $data['url'] = $request->input('url');
        // dd($data);
        if(DB::table('youqing')->insert($data)){
            //设置session success session名字
            return redirect('/adminyouqing')->with('success','添加成功');
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
        // 获取修改信息
    	$data = DB::table('youqing')->where('id',$id)->first();
    	return view('Admin.Youqing.edit',['data'=>$data]);
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
        // 执行修改方法
        // dd($request->all());
        $data['title'] = $request->input('title');
        $data['url'] = $request->input('url');
        // dd($data);
        if(DB::table('youqing')->where('id','=',$id)->update($data)){
            //设置session success session名字
            return redirect('/adminyouqing')->with('success','修改成功');
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
         if(DB::table('youqing')->where("id","=",$id)->delete()){
            return redirect("/adminyouqing")->with("success","删除成功");
        }else{
            return back()->with('error','添加失败');
        }
    }
}
