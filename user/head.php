<?php
@header('Content-Type: text/html; charset=UTF-8');
include("../core/common.php");
if(!isset($_COOKIE["user_token"]) or !$_SESSION['Query_pid'] or !$_SESSION['Query_key']){

	echo'<script>alert("请先登录!");location.href="./login.php"</script>';

}

$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$Query_pid}' limit 1")->fetch();
$Query=json_decode(base64_decode($userrow['_Query']),true);
$Orders=json_decode(base64_decode($userrow['_Orders']),true);
/*if($Query['active']==0&&$Query){
	sysmsg('由于你的商户违反相关法律法规与《'.$conf['sitename'].'用户协议》，已被禁用！');
}*/
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8" />
  <title><?php echo $title?> | <?php echo $conf['sitename']?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.css.net/libs/animate.css/3.5.1/animate.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.css.net/libs/font-awesome/4.5.0/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.css.net/libs/simple-line-icons/2.2.4/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/font.css" type="text/css" />
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/app.css" type="text/css" />
  <link rel="stylesheet" href="https://admin.down.swap.wang/assets/plugins/toastr/toastr.min.css" type="text/css" />
  <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico"/>
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="app app-header-fixed  ">
  <!-- header -->
  <header id="header" class="app-header navbar" role="menu">
          <!-- navbar header -->
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="/" class="navbar-brand text-lt">
          <i class="fa fa-btc"></i>
          <img src="https://template.down.swap.wang/ui/angulr_2.0.1/html/img/logo.png" alt="." class="hide">
          <span class="hidden-folded m-l-xs">即时到账Pay</span>
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
        </div>
        <!-- / buttons -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $Query['qq']?>&amp;spec=100" alt="Avatar" width="60" height="60" class="img-circle ">
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md" style="text-transform:uppercase;"><?php echo $Query_pid?></span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li>
                <a href="index.php">
                  <span>用户中心</span>
                </a>
              </li>
              <li>
                <a href="userinfo.php?mod=user">
                  <span>修改资料</span>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a ui-sref="access.signin" href="login.php?logout">退出登录</a>
              </li>
            </ul>
            <!-- / dropdown -->
          </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!--/ navbar collapse -->
  </header>
  <!-- / header -->
  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>导航</span>
              </li>
              <li>
                <a href="./">
                  <i class="glyphicon glyphicon-home icon text-primary-dker"></i>
				  <b class="label bg-info pull-right">N</b>
                  <span class="font-bold">用户中心</span>
                </a>
              </li>
              <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-leaf icon text-success-lter"></i>
                  <span>账户安全</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>账户安全</span>
                    </a>
                  </li>
				  <li>
                    <a href="userinfo.php?mod=user" onclick="activeselect(this)">
                      <span>修改资料</span>
                    </a>
                  </li> 
				  <li>
                    <a href="userinfo.php?mod=pay" onclick="activeselect(this)">
                      <span>支付设置</span>
                    </a>
                  </li> 
                  <!--li>
                    <a href="verification.php" onclick="alert('暂未开放');return false;">
                      <span>验证信息</span>
                    </a>
                  </li!-->
                </ul>
              </li>
              <li class="line dk"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>服务</span>
              </li>
			  <li>
                <a href="order.php" onclick="activeselect(this)">
                  <i class="glyphicon glyphicon-list-alt"></i>
                  <span>订单记录</span>
                </a>
              </li>
			  <li>
                <a href="qrlist.php" onclick="activeselect(this)">
                  <i class="glyphicon glyphicon-qrcode"></i>
                  <span>二维码列表</span>
                </a>
              </li>
			  <!--li>
                <a href="apply.php">
                  <i class="glyphicon glyphicon-check"></i>
                  <span>申请提现</span>
                </a>
              </li!-->
			  
			  <li class="line dk hidden-folded"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>下载</span>
              </li>
			  <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="fa fa-bolt"></i>
                  <span>软件下载</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>软件下载</span>
                    </a>
                  </li>
				  <li>
                    <a href="SDK/zeropay.zip" onclick="activeselect(this)">
                      <span>即时到账辅助软件_免费版</span>
                    </a>
                  </li> 
				  <li>
                    <a href="SDK/zeropay_vip.zip" onclick="activeselect(this)">
                      <span>即时到账辅助软件_会员版</span>
                    </a>
                  </li> 
				  <li>
                    <a href="SDK/zeropay_svip.zip" onclick="activeselect(this)">
                      <span>即时到账辅助软件_超级版</span>
                    </a>
                  </li> 
                  <!--li>
                    <a href="" onclick="alert('暂未开放');return false;">
                      <span>验证信息</span>
                    </a>
                  </li!-->
                </ul>
              </li>
               <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-cloud-download"></i>
                  <span>插件下载</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span>插件下载</span>
                    </a>
                  </li>
				  <li>
                    <a href="SDK/Ypay_SDK.zip" onclick="activeselect(this)">
                      <span>PHP_集成通用</span>
                    </a>
                  </li> 
				  <li>
                    <a href="SDK/whmcs_SDK.zip" onclick="activeselect(this)">
                      <span>WHMCS_主机销售</span>
                    </a>
                  </li> 
				  <li>
                    <a href="SDK/vhms_SDK.zip" onclick="activeselect(this)">
                      <span>VHMS_主机销售</span>
                    </a>
                  </li> 
				  <li>
                    <a href="SDK/swap_SDK.zip" onclick="activeselect(this)">
                      <span>SWAP_主机销售</span>
                    </a>
                  </li> 
            </ul>
			  </li>
               <li>
              <li class="line dk hidden-folded"></li>
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>帮助</span>
              </li>
              <li>
                <a href="help.php">
                  <i class="glyphicon glyphicon-info-sign"></i>
                  <span>使用说明</span>
                </a>
              </li>
              <li>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']?>&site=qq&menu=yes" target="blank">
                  <i class="fa fa-qq"></i>
                  <span>联系客服</span>
                </a>
              </li>
                </ul>
              <!--li>
              <a href="" target="blank">
                  <i class="fa fa-bolt"></i>
                  <span>零度云</span> 
                  </a>
              </li-->
            </ul>
          </nav>
          <!-- nav -->

          <!-- aside footer -->
          <div class="wrapper m-t">
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded"><?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>%</span>
              <span class="hidden-folded">Milestone</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-info" style="width: <?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>%;">
              </div>
            </div>
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded"><?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>%</span>
              <span class="hidden-folded"><h6>&copy; 2017-2018 Copyright.</h6></span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-primary" style="width: <?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>%;">
              </div>
            </div>
          </div>
          <!-- / aside footer -->
        </div>
      </div>
  </aside>
  <!-- / aside -->
  <!-- content -->
<script>
	var Api_Cron_url = 'Api_Cron.php';
	 Api_Notiry = window.setInterval(function () {//实时获取商户数据
		$.post(Api_Cron_url,'',function(json){
				// alert(json);
			},"html");
			
	/*var Wx_Cron_url = '/submit/wx_cron.php';
	Wx_Notiry = window.setInterval(function () {//微信监控
		$.post(Wx_Cron_url,'',function(json){
				// alert(json);
			},"html");*/
			
	}, 5000); //继续查询
</script>
<!--link href="/assets/css/pjax.css" rel="stylesheet" /-->
    <!-- / menu >
	<div id="content" class="app-content" role="main"-->
	<div id="Loading" style="display:none">
		<!-- div ui-butterbar="" class="butterbar active"><span class="bar"></span></div>
	</div>
<div class="app-content-body"-->	<section id="container">

        </div>