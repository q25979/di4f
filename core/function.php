<?php
function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept:*/*";
	$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
	$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
	$httpheader[] = "Connection:close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 4.4.2; NoxW Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
function send_mail($to, $sub, $msg) {
	global $conf;
	if($conf['mail_cloud']==1){
		$url='http://api.sendcloud.net/apiv2/mail/send';
		$data=array(
			'apiUser' => $conf['mail_apiuser'],
			'apiKey' => $conf['mail_apikey'],
			'from' => $conf['mail_name'],
			'fromName' => $conf['sitename'],
			'to' => $to,
			'subject' => $sub,
			'html' => $msg);
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$json=curl_exec($ch);
		curl_close($ch);
		$arr=json_decode($json,true);
		if($arr['statusCode']==200){
			return true;
		}else{
			return implode("\n",$arr['message']);
		}
	}else{
		if(!function_exists("openssl_sign") && $conf['mail_port']==465){
			$mail_api = 'http://1.mail.qqzzz.net/';
		}
	if($mail_api) {
		$post[sendto]=$to;
		$post[title]=$sub;
		$post[content]=$msg;
		$post[user]=$conf['mail_name'];
		$post[pwd]=$conf['mail_pwd'];
		$post[nick]=$conf['sitename'];
		$post[host]=$conf['mail_smtp'];
		$post[port]=$conf['mail_port'];
		$post[ssl]=$conf['mail_port']==465?1:0;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$mail_api);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$ret = curl_exec($ch);
		curl_close($ch);
		if($ret=='1')return true;
		else return $ret;
	} else {
		include_once ROOT.'core/smtp.class.php';
		$From = $conf['mail_name'];
		$Host = $conf['mail_smtp'];
		$Port = $conf['mail_port'];
		$SMTPAuth = 1;
		$Username = $conf['mail_name'];
		$Password = $conf['mail_pwd'];
		$Nickname = $conf['sitename'];
		$SSL = $conf['mail_port']==465?1:0;
		$mail = new SMTP($Host , $Port , $SMTPAuth , $Username , $Password , $SSL);
		$mail->att = array();
		if($mail->send($to , $From , $sub , $msg, $Nickname)) {
			return true;
		} else {
			return $mail->log;
		}
	}
	}
}
function getSubstr($str, $leftStr, $rightStr)
{
    $left = strpos($str, $leftStr);
    //echo '左边:'.$left;
    $right = strpos($str, $rightStr,$left);
    //echo '<br>右边:'.$right;
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}
function daddslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5($key ? $key : ENCRYPT_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}
function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}
function showmsg($content = '未知的异常',$type = 4,$back = false)
{
switch($type)
{
case 1:
	$panel="success";
break;
case 2:
	$panel="info";
break;
case 3:
	$panel="warning";
break;
case 4:
	$panel="danger";
break;
}

echo '<div class="panel panel-'.$panel.'">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
echo $content;

if ($back) {
	echo '<hr/><a href="'.$back.'"><< 返回上一页</a>';
}
else
    echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';

echo '</div>
    </div>';
exit;
}
function checkIfActive($string) {
	$array=explode(',',$string);
	$php_self=substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],'/')+1,strrpos($_SERVER['REQUEST_URI'],'.')-strrpos($_SERVER['REQUEST_URI'],'/')-1);
	if (in_array($php_self,$array)){
		return 'active';
	}else
		return null;
}
function sysmsg($msg = '未知的异常',$die = true) {
    ?>  
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>站点提示信息</title>
        <style type="text/css">
html{background:#eee}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px "微软雅黑","Microsoft YaHei",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}
        </style>
    </head>
    <body id="error-page">
        <?php echo '<h3>站点提示信息</h3>';
        echo $msg; ?>
    </body>
    </html>
    <?php
    if ($die == true) {
        exit;
    }
}
function getpay_id(){ //取IP函数
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            if (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
    }
    return $realip;
}
function qrcode($qrcode = 'http://pay.abcwl.cn/qrcode/1000272341207_alipay_index.png') {
	global $conf;
	$url = "http://api.jisuapi.com/qrcode/read?appkey=".$conf['appkey_appkey']."&qrcode=".$qrcode;
	$result=get_curl($url);
	$jsonarr = json_decode($result, true);
	if($jsonarr['status'] != 0)
	{
		return false;
	}else{
		return $jsonarr['result'];
	}
}
function creat_callback($data){
	global $DB;
	$DB->query("update `pay_order` set `status` ='1' where `trade_no`='{$data['trade_no']}'");
	$array=array('pid'=>$data['pid'],'trade_no'=>$data['trade_no'],'out_trade_no'=>$data['out_trade_no'],'type'=>$data['type'],'name'=>$data['name'],'money'=>$data['money'],'trade_status'=>'TRADE_SUCCESS');
	$arg=argSort(paraFilter($array));
	$prestr=createLinkstring($arg);
	$urlstr=createLinkstringUrlencode($arg);
	$sign=md5Sign($prestr, $data['key']);
	//$sign=$data['sign'];
	$url['notify']=$data['notify_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	$url['return']=$data['return_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	return $url;
}
function trimall($str)//删除空格
{
    $qian=array(" ","　","\t","\n","\r","#");
	$hou=array("","","","","","@");
    return str_replace($qian,$hou,$str);    
}

function short_url($url)//新浪短域名生成
{
	$short_url_api = 'http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long='.$url;
	$data = get_curl($short_url_api);
	$data=getSubstr($data, '[', ']');
	$json = json_decode($data, true);
	return $json['url_short'];
}
class runtime  
{  
   var $StartTime = 0;  
   var $StopTime = 0;  
   
    function get_microtime()  
    {  
        list($usec, $sec) = explode(' ', microtime());  
        return ((float)$usec + (float)$sec);  
    }  
   
    function start()  
    {  
        $this->StartTime = $this->get_microtime();  
    }  
   
    function stop()  
    {  
        $this->StopTime = $this->get_microtime();  
    }  
   
    function spent()  
    {  
        return round(($this->StopTime - $this->StartTime) * 1000, 1);  
    }  
   
}
function transferToAlipay($out_trade_no, $alipay_uid, $money,$bz){
	global $conf,$DB,$date;

require SYSTEM_ROOT.'AopSdk.php';

$BizContent = array(
	'out_biz_no' => $out_trade_no, //商户转账唯一订单号
	'payee_type' => 'ALIPAY_USERID', //收款方账户类型
	'payee_account' => $alipay_uid, //收款方账户
	'amount' => $money, //转账金额
	'payer_show_name' => $bz?$bz:$conf['sitename'], //付款方显示姓名
);

$aop = new AopClient ();
$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
$aop->appId = '2018021102180459'; //应用ID
$aop->rsaPrivateKey = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCRjqwYcMlEq+VnYqA6FMQ3EQhKkk0TyPu41LZyiz4Y9nVKVHr7BgOghoYAQ4YMGI3MFYOgVqNOFl6OfqXjOjAF8a8yg0xSRq0WezWOQ9y5ykzPlBlCdTMN2QlNUQzgKtpNmQJFOFwv/Y0W/5I6EgGlIkcN0Pv8vjTKMaKjM/9pKH+2ZdItOPrq+U6ZOardjrb6zKn8oUFK6JM9pZ+rb76ui0o7oxCXBxBvvLXiuzDR4f3LGhsc4QC+/Aarto831ft6K7nTSQNfdJqvIvTPfunR7ssH1vftsKn4l3vgIg5suPoO0i6mLnEZOueLKYTXlgMBdjz3QrAgMBAAECggEBAI2WD5cSluUipFplmGAG9TpvafZHy4v0U89dsj9HbNcRXdQ4ywvEtOCAGnbFN+4qMDwVrVzZCa8amU3YqfqXDkGp73aeOy5JK3MT1GuXXWyn+/f30MH/Os/+tIRF4Mf1Z///+0KRxXun76keyRSsWZUeY1++/uAJUmnWtVu3+Yang6FsVYkaPjzngckuO7peGJ6zLrsb95QIumTWnjyPaZfP41EM+FUBgOsoYNjimzbKJKB2Z23Joi53eYWtQlPL0GwSrQBAjtEmhn+FIkIZsljt6oGbBSyN7U/GtVAZA9b5/8CgYBOGiQ63GsuE4kwU+sDuMsqDMwF9WA753qGQ4O8Xct978HKujFs+FUKvtlBaMyhPlDQNMU53QQhfYNLQQ3m2q8YaUZtG35RKS2IpJUDSX4/y5ZagyZDSOAFSPM3EhB/k6T3D+Uo/r/+sZ3vqNEr2zNvE5fXSaN1HrGosnihD5Zpvy7v81sVa6+5VxOIDHWA42WjsBI/zVK8LqpEQYYFdokGEx6pabTzqNdMbrDH+1PVzFaZGMiX+MXynrWy5X5CfwVDaVTch6HdNfaUofxcAalfcG8Hg81lbpViC+deJej+fdSSWJAoGALlORLcMYOTv0Rtc9lx6Fe2EB2odlQKP2G8pdp9hStj4k3VuEwJ5UWEv1YdSNDK/wTyYqan/rNGM+Cmx92mcVa4mu0L3BUgPksKCFinIanB+LjBPo59s6NDijPiRMR8GT2d2Qa6bGnCu3X3H9LPrt7EWXJXfdBr7v0fmQb3qDFDY='; //应用私钥
$aop->alipayrsaPublicKey='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApmckIlbODaMCE++/okSTHADIiJSDidiIEPgQ3Vso5XavYObd+h45IEtLz9Vrqrrq0NogBFpACHUoK8LcA2WjiplaTLeHzpPcb32xhEWUUVCW8XxfDFQDirGxuUmi1RnY8lLp/+Z8d126nAKlfsWyD7BclzTSLz55nAh5+atGQIDAQAB'; //支付宝公钥
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset='UTF-8';
$aop->format='json';
$request = new AlipayFundTransToaccountTransferRequest ();
$request->setBizContent(json_encode($BizContent));
$result = $aop->execute ( $request); 
//file_put_contents('log.txt',json_encode($result));
$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
$resultCode = $result->$responseNode->code;
	if(!empty($resultCode)&&$resultCode == 10000){
		//转账成功$DB->exec("update `pay_settle` set `status`='1',`transfer_result`='".$result->$responseNode->order_id."',`transfer_date`='".$result->$responseNode->pay_date."' where `id`='$id'");
		$DB->exec("update `pay_settle` set `status`='1',`endtime`='{$date}' where id='{$out_trade_no}' limit 1");
	}elseif($resultCode == 40004) {
		//转账失败
		//$data='失败 ['.$result->$responseNode->sub_code.']'.$result->$responseNode->sub_msg;
		//$DB->exec("update `pay_order` set `transfer_status`='2',`transfer_result`='".$data."' where `id`='{$out_trade_no}'");
		$DB->exec("update `pay_settle` set `status`='2',`endtime`='{$date}' where id='{$out_trade_no}' limit 1");
	}
}
?>