<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DibuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('adevr')->get();

        return view('Admin.Dibu.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加页面
      	return view('Admin.Dibu.add');
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
        $data = $request->except('_token');
        // dd($data);
        $res = DB::table('adevr')->insert($data);

        if($res){
            return redirect('/dibu')->with('success','添加成功');
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
        $data = DB::table('adevr')->where('id','=',$id)->first();
        // 显示修改页面
        return view('Admin.Dibu.edit',['data'=>$data]);
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
       $data = $request->except(['_token','_method']);
        // dd($data);
        $res = DB::table('adevr')->where('id','=',$id)->update($data);
        if($res){
            return redirect('/dibu')->with('success','修改成功');
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
        if(DB::table("adevr")->where("id","=",$id)->delete()){
            return redirect("/dibu")->with("success","删除成功");
        }else{
            return back()->with('error','删除失败');
        }
    }
}
