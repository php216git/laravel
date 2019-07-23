@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>底部修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/dibu/{{$data->id}}" method="post"> 
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
       <label class="mws-form-label">版权</label> 
       <div class="mws-form-item"> 
        <input type="text" name="title" class="large" value="{{$data->title}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">备案号</label> 
       <div class="mws-form-item"> 
        <input type="text" name="desc" class="large" value="{{$data->desc}}" /> 
       </div> 
      </div>  
      <div class="mws-form-row"> 
       <label class="mws-form-label">公司名称</label> 
       <div class="mws-form-item"> 
        <input type="text" name="cort" class="large" value="{{$data->cort}}" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field('PUT')}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","底部修改")