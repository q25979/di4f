<?php
include("../core/common.php");
if($_GET['my']=='login'){
	$pid=daddslashes($_POST['pid']);
	$key=daddslashes($_POST['key']);
	if(!$pid or !$key){
		echo'<script>alert("PID.KEY不能为空!");location.href="?"</script>';
	}else{
		$Query = $Instant_Api->Query($pid,$key,1);
		if($Query['code']==1){
			$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
			if(!$userrow){
				$DB->exec("INSERT INTO `pay_user` (`pid`) VALUES ('{$pid}')");
			}
			//@get_curl('http://'.$_SERVER['HTTP_HOST'].'/user/Api_Cron.php?pid='.$pid.'&key='.$key);
		echo'<script>alert("'.$pid.'，欢迎回来!");location.href="./"</script>';
		}else{
		echo'<script>alert("PID或KEY错误!");</script>';
		}
	}
}
if($_GET['my']=='reg'){
	$pid='1000'.mt_rand(1000000000,9999999999);
	$key=daddslashes($_POST['key']);
	//$key=random(32);//随机生成32位key
	$qq =daddslashes($_POST['qq']);
	$code =daddslashes($_POST['code']);
	$uid =daddslashes($_GET['uid']);
	if(!$qq or !$key){
		echo'<script>alert("qq.KEY不能为空!");location.href="?"</script>';
	}elseif(strlen($code)!=6 or $code!=$_SESSION["code"]){
		echo'<script>alert("验证码错误");location.href="?"</script>';
	}else{
		unset($_SESSION['code']);//销毁验证码
		$Reg = $Instant_Api->Reg($pid,$key,$qq);
		if($Reg['code']==1){
		$DB->exec("insert into `pay_user` (`pid`,`qq_eamil`) values ('".$pid."','".$qq."')");
		if($uid)$DB->exec("update `pay_user` set `integral` =`integral`+'1' where `pid`='{$uid}'");
		$Query = $Instant_Api->Query($pid,$key,1);
		if($Query['code']==1){
			$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$pid}' limit 1")->fetch();
			if(!$userrow){
				$DB->exec("INSERT INTO `pay_user` (`pid`) VALUES ('{$pid}')");
			}
		}
		echo'<script>alert("'.$pid.'，注册成功，点击确定登录!");location.href="./"</script>';
		}else{
		echo'<script>alert("注册失败,换个注册资料重试!");location.href="?"</script>';
		}
	}
}

if(isset($_GET['logout'])){
unset($_SESSION['Query_pid']);//注销变量
unset($_SESSION['Query_key']);//注销变量
echo'<script>alert("注销登录成功!");location.href="/"</script>';
}
?>
<?php if(!$_GET['pid']&&!$_GET['key']&&$_GET['reg']!=1){?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎登录-<?php echo $conf['sitename']?></title>
	<meta name="keywords" content="XICMS">
	<meta name="content" content="XICMS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
    <link type="text/css" rel="stylesheet" href="/assets/LOGIN/css/login.css">
    <script type="text/javascript" src="/assets/LOGIN/js/jquery-1.8.0.min.js"></script>
</head>
<body class="login_bj" >
<div class="zhuce_body">
	<div class="logo"><a href="#"><img src="/assets/LOGIN/vip.png" width="114" height="54" border="0"></a></div>
    <div class="zhuce_kong login_kuang">
    	<div class="zc">
        	<div class="bj_bai">
            <h3>欢迎登录-云支付系统</h3>
       	  	  <form action="?my=login" method="post">
                <input name="pid" type="text" class="kuang_txt" placeholder="请输入你的商户PID">
                <input name="key" type="password" class="kuang_txt" placeholder="请输入你的商户KEY">
                <div>
               	<a href="find.php">忘记密码？</a><input name="" type="checkbox" value="" checked><span>记住我</span> 
                </div>
				<input type="submit" class="btn_zhuce" value="登录">
                </form>
            </div>
        	<div class="bj_right">
            	<p>使用以下账号直接登录</p>
                <a href="social.php" class="zhuce_qq">QQ号登录</a>
                <a href="oauth.php" class="zhuce_wb">支付宝登陆</a>
                <a href="#" class="zhuce_wx"><!--微信登陆-->暂不支持</a>
                <p>还没账号？<a href="?reg=1">立即注册</a></p>
            </div>
        </div>
        <P><?php echo $conf['sitename']?>&nbsp;©&nbsp;版权所有</P>
<?php }elseif(!$_GET['pid']&&!$_GET['key']&&$_GET['reg']==1){?>	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎申请-<?php echo $conf['sitename']?></title>
	<meta name="keywords" content="XICMS">
	<meta name="content" content="XICMS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
    <link type="text/css" rel="stylesheet" href="/assets/LOGIN/css/login.css">
    <script type="text/javascript" src="/assets/LOGIN/js/jquery-1.8.0.min.js"></script>
</head>
<body class="login_bj" >
<div class="zhuce_body">
	<div class="logo"><a href="#"><img src="/assets/LOGIN/vip.png" width="114" height="54" border="0"></a></div>
    <div class="zhuce_kong">
    	<div class="zc">
        	<div class="bj_bai">
            <h3>欢迎申请-云支付系统-米-粒-小-屋-提-供！</h3>	
				<form action="?my=reg" method="post">
                <input name="key"  id="key" type="password" class="kuang_txt possword" placeholder="请设置商户KEY">
                <input name="qq" id="qq" type="text" class="kuang_txt email" placeholder="请输入QQ号码">
                <input name="code" type="text" class="kuang_txt yanzm" style="max-width: 47.5%;display:inline-block;vertical-align:middle;" placeholder="QQ邮箱验证码">
				<input  id="Button1" type="button" class="btn btn-default btn-sm" value="获取验证码" onClick="get(this)" />
                <div>
               	<input name="" type="checkbox" value=""><span>已阅读并同意<a href="javascript:$('#myModal').modal('show');" target="_blank"><span class="lan">《支付使用协议》</span></a></span>
                </div>
                <input type="submit" class="btn_zhuce" value="注册">
                </form>
            </div>
        	<div class="bj_right">
            	<p>使用以下账号直接登录</p>
                <a href="social.php" class="zhuce_qq">QQ号登录</a>
                <a href="oauth.php" class="zhuce_wb">支付宝登陆</a>
                <a href="#" class="zhuce_wx"><!--微信登陆-->暂不支持</a>
                <p>已有账号？<a href="?">立即登录</a></p>
            
            </div>
        </div>
        <P><?php echo $conf['sitename']?>&nbsp;©&nbsp;版权所有</P>
<?php  } ?>
<script src="/assets/js/jquery.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">
function get(obj) {
    var partten = /^\d{5,10}$/;
	if (!$("#key").val()) {
        alert('请输入商户key！');
        return;
    }else if (!$("#qq").val()) {
        alert('请输入QQ号码！');
        return;
    }else if (!partten.test(document.getElementById("qq").value)) {
        alert('请输入正确的QQ号码！');
        return;
    }
  obj.disabled = true;
  $.ajax({
      url: "code.php?act=reg",
      type: "POST",
      data: "qq=" + $("#qq").val(),
      success: function(msg) {
          obj.disabled = false;
		  if(msg==1){
			  alert('验证码已发送到您的QQ邮箱，请注意查收！');
		  }else{
			  alert('发送验证码失败,可能此QQ邮箱已经注册过商户PID了！');
		  }
          
      }
  })
  
}
</script>
    </div>
</div>
</body>
</html>