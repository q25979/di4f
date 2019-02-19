<?php
require './core/common.php';
if($queryArr['act']=='update'){ //零支付即时到账软件更新检测-一 淘 模 板------------------------------------------------------------------------------


$edition='1.7';//普通版版本号一 淘 模 板
$notice="欢迎使用零度即时到帐支付，财付通.微信即时到账辅助工具，使用期间有何问题可以联系";//普通版公告
$updatecontent="
V".$edition."
1.提高了稳定性能，优化各个方面
2.修复了财付通无法登陆以及监控稳定
3.优化了软件卡死问题
4.修复了邮件提醒
";//普通版更新内容
$appurl=$siteurl."user/SDK/zeropay.zip";//普通版软件更新下载地址
$app=array('edition'=>$edition,'notice'=>$notice,'updatecontent'=>$updatecontent,'appurl'=>$appurl);



$paymb='1000';//商户低于多少额度不能使用会员版本的软件
$edition='1.0';//会员版版本号
$notice="欢迎使用零度即时到帐支付，财付通.微信即时到账辅助工具，使用期间有何问题可以联系";//会员版公告
$updatecontent="
V".$edition."
1.修复软件推送提示信息错误
2.优化漏单现象
";//会员版更新内容
$appurl=$siteurl."user/SDK/zeropay_vip.zip";//会员版软件更新下载地址
$app_vip=array('paymb'=>$paymb,'edition'=>$edition,'notice'=>$notice,'updatecontent'=>$updatecontent,'appurl'=>$appurl);


$paymb='3000';//商户低于多少额度不能使用会员版本的软件
$edition='1.0';//超级版版本号
$notice="欢迎使用零度即时到帐支付，财付通.微信即时到账辅助工具，使用期间有何问题可以联系";//超级版公告
$updatecontent="
V".$edition."
1.修复软件推送提示信息错误
2.优化漏单现象
";//超级版更新内容
$appurl=$siteurl."user/SDK/zeropay_svip.zip";//超级版软件更新下载地址
$app_svip=array('paymb'=>$paymb,'edition'=>$edition,'notice'=>$notice,'updatecontent'=>$updatecontent,'appurl'=>$appurl);



$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$queryArr['pid']}' limit 1")->fetch();//获取商户的信息
$soft_name=$userrow['soft_name'];//商户自定义的软件名称
$wxurl="https://share.weiyun.com/5OTC8f7";//微信下载地址
$qqpaytime=time()-(15);
$qqpaytime=date("Y-m-d H:i:s",$qqpaytime);//财付通账单获取时间,不必修改
$alipaytime=time()-(75);
$alipaytime=date("Y-m-dH:i:s",$alipaytime);//支付宝账单获取时间,不必修改
$result=array('code'=>1,'soft_name'=>$soft_name,'wxurl'=>$wxurl,'qqpaytime'=>$qqpaytime,'alipaytime'=>$alipaytime,'app'=>$app,'app_vip'=>$app_vip,'app_svip'=>$app_svip);


}elseif($queryArr['act']=='query'){//获取商户信息-------------------------------------------------------------------------------------------
	$row=$DB->query("SELECT * FROM pay_user WHERE pid='{$_GET['pid']}' limit 1")->fetch();
	if($row['alipay_date']>$date && $row['is_alipay']){
		$alipay=$row['alipay_uid']?true:false;
	}else{
		$alipay=$_GET['alipay']?true:false;
	}
	if($row['wxpay_date']>$date && $row['is_wxpay']){
		$wxpay=$row['is_wxpay']?true:false;
	}else{
		$wxpay=$_GET['wxpay']?true:false;
	}
	if($row['qqpay_date']>$date && $row['is_qqpay']){
		$qqpay=$row['alipay_uid']?true:false;
	}else{
		$qqpay=$_GET['qqpay']?true:false;
	}
	
	/*$alipay=$row['alipay_date']>$date && $userrow['is_alipay']?$row['alipay_uid']?'1':'0':$_GET['alipay']?'1':'0';
	$wxpay=$row['wxpay_date']>$date && $userrow['is_wxpay']?'1':$_GET['wxpay']?'1':'0';
	$qqpay=$row['qqpay_date']>$date && $userrow['is_qqpay']?'1':$_GET['qqpay']?'1':'0';*/
	
	if($alipay&&$wxpay&&$qqpay){
		$login='_alipay_wxpay_qqpay_';
	}elseif($alipay&&$wxpay){
		$login='_alipay_wxpay_';
	}elseif($alipay&&$qqpay){
		$login='_alipay_qqpay_';
	}elseif($wxpay&&$qqpay){
		$login='_wxpay_qqpay_';
	}elseif($alipay){
		$login='_alipay_';
	}elseif($wxpay){
		$login='_wxpay_';
	}elseif($qqpay){
		$login='_qqpay_';
	}else{
		$login='';
	}

$result = $Instant_Api->Query(NULL,NULL,NULL,daddslashes($login));
}elseif($queryArr['act']=='qqlogin'){//获取QQ快捷登录信息
$users=$DB->query("SELECT * FROM pay_user WHERE social_uid='{$queryArr['social_uid']}' and access_token='{$queryArr['access_token']}' limit 1")->fetch();
$pid=$users['pid'];
$key=$Instant_Api->Find($pid)['key'];
if($users)
$result=array('code'=>1,'nickname'=>$users['nickname'],'pid'=>$pid,'key'=>$key);
else
$result=array('code'=>-1);
}elseif($queryArr['act']=='monthly'){//获取代收款包月信息-------------------------------------------------------------------------------------------
	$row=$DB->query("SELECT * FROM pay_user WHERE pid='{$_GET['pid']}' limit 1")->fetch();
	$alipay = $row['alipay_date']>$date?'到期时间:'.$row['alipay_date']:'未开通或到期';
	$wxpay = $row['wxpay_date']>$date?'到期时间:'.$row['wxpay_date']:'未开通或到期';
	$qqpay = $row['qqpay_date']>$date?'到期时间:'.$row['qqpay_date']:'未开通或到期';
	
$result=array("code"=>1,"msg"=>"查询代收款包月服务成功!","alipay"=>$alipay,"wxpay"=>$wxpay,"qqpay"=>$qqpay);
}elseif($queryArr['act']=='change'){//修改商户信息------------------------------------------------------------------------------------------
$result = $Instant_Api->Change(daddslashes($queryArr['newkey']),daddslashes($queryArr['qq']),daddslashes($queryArr['outtime']));
}elseif($queryArr['act']=='paymb'){//充值额度------------------------------------------------------------------------------------------
$result = $Instant_Api->Paymb(daddslashes($queryArr['paymb']));
}elseif($queryArr['act']=='order'){//查询订单-----------------------------------------------------------------------------------------------
$result = $Instant_Api->Order(daddslashes($queryArr['out_trade_no']));
}elseif($queryArr['act']=='orders'){//获取订单列表------------------------------------------------------------------------------------------
$result = $Instant_Api->Orders(daddslashes($queryArr['limit']));
}elseif($queryArr['act']=='submit_order'){//获取订单状态------------------------------------------------------------------------------------
$result = $Instant_Api->Submit_order(daddslashes($queryArr['pid']),daddslashes($queryArr['out_trade_no']),daddslashes($queryArr['trade_no']));
}elseif($queryArr['act']=='submit_submit'){//发送通知---------------------------------------------------------------------------------------
$data = $Instant_Api->Submit_submit(daddslashes($queryArr['type']),daddslashes($queryArr['money']));
}elseif($queryArr['act']=='email_api'){//发送邮件---------------------------------------------------------------------------------------
$sub = $conf['sitename'].' - 提醒';
$res = send_mail($queryArr['qq'].'@qq.com', $sub, urldecode($queryArr['msg']));
if($res==true){
$result=array("code"=>1,"msg"=>"邮件发送成功!");
}else{
$result=array("code"=>-1,"msg"=>"邮件发送失败!");
	}
}else{
$result=array("code"=>-11,"msg"=>"NO Act!");
}//-----------------------------------------------------------------------------------------------------------------------------------------

if($result){
exit(json_encode($result));
}else{
exit($data);	
}
