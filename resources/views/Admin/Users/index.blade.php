@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 用户列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
    <form action="/adminusers" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>搜索:用户名 <input type="text" name="keyword" aria-controls="DataTables_Table_1"  value="{{$request['keyword'] or ''}}"/>邮箱 <input type="text" name="keywords" aria-controls="DataTables_Table_1"  value="{{$request['keywords'] or ''}}"/></label>
      <input type="submit" class="btn btn-success" value="搜索">
     </div>
     </form>
     <div id="uid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">邮箱</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">头像</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">电话</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">添加时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">修改时间</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->username}}</td> 
        <td class=" ">{{$row->email}}</td> 
        <td>
        	<img title="" src="/uploads/{{ $row->url}}" style="width:150px">
    	</td>
        <td class=" ">{{$row->status}}</td> 
        <td class=" ">{{$row->phone}}</td> 
        <td class=" ">{{$row->created_at}}</td> 
        <td class=" ">{{$row->updated_at}}</td> 

        <td class=" ">
          <form action="/adminusers/{{$row->id}}" method="post">
            {{method_field("DELETE")}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">删除</button>
          </form>
           <a href="/adminusers/{{$row->id}}/edit" class="btn btn-info">修改</a>
           <a href="/adminusers/{{$row->id}}" class="btn btn-success">会员详情</a>
           <a href="/adminaddress/{{$row->id}}" class="btn btn-success">会员收货地址</a>

         </td> 

       </tr>
       @endforeach
      </tbody>
     </table>
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      @foreach($pp as $row)
      <button class="btn btn-danger" onclick="page({{$row}})">{{$row}}</button>
      @endforeach
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 // alert($);
  function page(page){
    // alert(page);
    //执行Ajax
    $.get("/adminusers",{page:page},function(data){
      // alert(data);
      //把获取到的响应数据赋值给id为uid 的div
      $("#uid").html(data);
    });
  }
 </script>
</html>
@endsection
@section("title","用户列表")