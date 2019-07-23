<!DOCTYPE html>
<html>

	<head> 
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
		

		<title>个人中心</title>

		<link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"> 

		<link href="/static/Homes/xiangmv/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/static/Homes/xiangmv/css/infstyle.css" rel="stylesheet" type="text/css">
		<link href="/static/Homes/xiangmv/css/stepstyle.css" rel="stylesheet" type="text/css">
		<script href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		<link href="/static/Homes/xiangmv/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/static/Homes/xiangmv/css/systyle.css" rel="stylesheet" type="text/css">
		<link href="/static/Homes/xiangmv/css/addstyle.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/static/Homes/xiangmv/js/address.js"></script> 
		
	</head>
	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">

					<ul class="message-l">
							<div class="topMessage">
							@if(session('homeemail'))
			                <div class="menu-hd">
			                  <a href="#" target="_top" class="h">
			                  	你好!{{session ('homeemail')}}</a>         
			                  	<a href="/logout">退出</a>
			                </div>
			                @else
			                <div class="menu-hd">
			                  <a href="/homelogin/create" target="_top" class="h">亲，请登录</a>
			                  <a href="/homeregister/create" target="_top">免费注册</a>
			                </div>
			                @endif
							</div>
					</ul> 

						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/homeindex" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/static/Homes/xiangmv/#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/static/Homes/xiangmv/#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/static/Homes/xiangmv/#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/static/Homes/xiangmv/images/shangcheng.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="/static/Homes/xiangmv/#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
		 <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/static/Homes/xiangmv/#">首页</a></li>
                                <li class="qc"><a href="/static/Homes/xiangmv/#">闪购</a></li>
                                <li class="qc"><a href="/static/Homes/xiangmv/#">限时抢</a></li>
                                <li class="qc"><a href="/static/Homes/xiangmv/#">团购</a></li>
                                <li class="qc last"><a href="/static/Homes/xiangmv/#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
			
				<!-- 内容部分 开始 -->
				@section("main")
 

                @show
			    <!-- 内容部分 结束 -->
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="/static/Homes/xiangmv/#">恒望科技</a>
							<b>|</b>
							<a href="/static/Homes/xiangmv/#">商城首页</a>
							<b>|</b>
							<a href="/static/Homes/xiangmv/#">支付宝</a>
							<b>|</b>
							<a href="/static/Homes/xiangmv/#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="/static/Homes/xiangmv/#">关于恒望</a>
							<a href="/static/Homes/xiangmv/#">合作伙伴</a>
							<a href="/static/Homes/xiangmv/#">联系我们</a>
							<a href="/static/Homes/xiangmv/#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="/geren">个人中心</a>
					</li>
					<li class="person">
						<a href="/home_edit/{{session('userinfo')->id}}">个人资料</a>
						<ul>
							<li> <a href="/homeedit/{{session('userinfo')->id}}">修改密码</a></li>
							<li> <a href="/dizhi">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="/static/Homes/xiangmv/#">我的交易</a>
						<ul>
							<li><a href="/static/Homes/xiangmv/order.html">订单管理</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="/static/Homes/xiangmv/#">我的小窝</a>
						<ul>
							<li> <a href="/static/Homes/xiangmv/comment.html">评价</a></li>
						</ul>
					</li>

				</ul>

			</aside>
		</div>

	</body>

</html>
