@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminyouqing/{{$data->id}}" method="post"> 
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
       <label class="mws-form-label">友情名称</label> 
       <div class="mws-form-item"> 
        <input type="text" name="title" class="large" value="{{$data->title}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">url地址</label> 
       <div class="mws-form-item"> 
        <input type="url" name="url" class="large" value="{{$data->url}}" /> 
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
@section("title","友情连接修改")