@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head>
<style type="text/css">
</style>
 </head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 公告列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead>  
       <tr role="row"> 
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">操作</th>
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">标题</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">描述</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">图片</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">作者</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
       @foreach($article as $row)
       <tr class="odd"> 
        <td class=" "><input type="checkbox" value="{{$row['id']}}"></td> 
        <td class="  sorting_1">{{$row['id']}}</td> 
        <td class=" ">{{$row['title']}}</td> 
        <td class=" ">{!!$row['descr']!!}</td> 
        <td class=" "><img src="{{$row['thumb']}}"></td> 
        <td class=" ">{{$row['editor']}}</td> 
        <td class=" ">
           <a href="/adminarticles/{{$row['id']}}/edit" class="btn btn-success">修改</a>

         </td> 
       </tr>

       @endforeach
      </tbody>
      <tr>
        <td colspan="7"><a href="javascript:void(0)" class="btn btn-success allchoose">全选</a><a href="javascript:void(0)" class="btn btn-success nochoose">全不选</a><a href="javascript:void(0)" class="btn btn-success fchoose">反选</a></td>
       </tr>
        <tr>
        <td colspan="7"><a href="javascript:void(0)" class="btn btn-success del">删除</a></td>
       </tr>
     </table>

     <div class="dataTables_paginate paging_full_numbers" id="pages">
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 // alert($);
 //全选
 $(".allchoose").click(function(){
  //找到table 遍历tr 
  $("#DataTables_Table_1").find("tr").each(function(){
    //找checkbox 选中
    $(this).find(":checkbox").attr("checked",true);
  });
 });

  //全不选
 $(".nochoose").click(function(){
  //找到table 遍历tr 
  $("#DataTables_Table_1").find("tr").each(function(){
    //找checkbox 选中
    $(this).find(":checkbox").attr("checked",false);
  });
 });

 //反选
$(".fchoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    //判断
    if($(this).find(":checkbox").attr("checked")){
      //设置为不选中
      $(this).find(":checkbox").attr("checked",false);
    }else{
      $(this).find(":checkbox").attr("checked",true);

    }
  });
});

//删除
$(".del").click(function(){
  arr=[];
  //遍历选中复选框的id
  $(":checkbox").each(function(){
    //判断是否选中
    if($(this).attr("checked")){
      //获取id
      id=$(this).val();
      // alert(id);
      //把每个ID存储在数组arr
      arr.push(id);
    }
  });
  // alert(arr);

  //Ajax
  $.get("/del",{arr:arr},function(data){
    // alert(data);
    if(data==1){
      //遍历arr
      for(var i=0;i<arr.length;i++){
        //通过选中的id获取input
        $("input[value='"+arr[i]+"']").parents("tr").remove();
      }
    }else{
      alert(data);
    }
  })
});
 </script>
</html>
@endsection
@section("title","后台公告的列表")