@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 商品详情</span> 
   </div> 
   
     <div id="uid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">颜色</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">尺寸</th>
        
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      
       <tr class="odd"> 
        <td class=" ">{{$info['id']}}</td> 
        <td class=" ">{{$info['color']}}</td> 
        <td class=" ">{{$info['size']}}</td> 
      

       

       </tr>
   
      </tbody>
     </table>
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
    
     </div>
   
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">

 </script>
</html>
@endsection
@section("title","商品详情")