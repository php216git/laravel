<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入Hash加密类
use Hash;
//导入模型类  Userss
use App\Models\Userss;
use DB;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取数据总条数
        $tot=Userss::count();
        //每页显示的数据条数
        $rev=2;
        //获取最大页
        $maxpage=ceil($tot/$rev);
        //获取Ajax传递的参数 page
        $page=$request->input('page');
        // echo $page;
        if(empty($page)){
            $page=1;
        }
  
        //获取偏移量
        $offset=($page-1)*$rev;
        //执行sql语句  offset(分页偏移量)->limit(每页显示的数据条数)
 
        $data=Userss::offset($offset)->limit($rev)->get();
        // $data=DB::select("select * from userss limit $offset,$rev");
        // dd($data);
        //判断当前请求是否为Ajax请求
        if($request->ajax()){
            // echo $page;die;
            //加载模板
            return view("Admin.Users.ajaxpage",['data'=>$data]);
        }
        // 2
        // 
        // echo $maxpage;
        for($i=1;$i<=$maxpage;$i++){
            //给数组赋值
            $pp[$i]=$i;
        }
        // dd($pp);
        //加载模板
        return view("Admin.Users.index",['pp'=>$pp,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.Users.add");
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
        $data=$request->except(['repassword','_token']);
        

            // dd($request->all());
            //判断是否具有文件上传
            // if($request->hasFile('url')){
            // //初始化名字
            // $name=time()+rand(1,10000);
            // //获取上传文件后缀
            // $ext=$request->file("url")->getClientOriginalExtension();
            // //dd($ext,$name);
            // //移动到指定的目录下（提前在public下新建uploads目录）
            // $request->file("url")->move("./uploads/".date("Y-m-d"),$name.".".$ext);
            // }
            

        if($request->hasFile('url')){
                $url = $request->file('url')->store(date('Ymd'));
            }else{
                return back()->with('error','请选择图片');
        }

        
        //加密密码
        $data['password']=Hash::make($data['password']);  
        $data['status']=0;
        $data['url'] = $url;
        $data['token'] = str_random(50);
        //dd($data);

        //执行数据库插入操作 换为模型的写法 create 模型的添加方法
        if(Userss::create($data)){
            //设置session  success sesion名字
            return redirect("/adminusers")->with("success","添加成功");
        }else{
            return back()->with("error","添加失败");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // 获取用户详情数据
    public function show($id)
    {
        //调用关联数据
        $info=Userss::find($id)->info;
        // dd($info);
        //加载模板
        return view("Admin.Users.info",['info'=>$info]);
    }

    //获取会员的收货地址
    public function address($id){
        $address=Userss::find($id)->address;
        // dd($address);
        //加载模板 分配数据
        return view("Admin.Users.address",['address'=>$address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取需要修改的数据
        $data=Userss::find($id);
        //dd($data);
        //加载模板
        return view("Admin.Users.edit",['data'=>$data]);
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
        //获取修改的数据
        // dd($request->all());
        $data=$request->except(['_token','_method']);

        if($request->hasFile('url')){
                $url = $request->file('url')->store(date('Ymd'));
            }else{
                return back()->with('error','请选择图片');
        }
        $data['url'] = $url;
        //执行修改
        if(Userss::where("id","=",$id)->update($data)){
            return redirect("/adminusers")->with("success","修改成功");
        }else{
            return back()->with("error","修改失败");
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
        //直接删除
        if(Userss::where("id","=",$id)->delete()){
            return redirect("/adminusers")->with("success","删除成功");
        }else{
            return redirect("/adminusers")->with("success","删除失败");
        }
    }
}
