@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>权限修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/auth/{{$data->id}}" method="post" enctype="multipart/form-data"> 
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
       <label class="mws-form-label">权限名</label> 
       <div class="mws-form-item"> 
        <input type="text" name="name" class="large" value="{{$data->name}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器名</label> 
       <div class="mws-form-item"> 
        <input type="text" name="mname" class="large" value="{{$data->mname}}" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">方法名</label> 
       <div class="mws-form-item"> 
        <input type="text" name="aname" class="large" value="{{$data->aname}}" /> 
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">状态</label> 
       <div class="mws-form-item"> 
        未开启<input type="radio" name="status" value="1" checked>
        &nbsp;&nbsp;&nbsp;&nbsp;
        开启<input type="radio" name="status" value="0"> 
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
@section("title","权限修改")