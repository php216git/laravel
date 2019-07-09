@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>轮播图修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminbanner/{{$data->id}}" method="post" enctype="multipart/form-data"> 
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
       <label class="mws-form-label">轮播图标题</label> 
       <div class="mws-form-item"> 
        <input type="text" name="title" class="large" value="{{$data->title}}" /> 
       </div> 
      </div> 

      <div class="mws-form-row"> 
       <label class="mws-form-label">轮播图图片</label> 
       <div class="mws-form-item"> 
        <input type="file" name="url" class="form-control" value="{{$data->url}}"> 
       </div>

      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">轮播图状态</label> 
       <div class="mws-form-item"> 
        未开启<input type="radio" name="status" value="0" checked value="{{$data->status}}">
		    &nbsp;&nbsp;&nbsp;&nbsp;
		    开启<input type="radio" name="status" value="1" value="{{$data->status}}"> 
       </div> 
      </div> 
	
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","轮播图修改")