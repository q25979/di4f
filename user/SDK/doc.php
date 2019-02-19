<!DOCTYPE html>
<html lang="username-CN">
<head>
<meta charset="utf-8"/>
<title>零度即时到帐支付 - 开发文档</title>
<meta name="keywords" content="零度即时到帐支付,一款即时到账的辅助工具，让你解放双手，每天自动赚钱"/>
<meta name="description" content="零度云支付，可以助你一站式解决网站签约各种支付接口的难题，现拥有支付宝、QQ钱包、微信支付等免签约支付功能，并有开发文档与SDK，可快速集成到你的网站"/>
<meta name="viewport"content="pid-scalable=no, width=device-width">
<meta name="viewport"content="width=device-width, initial-scale=1"/>
<meta name="renderer"content="webkit">
<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
<link rel="stylesheet"href="css/font-awesome.min.css"type="text/css"/>
<link rel="stylesheet"href="css/bootstrap.css"type="text/css"/>
<link rel="stylesheet"href="css/common.css">
<link rel="stylesheet"href="css/index-top.css">
<!--[if IE 9 ]><style type="text/css">#ie9{ display:block; }</style><![endif]-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery-ujs.js"async="true"></script>
<link rel="stylesheet"type="text/css"href="css/index.css"/>
</head>
<body>
<!--[if (gt IE 6)&(lt IE 9)]>
<h1 style='color:red;text-align:center;'>
      你好，浏览器版本过低，升级可正常访问,点击<a style="color:blue"href="https://browsehappy.com/">升级您的浏览器</a>
</h1>
<style type="text/css">#ielt9{ display: none; }h1{ height:300px;line-height: 300px;display:block; }header{ display: none; }#ie9{ display: block; }.tenxcloud-logo{ margin:50px auto 0;display:block}</style>
<![endif]--><link rel="stylesheet"href="css/common1.css"/>
<script type="text/javascript">

function aclos(){
document.getElementById("q_Msgbox").style.display="none";
}
</script>


<div id="ielt9"style="height:100%">
<header>
<nav id="main-nav"class="navbar navbar-default"role="navigation">
<div class="container">
<div class="row">
<div class="navbar-header">
<button type="button"class="toggle navbar-toggle collapsed"data-toggle="collapse"data-target=".navbar-top-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="/"><span class="logo" style="background:url(assets/logo.png) no-repeat;height: 45px"></span></a>
</div>
<div class="navbar-collapse navbar-top-collapse collapse"style="height: 1px;">
<ul class="nav navbar-nav navbar-right c_navbar">

</ul>
<ul class="nav navbar-nav navbar-right z_navbar">
<li><a href="/">首页</a></li>
<li><a href="doc.html">开发文档</a></li>
<li><a href="https://bbs.buguaiwl.com/forum.php?mod=forumdisplay&fid=48">公告动态</a></li>
<li><a href="https://bbs.buguaiwl.com/forum.php?mod=forumdisplay&fid=49">问题反馈</a></li>
<!--li class="dropdown"><a class="dropdown-toggle"data-toggle="dropdown" href="/index.php/pid/index/">用户中心<b class="caret"></b></a>
<ul  class="dropdown-menu"style="width: 100%;">
<li><a style="line-height:30px;" href="/index.php/index/login/">登陆</a></li>
<li><a style="line-height:30px;" href="/index.php/index/register/">注册</a></li>
</ul>

</li-->
                    
                </ul>
</div>
</div>
</div>
</nav>
</header>

<div id="ie9">你当前的浏览器版本过低，请您升级至IE9以上版本，以达到最佳效果，谢谢！<span class="closeIE">X</span></div>
<div id="scroll_Top">
<i class="fa fa-arrow-up"></i>
<a href="javascript:;"title="去顶部"class="TopTop">TOP</a></div>
<script>

  $('.closeIE').click(function(event) {
    $('#ie9').fadeOut();
  });
</script>

<style type="text/css">
.bann{ content:'';background-size:100%;background:#4280cb;background:-webkit-gradient(linear,0 0,0 100%,from(#4585d2),to(#4280cb));background:-moz-linear-gradient(top,#4585d2,#4280cb);background:linear-gradient(to bottom,#4585d2,#4280cb);top:0;left:0;z-index:-1;min-height:50px;width:100%}.fl .active{ color:#3F5061;background:#fff;border-color:#fff}
</style>

<div class="bann">


<div class="col-xs-12"style="text-align:center;">
<div class="h3"style="color:#ffffff;margin-top: 35px;margin-bottom: 30px;">开发文档</div>
                  
<div style="clear:both;"></div>
</div><div style="clear:both;"></div>
</div>


<div class="container">

  <!-- Docs nav
  ================================================== -->
  <div class="row">
    <div class="col-md-3 ">
      <div id="toc" class="bc-sidebar">
		<ul class="nav">
			<li class="toc-h2 toc-active"><a href="#toc0">支付接口介绍</a></li>
			<li class="toc-h2"><a href="#toc1">协议规则</a></li>
			<hr/>
<li class="toc-h2"><a href="#api1">[API]查询商户信息</a></li>
<li class="toc-h2"><a href="#api2">[API]修改商户账号</a></li>
<li class="toc-h2"><a href="#api3">[API]单个订单查询</a></li>
<li class="toc-h2"><a href="#api4">[API]批量订单查询</a></li>
<li class="toc-h2"><a href="#api5">[API]记录支付订单</a></li>
<li class="toc-h2"><a href="#api6">[API]获取订单状态</a></li>
<li class="toc-h2"><a href="#api7">[API]发起扫码支付</a></li>
			<hr/>
			<li class="toc-h2"><a href="#sdk0">SDK下载</a></li>
			<hr/>
		</ul>
	</div>
   </div>

    <div class="col-md-9">
      <article class="post page">
      	<section class="post-content">
              <h2 id="toc0">支付接口介绍</h2>
<blockquote><p>使用此接口可以实现即时到账，免签约，无需企业认证。</p></blockquote>
<p>本文阅读对象：商户系统（在线购物平台、人工收银系统、自动化智能收银系统或其他）集成支付涉及的技术架构师，研发工程师，测试工程师，系统运维工程师。</p>
<h2 id="toc1">协议规则</h2>
<p>传输方式：HTTP</p>
<p>数据格式：JSON</p>
<p>签名算法：MD5</p>
<p>字符编码：UTF-8</p>
<hr/>
 
 


<h2 id="api1">[API]获取商户的信息</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=query&pid=[商户PID]&key=[商户KEY]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>商户pid</td><td>pid</td><td>是</td><td>String</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商务key</td><td>key</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>商户pid</td><td>pid</td><td>Int</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户key</td><td>key</td><td>Int</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  <tr><td>腾讯QQ号</td><td>qq</td><td>Int</td><td>272341207</td><td>商户KEY</td></tr>
  <tr><td>交易流量</td><td>paymb</td><td>Int</td><td>1000</td><td>可用的交易额度</td></tr>
  <tr><td>订单有效时间</td><td>outtime</td><td>Int</td><td>180</td><td>订单有效时间(单位:秒)</td></tr>
  <tr><td>支付状态</td><td>login</td><td>Int</td><td>_alipay_wxpay_qqpay_</td><td>使用查找支付方式字符是否存在来判断支付方式是否挂软件</td></tr>
  <tr><td>帐号状态</td><td>active</td><td>Int</td><td>1</td><td>=1则正常，0=则被禁封</td></tr>
  <tr><td>注册时间</td><td>addtime</td><td>String</td><td>2016-12-04 10:12:00</td><td>注册账号的时间</td></tr>
  </tbody>
</table>








<h2 id="api2">[API]修改账号信息</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=change&pid=[PID]&key=[KEY]&qq=[新的QQ号]&newkey=[新KEY]&outtime=[订单有效时间(单位:秒)]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>商户PID</td><td>pid</td><td>是</td><td>String</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户KEY</td><td>key</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  <tr><td>新的QQ号</td><td>qq</td><td>是</td><td>String</td><td>272341207</td><td>要修改的新QQ号</td></tr>
  <tr><td>商户新KEY</td><td>newkey</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>要修改的新商户新KEY</td></tr>
  <tr><td>订单有效时间</td><td>outtime</td><td>是</td><td>int</td><td>180</td><td>订单有效时间(单位:秒)</td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回信息</td><td>msg</td><td>String</td><td>修改成功！</td><td></td></tr>
  </tbody>
</table>





<h2 id="api3">[API]查询单个交易订单号</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=order&out_trade_no=[订单号]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th></th></thead>
  <tbody>
  <tr><td>交易订单</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td>交易订单号</tr>
  </td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>回信息</td><td>msg</td><td>查询成功</td><td></td><td>返回提示信息</td></tr>
  <tr><td>商户PID</td><td>pid</td><td>String</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>云端订单号</td><td>trade_no</td><td>String</td><td>20160806155158498</td><td>云端订单号</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>Int</td><td>20160806151343349</td><td>交易订单号</td></tr>
  <tr><td>用户UID</td><td>pay_id</td><td>String</td><td>admin</td><td>用户唯一的识标</td></tr>
  <tr><td>商品名称</td><td>name</td><td>String</td><td>zero</td><td>商品的名称</td></tr>
  <tr><td>商品价格</td><td>price</td><td>Int</td><td>30</td><td>商品的真实价格</td></tr>
  <tr><td>付款金额</td><td>money</td><td>Int</td><td>30</td><td>实际付款的金额</td></tr>
  <tr><td>创建时间</td><td>endtime</td><td>String</td><td>2016-12-04 10:12:00</td><td>订单创建的时间</td></tr>
  <tr><td>付款时间</td><td>endtime</td><td>String</td><td>2016-12-04 10:12:00</td><td>付款的时间</td></tr>
  <tr><td>支付方式</td><td>type</td><td>String</td><td>alipay</td><td>qqpay=QQ扫码;wxpay=微信红包;alipay=支付宝</td></tr>
  <tr><td>交易状态</td><td>status</td><td>Int</td><td>1</td><td>交易状态，1为已付款，其他值都是未付款</td></tr>
  </tbody>
</table>


<h2 id="api4">[API]交易订单号批量查询</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=orders&pid=[商户PID]&key=[商户KEY]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></th></thead>
  <tbody>
  <tr><td>商户PID</td><td>pid</td><td>是</td><td>String</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户KEY</td><td>key</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  </td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>回信息</td><td>msg</td><td>查询成功</td><td></td><td>返回提示信息</td></tr>
  <tr><td>订单列表</td><td>date</td><td>Array</td><td></td><td>订单列表</td></tr>
  </tbody>
</table>

 
<h2 id="api5">[API]记录支付订单</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=submit&pid=[商户PID]&key=[商户KEY]&trade_no=[云端订单号]&out_trade_no=[商户订单号]&pay_id=[用户UID,可以是IP]&name=[商品名称]&outtime=[订单超时时间戳]&money=[支付金额]&type=[支付方式]&</a>notify_url=[异步通知地址]&sign=[签名]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></th></thead>
  <tbody>
  <tr><td>商户PID</td><td>pid</td><td>是</td><td>Int</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户KEY</td><td>key</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  <tr><td>云端订单号</td><td>pay_id</td><td>是</td><td>String</td><td>1000</td><td>云端订单号</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>Int</td><td>201801265498161</td><td>商户唯一订单号</td></tr>
  <tr><td>用户UID丶IP</td><td>pay_id</td><td>是</td><td>String</td><td>1000</td><td>用户UID,可以是IP</td></tr>
  <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>测试商品</td><td>商品的名称</td></tr>
  <tr><td>订单超时时间戳</td><td>outtime</td><td>是</td><td>Int</td><td>180</td><td>订单超时的时间戳,单位:秒</td></tr>
  <tr><td>支付金额</td><td>money</td><td>是</td><td>String</td><td>10.00</td><td>商品的价格</td></tr>
  <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>qqpay=QQ扫码;wxpay=微信红包;alipay=支付宝</td></tr>
  <tr><td>异步通知地址</td><td>notify_url</td><td>是</td><td>String</td><td>http://pay.abcwl.cn/notify_url.php</td><td>通知平台处理业务</td></tr>
  <tr><td>MD5签名</td><td>sign</td><td>是</td><td>String</td><td>b0a107a9152939f6635099b081e6aa3a</td><td>生成方式 MD5 加密
如：
md5(money={值}&name={值}&out_trade_no={值}&pay_id={值}&pid={值}&type={值}{商户key})</td></tr>
  </td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>返回提示内容</td><td>msg</td><td>String</td><td>记录订单成功</td><td>记录订单成功</td></tr>
  <tr><td>应该付款的金额</td><td>money</td><td>String</td><td>10.01</td><td>用户必须付系统给出的金额,否则不会及时到账</td></tr>
  </tbody>
</table>


 
<h2 id="api6">[API]获取订单付款状态</h2>
<p>notify_url地址：http://pay.abcwl.cn/api.php?act=submit_order&pid=[商户PID]&out_trade_no=[商户订单号]&trade_no=[云端订单号]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></th></thead>
  <tbody>
  <tr><td>商户PID</td><td>pid</td><td>是</td><td>Int</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>Int</td><td>201801265498161</td><td>商户唯一订单号</td></tr>
  <tr><td>云端订单号</td><td>pay_id</td><td>是</td><td>String</td><td>1000</td><td>云端订单号</td></tr>
  </td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
  <tr><td>订单记录</td><td>data</td><td>String</td><td>订单</td><td>订单</td></tr>
  </tbody>
</table>

 
<h2 id="api7">[API]发起支付</h2>
<p>notify_url地址：http://pay.abcwl.cn/submit.php?pid=[商户PID]&key=[商户KEY]&out_trade_no=[商户订单号]&name=[商品名称]&money=[支付金额]&type=[支付方式]&</a>notify_url=[异步通知地址]&</a>return_url=[同步通知地址]&sitename=[站点名称]&sign=[签名]</p>
<p>请求参数说明：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></th></thead>
  <tbody>
  <tr><td>商户PID</td><td>pid</td><td>是</td><td>Int</td><td>10005158498</td><td>商户PID</td></tr>
  <tr><td>商户KEY</td><td>key</td><td>是</td><td>String</td><td>5esa812w1f59s7qs5c7s2c16a89fs14</td><td>商户KEY</td></tr>
  <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>Int</td><td>201801265498161</td><td>商户唯一订单号</td></tr>
  <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>测试商品</td><td>商品的名称</td></tr>
  <tr><td>支付金额</td><td>money</td><td>是</td><td>String</td><td>10.00</td><td>商品的价格</td></tr>
  <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>qqpay=QQ扫码;wxpay=微信红包;alipay=支付宝</td></tr>
  <tr><td>异步通知地址</td><td>notify_url</td><td>是</td><td>String</td><td>http://pay.abcwl.cn/notify_url.php</td><td>通知平台处理业务</td></tr>
  <tr><td>同步通知地址</td><td>return_url</td><td>是</td><td>String</td><td>http://pay.abcwl.cn/return_url.php</td><td>支付成功跳转返回的地址</td></tr>
  <tr><td>站点名称</td><td>sitename</td><td>否</td><td>String</td><td>零度即时到帐支付测试平台</td><td>扫码界面显示的名称</td></tr>
  <tr><td>MD5签名</td><td>sign</td><td>是</td><td>String</td><td>b0a107a9152939f6635099b081e6aa3a</td><td>签名方式和支付宝一致</td></tr>
  </td></tr>
  </tbody>
</table>
<p>返回结果：</p>
<table class="table table-bordered table-hover">
  <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
  <tbody>
  <tr><td>返回支付页面</td><td>返回支付页面</td><td>html</td><td>返回支付页面</td><td>返回支付页面</td></tr>
  </tbody>
</table>

<hr/>
<h2 id="sdk0">SDK下载</h2>
<blockquote>
<a href="Ypay_SDK.zip" style="color:blue">Ypay_SDK.zip</a><br/>
SDK版本：V1.0
</blockquote>
          </section>
      </article>
    </div>
  </div>
</div>
<div class="address">
<footer>
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-8 col-lg-9">
<ul class="porduct">
<h4>合作伙伴</h4>
<li><a href="/">零度科技</a></li>
<li><a href="/">零度支付科技</a></li>
</ul>
<ul class="price">
<h4>关于我们</h4>
<li>零度云支付是零度网络商务科技有限公司旗下的免签约支付辅助产品</li>
</ul>
<ul class="about"style="width: 40%;padding-left: 22px;">
<h4>联系我们</h4>
<li><strong>QQ:</strong><a target="_blank"href="https://wpa.qq.com/msgrd?v=3&amp;uin=272341207&amp;site=qq&amp;menu=yes">272341207</a></li>
<li><strong>Email:</strong><a name="baidusnap4"></a><a href="mailto:272341207@qq.com">272341207@qq.com</a></li>
</ul>
</div>

</div>
<div class="xinxi">
<p>Copyright (c) 2016 零度云支付  | Powered by <a href="/">pay.qqmzz.cn</a></p>
</div>
<script type="text/javascript">
        if('ontouchend' in document.body &amp;&amp; $(window).width() < 996){
          $('.col-xs-12 .h2').css('text-align','center');
        }
      </script>
</div>
</footer>
</div>
</div>
</body>
</html> 