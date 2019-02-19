<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>零度即时到账支付</title>
</head>
<?php
/* *
 * 功能：即时到账交易接口接入页
 * 
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */
include("../core/common.php");
$trade_no=daddslashes($_GET['trade_no']);
$type=daddslashes($_GET['type']);
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$srow)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

$key  = $srow['key'];//获取商户KEY

$array=array('pid'=>$srow['pid'],'trade_no'=>$trade_no,'out_trade_no'=>$srow['out_trade_no'],'type'=>'','name'=>$srow['name'],'money'=>$srow['money'],'trade_status'=>'TRADE_SUCCESS');
	$paraer = paraFilter($array);
	$arg    = argSort($paraer);
	$prestr = createLinkstring($arg);
	$urlstr = createLinkstringUrlencode($arg);
	$sign   = md5Sign($prestr,$key);
	$prestr=createLinkstring(argSort(paraFilter($array)));
if(!md5Verify($prestr, $srow['sign'], $key))sysmsg('签名校验失败，请返回重试！');
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//商户ID
$alipay_config['partner']		= $srow['pid'];

//商户KEY
$alipay_config['key']			= $key;

$alipay_config['sign_type']    = strtoupper('MD5');

$alipay_config['input_charset']= strtolower('utf-8');

$alipay_config['transport']    = 'http';

$alipay_config['apiurl']    = 'http://'.$_SERVER['HTTP_HOST'].'/';

require "../user/SDK/lib/epay_submit.class.php";



//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $srow['notify_url'],
		"return_url"	=> $srow['return_url'],
		"out_trade_no"	=> $srow['out_trade_no'],
		"name"	=> $srow['name'],
		"money"	=> $srow['money'],
		"sitename"	=> $_GET['sitename']
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

?>
</body>
</html>
