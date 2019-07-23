@extends("Home.HomePublic.publics")
@section("main")

		<div class="user-info">
			<!--标题 -->
			<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">保存资料</strong> / <small>Personal&nbsp;information</small></div>
			</div>
			<hr/>
			<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								<img class="am-circle am-img-thumbnail" src="/uploads/{{session('userinfo')->url}}" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>小叮当</i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						            </span>
								</div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
							</div>
						</div>

						<!--个人信息 -->
				<div class="info-main">
				<form class="am-form am-form-horizontal" action="/home_update/{{$upss->id}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">昵称</label>
                  <div class="am-form-content">
                    <input type="text" id="name" name="username" value="{{$upss->username}}" placeholder="昵称">

                  </div>
                </div>
             
                <div class="am-form-group">
                  <label for="user-phone" class="am-form-label">手机号</label>
                  <div class="am-form-content">
                    <input id="phone" name="phone" value="{{$upss->phone}}" placeholder="手机号" type="text">

                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-email" class="am-form-label">邮箱</label>
                  <div class="am-form-content">
                    <input id="user-email" name="email" value="{{$upss->email}}" placeholder="邮箱" type="text">

                  </div>
                </div>
                 <div class="am-form-grou"> 
				       <label class="am-form-label">头像</label> 
				       <div class="mws-form-item"> 
				        	<input type="file" name="url" class="form-control"> 
				       </div>

			     </div>                          
                <div class="info-btn">
                  <div class="am-btn am-btn-danger">
                    <input type="submit" class="am-btn am-btn-danger" value="保存资料">
                  </div>
                </div>

              </form>
						</div>

					</div>


@endsection