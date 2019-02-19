<?php
/**
 * 找回商户pid和key
 **/
include("../core/common.php");
//            exit('暂时维护，更新加入找回pid和key的功能');
if(isset($_GET['act']) && $_GET['act']=='qrlogin'){
    if(isset($_SESSION['findpwd_qq']) && $qq=$_SESSION['findpwd_qq']){
        $FindPidKey=$Instant_Api->FindPidKey($qq);
        unset($_SESSION['findpwd_qq']);
        if($FindPidKey['code']==1){
		$data='('.$qq.')找回成功了哟，如下：<br>';
		$i=0;
		foreach($FindPidKey["data"] as $res){
		$i++;
		$data.='商户_'.$i.'：ID：'.$res["pid"].' KEY：'.$res["key"].'<br>';
		}
			
            exit('{"code":1,"msg":"登录成功，请在用户资料设置里重置密码","data":"'.$data.'"}');
        }else{
            @header('Content-Type: application/json; charset=UTF-8');
            exit('{"code":-1,"msg":"当前QQ不存在，请确认你已注册过商户"}');
        }
    }else{
        @header('Content-Type: application/json; charset=UTF-8');
        exit('{"code":-2,"msg":"验证失败，请重新扫码"}');
    }
}elseif(isset($_COOKIE["user_token"]) and $_SESSION['Query_pid'] and $_SESSION['Query_key']){
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='找回pid和key';
?>
<title><?php echo $title?> | <?php echo $conf['sitename']?></title>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/assets/js/simple/css/plugins.css">
<link rel="stylesheet" href="/assets/js/appui/css/main.css">
<link rel="stylesheet" href="/assets/js/appui/css/themes.css">
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    img.logo {
        width: 14px;
        height: 14px;
        margin: 0 5px 0 3px;
    }

    body {
        background: #ecedf0 url("//cdn.dkfirst.cn/htbj.png") fixed;
        background-repeat: repeat;
    }
</style>
<div id="login-container">
    <div class="widget-content themed-background-flat2 text-center push-top-bottom animation-slideDown">
        <div class="widget">
            <!--logo-->
            <div class="widget-content themed-background-flat text-center"
                 style="background-image: url('//cdn.dkfirst.cn/htbj1.jpg');background-size: 100% 100%;">
                <a href="javascript:void(0)">
                    <img src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['qq'] ?>&amp;spec=100"
                         alt="Avatar" width="80"
                         style="height: auto filter: alpha(Opacity=80);-moz-opacity: 0.80;opacity: 0.80;"
                         class="img-circle img-thumbnail img-thumbnail-avatar-1x">
                </a>
            </div>
            <div class="widget-content text-center">
                <center style="padding-bottom:20px"><a class="btn btn-xs btn-info" id="search_toggle"
                                                       style="width:100px;"><i class="fa fa-angle-double-down"></i></a>
                </center>
                <div class="panel-body">
                    <div class="list-group" style="text-align: center;">
                        <div class="list-group-item list-group-item-info" style="font-weight: bold;" id="login">
                            <span id="loginmsg">请使用QQ手机版扫描二维码</span><span id="loginload" style="padding-left: 10px;color: #790909;">.</span>
                        </div>
                        <div class="list-group-item" id="qrimg">
						 </div>
                    </div>
                </div>
                <div class="form-group" id="search" style="display:none;">
                    <p class="text-center" id="text-center">
                    <center>
                        <a href="login.php"class="label label-info">
                            <small>返回登录</small>
                        </a> - <a href="../" class="label label-primary">
                            <small>返回首页</small>
                        </a>
                        <center>
                    </p>
                </div>
            </div>


            <script src="/assets/js/qrlogin.js"></script>
            <script>
                $(document).ready(function(){
                    getqrpic();
                    interval1=setInterval(loginload,1000);
                    interval2=setInterval(loadScript,3000);
                });
            </script>
            <script>
                $("#search").delay("1000").slideToggle("slow");
                $("#search").slideToggle("slow");
            </script>
            <script src="//cdn.dkfirst.cn/ht3_main.js?ver=3506"></script>
