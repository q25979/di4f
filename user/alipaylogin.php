<?php
/**
 * 登录
**/
include './head.php';
//exit('内测中');
if(isset($_GET['user_id']) && isset($_GET['token'])){

require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."alipay/alipay_notify.class.php");

$alipay_config['partner'] = '2088221301492260';
$alipay_config['key'] = 'sse5jtujl3uyz2i9p9lca2z1f047vyo7';

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功

	//支付宝用户号
	$user_id = daddslashes($_GET['user_id']);

	$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$Query_pid}' limit 1")->fetch();
	if($userrow['alipay_uid']){
		$DB->query("update `pay_user` set `alipay_uid` ='{$user_id}' where `pid`='$Query_pid'");
		exit("<script language='javascript'>alert('换绑成功！');window.location.href='./';</script>");
	}else{
		$DB->query("update `pay_user` set `alipay_uid` ='{$user_id}' where `pid`='$Query_pid'");
		exit("<script language='javascript'>alert('绑定成功！');window.location.href='./';</script>");
	}
}
else {
    //验证失败
    exit("<script language='javascript'>alert('验证失败');window.location.href='../';</script>");
}

}
?>
<?php
include './head.php';
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."alipay/alipay_submit.class.php");

$alipay_config['partner'] = '2088221301492260';
$alipay_config['key'] = 'sse5jtujl3uyz2i9p9lca2z1f047vyo7';

/**************************请求参数**************************/

//目标服务地址
$target_service = "user.auth.quick.login";
//必填，页面跳转同步通知页面路径
$return_url = "http://".$_SERVER['HTTP_HOST']."/user/alipaylogin.php";
//需http://格式的完整路径，不允许加?id=123这类自定义参数

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "alipay.auth.authorize",
		"partner" => trim($alipay_config['partner']),
		"target_service"	=> $target_service,
		"return_url"	=> $return_url,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
echo $html_text;

?>
</body>
</html>