<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HomeEditController extends Controller
{
    public function edit($id)
    {
    	if(!session('homeemail')){
            return redirect('/homelogin/create');
        }

 
        $upss = DB::table('userss')->where('id','=',$id)->first();
        // 显示添加页面
        return view('Home.Geren.add',['upss'=>$upss]);
    }


    public function update(Request $request,$id)
    {
    	// dd($request->all());
    	 if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
        }

    	$data['username'] = $request->input('username');
    	$data['phone'] = $request->input('phone');
    	$data['email'] = $request->input('email');
    	$data['url'] = $url;
    	// 修改头像存入session
    	session('userinfo')->url = $url;
    	$data['token'] = str_random(50);

    	$res = DB::table('userss')->where('id','=',$id)->update($data);

    	if($res){
    		return back()->with('success','修改成功');
    	}else{
    		return back()->with('error','修改失败');
    	}
    }
}
