<?php
require_once("../SDK/epay.config.php");
require '../core/common.php';
@header('Content-Type: text/html; charset=UTF-8');
if($_GET['act']=='notify'){
	$data = $Instant_Api->Submit_order($_GET['pid'],$_GET['out_trade_no'],$_GET['trade_no']);
	//$data = $Instant_Api->Order($_GET['out_trade_no']);
	if($data['code']==1 && $data['status']==1){
	exit('success');
		}ELSE{
	exit('fail');
	}
exit;
}else{

$trade_no=daddslashes($_GET['trade_no']);
$DB->query("update `pay_order` set `type` ='wxpay' where `trade_no`='$trade_no'");
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
if(!$srow)sysmsg('该订单号不存在，请返回来源地重新发起请求！');
//if(empty($row['qq']))sysmsg('商家未绑定收款QQ号，无法发起支付，请试试其他支付方式');
if(empty($userrow['alipay_uid']))sysmsg('商家未绑定收款支付宝，无法发起支付，请试试其他支付方式');

$pid			= daddslashes(trim($alipay_config['partner']));
$key			= daddslashes($alipay_config['key']);
$trade_no		= daddslashes($srow['trade_no']);
$out_trade_no	= daddslashes($srow['out_trade_no']);
$name			= daddslashes($srow['name']);
$money			= daddslashes($srow['money']);
$type 			= daddslashes($srow['type']);
$notify_url		= 'http://'.$conf['local_domain'].'/submit/wxpay_notify.php';
$return_url		= 'http://'.$_SERVER['HTTP_HOST'].'/submit/wxpay_return.php';

$array=array('pid'=>$pid,'trade_no'=>$trade_no,'out_trade_no'=>$out_trade_no,'type'=>$type,'name'=>$name,'money'=>$money,'trade_status'=>'TRADE_SUCCESS');
$sign   = md5Sign(createLinkstring(argSort(paraFilter($array))),$key);

$sitename		= daddslashes($_GET['sitename']);


//*******************************以下参数勿动***********************

//$Find = $Instant_Api->Find($pid);//远程获取商户KEY
//$key  = $Find['key'];//获取商户KEY
//$row  = $Instant_Api->Query($pid,$key);//获取商户信息
$qrcode_url		= 'qrcode.php';
$pay_id			= getpay_id();
$outtime		= $srow['outtime'];
$user_data = array(
	"pay_id" => $pay_id,//用户IP  UID
	"qrcode_url" => $qrcode_url,//付款二维码获取地址
	"return_url" => $return_url,
	"type" =>$type, 
	"outtime" => $outtime
);
if($type=='alipay'){
	$typeName = '支付宝';
}elseif($type =='wxpay'){
	$typeName = '微信';
}elseif($type=='qqpay'){
	$typeName = 'QQ';
}else{
	$typeName = '支付宝';
}
//*******************************以上参数勿动***********************
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $zeropay_config['chart'] ?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $typeName ?>扫码支付 - <?php echo $sitename?$sitename:'零度即时到账支付';?></title>
    <link href="/assets/zeropay/assets/css/wechat_pay.css" rel="stylesheet" media="screen">
	<link rel="icon" type="image/x-icon" href="/assets/zeropay/assets/img/favicon.ico" />
	
<style>
#test1{
color:red;
font-style:italic;
font-weight:bold;
font-size:20px;
line-height:20px;
font-family:'NewTime','新宋体','宋体',sans-serif;
}
.btn-success {
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, rgba(126, 178, 22, 0)), color-stop(100%, rgba(0, 0, 0, 0.1)));
  background-image: -webkit-linear-gradient(rgba(126, 178, 22, 0), rgba(0, 0, 0, 0.1));
  background-image: -moz-linear-gradient(rgba(126, 178, 22, 0), rgba(0, 0, 0, 0.1));
  background-image: -o-linear-gradient(rgba(126, 178, 22, 0), rgba(0, 0, 0, 0.1));
  background-image: linear-gradient(rgba(126, 178, 22, 0), rgba(0, 0, 0, 0.1));
  background-color: green;
  border-color: green green green;
  border-color: rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.6) rgba(0, 0, 0, 0.15);
  color: green;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.15);
  *background-color: green;
}
.btn-success:hover, .btn-success:active, .btn-success.active, .btn-success.disabled, .btn-success[disabled] {
	background-color: green;
  color: green;
  *background-color: green;
}
.btn-success:active, .btn-success.active {
	 background-color: #4e6e0e \15;
}
</style>


</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo $type ?>"></span>
    </h1>
<?php if($userrow['pay_gg']){?>	
<body>
<div class="body">
    <h5 class="mod-title">
        <span><?=$userrow['pay_gg']?></span>
    </h5>
<?php }?>	
    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="price">￥<?php echo $zeropay_json['price'] ?></div>
	<div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img class="shadow" id='show_qrcode' alt="加载中..." src="">
					</div>

                    <img onclick="$('#use').hide()" id="use"
                         src="/assets/zeropay/assets/img/use_<?php echo $type ?>.png"
                         style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -21px;margin-top: -21px">
                </div>
            </div>
			
			<!--div class="alipayApp" style="display: none;">
           <H2>记住应该支付多少金额然后</H2></BR><a href="<//?=strpos(get_curl('http://'.$_SERVER['HTTP_HOST'].'/qrcode/'.$pid.'_'.$type.'_index.txt'),'//')?get_curl('http://'.$_SERVER['HTTP_HOST'].'/qrcode/'.$pid.'_'.$type.'_index.txt'):''?>" id="test1" class="btn btn-success" target="_blank">点此唤起支付宝App支付</a>
			</div>
			
        <div class="wxpayApp" style="display: none;">
        	<a href="<//?=strpos(get_curl('http://'.$_SERVER['HTTP_HOST'].'/qrcode/'.$pid.'_'.$type.'_index.txt'),'//')?get_curl('http://'.$_SERVER['HTTP_HOST'].'/qrcode/'.$pid.'_'.$type.'_index.txt'):''?>" target="_blank" download="" id="test1" class="btn btn-success">1.先保存二维码到手机</a></div></BR>
        <div class="wxpayApp" style="display: none;padding-top: 10px">
        	<a href="weixin://" id="test1" class="btn btn-success">2.打开微信，扫一扫本地图片</a></div>
			
       <div class="ioswxpayApp" style="display: none;">
		<a href="<//?=get_curl('http://'.$_SERVER['HTTP_HOST'].'/qrcode/'.$pid.'_'.$type.'_index.txt')?>" target="_blank" download="" id="test1" class="btn btn-success">1.长按上面的图片然后"保存图片"</div></BR>
        <div class="ioswxpayApp" style="display: none;padding-top: 10px">
        	<a href="weixin://scanqrcode" class="btn btn-success" id="test1">2.打开微信，扫一扫本地图片</a>
			</div-->


    
    
	<div class="time-item" style="padding-top: 10px;color:red">
	<div class="time-item" id="msg"><h1>请在<?=$outtime?>秒内及时付款，失效请勿付款</h1></div>
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用<?php echo $typeName ?>扫一扫</p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>

        <div class="detail" id="orderDetail">
            <dl class="detail-ct" id="desc" style="display: none;">

                <dt>状态</dt>
                <dd id="createTime">订单创建</dd>

            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在<?php echo $typeName ?>扫一扫中选择“相册”即可</p>
        </div>
    </div>

</div>
<div class="copyRight">
    <p>支付合作：<a href="http://pay.abcwl.cn/" target="_blank">零度支付</a></p>
</div>
<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="/assets/zeropay/assets/js/jquery.js"></script>
<!--[if lt IE 8]>
<script src=zeropay/js/json3.min.js"></script><![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>;
</script>
<script src="/assets/zeropay/assets/js/notify.js"></script>
<script src="/assets/zeropay/assets/js/zeropay.js"></script>

<script>
setTimeout("Instant_Submit()",888); //启用支付成功通知服务
function Instant_Submit() {	
	//window.setInterval(function () {
		$.post('pay.php?act=Submit_Api&trade_no=<?=$trade_no?>','',function(json_Api){
			if (json_Api != "") {
				/*json_Api.code//状态码
				json_Api.msg//提示内容
				json_Api.pid//商户pid
				json_Api.login//登录软件状态
				json_Api.out_trade_no//订单号
				json_Api.name//商品名称
				json_Api.date//订单提交时间
				json_Api.money//实际付款金额*/
			callback(json_Api);
            } else { //异常
                setTimeout("Instant_Submit()", 888);//继续提交
			}
		},"json");
	//}, 2000); //继续查询

}
</script>
<script>
    setTimeout(function () {
        $('#use').hide()
    },2000)
</script>
</body>
</html>
<?php } ?>