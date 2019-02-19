<?php 
include("../core/common.php");
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']. '/';//获取本地域名
$allapi	 ='http://www.qqmzz.cn/';//QQ快捷登录API地址
require_once("../core/Oauth.class.php");
$Oauth = new Oauth();
header("Content-Type: text/html; charset=UTF-8");
if ($_GET['code']) {
    $array = $Oauth->callback();
    $social_uid	  	=	 $array['social_uid'];//固定值 可作为账号
    $access_token 	=	 $array['access_token'];//固定值 可作为密码
    $gender		  	=	 $array['gender'];//性别
	$nickname	 	=	 $array['nickname'];//QQ名称
    $figureurl_qq_1 =	 $array['figureurl_qq_1'];//大小为40×40像素的QQ头像URL
    $figureurl_qq_2	=	 $array['figureurl_qq_2'];//[大小为100×100像素的QQ头像URL。不是所有的用户都拥有QQ的100×100的头像。]
	$vip	 	 	=	 $array['vip'];//标识用户是否为黄钻用户（0：不是；1：是）
    $level			=	 $array['level'];//黄钻等级
	$is_yellow_year_vip= $array['is_yellow_year_vip'];//标识是否为年费黄钻用户（0：不是； 1：是）
	
	$_SESSION['social_uid'] 	=  $social_uid;//QQ登录返回的uid 固定值
	$_SESSION['access_token'] 	=  $access_token;//QQ登录返回的token  固定值
	$_SESSION['nickname']		=  $nickname;//QQ网名
	$users=$DB->query("SELECT * FROM pay_user WHERE social_uid='{$social_uid}' limit 1")->fetch();
	$pid=$users['pid'];
	$key=$Instant_Api->Find($pid)['key'];
	if($users){
	if(isset($_COOKIE["user_token"]) && $_SESSION['Query_pid'] && $_SESSION['Query_key']){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前QQ已绑定商户ID:{$pid}，请勿重复绑定！');window.location.href='./';</script>");
		}
		$Query = $Instant_Api->Query($pid,$key,1);
		if($Query['code']==1){
			$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
			if(!$userrow){
				$DB->exec("INSERT INTO `pay_user` (`pid`) VALUES ('{$pid}')");
			}else{
				$DB->exec("update `pay_user` set `nickname` ='{$_SESSION['nickname']}' where `pid`='{$pid}'");
			}
		}
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('[{$_SESSION['nickname']}]登录成功,欢迎回来！');window.location.href='./';</script>");
	}elseIf(isset($_COOKIE["user_token"])){
		 $DB->exec("update `pay_user` set `social_uid` ='{$_SESSION['social_uid']}',`access_token` ='{$_SESSION['access_token']}',`nickname` ='{$_SESSION['nickname']}' where `pid`='{$Query_pid}'");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('商户:{$Query_pid}已成功绑定QQ账号:{$_SESSION['nickname']}.！');window.location.href='./';</script>");
	}else{
	exit("<script language='javascript'>alert('请输入商户ID和密钥完成登录');window.location.href='./login.php?connect=true';</script>");
	}
		
	
} elseif(isset($_COOKIE["user_token"]) && $_SESSION['Query_pid'] && $_SESSION['Query_key'] && isset($_GET['unbind'])) {
$DB->exec("update `pay_user` set `social_uid` =NULL,`access_token` =NULL,`nickname` =NULL where `pid`='{$_SESSION['Query_pid']}'");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功解绑QQ账号！');window.location.href='./';</script>");	
	
}elseif(isset($_COOKIE["user_token"]) && $_SESSION['Query_pid'] && $_SESSION['Query_key'] && isset($_GET['unbind'])){
	exit("<script language='javascript'>alert('您未登录,无法解绑！');window.location.href='./';</script>");	
}else{
    $Oauth->login();
	
}