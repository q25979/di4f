<?php
/* *
 * 功能：彩虹易支付异步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 */
require_once('../core/common.php');//获取核心数据
require_once(SYSTEM_ROOT."epay/epay.config.php");
require_once(SYSTEM_ROOT."epay/epay_notify.class.php");
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//彩虹易支付交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];

	$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
	if($_GET['trade_status'] == 'TRADE_SUCCESS'&&$srow['status']==0) {
		$DB->query("update `pay_order` set `status` ='0' where `trade_no`='$out_trade_no'");
		$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
		$url=creat_callback($srow);
		echo get_curl($url['notify']);
		$type='wxpay';
		if($srow['money']>=0.1){
			$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
			$id=$out_trade_no;
			$alipay_uid=$userrow['alipay_uid'];
			$qq=$srow['qq'];
			$money=round($srow['money']*$conf['money_rate']/100,2);
			$Profit=$srow['money']-$money;
			$bz='Wxpay结算_零度Pay';
			$DB->exec("INSERT INTO `pay_settle` (`id`, `alipay_uid`, `qq`, `money`, `Profit`, `bz`, `type`, `addtime`) VALUES ('{$id}', '{$alipay_uid}', '{$qq}', '{$money}', '{$Profit}', '{$bz}', '{$type}', '{$date}')");
			$settle=$DB->query("SELECT * FROM pay_settle WHERE id='{$out_trade_no}' limit 1")->fetch();
			transferToAlipay($settle['id'], $settle['alipay_uid'], $settle['money']);
		}
		
		$Instant_Api->Submit_submit($type,$srow['moneyy'],$srow['pid'],$srow['key']);
		/*$url=creat_callback($srow);
		get_curl($url['notify']);*/
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
	echo "success";		//请不要修改或删除
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";
}
?>