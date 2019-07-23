@extends("Admin.AdminPublic.publics")
@section("main")
<html>
 <head></head>
 	<script type="text/javascript" charset="utf-8" src="/static/Admins/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/Admins/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/static/Admins/ueditor/lang/zh-cn/zh-cn.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>公告添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminarticles" method="post" enctype="multipart/form-data"> 
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
       <label class="mws-form-label">标题</label> 
       <div class="mws-form-item"> 
        <input type="text" name="title" class="large" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" name="thumb" class="large" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">作者</label> 
       <div class="mws-form-item"> 
        <input type="text" name="editor" class="large" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">描述</label> 
       <div class="mws-form-item"> 
      <script id="editor" type="text/plain" name="descr" style="width:825px;height:500px;"></script>
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
<script type="text/javascript">
var ue = UE.getEditor('editor');
</script>
</html>
@endsection
@section("title","公告添加")