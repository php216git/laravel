@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 评论列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <div id="uid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">商品名称</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">内容</th>
        
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($data as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->sname}}</td> 
        <td class=" ">{{$row->uname}}</td> 
        <td class=" ">{{$row->content}}</td> 

        <td class=" ">
          <form action="/admincomment/{{$row->id}}" method="post">
            {{method_field("DELETE")}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">删除</button>
          </form>

         </td> 

       </tr>
       @endforeach
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
@section("title","评论列表")