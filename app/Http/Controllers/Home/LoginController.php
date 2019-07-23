<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userss;
use Hash;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       	
    }

    public function logout(Request $request)
    {
    	 // 销毁session
        $request->session()->pull('homeemail');
        $request->session()->pull('userinfo');

        // 跳转到主页面
        return redirect('/homeindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        return view("Home.Login.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $email=$request->input("email");
        $password=$request->input("password");
        // 检测邮箱
        $info=Userss::where("email",$email)->first();
        if($info){
            // 检测密码
            if(Hash::check($password,$info->password)){
                // 把登录的管理员存储在session
                session(['homeemail'=>$email]);
                session(['userinfo'=>$info]);
				// 存个收货地址表的user_id到session
                session(['user_id'=>$info->id]);
                // 检测是否已经激活
                if($info->status=="激活"){
                  return redirect("/homeindex");  
                }else{
                    return back()->with("error","请登入邮箱激活用户");
                }
            }else{
               return back()->with("error","密码有误"); 
            }
        }else{
            return back()->with("error","邮箱有误");
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

    public function forget()
    {
        // 加载发送邮件模板
        return view("Home.Login.forget");
    }

    // 发邮件重置密码
    public function sendMail($email,$id,$token){
        //闭包函数内部获取闭包函数外部的变量 use
        Mail::send("Home.Login.reset",['id'=>$id,'token'=>$token],function($message) use ($email){
            //接收方
            $message->to("$email");
            //主题
            $message->subject("密码重置");
        });
        return true;
    }

    public function doforget(Request $request)
    {
        // 获取需要发送的邮箱值
        $email=$request->input("email");
        // 通过邮箱条件获取全部数据
        $info=Userss::where("email","=",$email)->first();
        // 调用发送邮件的方法
        $res=$this->sendMail($email,$info->id,$info->token);
        if($res){
            // 如果没问题跳转到邮箱界面
            return redirect("https://mail.qq.com");
        }
    }
    public function reset(Request $request)
    {
        $id=$request->input("id");
        $token=$request->input("token");
        // 通过id获取数据库数据
        $info=Userss::where("id","=",$id)->first();
        if($token==$info->token){
            // 如果输入的token等于数据库中的token就加载重置密码模板
            return view("Home.Login.reset1",['id'=>$id]);
        }
    }
    public function doreset(Request $request)
    {
        $id=$request->input("id");
        // 执行密码修改
        $data['password']=Hash::make($request->input("password"));
        $data['token']=str_random(50);
        if(Userss::where("id","=",$id)->update($data)){
           return redirect("/homelogin/create"); 
        }
    }

}
