@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>商品添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminshops/{{$data->id}}" method="post" enctype="multipart/form-data"> 
      @if (count($errors) > 0)
       <div class="mws-form-message error">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
       </div>
    @endif

     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">商品名称</label> 
       <div class="mws-form-item"> 
        <input type="text" name="name" class="large" value="{{$data->name}}"/> 
       </div> 
      </div> 
     
     <div class="mws-form-row"> 
       <label class="mws-form-label">类别</label> 
       <div class="mws-form-item"> 
       <select name="cate_id" class="large">
        
        @foreach($cate as $row)
        <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
       </select>
       </div> 
      </div> 
      
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">描述</label> 
       <div class="mws-form-item"> 
        <textarea name="descr" class="large">{{$data->descr}}</textarea>
       </div> 
      </div>

      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" name="pic" class="large" /> 
       </div> 
      </div>

      <div class="mws-form-row"> 
       <label class="mws-form-label">数量</label> 
       <div class="mws-form-item"> 
        <input type="text" name="num" class="large" value="{{$data->num}}"/> 
       </div> 
      </div> 

      <div class="mws-form-row"> 
       <label class="mws-form-label">价格</label> 
       <div class="mws-form-item"> 
        <input type="text" name="price" class="large" value="{{$data->price}}"/> 
       </div> 
      </div>  

     <div class="mws-button-row">
      {{method_field("PUT")}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","商品修改")