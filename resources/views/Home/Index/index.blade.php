<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
  <title>首页</title> 
  <link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Homes/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Homes/xiangmv/css/hmstyle.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Homes/xiangmv/css/skin.css" rel="stylesheet" type="text/css" /> 
  <script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"></script> 
  <script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script> 
  <style type="text/css">
    .aaa{ 
      position: fixed;
      left:0px;
      top:350px;
    }

    .bbb{
      position: absolute;
      top:1px;
      right:3px;


    }
    .hide{
      display: none!important;
    }
    .coolscrollbar{scrollbar-arrow-color:yellow;scrollbar-base-color:lightsalmon;}
  </style>
 </head> 
 <body> 
  <div class="hmtop"> 
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
      <div class="menu-hd">
       <a href="/homeindex" target="_top" class="h">商城首页</a>
      </div> 
     </div> 
     <div class="topMessage my-shangcheng"> 
      <div class="menu-hd MyShangcheng">
       <a href="/geren" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a>
      </div> 
     </div> 
     <div class="topMessage mini-cart"> 
      <div class="menu-hd">
       <a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a>
      </div> 
     </div> 
     <div class="topMessage favorite"> 
      <div class="menu-hd">
       <a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
      </div> 
     </div>
    </ul> 
   </div> 
   <!--悬浮搜索框--> 
   <div class="nav white"> 
    <div class="logo">
     <img src="/static/Homes/xiangmv/images/logo.png" />
    </div>

    <div class="logoBig"> 
     <li><img src="/static/Homes/xiangmv/images/shangcheng.png" style="width:110px,height:100px"/></li> 
    </div> 

    <div class="search-bar pr"> 
     <a name="index_none_header_sysc" href="#"></a> 
     <form> 
      <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off" /> 
      <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit" /> 
     </form> 
    </div> 
   </div> 
   <div class="clear"></div> 
  </div> 
  <div class="banner"> 
   <!--轮播 开始--> 

   <div class="am-slider am-slider-default scoll" data-am-flexslider="" id="demo-slider-0"> 
    <ul class="am-slides"> 

      @foreach($banners_data as $row)
     <li class="banner1"><a><img src="/uploads/{{$row->url}}" style="margin-left: -674px; width:1355px;height:430px"/></a></li> 
      @endforeach

    </ul> 
   </div> 
   <!--轮播结束-->

   <div class="clear"></div> 
  </div> 
  <div class="shopNav"> 
   <div class="slideall"> 
    <div class="long-title">
     <span class="all-goods">全部分类</span>
    </div> 
    <div class="nav-cont"> 
     <ul> 
      <li class="index"><a href="#">首页</a></li> 
      <li class="qc"><a href="#">闪购</a></li> 
      <li class="qc"><a href="#">限时抢</a></li> 
      <li class="qc"><a href="#">团购</a></li> 
      <li class="qc last"><a href="#">大包装</a></li> 
     </ul> 
     <div class="nav-extra"> 
      <i class="am-icon-user-secret am-icon-md nav-user"></i>
      <b></b>我的福利 
      <i class="am-icon-angle-right" style="padding-left: 10px;"></i> 
     </div> 
    </div> 
    <!--侧边导航 --> 
    <div id="nav" class="navfull"> 
     <div class="area clearfix"> 
      <div class="category-content" id="guide_2"> 
       <div class="category">
       <!-- 前天首页左侧菜单开始  -->
        <ul class="category-list" id="js_climit_li">

        @foreach($cate as $row) 
         <li class="appliance js_toggle relative"> 
          <div class="category-info"> 
           <h3 class="category-name b-category-name"><i><img src="/static/Homes/xiangmv/images/cake.png" /></i><a class="ml-22" title="点心">{{$row->name}}</a></h3> 
           <em>&gt;</em>
          </div> 
          @if(count($row->suv))
          <div class="menu-item menu-in top"> 
           <div class="area-in"> 
            <div class="area-bg"> 
             <div class="menu-srot"> 
              <div class="sort-side">
             
              @foreach($row->suv as $rows)
               <dl class="dl-sort"> 
                <dt>
                 <span title="蛋糕">{{$rows->name}}</span>
                </dt>
                @foreach($rows->suv as $rr) 
                <dd>
                 <a title="蒸蛋糕" href="#"><span>{{$rr->name}}</span></a>
                </dd>
                @endforeach
               </dl>
               @endforeach
              
              </div> 
             </div> 
            </div> 
           </div> 
          </div> <b class="arrow"></b> </li>
          @endif
          @endforeach
          

        
        
        </ul> 
        <!-- 前台首页左侧菜单结束 -->
       </div> 
      </div> 
     </div> 
    </div> 
    <!--轮播--> 
    <script type="text/javascript">
              (function() {
                $('.am-slider').flexslider();
              });
              $(document).ready(function() {
                $("li").hover(function() {
                  $(".category-content .category-list li.first .menu-in").css("display", "none");
                  $(".category-content .category-list li.first").removeClass("hover");
                  $(this).addClass("hover");
                  $(this).children("div.menu-in").css("display", "block")
                }, function() {
                  $(this).removeClass("hover")
                  $(this).children("div.menu-in").css("display", "none")
                });
              })
            </script> 
    <!--小导航 --> 
    <div class="am-g am-g-fixed smallnav"> 
     <div class="am-u-sm-3"> 
      <a href="sort.html"><img src="/static/Homes/xiangmv/images/navsmall.jpg" /> 
       <div class="title">
        商品分类
       </div> </a> 
     </div> 
     <div class="am-u-sm-3"> 
      <a href="#"><img src="/static/Homes/xiangmv/images/huismall.jpg" /> 
       <div class="title">
        大聚惠
       </div> </a> 
     </div> 
     <div class="am-u-sm-3"> 
      <a href="#"><img src="/static/Homes/xiangmv/images/mansmall.jpg" /> 
       <div class="title">
        个人中心
       </div> </a> 
     </div> 
     <div class="am-u-sm-3"> 
      <a href="#"><img src="/static/Homes/xiangmv/images/moneysmall.jpg" /> 
       <div class="title">
        投资理财
       </div> </a> 
     </div> 
    </div> 
	<!-- 广告 开始 -->
    <div class="marqueen aaa coolscrollbar" style="width:138px;height:300px;border:1px solid #FFD700;" id="ooo"> 
     <span class="marqueen-title">全网最新广告</span>
     <div class="bbb">
        <img src="" alt="">
        <a href="#" id="close">×</a>
     </div> 
     <div class="demo"> 
      <ul> 
       @foreach($data as $row)
       <li class="title-first"><a target="_blank" href="#"> <img src="/static/Homes/xiangmv/images/TJ2.jpg" /> <span>[{{$row->title}}]</span>{{$row->content}} </a></li><hr>
       @endforeach
      </ul> 
     </div> 
    </div> 
    <!-- 广告 结束 -->
    <!--走马灯 --> 
    <div class="marqueen"> 
     <span class="marqueen-title">商城头条</span> 
     <div class="demo"> 
      <ul> 
       <li class="title-first"><a target="_blank" href="#"> <img src="/static/Homes/xiangmv/images/TJ2.jpg" /> <span>[特惠]</span>商城爆品1分秒 </a></li> 
       <li class="title-first"><a target="_blank" href="#"> <span>[公告]</span>商城与广州市签署战略合作协议 </a></li> 
      <!--  @if(session('homeemail'))
        <div class="m-baseinfo"> 
        	<a href="person/index.html">
				<img src="/uploads/{{session('userinfo')->url}}">
			</a>
         <em><span class="s-name" style="margin-left: -50px;"> Hi: {{session ('homeinfo')}}</span> <a href="#"></a> </em> 
        </div>
        @else

        <div class="member-logout"> 
         <a class="am-btn-warning btn" href="/homelogin/create">登录</a> 
         <a class="am-btn-warning btn" href="/homeregister/create">注册</a> 
        </div>
        @endif -->
    

        <!-- 正确头像 开始 -->
      <!--   <div class="m-baseinfo">
        	@if(session('userinfo'))
								<a href="person/index.html">
									<img src="/uploads/{{session('userinfo')->url}}">
								</a>
								<em>
									Hi,<span class="s-name">{{session('userinfo')->username}}</span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
		</div>
		@else
		<div class="member-logout"> 
         <a class="am-btn-warning btn" href="/homelogin/create">登录</a> 
         <a class="am-btn-warning btn" href="/homeregister/create">注册</a> 
        </div>
        @endif -->
        <!-- 正确头像 结束 -->



				<div class="m-baseinfo">
				        @if(session('userinfo'))
                <div class="menu-hd">
                  <a href="#" target="_top" class="h" style="color:red;">
                  	你好!&nbsp;&nbsp;&nbsp;&nbsp;{{session ('userinfo')->username}}</a>         
                </div>
                @else
                <div class="member-logout"> 
                 <a class="am-btn-warning btn" href="/homelogin/create">登录</a> 
                 <a class="am-btn-warning btn" href="/homeregister/create">注册</a> 
                </div>
                @endif
				</div>
        

        <div class="member-login"> 
           <a href="#"><strong>0</strong>待收货</a> 
           <a href="#"><strong>0</strong>待发货</a> 
           <a href="#"><strong>0</strong>待付款</a> 
           <a href="#"><strong>0</strong>待评价</a> 
        </div> 
        <div class="clear"></div> 
  
      @foreach($articles_data as $ress)
       <li><a target="_blank" href="/homegonggao/{{$ress->id}}"><span>[公告]</span>{{$ress->title}}</a></li> 
      @endforeach
      </ul> 

      <div class="advTip">
       <img src="/static/Homes/xiangmv/images/advTip.jpg" />
      </div> 
     </div> 
    </div>

    <div class="clear"></div> 
   </div> 
   <script type="text/javascript">
          if ($(window).width() < 640) {
            function autoScroll(obj) {
              $(obj).find("ul").animate({
                marginTop: "-39px"
              }, 500, function() {
                $(this).css({
                  marginTop: "0px"
                }).find("li:first").appendTo(this);
              })
            }
            $(function() {
              setInterval('autoScroll(".demo")', 3000);
            })
          }
        </script> 
  </div> 
  <div class="shopMainbg"> 
   <div class="shopMain" id="shopmain"> 
    <!--今日推荐 --> 
    <div class="am-g am-g-fixed recommendation"> 
     <div class="clock am-u-sm-3" "=""> 
      <img src="/static/Homes/xiangmv/images/2016.png " /> 
      <p>今日<br />推荐</p> 
     </div> 
     <div class="am-u-sm-4 am-u-lg-3 "> 
      <div class="info "> 
       <h3>真的有鱼</h3> 
       <h4>开年福利篇</h4> 
      </div> 
      <div class="recommendationMain one"> 
       <a href="introduction.html"><img src="/static/Homes/xiangmv/images/tj.png " /></a> 
      </div> 
     </div> 
     <div class="am-u-sm-4 am-u-lg-3 "> 
      <div class="info "> 
       <h3>囤货过冬</h3> 
       <h4>让爱早回家</h4> 
      </div> 
      <div class="recommendationMain two"> 
       <img src="/static/Homes/xiangmv/images/tj1.png " /> 
      </div> 
     </div> 
     <div class="am-u-sm-4 am-u-lg-3 "> 
      <div class="info "> 
       <h3>浪漫情人节</h3> 
       <h4>甜甜蜜蜜</h4> 
      </div> 
      <div class="recommendationMain three"> 
       <img src="/static/Homes/xiangmv/images/tj2.png " /> 
      </div> 
     </div> 
    </div> 
    <div class="clear "></div> 
    <!--热门活动 --> 
    <div class="am-container activity "> 
     <div class="shopTitle "> 
      <h4>活动</h4> 
      <h3>每期活动 优惠享不停 </h3> 
      <span class="more "> <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;"></i></a> </span> 
     </div> 
     <div class="am-g am-g-fixed "> 
      <div class="am-u-sm-3 "> 
       <div class="icon-sale one "></div> 
       <h4>秒杀</h4> 
       <div class="activityMain "> 
        <img src="/static/Homes/xiangmv/images/yang.jpg" style="height:315px"/> 
       </div> 
       <div class="info "> 
        <h3>春节送礼优选</h3> 
       </div> 
      </div> 
      <div class="am-u-sm-3 "> 
       <div class="icon-sale two "></div> 
       <h4>特惠</h4> 
       <div class="activityMain "> 
        <img src="/static/Homes/xiangmv/images/yuan.jpg " style="height:315px;width:595px"/> 
       </div> 
      </div> 
      <div class="am-u-sm-3 last "> 
       <div class="icon-sale "></div> 
       <h4>超值</h4> 
       <div class="activityMain "> 
        <img src="/static/Homes/xiangmv/images/jiu.jpg " style="height:315px"/> 
       </div> 
       <div class="info "> 
        <h3>春节送礼优选</h3> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div id="f4">  
    <div class="clear "></div> 
    @foreach($cate as $r)
    <div id="f1"> 
     <!--甜点--> 
     <div class="am-container "> 
      <div class="shopTitle "> 
       <h4>{{$r->name}}</h4> 
       <h3>科技改变未来</h3> 
       <div class="today-brands "> 
        @foreach($r->suv as $rr)
        <a href="# ">{{$rr->name}}</a> 
        @endforeach
       </div> 
       <span class="more "> <a href="# ">更多商品<i class="am-icon-angle-right" style="padding-left:10px ;"></i></a> </span> 
      </div> 
     </div> 
     <div class="am-g am-g-fixed floodFour"> 
      <div class="am-u-sm-5 am-u-md-4 text-one list "> 
       <div class="word"> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
        <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a> 
       </div> 
       <a href="# "> 
        <div class="outer-con "> 
         <div class="title ">
           开抢啦！ 
         </div> 
         <div class="sub-title ">
           零食大礼包 
         </div> 
        </div> <img src="/static/Homes/xiangmv/images/act1.png " /> </a> 
       <div class="triangle-topright"></div> 
      </div> 

      @foreach($shop as $s)
      @foreach($s as $ss)
      @if($ss->cid == $r->id)
      <!-- 商品图开始 -->
      <div class="am-u-sm-7 am-u-md-4 text-two " style="float:left"> 
       <div class="outer-con "> 
        <div class="title ">
          {!!$ss->descr!!} 
        </div> 
        <div class="sub-title ">
          &yen;{{$ss->price}}
        </div> 
        <i class="am-icon-shopping-basket am-icon-md  seprate"></i> 
       </div> 
       <a href="/homeindex/{{$ss->sid}}"><img style="width: 200px;height:160px" src="{{$ss->pic}}" /></a> 
      </div> 
     <!--  商品图结束 -->
      @endif
      @endforeach
      @endforeach

     </div> 
     <div class="clear "></div> 
    </div> 
    @endforeach 
	
	
	
    <div class="footer "> 
     <!-- 友情链接 开始 -->
       <h1>友情链接:</h1>
     <div class="footer-hd "> 
      <p>
        @foreach($youqing_data as $row)
        <a href="{{$row->url}} ">{{$row->title}}</a> 
        @endforeach
      </p> 
     </div> 
     <!-- 友情链接 结束 --> 
     <div class="footer-bd "> 
      <p> <a href="# ">关于恒望</a> <a href="# ">合作伙伴</a> <a href="# ">联系我们</a> <a href="# ">{{$adevr_data->title}}&nbsp;&nbsp;&nbsp;{{$adevr_data->desc}}&nbsp;&nbsp;&nbsp;{{$adevr_data->cort}}</a> <em>&copy;</em> </p> 
     </div> 

    </div> 
   </div> 
  </div> 
  <!--引导 --> 
  <div class="navCir"> 
   <li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li> 
   <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li> 
   <li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li> 
   <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li> 
  </div> 
  <!--菜单 --> 
  <div class="tip"> 
   <div id="sidebar"> 
    <div id="wrap"> 
     <div id="prof" class="item "> 
      <a href="# "> <span class="setting "></span> </a> 
      <div class="ibar_login_box status_login "> 
       <div class="avatar_box "> 
        <p class="avatar_imgbox "><img src="/static/Homes/xiangmv/images/no-img_mid_.jpg " /></p> 
        <ul class="user_info "> 
         <li>用户名sl1903</li> 
         <li>级&nbsp;别普通会员</li> 
        </ul> 
       </div> 
       <div class="login_btnbox "> 
        <a href="# " class="login_order ">我的订单</a> 
        <a href="# " class="login_favorite ">我的收藏</a> 
       </div> 
       <i class="icon_arrow_white "></i> 
      </div> 
     </div> 
     <div id="shopCart " class="item "> 
      <a href="# "> <span class="message "></span> </a> 
      <p> 购物车 </p> 
      <p class="cart_num ">0</p> 
     </div> 
     <div id="asset " class="item "> 
      <a href="# "> <span class="view "></span> </a> 
      <div class="mp_tooltip ">
        我的资产 
       <i class="icon_arrow_right_black "></i> 
      </div> 
     </div> 
     <div id="foot " class="item "> 
      <a href="# "> <span class="zuji "></span> </a> 
      <div class="mp_tooltip ">
        我的足迹 
       <i class="icon_arrow_right_black "></i> 
      </div> 
     </div> 
     <div id="brand " class="item "> 
      <a href="#"> <span class="wdsc "><img src="/static/Homes/xiangmv/images/wdsc.png " /></span> </a> 
      <div class="mp_tooltip ">
        我的收藏 
       <i class="icon_arrow_right_black "></i> 
      </div> 
     </div> 
     <div id="broadcast " class="item "> 
      <a href="# "> <span class="chongzhi "><img src="/static/Homes/xiangmv/images/chongzhi.png " /></span> </a> 
      <div class="mp_tooltip ">
        我要充值 
       <i class="icon_arrow_right_black "></i> 
      </div> 
     </div> 
     <div class="quick_toggle "> 
      <li class="qtitem "> <a href="# "><span class="kfzx "></span></a> 
       <div class="mp_tooltip ">
        客服中心
        <i class="icon_arrow_right_black "></i>
       </div> </li> 
      <!--二维码 --> 
      <li class="qtitem "> <a href="#none "><span class="mpbtn_qrcode "></span></a> 
       <div class="mp_qrcode " style="display:none; ">
        <img src="/static/Homes/xiangmv/images/weixin_code_145.png " />
        <i class="icon_arrow_white "></i>
       </div> </li> 
      <li class="qtitem "> <a href="#top " class="return_top "><span class="top "></span></a> </li> 
     </div> 
     <!--回到顶部 --> 
     <div id="quick_links_pop " class="quick_links_pop hide "></div> 
    </div> 
   </div> 
   <div id="prof-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      我 
    </div> 
   </div> 
   <div id="shopCart-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      购物车 
    </div> 
   </div> 
   <div id="asset-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      资产 
    </div> 
    <div class="ia-head-list "> 
     <a href="# " target="_blank " class="pl "> 
      <div class="num ">
       0
      </div> 
      <div class="text ">
       优惠券
      </div> </a> 
     <a href="# " target="_blank " class="pl "> 
      <div class="num ">
       0
      </div> 
      <div class="text ">
       红包
      </div> </a> 
     <a href="# " target="_blank " class="pl money "> 
      <div class="num ">
       ￥0
      </div> 
      <div class="text ">
       余额
      </div> </a> 
    </div> 
   </div> 
   <div id="foot-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      足迹 
    </div> 
   </div> 
   <div id="brand-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      收藏 
    </div> 
   </div> 
   <div id="broadcast-content " class="nav-content "> 
    <div class="nav-con-close "> 
     <i class="am-icon-angle-right am-icon-fw "></i> 
    </div> 
    <div>
      充值 
    </div> 
   </div> 
  </div> 
  <script>
      window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
    </script> 
  <script type="text/javascript " src="basic/js/quick_links.js "></script>  
  <script>
      var close=document.getElementById("close");
      var ooo=document.getElementById("ooo");
      close.onclick=function fff(){
        ooo.className="hide";
      }
  </script>
 </body>
</html>