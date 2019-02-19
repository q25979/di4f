<?php
require './core/common.php';
//require './core/security.php';一 淘 模 板
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false){
	echo '<!DOCTYPE html>
<html>
 <head>
  <title>请使用浏览器打开</title>
  <script src="https://open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
  <script type="text/javascript"> mqq.ui.openUrl({ target: 2,url: "'.$siteurl.'"}); </script>
 </head>
 <body></body>
</html>';
exit;
}

//if($_SERVER['HTTP_HOST']=='pay.qqlepay.cn')sysmsg('无效地址,404');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $conf['sitename']?>|支付宝、QQ钱包财付通、微信即时到账支付</title>
        <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico"/>
		<meta name="keywords" content="<?php echo $conf['keywords']?>">
		<meta name="description" content="<?php echo $conf['description']?>">

        <link href="assets/HOME2/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/HOME2/css/bootstrap-theme.min.css" rel="stylesheet">

        <link href="assets/HOME2/css/owl.carousel.css" rel="stylesheet">
        <link href="assets/HOME2/css/owl.theme.default.min.css" rel="stylesheet">

        <link href="assets/HOME2/css/magnific-popup.css" rel="stylesheet">

        <link href="assets/HOME2/css/style.css" rel="stylesheet">


        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="menu-item" class="menu-item hide-menu">
            <div class="container">
                <ul>
                    <a href="index.php"><li>主页</li></a>
                    <a href="/user"><li>用户中心</li></a>
					<a href="about.html"><li>本站优势</li></a>
                    <a href="#expertise"><li>接入使用</li></a>
                    <a href="#changjing"><li>适用场景</li></a>
                    <a href="#team"><li>我们团队</li></a>
                    <a href="#contact"><li>关于我们</li></a>
                </ul>
            </div>
        </div>
        <div class="main">
            <header class="bg-img header">
                <nav class="navbar navbar-default navbar-vira">
                    <div class="container">
                        <div class="navigation-bar">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="logo">
                                        <a href="#"><span class="fa fa-viacoin"></span></a>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <div class="menu m">
                                        <a href="#"><span class="ion-navicon _ion-android-menu"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="intro-box">
                            <div class="intro">
                                <h1>欢迎使用<?php echo $conf['sitename']?></h1>
                                <p>集成支付宝支付、微信支付、QQ钱包支付三大支付方式，方便快捷的扫码支付，资金实时到自己的收款账户，不用担心平台跑路。</p>
                                <a class="btn vira-btn" href="/SDK">在线测试</a>
                                <a class="btn vira-btn" href="/user">用户中心</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section id="about" class="about section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h2 class="title">我们的优势</h2>
                            <p>
							集成支付宝支付、微信支付、QQ钱包支付三大支付方式，方便快捷的扫码支付，资金实时到自己的收款账户，不用担心平台跑路。
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="changjing" class="purpose section">
                <div class="container">
                    <h2 class="title">适用场景</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <div class="card-icon">
                                        <span class="fa fa-diamond" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="vira-card-content">
                                    <h3>网站支付</h3>
                                    <p>
									快速集成支付接口接入到自己的网站实现网站支付功能，更便捷、资金更安全的支付系统。
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <div class="card-icon">
                                        <span class="fa fa-cogs" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="vira-card-content">
                                    <h3>快速适用</h3>
                                    <p>
									目前支付系统已经支持接入彩虹代刷、旧言代刷、小炫代刷、VHMS及SWAP主机销售系统等多个程序。
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <div class="card-icon">
                                        <span class="fa fa-bicycle" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="vira-card-content">
                                    <h3>便捷优势</h3>
                                    <p>
									拿出手机扫码支付即可完成，无需将资金寄存在支付平台，实现0手续费实时结算的免签约支付。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="expertise" class="expert">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 bg-img">
                            <div></div>
                        </div>
                        <div class="col-sm-5 section">
                            <h2 class="title">接入使用</h2>
                            <div id="expert-slider" class="owl-carousel">
                                <div class="item">
                                    <p>
									无论是个人还是商户都可以通过本平台注册属于自己的PID及KEY，上传属于自己的收款二维码。
                                    </p>
                                </div>
                                <div class="item">
                                    <p>
									接入程序到你的网站，然后你只需要挂上零度云支付软件即可完成整个支付收款流程。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="team" class="team section">
                <div class="container">
                    <h2 class="title">我们的创作团队</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <img class="img-responsive" src="//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['qq']?>&src_uin=pay.abcwl.cn&fid=666&spec=640">
                                </div>
                                <div class="vira-card-content">
                                    <h3><?php echo $conf['name']?>（QQ<?php echo $conf['qq']?>）</h3>
                                    <p>
									可能是全球上唯一一个时刻不忘骚气的程序小白鼠。
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <img class="img-responsive" src="//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['qq']?>&src_uin=pay.abcwl.cn&fid=666&spec=640">
                                </div>
                                <div class="vira-card-content">
                                    <h3><?php echo $conf['name']?>（WX<?php echo $conf['wx']?>）</h3>
                                    <p>
									可能是全球上唯一一个时刻不忘装比的大帅比。
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                    <img class="img-responsive" src="assets/HOME2/picture/intlpay.png">
                                </div>
                                <div class="vira-card-content">
                                    <h3>虚位以待（联系<?php echo $conf['qq']?>）</h3>
                                    <p>
									我们同时期待更装比的你加入，只要你有牛比的手段。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="contact" class="contact section">
                <div class="container">
                    <h2 class="title">关于我们</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                        <span class="fa fa-map-o" aria-hidden="true"></span>
                                </div>
                                <div class="vira-card-content">
                                    <h3>官方QQ群</h3>
                                    <p>
									唯一群号：<?php echo $conf['qqun']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                        <span class="fa fa-phone" aria-hidden="true"></span>
                                </div>
                                <div class="vira-card-content">
                                    <h3>商务联系</h3>
                                    <p>
									不确定的事请别过来谈
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="vira-card">
                                <div class="vira-card-header">
                                        <span class="fa fa-paper-plane" aria-hidden="true"></span>
                                </div>
                                <div class="vira-card-content">
                                    <h3>Email</h3>
                                    <p>
									mpai@abcwl.cn
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <p> 本站最终解释权归 <a href="/" target="_blank" title="<?php echo $conf['sitename']?>"><?php echo $conf['sitename']?></a> && <a href="//www.abcwl.cn/" title="<?php echo $conf['sitename']?>" target="_blank"><?php echo $conf['name']?></a>所有</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="assets/HOME2/js/jquery-3.1.1.js"></script>
        <script src="assets/HOME2/js/bootstrap.min.js"></script>
        <script src="assets/HOME2/js/owl.carousel.min.js"></script>
        <script src="assets/HOME2/js/55b73bf748.js"></script>
        <script src="assets/HOME2/js/jquery.magnific-popup.js"></script>
        <script src="assets/HOME2/js/script.js"></script>
    </body>
</html>