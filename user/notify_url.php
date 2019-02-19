<?php
/* *
 * 功能：零度即时到账支付支付异步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 */
include("../core/common.php");
require_once("../SDK/epay.config.php");
require_once("SDK/lib/epay_notify.class.php");

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

	//零度云支付2.0交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];
	
	$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
	if($_GET['trade_status'] == 'TRADE_SUCCESS'&&$srow['status']==1) {
		$DB->query("update `pay_order` set `status` ='0' where `trade_no`='$trade_no'");
		$explode = explode('|',$srow['name']);
		$pid=$explode[1];
		$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
		
			if($explode[0]=='充值额度'&&$srow['money']>=10){
				$Instant_Api->Paymb(3000,$explode[1],$explode[2]);
			}elseif($explode[0]=='支付宝代收款'&&$srow['money']>=$conf['alipay_money']){
				$alipay_date = ($userrow['alipay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['alipay_date'])+60*60*24*31));
				$DB->exec("update `pay_user` set `alipay_date` ='{$alipay_date}' where `pid`='{$pid}'");
			}elseif($explode[0]=='微信代收款'&&$srow['money']>=$conf['wxpay_money']){
				$wxpay_date = ($userrow['wxpay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['wxpay_date'])+60*60*24*31));
				$DB->exec("update `pay_user` set `wxpay_date` ='{$wxpay_date}' where `pid`='{$pid}'");
			}elseif($explode[0]=='QQ钱包代收款'&&$srow['money']>=$conf['qqpay_money']){
				$qqpay_date = ($userrow['qqpay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['qqpay_date'])+60*60*24*31));
				$DB->exec("update `pay_user` set `qqpay_date` ='{$qqpay_date}' where `pid`='{$pid}'");
			}
		
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
