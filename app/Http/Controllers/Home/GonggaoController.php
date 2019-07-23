<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GonggaoController extends Controller
{
    // 显示公告页面
    public function index($id)
    {
    	//dd($id);
    	$user=DB::table("articles")->where("id",'=',$id)->first();

    	return view('Home.Gonggao.index',['user'=>$user]);
    }
} 
