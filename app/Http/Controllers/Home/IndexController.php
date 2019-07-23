<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public static function getCatesBypid($pid){
        $data=DB::table("cates")->where("pid","=",$pid)->get();
        $data1=array();
        //遍历数据
        foreach($data as $key=>$value){
            //把当前类别下的子类信息封装在suv的下标里
            $value->suv=self::getCatesBypid($value->id);
            $data1[]=$value;
            
        }
        return $data1;
    }
    public function index()
    {
        //加载前台首页
        // echo "111";
        //获取无限分类递归数据
        $cate=self::getCatesBypid(0);
		
	
		
		 // 获取轮播图数据
        $banners_data = DB::table('banners')->where('status',1)->get();

        // 获取友情链接数据
        $youqing_data = DB::table('youqing')->get();
		
			   // 获取所有的顶级分类
        $cates=DB::table("cates")->where("pid","=",0)->get();
		
		foreach($cates as $row){
            // 表关联
            $shop[]=DB::table("shops")->join("cates","shops.cate_id","=","cates.id")->select("shops.name as sname","shops.id as sid","shops.descr","shops.pic","shops.num","shops.price","cates.id as cid","cates.name as cname")->where("shops.cate_id","=",$row->id)->get();
        }
        // dd($shop);
		
		// 广告获取
		$data = DB::table("advert")->get();

		// 获取公告数据
		$articles_data = DB::table('articles')->get();

	   // 获取网站底部数据
        $adevr_data = DB::table('adevr')->first();
        //dd($adevr_data);
        // dd($cate);
		return view("Home.Index.index",['cate'=>$cate,'banners_data'=>$banners_data,'youqing_data'=>$youqing_data,'data'=>$data,'articles_data'=>$articles_data,'shop'=>$shop,'adevr_data'=>$adevr_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	// 获取友情链接数据
    	$youqing_data = DB::table('youqing')->get();
        //
		 $info=DB::table("shops")->where("id","=",$id)->first();
		 // 评论信息遍历
        $data = DB::table("comment")->where("sid","=",$id)->get();
		 
		$shopinfo = DB::table("shop_info")->join("shops","shop_info.shop_id","=","shops.id")->select("shop_info.id as siid","shop_info.color as scolor","shop_info.size as ssize","shop_info.pixel as spixel","shop_info.battery as sbattery","shop_info.internal as sinternal","shop_info.processors as sprocessors","shop_info.remarks as sremarks","shops.name as sname")->first();
        // 加载模板
        return view("Home.Index.info",['info'=>$info,'youqing_data'=>$youqing_data,'shopinfo'=>$shopinfo,"data"=>$data]);
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
