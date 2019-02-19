<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once('../core/common.php');
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."alipay/alipay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	//商户订单号
	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号
	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];

	//买家支付宝
	$buyer_email = $_POST['buyer_email'];


	$out_trade_no = daddslashes($_POST['out_trade_no']);
	$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
    if($_POST['trade_status'] == 'TRADE_FINISHED') {
		//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS'&&$srow['status']==0) {
		//付款完成后，支付宝系统发送该交易状态通知
		$DB->query("update `pay_order` set `status` ='1' where `trade_no`='$out_trade_no'");
		
	$type='alipay';
	if($srow['money']>=0.1){
	$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
	$id=$out_trade_no;
	$alipay_uid=$userrow['alipay_uid'];
	$qq=$srow['qq'];
	$money=round($srow['money']*$conf['money_rate']/100,2);
	$Profit=$srow['money']-$money;
	$bz='Alipay结算_零度Pay';
	$DB->exec("INSERT INTO `pay_settle` (`id`, `alipay_uid`, `qq`, `money`, `Profit`, `bz`, `type`, `addtime`) VALUES ('{$id}', '{$alipay_uid}', '{$qq}', '{$money}', '{$Profit}', '{$bz}', '{$type}', '{$date}')");
	$settle=$DB->query("SELECT * FROM pay_settle WHERE id='{$id}' limit 1")->fetch();
	transferToAlipay($settle['id'], $settle['alipay_uid'], $settle['money']);
	}
		
		$Instant_Api->Submit_submit($type,$srow['moneyy'],$srow['pid'],$srow['key']);
		/*$url=creat_callback($srow);
		get_curl($url['notify']);*/
    }

	echo "success";
}
else {
    //验证失败
    echo "fail";
}
?>