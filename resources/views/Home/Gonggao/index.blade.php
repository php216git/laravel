<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>新闻公告</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
   <link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
   <link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
   <link href="/static/Homes/xiangmv/css/personal.css" rel="stylesheet" type="text/css">
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
								<li><img src="/static/Homes/xiangmv/images/logobig.png" /></li>
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
					   <div class="long-title"><span class="all-goods">公告</span></div>
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
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
       <div id='marguee' style='text-align:center;font-size:50px;color:red'>{{$user->title}}</div>
      </h3>
      <h4 class="am-article-meta blog-meta">作者: {{$user->editor}}</h4>

      <div class="am-g blog-content">
        <div class="am-u-sm-12"> 
          <div class="Row">
          	<li><img src="/{{$user->thumb}}"></li>
          
          </div>
          <p>{!!$user->descr!!}</p>
          

        </div>
  
      </div>

    </article>

  </div>

  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">其它公告</div>
        <ul class="am-list blog-list">
        	<li><a href="/static/Homes/xiangmv/#"><p>[特惠]闺蜜喊你来囤国货啦</p></a></li>  
          <li><a href="/static/Homes/xiangmv/#"><p>[公告]华北、华中部分地区配送延迟</p></a></li>
          <li><a href="/static/Homes/xiangmv/#"><p>[特惠]家电狂欢千亿礼券 买1送1！</p></a></li>
          <li><a href="/static/Homes/xiangmv/#"><p>[公告]商城与广州市签署战略合作协议</p></a></li>
          <li><a href="/static/Homes/xiangmv/#"><p>[特惠]洋河年末大促，低至两件五折</p></a></li>      
        </ul>
      </section>

    </div>
  </div>

</div>

<div class="footer" >
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

<script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</body>
</html>
