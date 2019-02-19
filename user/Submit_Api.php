<?php
require '../core/common.php';
@header('Content-Type: text/html; charset=UTF-8');
$trade_no=$_GET['trade_no']?daddslashes($_GET['trade_no']):daddslashes($_POST['trade_no']);
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
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
$outtime		= daddslashes($srow['outtime']);
$pay_id			= getpay_id();
exit(json_encode($Instant_Api->Submit($pid,$key,$pay_id,$outtime,$trade_no,$out_trade_no,$notify_url,$type,$name,$money,$sign)));
?>
