<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class EditController extends Controller
{
     public function edit($id)
    {
        // echo $id;
    	// 获取当前的要修改的数据
    	$ress = DB::table('userss')->where('id','=',$id)->first();
    	// dd($ress);

    	return view('Home.Geren.edit',['ress'=>$ress]);
    }
 
  
    public function update(Request $request, $id)
    {
        // dd($request->all());
    	// 获取提交的数据
        $password = $request->input('password');
    	$new_password1 = $request->input('password1');
    	$new_password2 = $request->input('password2');

    	$new_password1 = password_hash($new_password1,PASSWORD_DEFAULT);
    	$data['token'] = str_random(50);

    	$res = DB::table('userss')->where('id','=',$id)->update(['password'=>$new_password1],$data);

    	if($res){
            return redirect('/homelogin/create');
        } else {
            return back()->with('error','修改密码失败');
        }
    }
}
