@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>广告添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminadvert" method="post"> 
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
       <label class="mws-form-label">广告主</label> 
       <div class="mws-form-item"> 
        <input type="text" name="name" class="large" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告标题</label> 
       <div class="mws-form-item"> 
        <input type="text" name="title" class="large" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容</label> 
       <div class="mws-form-item"> 
        <input type="text" name="content" class="large" /> 
       </div> 
      </div>   
     </div> 
     <div class="mws-button-row"> 
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
@section("title","广告添加")