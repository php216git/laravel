<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $article = DB::table('articles')->get();
        return view('Admin.Article.index',['article'=>$article]);
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
        // 执行添加方法
        // dd($request->all());
        $data = $request->except('_token');
        $data = DB::table('articles')->insert($data);
        // dd($data);
        if($data){
            return redirect('/adminarticles')->with('success','添加成功');
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
        // dd($data);
        $data = DB::table('articles')->where('id','=',$id)->update($data);
        if($data){
            return redirect('/adminarticles')->with('success','修改成功');
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
            DB::table("articles")->where("id","=",$value)->delete();
        }

        echo 1;
    }
}
