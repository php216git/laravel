<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>购物车页面</title>

    <link href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/static/Homes/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/static/Homes/xiangmv/css/cartstyle.css" rel="stylesheet" type="text/css" />
    <link href="/static/Homes/xiangmv/css/optstyle.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/static/Homes/xiangmv/js/jquery.js"></script>
 
  </head>

  <body>

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
              <a href="/homelogin/create" target="_top" class="h">请登录</a>
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
          <div class="menu-hd MyShangcheng"><a href="/geren" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
          <div class="menu-hd"><a id="mc-menu-hd" href="/homecart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
          <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
      </ul>
      </div>

      <!--悬浮搜索框-->

      <div class="nav white">
        <div class="logo"><img src="/static/Homes/xiangmv/images/logo.png" /></div>
        <div class="logoBig">
          <li><img src="/static/Homes/xiangmv/images/shangcheng.png" /></li>
        </div>

        <div class="search-bar pr">
          <a name="index_none_header_sysc" href="#"></a>
          <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
          </form>
        </div>
      </div>

      <div class="clear"></div>
    
      <!--购物车 -->
      <div class="concent">
        <div id="cartTable">
          <div class="cart-table-th">
            <div class="wp">
              <div class="th th-chk">
                <div id="J_SelectAll1" class="select-all J_SelectAll">

                </div>
              </div>
              <div class="th th-item">
                <div class="td-inner">商品信息</div>
              </div>
              <div class="th th-price">
                <div class="td-inner">单价</div>
              </div>
              <div class="th th-amount">
                <div class="td-inner">数量</div>
              </div>
              <div class="th th-sum">
                <div class="td-inner">金额</div>
              </div>
              <div class="th th-op">
                <div class="td-inner">操作</div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
          
          
          <tr class="item-list">
            <!-- 购物车遍历开始 -->
            @if(count($data1)) 
            @foreach($data1 as $row)
            <div class="bundle  bundle-last">
              <div class="clear"></div>
              <div class="bundle-main">                
                <ul class="item-content clearfix">
                  <li class="td td-chk">
                    <div class="cart-checkbox ">
                      <input class="check" id="J_CheckBox_170037950254" name="items" value="{{$row['id']}}" type="checkbox">
                      <label for="J_CheckBox_170037950254"></label>
                    </div>
                  </li>
                  <li class="td td-item">
                    <div class="item-pic">
                      <a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
                        <img src="{{$row['pic']}}" style="height:70px" class="itempic J_ItemImg"></a>
                    </div>
                    <div class="item-info">
                      <div class="item-basic-info">
                        <a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">名字</a>
                      </div>
                    </div>
                  </li>
                  <li class="td td-info">
                    <div class="item-props item-props-can">
                      <span class="sku-line">描述：{!!$row['descr']!!}</span>
                      <span class="sku-line">包装：裸装</span>
                      <i class="theme-login am-icon-sort-desc"></i>
                    </div>
                  </li>
                  <li class="td td-price">
                    <div class="item-price price-promo-promo">
                      <div class="price-content">
                        <div class="price-line">
                          <em class="J_Price price-now" tabindex="0">单价{{$row['price']}}</em>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-amount">
                    <div class="amount-wrapper ">
                      <div class="item-amount ">
                        <div class="sl">
                          <a href="javascript:void(0)" class="btn btn-info updatee" name="{{$row['id']}}">-</a>
                          <input class="text_box" type="text" value="{{$row['num']}}" style="width:30px;" />
                          <a href="javascript:void(0)" name="{{$row['id']}}" class="btn btn-info update">+</a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-sum">
                    <div class="td-inner">
                      <em tabindex="0" class="J_ItemSum number">{{$row['price']*$row['num']}}</em>
                    </div>
                  </li>
                  <li class="td td-op">
                    <div class="td-inner">
                      <a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a>
                     <form action="/homecart/{{$row['id']}}" method="post">
                     	{{csrf_field()}}
                     	{{method_field('DELETE')}}
                        <button type="submit" class="delete">删除</button>
                  </form>
                    </div>
                  </li>
                </ul>
                          
                
                
                
              </div>
            </div>
            @endforeach
            @else 
            购物车空空如也
            @endif
          </tr>
          <!-- 购物车遍历结束 -->
          <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <div class="float-bar-wrapper">
          <div id="J_SelectAll2" class="select-all J_SelectAll">
            <div class="cart-checkbox">
             	
            </div>
            <a href="javescript:void(0)" class="allcheckbox">全选</a>
          </div>
          <div class="operations">
            <a href="/alldelete" hidefocus="true" class="deleteAll">删除</a>
            <a href="/homeindex" hidefocus="true" class="J_BatchFav">继续购物</a>
          </div>
          <div class="float-bar-right">
            <div class="amount-sum">
              <span class="txt">已选商品</span>
              <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
              <div class="arrow-box">
                <span class="selected-items-arrow"></span>
                <span class="arrow"></span>
              </div>
            </div>
            <div class="price-sum">
              <span class="txt">合计:</span>
              <strong class="price">¥<em id="J_Total">0元</em></strong>
            </div>
            <div class="">
              {{csrf_field()}}
                <input type="submit" name="jie" value="结算" style="background-color:green;width:150px;height:100px;color:black">
            </div>
          </div>
        


        </div>
     
        <div class="footer "> 
     <!-- 友情链接 开始 -->
       <h1>友情链接:</h1>
     <div class="footer-hd ">  
     </div> 
     <!-- 友情链接 结束 --> 
     <div class="footer-bd "> 
      <p> <a href="# ">关于恒望</a> <a href="# ">合作伙伴</a> <a href="# ">联系我们</a> <a href="# ">网站地图</a> <em>&copy; 2015-2025 Hengwang.com 版权所有</em> </p> 
     </div> 
    </div> 

      </div>

      <!--操作页面-->

      <div class="theme-popover-mask"></div>

      <div class="theme-popover">
        <div class="theme-span"></div>
        <div class="theme-poptit h-title">
          <a href="javascript:;" title="关闭" class="close">×</a>
        </div>
        <div class="theme-popbod dform">
          <form class="theme-signin" name="loginform" action="" method="post">

            <div class="theme-signin-left">

              <li class="theme-options">
                <div class="cart-title">颜色：</div>
                <ul>
                  <li class="sku-line selected">12#川南玛瑙<i></i></li>
                  <li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
                </ul>
              </li>
              <li class="theme-options">
                <div class="cart-title">包装：</div>
                <ul>
                  <li class="sku-line selected">包装：裸装<i></i></li>
                  <li class="sku-line">两支手袋装（送彩带）<i></i></li>
                </ul>
              </li>
              <div class="theme-options">
                <div class="cart-title number">数量</div>
                <dd>
                  <input class="min am-btn am-btn-default" name="" type="button" value="-" />
                  <input class="text_box" name="" type="text" value="1" style="width:30px;" />
                  <input class="add am-btn am-btn-default" name="" type="button" value="+" />
                  <span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
                </dd>

              </div>
              <div class="clear"></div>
              <div class="btn-op">
                <div class="btn am-btn am-btn-warning">确认</div>
                <div class="btn close am-btn am-btn-warning">取消</div>
              </div>

            </div>
            <div class="theme-signin-right">
              <div class="img-info">
                <img src="/static/Homes/xiangmv/images/kouhong.jpg_80x80.jpg" />
              </div>
              <div class="text-info">
                <span class="J_Price price-now">¥39.00</span>
                <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
              </div>
            </div>

          </form>
        </div>
      </div>
    <!--引导 -->
    <div class="navCir">
      <li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
      <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
      <li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>  
      <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>         
    </div>
  </body>
  <script type="text/javascript">
  	// 减操作
  	$(".updatee").click(function(){
  		ob=$(this);
  		// 获取id
  		id=$(this).attr("name");
  		
  		$.get("/cartupdatee",{id:id},function(data){
  			// 赋值给数量
  			ob.next("input").val(data.num);
  			// 赋值给金额
  			ob.parents("li").next("li").find("em").html(data.tot);
  		},'json')
  	})
  	// 加操作
  	$(".update").click(function(){
  		ob=$(this);
  		// 获取id
  		id=$(this).attr("name");

  		$.get("/cartupdate",{id:id},function(data){
  			// 赋值给数量
  			ob.prev("input").val(data.num);
  			// 赋值给金额
  			ob.parents("li").next("li").find("em").html(data.tot);
  		},'json')
  	})


  	arr=[];
  	// 计算总是和总价格 给文本改变事件
  	$("input[name='items']").change(function(){
  		// 判断如果复选框选中状态获取id
  		if($(this).attr("checked")){
  			// 获取id
  			id=$(this).val();
  			arr.push(id);
  		}else{
  			// 获取没有选中的id
  			ids=$(this).val();
  			// 若没选择框 删除
  			// 		获取删除的索引值
  			Array.prototype.indexOf = function(val){
  				for(var i=0;i<this.length; i++){
  					if(this[i]== val)return i;
  				}
  				return -1;
  			}
  			//       截取索引
  			Array.prototype.remove=function(val){
  				var index = this.indexOf(val);
  				if(index> -1){
  					this.splice(index,1);
  				}
  			}
  			// 删除没选中的id
  			arr.remove(ids);
  		}
  		$.get("/carttot",{arr:arr},function(data){
  			//总件数
      		$("#J_SelectedItemsCount").html(data.nums);
      		//总价
      		$("#J_Total").html(data.sum);
  		},'json')
  		
  	})

  	// 全选操作
  	$(".allcheckbox").click(function(){
  		$(".check").attr("checked",true);
  	})
	
	
	
	
    // 结算操作
    $("input[name='jie']").click(function(){
        // 判断checked是否选中 选中就发送ajax
        if($("input[name='items']").is(':checked')){
          $.get("/jiesuan",{arr:arr},function(data){
              if(data){
                // 跳转
                window.location="/order/insert";
              }
          },'json')
        }else{
          alert("请至少选中一条");
        }
    })
  </script>
</html>