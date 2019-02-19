<?php
include("../core/common.php");
$title=$config['name'];
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$count=$DB->query("SELECT * from pay_user")->rowCount();
$count1=$DB->query("SELECT * from pay_settle")->rowCount();
$rs=$DB->query("SELECT * from pay_settle");
$count2=0;
while($row = $rs->fetch())
{
	$count2+=$row['money'];
}
$rs=$DB->query("SELECT * from pay_settle WHERE status='1'");
$count3=0;
while($row = $rs->fetch())
{
	$count3+=$row['money'];
}
$rs=$DB->query("SELECT * from pay_settle WHERE status!='1' or nums>=3");
$count4=0;
while($row = $rs->fetch())
{
	$count4+=$row['money'];
}


$alipay = $DB->query("SELECT * from pay_settle WHERE type='alipay'");
$jalipay=0;
$zalipay=0;
while($row = $alipay->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jalipay+=$row['money'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zalipay+=$row['money'];
	}
}

$alipay = $DB->query("SELECT * from pay_settle WHERE type='alipay'");
$jalipay=0;
$zalipay=0;
while($row = $alipay->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jalipay+=$row['money'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zalipay+=$row['money'];
	}
}

$wxpay = $DB->query("SELECT * from pay_settle WHERE type='wxpay'");
$jwxpay=0;
$zwxpay=0;
while($row = $wxpay->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jwxpay+=$row['money'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zwxpay+=$row['money'];
	}
}

$qqpay = $DB->query("SELECT * from pay_settle WHERE type='qqpay'");
$jqqpay=0;
$zqqpay=0;
while($row = $qqpay->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jqqpay+=$row['money'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zqqpay+=$row['money'];
	}
}

$all = $DB->query("SELECT * from pay_settle");
$jall=0;
$zall=0;
while($row = $all->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jall+=$row['money'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zall+=$row['money'];
	}
}

$all = $DB->query("SELECT * from pay_settle");
$jlr=0;
$zlr=0;
while($row = $all->fetch())
{	
	if($row['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
	$jlr+=$row['Profit'];
	}
	if(date("Y-m-d 00:00:00")>=$row['addtime']&&$row['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
	$zlr+=$row['Profit'];
	}
}
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">后台管理首页</h3></div>
          <ul class="list-group">
		  <?php if($conf['zid']==1){?>
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>前端登录商户：</b><?php echo $count?>个</li>
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>包月代收款结算记录：</b><?php echo $count1?>个</li>
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>包月代收款结算总额：</b><?php echo $count2?>元</li>
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>包月代收款已结余额：</b><?php echo $count3?>元</li>
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>包月代收款未结余额：</b><?php echo $count4?>元</li>
		  <?php }else{ $user=$DB->query("SELECT * FROM pay_site WHERE zid='{$conf['zid']}' limit 1")->fetch();?>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>站点名称：</b><?php echo $user['sitename']?></li>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>管理员名称：</b><?php echo $user['name']?></li>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>管理员QQ号：</b><?php echo $user['qq']?></li>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>管理员WX号：</b><?php echo $user['wx']?></li>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>站点创建时间：</b><?php echo $user['addtime']?></li>
		  <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>站点到期时间：</b><?php echo $user['endtime']?></li>
		  <?php }?>
          </ul>
      </div>
	  <div class="panel panel-success">
          <table class="table table-bordered table-striped">
		  <?php if($conf['zid']==1){?>
		    <thead><tr><th class="success">代收款统计</th><th>支付宝</th><th>微信支付</th><th>QQ钱包</th><th>总计</th><th>平台利润</th></thead>
            <tbody>
			  <tr><td>今日收入</td><td><?php echo round($jalipay,2)?></td><td><?php echo round($jwxpay,2)?></td><td><?php echo round($jqqpay,2)?></td><td><?php echo round($jall,2)?></td><td><?php echo round($jlr,2)?></td></tr>
			  
			  <tr><td>昨日收入</td><td><?php echo round($zalipay,2)?></td><td><?php echo round($zwxpay,2)?></td><td><?php echo round($zqqpay,2)?></td><td><?php echo round($zall,2)?></td><td><?php echo round($zlr,2)?></td></tr>
			</tbody>
          </table>
		  <?php }?>
      </div>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">服务器信息</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php $MySQL = $DB->query("select VERSION()")->fetch(); echo $MySQL[0] ?>
		</li>
		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize'); ?>
		</li>
	</ul>
</div>
    </div>
  </div>