<?php
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
}elseif($_GET['act']=='Submit_Api'){
$trade_no=$_GET['trade_no']?daddslashes($_GET['trade_no']):daddslashes($_POST['trade_no']);
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
$pid			= daddslashes($srow['pid']);
$key			= daddslashes($srow['key']);
$trade_no		= daddslashes($srow['trade_no']);
$out_trade_no	= daddslashes($srow['out_trade_no']);
$name			= daddslashes($srow['name']);
$money			= daddslashes($srow['money']);
$type 			= daddslashes($srow['type']);
$notify_url		= daddslashes($srow['notify_url']);
$return_url		= daddslashes($srow['return_url']);
$sign			= daddslashes($srow['sign']);
$outtime		= daddslashes($srow['outtime']);
$pay_id			= getpay_id();
$json=$Instant_Api->Submit($pid,$key,$pay_id,$outtime,$trade_no,$out_trade_no,$notify_url,$type,$name,$money,$sign);	

$zeropay_json = array(
	"pid" => $pid, //商户PID
	"trade_no" => $trade_no,//云支付订单
	"out_trade_no" => $out_trade_no, //商户订单号
	"code" => $json['code'], //状态码 1正常 -1密钥不正确 -2此支付方式软件未挂 -4等于当前商户交易流量不足以记录此订单金额
	"msg" => $json['msg'],//系统提示
	"type" => $type, //支付方式
	"name" => $name,//商品名称
	"price" => $json['money'],//实际付款金额
	"money" => $money,//商品价格
	"outtime" => $outtime+time(),//订单过期时间
	"sign" => $sign,
	"sign_type" => "MD5",
	"trade_status"=>"TRADE_SUCCESS"// 
//	"qrcode" => '//codepay.fateqq.com/qr/1/3/100/0.png'//远程二维码地址
);
exit(json_encode($zeropay_json));
}else{

$trade_no=daddslashes($_GET['trade_no']);
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$srow['pid']}' limit 1")->fetch();
if(!$srow)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

$pid			= daddslashes($srow['pid']);
$key			= daddslashes($srow['key']);
$trade_no		= daddslashes($srow['trade_no']);
$out_trade_no	= daddslashes($srow['out_trade_no']);
$name			= daddslashes($srow['name']);
$money			= daddslashes($srow['money']);
$type 			= daddslashes($srow['type']);
$notify_url		= daddslashes($srow['notify_url']);
$return_url		= daddslashes($srow['return_url']);
$sign			= daddslashes($srow['sign']);
$sitename		= daddslashes($_GET['sitename']);


//*******************************以下参数勿动***********************
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
    <title><?php echo $typeName ?>扫码支付 - <?php echo $sitename?$sitename:$conf['sitename'];?></title>
    <link href="/assets/zeropay/assets/css/wechat_pay.css" rel="stylesheet" media="screen">
	<link rel="icon" type="image/x-icon" href="/assets/zeropay/assets/img/favicon.ico" />
	
<style>
.shadow{  
   -webkit-box-shadow: #666 0px 0px 10px;  
   -moz-box-shadow: #666 0px 0px 10px;  
   box-shadow: #666 0px 0px 10px;  
    padding-top: 15px;
    padding-right: 5px;
    padding-bottom: 1px;
    padding-left: 5px;
   background: #FFFFFF; 
   width:240px;
  height:240px;
} 
.time-item strong {
    background:#006BFC;
    color:#fff;
    line-height:30px;
    font-size:20px;
    font-family:Arial;
    padding:0 10px;
    margin-right:10px;
    border-radius:5px;
    box-shadow:1px 1px 3px rgba(0,0,0,0.2);
}
h2 {
	line-height:50px;
    font-family:"微软雅黑";
    font-size:16px;
    letter-spacing:2px;
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
        <div class="amount" id="price">￥加载中...</div>
	<div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img class="shadow" id='show_qrcode' alt="加载中..." src="/assets/zeropay/assets/img/load.gif">
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
	<div class="time-item" id="msg"><h1>如果5秒后还不能打开,请刷新页面...</h1></div>
            <h1>距离该订单过期还有</h1>
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
            <p>页面加载耗时：<?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>毫秒</p>
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
