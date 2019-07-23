<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入Mail 发送邮件
use Mail;
use Hash;
// 导入校验第三方类
use Gregwar\Captcha\CaptchaBuilder;
// 导入模型类 Userss
use App\Models\Userss;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //发送邮件测试1
    public function send(){
        // echo "this is mail";
        //发送原始字符串 $message 消息生成器(方法)
        Mail::raw('我好想你,你知道吗,我愿意为你付出一切',function($message){
            //接收方
            $message->to("1648305715@qq.com");
            //主题
            $message->subject("mamamama");
        });
    }

    // 发送邮件测试2
    public function sends(){
    	Mail::send("Home.Register.a",['id'=>12],function($message){
    		//接收方
            $message->to("1648305715@qq.com");
            //主题
            $message->subject("mamamama");
    	});
    }
    //激活用户
    public function a(Request $request){
    	$id = $request->input("id");
    	// 获取数据表数据
    	$info = Userss::where("id","=",$id)->first();
    	//dd($info);
    	// 校验字段 
    	$token = $request->input("token");
    	// 做token对比
    	if($token == $info->token){
    		// 执行数据的修改 
	    	// 封装数据
	    	$data['status'] = 1;
	    	if(Userss::where("id","=",$id)->update($data)){
	    		echo "用户已经激活,可以登录";
	    	}
    	}
    	
    }

    // 引入校验码
    public function code(){
    	//生成校验码代码
        ob_clean();//清除操作
        //实例化校验码类
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session方便和输入的校验码对比
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        //输出
        $builder->output();
        //die;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载注册模板
        return view("Home.Register.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // 发送邮件激活用户  $email要注册的邮箱 $id注册的用户id $token校验参数
    public function sendMail($email,$id,$token){
    	//闭包函数内部获取闭包函数外部的变量 use
    	Mail::send("Home.Register.a",['id'=>$id,'token'=>$token],function($message) use ($email){
    		//接收方
            $message->to("$email");
            //主题
            $message->subject("激活用户");
    	});
    	return true;
    }
    
    public function store(Request $request)
    {
        //获取输入的校验码
        $code = $request->input("code");
        //获取系统的校验码
        $vcode = session("vcode");
        //echo $code.":".$vcode;
        if($code == $vcode){
        	//数据库插入
        	$data = $request->except(['_token','repassword','code']);
        	//dd($data);
        	//密码加密
        	$data['password'] = Hash::make($data['password']);
        	$data['username'] = "admin".rand(1,1000);
        	$data['status'] = 0;
        	$data['token'] = str_random(50);

        	$user = Userss::create($data);
        	//获取刚刚插入的数据id
        	$id = $user->id;
        	if($id){
        		// 直接调用发送邮件函数
        		$res = $this->sendMail($data['email'],$id,$data['token']);
        		if($res){
        			return redirect("https://mail.qq.com");
        		}else{
        			return back()->with("error","请重新发送邮件");
        		}
        		
        	}
        	
        }else{
        	return back()->with("error","两次校验码不一致");
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

    // 检测手机号是否被注册
    public function checkphone(Request $request){
    	// echo "sss";
        //获取注册的手机号
        $p=$request->input("p");
        //获取数据表的phone字段值
        $data=Userss::pluck("phone");
        $pp=array();
        //转换为一维数组
        foreach($data as $key=>$value){
            $pp[$key]=$value;
        }
        // dd($pp);
        // in_array();
        if(in_array($p,$pp)){
            echo 1;//手机号已经被注册
        }else{
            echo 0;//手机号可用
        }
    }

    // 获取校验码
    public function sendphone(Request $request)
    {
        $pp=$request->input("pp");
        // echo $pp;
        //调用短信接口
        sendsphone($pp);
        // pay();
    }
    // 检测校验
    public function checkcode(Request $request)
    {
        // 输入的校验码
        $code=$request->input("code");
       
        // 判断发送检验码且不为空
        if(isset($_COOKIE['fcode']) && !empty($code)){
             // 获取手机接收系统校验码
             $fcode=$request->cookie("fcode");
             if($fcode==$code){
                echo 1; //校验码没问题
             }else{
                echo 2; //校验码有误
             }
        }elseif(empty($code)){
            echo 3; //输入的校验码为空
        }else{
            echo 4;   //校验码已经过期
        }
    }

    // 执行注册
    public function registerphone()
    {
        echo "手机注册";
    }
}
