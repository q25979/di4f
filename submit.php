<?php
require './core/common.php';
@header('Content-Type: text/html; charset=UTF-8');
if(isset($_GET['pid'])){
	$queryArr=$_GET;
}else{
	$queryArr=$_POST;
}
?>
<script src="/assets/zeropay/assets/js/jquery.js"></script>
<script src="/assets/js/layer/layer.js"></script>
<script>
				layer.msg('正在与终端通讯中...,请稍等...', {icon: 16,shade: 0.01,time: 5000});
	$.post('user/Api_Cron.php?pid=<?=$queryArr['pid']?>','',function(json){
				layer.msg('数据提交完毕,正在跳转...', {icon: 16,shade: 0.01,time: 5000});
			},"html");
	 /*Api_Notiry = window.setInterval(function () {//实时获取商户数据
		$.post(Api_Cron_url,'',function(json){
				//alert(json);
			},"html");一 淘 模 板
	}, 800); //继续查询*/
</script>
<?php
//sleep(2);//延迟1秒执行后面的程序
$pid = intval($queryArr['pid']);
if(empty($pid))sysmsg('PID不存在');
//$row = $Instant_Api->Find($pid);//获取商户信息
$row=json_decode(base64_decode($DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch()['_Query']),true);//获取商户信息
$key = $row['key'];//获取商户KEY
$prestr=createLinkstring(argSort(paraFilter($queryArr)));
if(!md5Verify($prestr, $queryArr['sign'], $key))sysmsg($key.'签名校验失败，请返回平台登录10秒钟左右重试,再不行请检查你的id和key是否正确！');
if($row['active']==0)sysmsg('商户已被禁封！');
?>
<?php
$pid			= daddslashes($queryArr['pid']);
$out_trade_no	= daddslashes($queryArr['out_trade_no']);
$name			= daddslashes(trimall($queryArr['name']));
$money			= daddslashes($queryArr['money']);
$type 			= daddslashes($queryArr['type']);
$notify_url		= daddslashes($queryArr['notify_url']);
$return_url		= daddslashes($queryArr['return_url']);
$sitename		= daddslashes($_GET['sitename']);

if(empty($out_trade_no))sysmsg('订单号(out_trade_no)不能为空');
if(empty($name))sysmsg('商品名称(name)不能为空');
if(empty($money))sysmsg('金额(money)不能为空');
if(empty($notify_url))sysmsg('通知地址(notify_url)不能为空');
if(empty($return_url))sysmsg('回调地址(return_url)不能为空');
if($money<=0)sysmsg('金额不合法');
if($row['paymb']<$money)sysmsg('商户的交易额度不足以发起此金额的支付，请联系商家充值');

//*******************************以下参数勿动***********************
	$trade_no=date("YmdHis").rand(11111,99999);
	$array=array('pid'=>$pid,'trade_no'=>$trade_no,'out_trade_no'=>$out_trade_no,'type'=>$type,'name'=>$name,'money'=>$money,'trade_status'=>'TRADE_SUCCESS');
	$sign   = md5Sign(createLinkstring(argSort(paraFilter($array))),$key);

	if(!$DB->exec("insert into `pay_order` (`trade_no`,`out_trade_no`,`notify_url`,`return_url`,`type`,`pid`,`key`,`qq`,`name`,`money`,`outtime`,`sign`) values ('".$trade_no."','".$out_trade_no."','".$notify_url."','".$return_url."','".$type."','".$pid."','".$key."','".$row['qq']."','".$name."','".$money."','".$row['outtime']."','".$sign."')"))exit('创建订单失败，请返回重试！');

$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
if($type=='wxpay'){
	if($userrow['wxpay_date']>$date && $userrow['is_wxpay']){
		//if(empty($row['qq']))sysmsg('商家未绑定收款QQ号，无法发起支付，请试试其他支付方式');
		if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');
		//exit("<script>window.location.href='./submit/epayapi.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
		exit("<script>window.location.href='./submit/wxpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}else{
		if(strpos($row['login'],$type)==false)sysmsg('商家此支付方式未挂软件，无法发起支付，请试试其他支付方式');
		exit("<script>window.location.href='./submit/pay.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}
}elseif($type=='qqpay'){
	if($userrow['qqpay_date']>$date && $userrow['is_qqpay']){
		//if(empty($row['qq']))sysmsg('商家未绑定收款QQ号，无法发起支付，请试试其他支付方式');
		if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');
		exit("<script>window.location.href='./submit/qqpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}else{
		if(strpos($row['login'],$type)==false)sysmsg('商家此支付方式未挂软件，无法发起支付，请试试其他支付方式');
		exit("<script>window.location.href='./submit/pay.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}
}elseif($type=='alipay'){
	if($userrow['alipay_date']>$date && $userrow['is_alipay']){
		if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');
		exit("<script>window.location.href='./submit/alipay_payapi.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}else{
		if(strpos($row['login'],$type)==false)sysmsg('商家此支付方式未挂软件，无法发起支付，请试试其他支付方式');
		exit("<script>window.location.href='./submit/pay.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
	}
}else{
	exit("<script>window.location.href='./submit/default.php?trade_no={$trade_no}&sitename={$sitename}';</script>");
}
?>

