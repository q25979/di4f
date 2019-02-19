<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在为您跳转到支付页面，请稍候...</title>
    <style type="text/css">
        body {margin:0;padding:0;}
        p {position:absolute;
            left:50%;top:50%;
            width:330px;height:30px;
            margin:-35px 0 0 -160px;
            padding:20px;font:bold 14px/30px "宋体", Arial;
            background:#f9fafc url(../images/loading.gif) no-repeat 20px 26px;
            text-indent:22px;border:1px solid #c5d0dc;}
        #waiting {font-family:Arial;}
    </style>
<script>
function open_without_referrer(link){
document.body.appendChild(document.createElement('iframe')).src='javascript:"<script>top.location.replace(\''+link+'\')<\/script>"';
}
</script>
</head>
<body>
<?php
require '../core/common.php';

@header('Content-Type: text/html; charset=UTF-8');

function strexists($string, $find) {
	return !(strpos($string, $find) === FALSE);
}

function dstrpos($string, $arr) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			return true;
		}
	}
	return false;
}

function checkmobile() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ualist = array('android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone');
	if((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP") || strexists($_SERVER['HTTP_VIA'],"wap")))
		return true;
	else
		return false;
}


$trade_no=daddslashes($_GET['trade_no']);
$DB->query("update `pay_order` set `type` ='alipay' where `trade_no`='$trade_no'");
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$srow)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
//if(empty($row['qq']))sysmsg('商家未绑定收款QQ号，无法发起支付，请试试其他支付方式');
if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');
if($userrow['alipay_date']<$date)sysmsg('未开通此支付方式的包月业务，请试试其他支付方式');

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

require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."alipay/alipay_submit.class.php");

//构造要请求的参数数组，无需改动
if(checkmobile()==true){
	$alipay_service = "alipay.wap.create.direct.pay.by.user";
}else{
	$alipay_service = "create_direct_pay_by_user";
}
//$name = 'onlinepay-'.time();
$parameter = array(
	"service" => $alipay_service,
	"partner" => trim($alipay_config['partner']), //合作身份者id
	"seller_id" => trim($alipay_config['partner']), //收款支付宝用户号
	"payment_type"	=> "1", //支付方式
	"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/alipay_notify.php', //服务器异步通知页面路径
	"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/alipay_return.php', //页面跳转同步通知页面路径
	"out_trade_no"	=> $trade_no, //商户订单号
	"subject"	=> '请在'.$outtime.'秒内付款-->'.$srow['name'], //订单名称
	"total_fee"	=> $srow['money'], //付款金额
	"_input_charset"	=> strtolower('utf-8')
);
if(checkmobile()==true){
	$parameter['app_pay'] = "Y";
}

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "正在跳转");
echo $html_text;
?>
<p>正在为您跳转到支付页面，请稍候...</p>
</body>
</html>