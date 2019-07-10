<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$k=$request->input("chen");
        // 获取权限列表
        $auth=DB::table('node')->where("name","like","%".$k."%")->paginate(4);
        return view('Admin.Auth.index',['auth'=>$auth,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加页面
        return view('Admin.Auth.add');
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
        // dd($request->all());
       	$data = $request->except('_token');
       	$data = DB::table('node')->insert($data);
       	if($data){
       		return redirect('/auth')->with('success','添加成功');
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
        // 获取修改数据
        $data = DB::table('node')->where('id','=',$id)->first();
        // dd($data);
        // 显示修改页面
        return view('Admin.Auth.edit',['data'=>$data]);
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
        $data['name'] = $request->input('name');
        $data['mname'] = $request->input('mname');
        $data['aname'] = $request->input('aname');

        $data = DB::table('node')->where('id','=',$id)->update($data);
        if($data){
        	return redirect('/auth')->with('success','修改成功');
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
        // 获取需要删除的id
        $data = DB::table('node')->where('id','=',$id)->delete();
        if($data){
        	return redirect('auth')->with('success','删除成功');
        }else{
        	return back()->with('error','删除失败');
        }
    }
}
