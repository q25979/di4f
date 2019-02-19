<?php
include("../core/common.php");

		$keysArr = array(
				"pid" => $_GET['pid'],
				"trade_no" => $_GET['trade_no'],
				"out_trade_no" => $_GET['out_trade_no'],
				"type" => $_GET['type'],
				"name" =>$_GET['name'],
				"money" =>$_GET['money'],
				"sign" =>$_GET['sign'],
				"sign_type" =>$_GET['sign_type']?$_GET['sign_type']:'MD5',
				"trade_status" =>$_GET['trade_status']
			);	
	echo get_curl($_GET['notify_url'].'?'.http_build_query($keysArr),http_build_query($keysArr));
//*******************************以上参数勿动***********************
//异步转接通知文件
?>

