<?php
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
	if((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP")))
		return true;
	else
		return false;
}
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false){
	echo '<!DOCTYPE html>
<html>
 <head>
  <title>请使用浏览器打开</title>
  <script src="https://open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
  <script type="text/javascript"> mqq.ui.openUrl({ target: 2,url: "'.$siteurl.'"}); </script>
 </head>
 <body></body>
</html>';
exit;
}
if(checkmobile()==true){
require 'wap.php';
}else{
require 'pc.php';
}
?>
