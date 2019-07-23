@extends("Home.HomePublic.publics")
@section("main")
<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
					 <ul> 
					      <div class="per-border"></div> 
					      <!-- 收货地址开头 -->
					      @if(count($address))
					      @foreach($address as $row)
					      <!-- defaultAddr 这个是默认选中的样式 uid地址id -->
					      <li class="user-addresslist" uid="{{$row->id}}"> 
					       <div class="address-left"> 
					        <div class="user"> 
					         <span class="buy-address-detail"> <span class="buy-user">{{$row->name}}</span> <span class="buy-phone">{{$row->phone}}</span> </span> 
					        </div> 
					        <div class="default-address"> 
					         <span class="buy-line-title buy-line-title-type">收货地址：</span> 
					         <span class="buy--address-detail"> <span class="province">{{$row->xhuo}}</span>  
					        </div> 
					       <!--  <ins class="deftip">
					         默认地址
					        </ins>  -->
					       </div> 
					      
					       <div class="clear"></div> 
					       <div class="new-addr-btn"> 
					        <a href="#" class="hidden">设为默认</a> 
					        <span class="new-addr-bar hidden">|</span> 
					        <a href="#">编辑</a> 
					        <span class="new-addr-bar">|</span> 
					        <a href="/shanchu/{{$row->id}}" onclick="delClick(this);">删除</a> 
					       </div> </li>
					       @endforeach
					       @else
					       添加收货地址
					       @endif 
					       <!-- 收货地址结尾 -->
					      <div class="per-border"></div> 
					     </ul> 
						<div class="clear"></div>
				
						<!--例子-->
				

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<form class="am-form am-form-horizontal" action="/gerendizhi/insert" method="post">

										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="name" name="name" placeholder="收货人">
											</div>
										</div>

										     <div class="am-form-group"> 
										      <label for="user-phone" class="am-form-label">手机号码</label> 
										      <div class="am-form-content"> 
										       <input id="user-phone" placeholder="手机号必填" name="phone" type="text" /> 
										      </div> 
										     </div>

										<div class="am-form-group"> 
									      <label for="user-phone" class="am-form-label">所在地</label> 
									      <div class="am-form-content address"> 
									       <select id="cid"> 
									          <option value="" class="ss">--请选择--</option> 
									       </select> 
									      </div> 
									     </div>

										<div class="am-form-group"> 
								      <label for="user-intro" class="am-form-label">详细地址</label> 
								      <div class="am-form-content"> 
								       <textarea class="" rows="3" id="user-intro" placeholder="输入详细地址" name="xhuo"></textarea> 
								      </div> 
								     </div> 
								     <div class="am-form-group theme-poptit"> 
								      <div class="am-u-sm-9 am-u-sm-push-3"> 
								       <div class="am-btn am-btn-danger">
								        <input type="hidden" name="huo" value="">
								        {{csrf_field()}}
								        <input type="submit" id="buttonid" value="提交">
								       </div> 
								       <div class="am-btn am-btn-danger close">
								        取消
								       </div> 
								      </div> 
								     </div>
									</form>
								</div>

							</div>


					</div>


@endsection
<script src="/static/jquery-1.8.3.min.js"></script>
<script type="text/javascript">

		$.ajaxSetup({
		  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		

     $.ajax({
      url:'/create',//url地址
      type:'get',//请求方式
      data:{upid:0},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        // alert(data);
        //遍历
        for(var i=0;i<data.length;i++){
          $(".ss").attr("disabled",true);
          // alert(data[i].name);
          //存储在option
          option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
          // alert(option);
          //把带有数据的option内部插入到第一个select
          $("#cid").append(option);
        }
      },
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });

    //获取其他几级数据 
    //事件委派 live(事件,事件处理器函数)
    $("select").live("change",function(){
      //移除元素
      $(this).nextAll("select").remove();
      // alert($(this).val());
      o=$(this);
      //获取子级的upid
      upid=$(this).val();
      // alert(upid);
      $.ajax({
      url:'/create',//url地址
      type:'get',//请求方式
      data:{upid:upid},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        //创建select
        select=$("<select></select>");
        //内部插入option
        select.append('<option value="" class="mm">--请选择--</option>');
        // alert(data);
        //判断
        if(data.length>0){
          //遍历
          for(var i=0;i<data.length;i++){
            // alert(data[i].name);
            //存储在option
            option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
            // alert(option);
            // 把带有数据的option内部插入到创建好的select
            select.append(option);
          }
          //把创建好的select 追加到前一个select后
          o.after(select);
          //禁用其他级别 请选择
          $(".mm").attr("disabled",true);
        }

      }, 
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });
    });

    arr=[];
    //获取选中的收货地址 赋值给隐藏域
    $("#buttonid").click(function(){
      // alert('id');
      // 遍历
      $("select").each(function(){
        v=$(this).find("option:selected").html();
        // alert(v);
        arr.push(v);
      }); 
      // alert(arr);
      //给隐藏域赋值
      $("input[name='huo']").val(arr); 

    }); 


</script>