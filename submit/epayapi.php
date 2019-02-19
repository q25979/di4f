<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>云支付即时到账交易接口</title>
</head>
<?php
require '../core/common.php';
$sitename=daddslashes($_GET['sitename']);
$trade_no=daddslashes($_GET['trade_no']);
$DB->query("update `pay_order` set `type` ='wxpay' where `trade_no`='$trade_no'");
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$srow)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');
if($userrow['wxpay_date']<$date)sysmsg('未开通此支付方式的包月业务，请试试其他支付方式');

$pid			= daddslashes($srow['pid']);
$key			= daddslashes($srow['key']);
$trade_no		= daddslashes($srow['trade_no']);
$out_trade_no	= daddslashes($srow['out_trade_no']);
$name			= daddslashes($srow['name']);
$money			= daddslashes($srow['money']);
$type 			= daddslashes($srow['type']);
$notify_url		= daddslashes($srow['notify_url']);
$return_url		= daddslashes($srow['return_url']);
$sign			= daddslashes($srow['sign']);
$sitename		= daddslashes($_GET['sitename']);

//*******************************以下参数勿动***********************

//$Find = $Instant_Api->Find($pid);//远程获取商户KEY
//$key  = $Find['key'];//获取商户KEY
//$row  = $Instant_Api->Query($pid,$key);//获取商户信息
$pay_id			= getpay_id();
$outtime		= $srow['outtime'];
//发送订单给服务器记录
$json=$Instant_Api->Submit($pid,$key,$pay_id,$outtime,$trade_no,$out_trade_no,$notify_url,$type,$name,$money,$sign);	
//更新数据库记录实际付款金额
$DB->query("update `pay_order` set `moneyy` ='{$json['money']}' where `trade_no`='$trade_no'");

require_once(SYSTEM_ROOT."epay/epay.config.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
/**************************请求参数**************************/


//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/epay_notify.php', //服务器异步通知页面路径
		"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/epay_return.php', //页面跳转同步通知页面路径
		"out_trade_no"	=> $trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"sitename"	=> $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

?>
</body>
</html>