<?php

//---------------------------------------------------------
//财付通即时到帐支付后台回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------
require_once('../core/common.php');
require_once(SYSTEM_ROOT.'qqpay/qpayNotify.class.php');
@header('Content-Type: text/html; charset=UTF-8');

$qpayNotify = new QpayNotify();
$result = $qpayNotify->getParams();
//判断签名
if($qpayNotify->verifySign()) {

//判断签名及结果（即时到帐）
	if($result['trade_state'] == "SUCCESS") {
		//商户订单号
		$out_trade_no = $result['out_trade_no'];
		//QQ钱包订单号
		$transaction_id = $result['transaction_id'];
		//金额,以分为单位
		$total_fee = $result['total_fee'];
		//币种
		$fee_type = $result['fee_type'];

		//------------------------------
		//处理业务开始
		//------------------------------
		$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
		//付款完成后，支付宝系统发送该交易状态通知
		$DB->query("update `pay_order` set `status` ='1' where `trade_no`='{$out_trade_no}'");
		if($srow['status']==0){
			$type='qqpay';
			if($srow['money']>=0.1){
			$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
			$id=$out_trade_no;
			$alipay_uid=$userrow['alipay_uid'];
			$qq=$srow['qq'];
			$money=round($srow['money']*$conf['money_rate']/100,2);
			$Profit=$srow['money']-$money;
			$bz='Qqpay结算_零度Pay';
			$DB->exec("INSERT INTO `pay_settle` (`id`, `alipay_uid`, `qq`, `money`, `Profit`, `bz`, `type`, `addtime`) VALUES ('{$id}', '{$alipay_uid}', '{$qq}', '{$money}', '{$Profit}', '{$bz}', '{$type}', '{$date}')");
			$settle=$DB->query("SELECT * FROM pay_settle WHERE id='{$id}' limit 1")->fetch();
			transferToAlipay($settle['id'], $settle['alipay_uid'], $settle['money']);
		}

		$Instant_Api->Submit_submit($type,$srow['moneyy'],$srow['pid'],$srow['key']);
		/*$url=creat_callback($srow);
		get_curl($url['notify']);*/
		}
		//------------------------------
		//处理业务完毕
		//------------------------------
		echo "<xml>
<return_code>SUCCESS</return_code>
</xml>";
	} else {
		echo "<xml>
<return_code>FAIL</return_code>
</xml>";
	}

} else {
	//回调签名错误
	echo "<xml>
<return_code>FAIL</return_code>
<return_msg>签名失败</return_msg>
</xml>";
} 

?>