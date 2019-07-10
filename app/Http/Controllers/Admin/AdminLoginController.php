<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 退出
        // 销毁session
        $request->session()->pull('adminname');
        // 删除权限
        $request->session()->pull('nodelist');
        // 跳转到登录页面
        return redirect('/adminlogin/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载后台登录模板
        // echo '电话fid要素颜';
        return view('Admin.AdminLogin.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 执行登录 检测当前登录的管理员和密码是否在数据表;里(管理员)
        $name = $request->input('name');
        $password = $request->input('password');
        // 检测管理员名字
        $info = DB::table('Adminusers')->where('name','=',$name)->first();
        if($info){
            // echo '管理员ok';
            // 检测密码
            if(Hash::check($password,$info->password)){

                // 把登录的管理员存储在session
                session(['adminname'=>$name]);
                // 1.获取当前登录用户的所有权限信息
                $list = DB::select("select n.name,n.mname,n.aname from userrole as ur,rolenode as rn,node as n where ur.rid = rn.rid and rn.nid=n.id and uid={$info->id}");
                // 2.初始化权限信息 让所有的管理员都可以访问到后台首页 Admin控制器名字 index方法
                $nodelist['AdminController'][]="index";
                // 遍历
                foreach($list as $key=>$value){
                    // 把权限写入到$nodelist
                    $nodelist [$value->mname][]=$value->aname;
                    //如果有create方法, 加入store方法
                    if($value->aname=="create"){
                        $nodelist[$value->mname][]="store";
                    }

                    // 如果有edit方法 加入update
                    if($value->aname=="edit"){
                        $nodelist[$value->mname][]="update";
                    }
                    
                }

                // 3. 把初始化后的当前登录用户的权限信息写入session
                session(['nodelist'=>$nodelist]);
                //dd($nodelist);
                return redirect('/admin')->with('success','登录成功');
            }else{
                return back()->with('error','密码有误!');
            }
        }else{
            return back()->with('error','管理员有误!');
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
