<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminuserController extends Controller
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
        $data = DB::table('adminusers')->where('name','like','%'.$c.'%')->paginate(2);;
        //加载模板
        return view('Admin.Adminuser.index',['data'=>$data,'request'=>$request->all()]);
    }

    // 分配角色
    public function role($id)
    {
        // echo $id;
        //  获取当前管理员的信息
        $adminuser = DB::table('adminusers')->where('id','=',$id)->first();
        // 获取所有的角色信息
        $role = DB::table('role')->get();
        // 获取当前管理员角色
        $rid = DB::table('userrole')->where('uid','=',$id)->get();
        // dd($rid);
        $rids=array();
        if(count($rid)){
                // 遍历
            foreach($rid as $key=>$value){
                // $rods 数组主要存放的是角色ID
                $rids[]=$value->rid;
            }
                 // dd($rids);
            // 加载模板
            return view('Admin.Adminuser.role',['adminuser'=>$adminuser,'role'=>$role,'rids'=>$rids]);
        }else{
             // dd($rids);
            // 加载模板
            return view('Admin.Adminuser.role',['adminuser'=>$adminuser,'role'=>$role,'rids'=>array()]);
        }   
    }


    // 保存角色
    public function saverole(Request $request)
    {
        //echo 'this is saverole';
        // 获取管理员id
        $uid = $request->input('uid');
        // 获取选择的角色
        $rids=$_POST['rids'];
        //echo $uid;
        //dd($rids);
        //删除当前管理员已有的角色
        DB::table('userrole')->where('uid','=',$uid)->delete();
        foreach($rids as $key=>$value){
            //封装要插入的数据
            $data['uid']=$uid;
            $data['rid']=$value;
            //把选择的角色存储在userrole表
            DB::table('userrole')->insert($data);
        }

        return redirect('/adminuser')->with('success','角色分配成功');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 添加
        return view('Admin.Adminuser.add');
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
        $data = $request->except('_token');
        //密码做加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        //执行添加  入库
        // if(DB::table('adminusers')->insert($data)){
        //     echo '1';
        // }
        if(DB::table('adminusers')->insert($data)){
            //设置session success session名字
            return redirect('/adminuser')->with('success','添加成功');
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
        // 获取需要修改的数据
        $data = DB::table('adminusers')->where('id','=',$id)->first();
        return view('Admin.Adminuser.edit',['data'=>$data]);
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
        // 执行添加方法
        $data['name'] = $request->input('name');
        $data['password'] = $request->input('password');
        
        // dd($request->all());
        // $data = $request->except(['_token','_method']);
        //执行修改
        if(DB::table('adminusers')->where('id','=',$id)->update($data)){
            return redirect('/adminuser')->with('success','修改成功');
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
        if(DB::table('adminusers')->where('id','=',$id)->delete()){
            return redirect('/adminuser')->with('success','删除成功');
        }else{
            return redirect('/adminuser')->with('success','删除失败');
        }
    }
}
