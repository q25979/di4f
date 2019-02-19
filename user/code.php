<?php
include("../core/common.php");
$qq=$_POST["qq"]?$_POST["qq"]:$_GET["qq"];
$email=$qq.'@qq.com';
$sub = $conf['sitename'].' - 验证码获取';
$code=mt_rand(100000,999999);//6位随机验证码
$msg = '您的验证码是：'.$code;
$_SESSION["code"]=$code;//赋予值
$isqq=$DB->query("SELECT * FROM pay_user WHERE qq_eamil='{$qq}' limit 1")->fetch();
if($_GET["act"]=='reg'&&!$isqq){
	$result = send_mail($email, $sub, $msg);
	if($result==true&&$_SESSION["code"]){
		echo "1";
	}else{
		echo "0";
	}
}elseif($_GET["act"]!='reg'){
	$result = send_mail($email, $sub, $msg);
	if($result==true&&$_SESSION["code"]){
		echo "1";
	}else{
		echo "0";
	}	
}else{
	echo "0";	
}
?>