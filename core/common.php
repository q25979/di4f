<?php
@header('Content-Type: text/html; charset=UTF-8');
//error_reporting(E_ALL); ini_set("display_errors", 1);
//error_reporting(0);
session_start();
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('SYS_KEY', 'pay_key');
date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

if(is_file(SYSTEM_ROOT.'360safe/360webscan.php')){ // 360网站卫士
   require_once(SYSTEM_ROOT.'360safe/360webscan.php');
}
/*数据库配置*/
$dbconfig = array(
	'host' => 'localhost', //数据库服务器
	'port' => 3306, //数据库端口
	'user' => 'root', //数据库用户名
	'pwd'  => 'root', //数据库密码
	'dbname' => 'di4f',//数据库名
);

include_once(SYSTEM_ROOT."function.php");
$runtime= new runtime;   
$runtime->start();
require_once(SYSTEM_ROOT."alipay/alipay_core.function.php");
require_once(SYSTEM_ROOT."alipay/alipay_md5.function.php");
include_once(SYSTEM_ROOT."Instant_Api.php");
try {
    $DB = new PDO("mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};port={$dbconfig['port']}",$dbconfig['user'],$dbconfig['pwd']);
}catch(Exception $e){
    exit('链接数据库失败:'.$e->getMessage());
}
$DB->exec("set names utf8");

$conf=$DB->query("SELECT * FROM pay_site WHERE domain='{$_SERVER['HTTP_HOST']}' limit 1")->fetch();
if($conf){
if($date > $conf['endtime']){
sysmsg('<h2>该分站已到期，请联系主站管理员续期...<br/>',true);
}
}else{
$conf=$DB->query("SELECT * FROM pay_site WHERE zid='1' limit 1")->fetch();
}

$conf=array(
	'local_domain' => 'p.abcwl.cn', //异步回调地址
	'sitename' => $conf['sitename'], //网站标题
	'keywords' => $conf['keywords'], //关键词
	'description' => $conf['description'],//关键词
	
	
	'zid' => $conf['zid'], //平台ZID
	'admin_user' => $conf['admin_user'], //管理员用户名
	'admin_pwd' => $conf['admin_pwd'], //管理员密码
		
	'name' => $conf['name'] ,//客服名称
	'qq' => $conf['qq'] ,//客服QQ号 (包过QQ邮箱)
	'qqun' => $conf['qqun'] ,//QQ售后交流群
	'wx' => $conf['wx'] ,//客服微信号
	
	
	'modal' => $conf['modal'],//弹窗公告
	
	
	'alipay_money' => 10,//支付宝代收款包月价格
	'wxpay_money' => 10,//微信代收款包月价格
	'qqpay_money' => 10,//QQ钱包代收款包月价格
	'money_rate' => 95, //代收款分润比例（百分数）
	
	
	'mail_cloud' => 0, //0为使用SMTP发信，1为使用sendcloud
	'mail_smtp' => 'smtp.qq.com', //SMTP地址
	'mail_port' => 465, //SMTP端口
	'mail_name' => 'QQ群392351553 ', //邮箱账号
	'mail_pwd' => 'vidqryjxdjxucifj', //邮箱密码（授权码）
	'mail_apiuser' => 'qqlpay_test_Be10G1', //sendcloud API_USER
	'mail_apikey' => 'QhX7hO6EvX3tr9wf', //sendcloud API_KEY
	
	'appkey_appkey' => '2230ec0ec1bc7b4a', //极速二维码解码接口秘钥   地址:www.jisuapi.com 账号18077130418 密码qinjireno  解码调用函数qrcode('图片地址')
	
	'url' => 'http://api.k780.com/', //二维码生成 申请地址https://www.nowapi.com/   账号密码都是qinjireno
	'appkey' => '31067', //查询接口KEY
	'sign' => 'bfb903be4f90d838fbcb9631fa042318', //查询接口sign
	
	'Instant_url' => 'http://www.qqmzz.cn/', //官方服务器地址,此地址不要改
	'gongg' => '备用!'
);
//-------------------------------------------------------------------------------------------------
if(!$conf['local_domain'])$conf['local_domain']=$_SERVER['HTTP_HOST'];
$password_hash='Zero即时到账';
if(isset($_COOKIE["admin_token"]))
{
	$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	$session_1=md5($conf['admin_user_1'].$conf['admin_pwd_1'].$password_hash);
	if($session==$sid or $session_1==$sid) {
		$islogin=1;
	}
}

if(count($_GET)){
$queryArr=$_GET;
}else{
$queryArr=$_POST;
}
if($queryArr['act']&&$queryArr['pid']&&$queryArr['key']){
$Query_pid=daddslashes($queryArr['pid']);
$Query_key=daddslashes($queryArr['key']);
}else{
$Query_pid=$_SESSION['Query_pid'];
$Query_key=$_SESSION['Query_key'];
}

$Instant_Api=new Instant_Api($conf['Instant_url'],$Query_pid,$Query_key);
?>