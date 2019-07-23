@extends("Home.HomePublic.publics")
@section("main")


					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
					</div> 
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal" action="/homeupdate/{{$ress->id}}" method="post">
						<div class="am-form-group">
							<label for="password" class="am-form-label">原密码</label>
							<div class="am-form-content">
								<input type="password" id="upass" name="password" placeholder="请输入原登录密码" value="{{$ress->password}}">
							</div>
						</div>
						<div class="am-form-group">
							<label for="password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" id="upass1" name="password1" placeholder="由数字、字母组合">
							</div>
						</div>
						<div class="am-form-group">
							<label for="password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" id="upass2" name="password2" placeholder="请再次输入上面的密码">
							</div>
						</div>
						<div class="info-btn"> 
						      {{csrf_field()}}
						      <input type="submit" value="修改密码" class="am-btn am-btn-danger" /> 
						      <input type="reset" value="重置" class="am-btn am-btn-danger" /> 
     					</div>

					</form>


@endsection