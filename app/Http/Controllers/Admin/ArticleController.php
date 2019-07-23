<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入组建类
use Intervention\Image\ImageManager;
use Config;
use App\Services\OSS;//导入OSS类
use Storge;;//导入Storage类
use Illuminate\Support\Facades\Redis;
use App\Models\Article;
class ArticleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        
        // $article = DB::table('articles')->get();
        // return view('Admin.Article.index',['article'=>$article]);
    	
    	// 练习redis
    	// Redis::set("lamp216","sm");

    	// 获取数据
    	// echo Redis::get("lamp216");

        // 公告数据缓存
        // 判断下缓存服务器里有没有公告列表
        // 哈希表:缓存当前列表数据
        // 链表:存储每条数据的id
        //定义一个变量,存储公告的列表的记录
        $arts=[];
        //链表名字,存储每条数据的id
        $listKey='List:php216slist';
        // 哈希表,存储公告列表数据
        $hasKey="HASH:php215hash";

        // 判断redis 缓存服务器里是否具有缓存数据
        // 判断链表里有没有数据id
        if(Redis::exists($listKey)){
        	// 获取所有的id
        	$lists = Redis::lrange($listKey,0,-1);
        	// 遍历id
        	foreach($lists as $k=>$v){
        		// 根据获取到的id值获取哈希表中的所有公告数据
        		$arts[]=Redis::hgetall($hasKey.$v);
        	}
        }else{
        	// 缓存服务器里没有数据
        	// 先从数据库获取数据 给缓存服务器一份
        	$arts = Article::get()->toArray();
        	foreach($arts as $k=>$v){
        		// 把数据的id存储在列表里
        		Redis::rpush($listKey,$v['id']);
        		// 把数据存储字啊哈希表里
        		Redis::hmset($hasKey.$v['id'],$v);
        	}

        	
        }
         $article = DB::table('articles')->get();
        return view('Admin.Article.index',['article'=>$arts]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加页面
        return view('Admin.Article.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$data = $request->except('_token');
    	//  普通上传
  
        // // 执行添加方法
        // if($request->hasFile("thumb")){
        // 	$name=time();
        // 	$ext = $request->file('thumb')->getClientOriginalExtension();
        // 	// 移动
        // 	$request->file('thumb')->move(Config::get("app.app_uploads"),$name.".".$ext);
        // 	// 裁剪图片
        // 	$manager = new ImageManager();
        // 	// resize 裁剪的意思  100 100 宽和高  save保存方法
        // 	$manager->make(Config::get("app.app_uploads").$name.".".$ext)->resize(100,100)->save(Config::get("app.app_uploads")."r_".$name.".".$ext);

        // 	// 封装thumb
        // 	$data['thumb']=Config::get("app.app_uploads")."r_".$name.".".$ext;

        // 	// 执行数据库的插入
        // 	if(DB::table('articles')->insert($data)){
        // 		return redirect('/adminarticles')->with('success','添加成功');
        // 	}else{
        // 		return back()->with('error','添加失败');
        // 	}
        //  }


    	// //上传到aliyun oos下
    	
     //    //执行图片的上传
     //    if($request->hasFile("thumb")){
     //        $file=$request->file("thumb");
     //        // dd($file);
     //        $name=time();
     //        $ext=$request->file("thumb")->getClientOriginalExtension();
     //        $newfile=$name.".".$ext;
     //        $filepath=$file->getRealPath();
     //        //OSS上传
     //        //$newfile上传到阿里云oss平台下的文件名字
            
     //        // dd($newfile,$filepath);
     //        //$filepath 临时资源
     //        OSS::upload($newfile, $filepath);
     //        //裁剪图片
     //        $manager = new ImageManager();
     //        //resize 裁剪 100 100 宽和高   save保存方法
     //        // $manager->make(env('ALIURL').$name.".".$ext)->resize(100,100)->save(Config::get("app.app_uploads")."r_".$name.".".$ext);
            
     //        //封装thumb
     //       //  $data['thumb']=Config::get("app.app_uploads")."r_".$name.".".$ext;
     //        $data['thumb']=env('ALIURL').$name.'.'.$ext;

     //        //执行数据库的插入
     //        if(DB::table("articles")->insert($data)){
     //            return redirect("/adminarticles")->with("success","添加成功");
     //        }else{
     //            return back()->with("error","添加失败");
     //        }

     //    }
     


     		//上传到七牛下
    	
        //执行图片的上传
        if($request->hasFile("thumb")){
            $file=$request->file("thumb");
            // dd($file);
            $name=time();
            $ext=$request->file("thumb")->getClientOriginalExtension();
            $newfile=$name.".".$ext;
            $filepath=$file->getRealPath();
            //OSS上传
            //$newfile上传到阿里云oss平台下的文件名字
            
            // dd($newfile,$filepath);
            //$filepath 临时资源
            \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(), 'r'));
            //裁剪图片
            $manager = new ImageManager();
            //resize 裁剪 100 100 宽和高   save保存方法
            $manager->make(env('QINIU_DOMAIN').$name.".".$ext)->resize(100,100)->save(Config::get("app.app_uploads")."r_".$name.".".$ext);
            
            //封装thumb
            $data['thumb']=Config::get("app.app_uploads")."r_".$name.".".$ext;
            
            // $data['thumb']=env('QINIU_DOMAIN').$name.'.'.$ext;

            $id = DB::table("articles")->insertGetId($data);
            //执行数据库的插入
            if($id){
            	$data['id']=$id;
            	// 添加的同时把添加的数据存储在缓存服务器里
            	 //链表名字,存储每条数据的id
			        $listKey='List:php216slist';
			        // 哈希表,存储公告列表数据
			        $hasKey="HASH:php215hash";

			        Redis::rpush($listKey,$id);
			        // 把数据添加到哈希表里
			        Redis::hmset($hasKey.$id,$data);
                return redirect("/adminarticles")->with("success","添加成功");
            }else{
                return back()->with("error","添加失败");
            }

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
        // dd($id);
        // 获取需要修改的数据
        $data = DB::table('articles')->where('id','=',$id)->first();
        // dd($data);
        // 显示修改页面
        return view('Admin.Article.edit',['data'=>$data]);
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
        $data = $request->except('_token','_method');
        //执行图片的上传
        if($request->hasFile("thumb")){
            $file=$request->file("thumb");
            // dd($file);
            $name=time();
            $ext=$request->file("thumb")->getClientOriginalExtension();
            $newfile=$name.".".$ext;
            $filepath=$file->getRealPath();
            //OSS上传
            //$newfile上传到阿里云oss平台下的文件名字
            
            // dd($newfile,$filepath);
            //$filepath 临时资源
            OSS::upload($newfile, $filepath);
            //裁剪图片
            $manager = new ImageManager();
            //resize 裁剪 100 100 宽和高   save保存方法
            $manager->make(env('ALIURL').$name.".".$ext)->resize(100,100)->save(Config::get("app.app_uploads")."r_".$name.".".$ext);
            
            //封装thumb
            $data['thumb']=Config::get("app.app_uploads")."r_".$name.".".$ext;
            // $data['thumb']=env('ALIURL').$name.'.'.$ext;

            //执行数据库的插入
            if(DB::table("articles")->where('id','=',$id)->update($data)){
                return redirect("/adminarticles")->with("success","修改成功");
            }else{
                return back()->with("error","修改失败");
            }

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
        //
    }

    //删除
    public function del(Request $request){
        $arr=$request->input("arr");
        if($arr==""){
            echo "请至少选中一条数据";die;
        }
        // echo json_encode($arr);
        //遍历数组arr
        foreach($arr as $key=>$value){
        	// 删除缓存服务器数据
        	 //链表名字,存储每条数据的id
			        $listKey='List:php216slist';
			        // 哈希表,存储公告列表数据
			        $hasKey="HASH:php215hash";
			// 删除哈希表的数据
			Redis::del($hasKey.$value);
			// 删除链表id
			Redis::lrem($listKey,0,$value);
        	// 获取删除的数据
        	$info = DB::table('articles')->where('id','=',$value)->first();
        	// 删除裁剪图片
            unlink($info->thumb);

            DB::table("articles")->where("id","=",$value)->delete();
        }

        echo 1;
    }
}
