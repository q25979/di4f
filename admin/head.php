<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?=$conf['sitename']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>"/>
  <meta name="description" content="<?php echo $conf['description']?>"/>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">管理中心|<?php echo $conf['sitename']?></a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="./"><span class="glyphicon glyphicon-home"></span> 平台首页</a>
          </li>
				<?php if($conf['zid']==1){?>
		  <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cloud"></span> 代收款结算实时记录<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./slistlist.php">全部数据</a></li>	
              <li><a href="./slistlist.php?my=search&column=type&value=alipay">支付宝</a></li>		  
			  <li><a href="./slistlist.php?my=search&column=type&value=qqpay">Q Q</a><li>		  
			  <li><a href="./slistlist.php?my=search&column=type&value=wxpay">微信</a><li>
            </ul>
          </li>
				<?php }?>
		 <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> 用户管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./ulist.php">用户列表</a></li>		  
			  <li><a href="./shop.php">充值额度</a><li>	
            </ul>
          </li>
			<?php if($conf['zid']==1){?>
		  <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cloud"></span> 影子系统<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./sitelist.php?my=add">添加影子平台</a></li>		  
			  <li><a href="./sitelist.php">影子平台管理</a><li>	
            </ul>
          </li>
			<?php }?>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <script>
	var Settle_Cron = 'settle_cron.php?act=settle';
	 Settle_Api = window.setInterval(function () {//实时获取商户数据
		$.post(Settle_Cron,'',function(json){
				// alert(json);
			},"html");
			
	/*var Wx_Cron_url = '/submit/wx_cron.php';
	Wx_Notiry = window.setInterval(function () {//微信监控
		$.post(Wx_Cron_url,'',function(json){
				// alert(json);
			},"html");*/
			
	}, 3000); //继续查询
</script>