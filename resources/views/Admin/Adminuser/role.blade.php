@extends("Admin.AdminPublic.publics")
@section("main")
<div class="container">
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saverole" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">角色信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前用户: {{$adminuser->name}}的角色信息</h4> 
         <ul class="mws-form-list inline">
			@foreach($role as $row)
              <li><input type="checkbox" name="rids[]" value="{{$row->id}}" @if(in_array($row->id,$rids)) checked @endif > <label>{{$row->name}}</label></li>
            @endforeach
          </ul> 
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{csrf_field()}}
        <input type="hidden" value="{{$adminuser->id}}" name="uid">
       <input value="分配角色" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div>
@endsection
@section("title","分配角色")