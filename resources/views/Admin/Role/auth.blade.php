@extends("Admin.AdminPublic.publics")
@section("main")
<div class="container"> 
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saveauth" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">权限信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前角色:{{$role->name}}的角色信息</h4> 
         <ul class="mws-form-list inline">
          @foreach($auth as $row)
          <li><input type="checkbox" name="nid[]" value="{{$row->id}}" @if(in_array($row->id,$nid)) checked @endif> <label>{{$row->name}}</label></li>
          @endforeach                            
          </ul> 
        </div> 
       </div> 
      </div>  
      <div class="mws-button-row">
        {{csrf_field()}}
        <input type="hidden" value="{{$role->id}}" name="rid">
       <input value="分配权限" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div>
@endsection
@section("title","后台分配权限")