<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        //
        // echo '这是角色列表';
        $role = DB::table('role')->get();
    	return view('Admin.Role.index',['role'=>$role]);
    }

    // 分配权限
    public function adminauth($id)
    {
    	// echo $id;
    	// 获取当前角色
    	$role = DB::table('role')->where('id','=',$id)->first();
    	// 获取所有权限
    	$auth = DB::table('node')->get();
    	// 获取当前已有的角色权限
    	$data = DB::table('rolenode')->where('rid','=',$id)->get();
    	// dd($data);
    	$nid=array();
    	if(count($data)){
    		// 遍历
    		foreach ($data as $key=>$value){
			$nid[]=$value->nid;
    	}
    		// 加载模板
    		return view('Admin.Role.auth',['role'=>$role,'auth'=>$auth,'nid'=>$nid]);
  
		}else{
			// 加载模板
    		return view('Admin.Role.auth',['role'=>$role,'auth'=>$auth,'nid'=>array()]);
		}	
		// dd($nid);
		
    }

    // 保存权限
    public function saveauth(Request $request)
    {
    	// echo '就覅大家分开的时间空间进入一';
    	// 湖区角色id
    	$rid = $request->input('rid');
    	// 获取选择的权限
    	$nid = $_POST['nid'];
    	// echo $rid;
    	// dd($nid);
    	DB::table('rolenode')->where('rid','=',$rid)->delete();
    	$nids = array();  
    	// 遍历
    	foreach ($nid as $key=>$value){
    		//封装要插入的数据
    		$nids['rid']=$rid;
    		$nids['nid']=$value;
    		// 向roile_node 表插入数据
    		DB::table('rolenode')->insert($nids);
    	}

    	return redirect('/adminroles')->with('success','权限分配成功');
    	// 向rolenode 表插入数据
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加页面
        return view('Admin.Role.add');
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
        // dd($data);
        $data = DB::table('role')->insert($data);
        if($data){
            return redirect('/adminroles')->with('success','添加成功');
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
        // 获取修改的内容
        $data = DB::table('role')->where('id','=',$id)->first();
        // 显示修改页面
        return view('Admin.Role.edit',['data'=>$data]);
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
        $data = $request->except('_token',"_method");
         //dd($data);
        $data = DB::table('role')->where('id','=',$id)->update($data);
            if($data){
                return redirect('/adminroles')->with('success','修改成功');
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
        if(DB::table("role")->where("id","=",$id)->delete()){
            return redirect("/adminroles")->with("success","删除成功");
        }else{
            return back()->with('error','删除失败');
        }
    }
}
