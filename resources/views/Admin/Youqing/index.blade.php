@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body> 
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 友情链接列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <div id="uid">
     <form action="/adminyouqing" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>
        搜索:网站名 <input type="text" name="chen" aria-controls="DataTables_Table_1"  value="{{$request['chen'] or ''}}"/></label>
      <input type="submit" class="btn btn-success" value="搜索">
     </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;" >友情链接名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">url地址</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($data as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->title}}</td> 
        <td class=" ">{{$row->url}}</td> 
        <td class=" ">
          <form action="/adminyouqing/{{$row->id}}" method="post">
            {{method_field("DELETE")}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">删除</button>
          </form>
           <a href="/adminyouqing/{{$row->id}}/edit" class="btn btn-success">修改</a>
         </td> 
      @endforeach
       </tr>

      </tbody>
     </table>
   </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
       {{$data->appends($request)->render()}}
     </div>
    </div> 
   </div> 
  </div>
 </body>

</html>
@endsection
@section("title","友情链接列表")