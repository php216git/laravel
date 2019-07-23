<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/static/Homes/xiangmv/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/static/Homes/xiangmv/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/Homes/xiangmv/bootstrap/css/bootstrap.min.css">

  </head>
  <style type="text/css">
    .cur{
      border:1px solid red;
    }

     .curs{
      border:1px solid green;
    }
  </style>
  <body>

    <div class="login-boxtitle">
      <a href="home/demo.html"><img alt="" src="/static/Homes/xiangmv/images/logobig.png" /></a>
    </div>

    <div class="res-banner">
      <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/static/Homes/xiangmv/images/big.jpg" /></div>
        <div class="login-box">

            <div class="am-tabs" id="doc-my-tabs">
              <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                <li class="am-active"><a href="">邮箱注册</a></li>
                <li><a href="">手机号注册</a></li>
              </ul>

              <div class="am-tabs-bd">
                <div class="am-tab-panel am-active">
                  <form  action="/homeregister" method="post">
                    @if(session('error'))
                    {{session('error')}}
                    @endif
                 <div class="user-email">
                    <label for="email"><i class="am-icon-envelope-o"></i></label>
                    <input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                 </div>                   
                 <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="设置密码">
                 </div>                   
                 <div class="user-pass">
                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">
                 </div> 

                  <div class="user-pass">
                    <label for="passwordRepeat"><i class="am-icon-code-fork"></i></label>
                    <img src="/code" onclick="this.src=this.src+'?a=1'" style="float:right"> 
                 </div>

                  <div class="verification">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码">
                    </div> 
                 
                 
                 <div class="login-links">
                  </div>
                    <div class="am-cf">
                      {{csrf_field()}}
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                </div>

                </form>

                <div class="am-tab-panel">
                  <form method="post" action="/registerphone" id="ff">
                 <div class="user-phone" style="margin-top:20px">
                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                    <input type="tel" name="phone" id="phone" placeholder="请输入手机号" class="ll"reminder="请输入正确的手机号"><span></span>
                 </div>                                     
                    <div class="verification" style="margin-top:20px">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码"  style="width:140px" class="ll" reminder="请输入验证码"><span></span>
                      <a href="javascript:void(0)"class="btn btn-info" style="float:right" id="ss">获取</a>
                    </div>
                 <div class="user-pass" style="margin-top:20px">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="设置密码" class="ll" reminder="请输入正确的密码"><span></span>
                 </div>                   
                 <div class="user-pass" style="margin-top:20px">
                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码" class="ll" reminder="请再次重复密码"><span></span>
                 </div> 
                    <div class="am-cf">
                      {{csrf_field()}}
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                      
                    </div>
                    </form>
                
                  <hr>
                </div>

                <script>
                  $(function() {
                      $('#doc-my-tabs').tabs();
                    })
                </script>

              </div>
            </div>

        </div>
      </div>
      
          <div class="footer ">
            <div class="footer-hd ">
              <p>
                <a href="# ">恒望科技</a>
                <b>|</b>
                <a href="# ">商城首页</a>
                <b>|</b>
                <a href="# ">支付宝</a>
                <b>|</b>
                <a href="# ">物流</a>
              </p>
            </div>
            <div class="footer-bd ">
              <p>
                <a href="# ">关于恒望</a>
                <a href="# ">合作伙伴</a>
                <a href="# ">联系我们</a>
                <a href="# ">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em>
              </p>
            </div>
          </div>
  </body>
  <script type="text/javascript">
    PHONES=false;
    CODE=false;
  // alert($);
  //获取焦点做校验
  $(".ll").focus(function(){
    //获取reminder
    reminder=$(this).attr("reminder");
    //直接给下一个span元素赋值
    $(this).next("span").css("color","red").html(reminder);
    //addClass 添加样式
    $(this).addClass("cur");
  });

//手机号校验
$("input[name='phone']").blur(function(){
  //获取手机号
  phone=$(this).val();
  ob=$(this);
  p=ob.val();
  //检测是否符合正则规则 match没有匹配到正则返回值为null
  if(phone.match(/^\d{11}$/)==null){
    // alert("手机号不符合规则");
    $(this).next("span").css("color","red").html("手机号不合法");
    $(this).addClass("cur");
    PHONES=false;
  }else{
    // alert("ok");
    //Ajax 判断手机号是否已经被注册
    $.get("/checkphone",{p:p},function(data){
      // alert(data);
      if(data==1){
        ob.next("span").css("color","red").html("手机号已经被注册");
        ob.addClass("cur");
        PHONES=false;
      }else{
        ob.next("span").css("color","green").html("手机号可用");
        ob.addClass("curs");
        PHONES=true;
      }
    });
  }
});
  

  // 获取手机校验码
 $("#ss").click(function(){
  oo=$(this);
    //获取手机号
    pp=$("input[name='phone']").val();
    // ajax
    $.get("/sendphone",{pp:pp},function(data){
      // alert(data);
      // 判断状态码
      // 短信发出开始倒计时
      if(data.code==000000){
        m=60;
        mytime=setInterval(function(){
          m--;
          oo.html(m);
          oo.attr("disabled",true);
          if(m<0){
            // 清除定时器
            clearInterval(mytime);
            oo.html("获取");
            oo.attr("disabled",false);
          }
        },1000);
      }
     
    },'json');
 });

 // 获取输入校验码的值进行校验
 $("input[name='code']").blur(function(){
  cc=$(this);
  //获取输入校验码
  code=$(this).val();
  // ajax请求
  $.get("/checkcode",{code:code},function(data){
      if(data==1){
        cc.next("span").css("color","green").html("校验码正确");
        cc.addClass("curs");
        CODE=true;
      }else if(data==2){
        cc.next("span").css("color","red").html("校验码不对");
        cc.addClass("cur");
        CODE=false;
      }else if(data==3){
        cc.next("span").css("color","green").html("校验码为空");
        cc.addClass("cur");
        CODE=false;
      }else{
        cc.next("span").css("color","green").html("校验码过期");
        cc.addClass("curs");
        CODE=false;
      }
  });
 });

 // 表单提交或者阻止提交
 $("#ff").submit(function(){
  // 让元素触发失去焦点事件
  $("input").trigger("blur");
  if(PHONES && CODE){
    return true;
  }else{
     return false;
  }
 
 });
  </script>
</html>