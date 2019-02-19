<?php
@header('Content-Type: text/html; charset=UTF-8');
$title='使用说明';
include './head.php';
?>
<?php

?>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">使用说明</h1>
</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			使用说明
		</div>
		<div class="panel-body">
		<h3>1分钟读懂<?php echo $conf['web_name']?>交易规则</h3>
			<div style="line-height:26px"><span style="white-space:nowrap;"> 
<p style="white-space:normal;margin-bottom:14px;color:#333333;font-family:'microsoft yahei';font-size:14px;line-height:24px;">
	<strong>一、交易即时到账</strong> 
</p>
<p style="white-space:normal;margin-bottom:14px;color:#333333;font-family:'microsoft yahei';font-size:14px;line-height:24px;">
你的客户通过<?php echo $conf['sitename']?>中任意一种付款方式（支付宝、微信支付、QQ钱包）付款成功后均会实时到账于你的账户，资金不中转。
</p>
<p style="white-space:normal;margin-bottom:14px;color:#333333;font-family:'microsoft yahei';font-size:14px;line-height:24px;">
<strong>二、代收款详解</strong>
</p>
<p style="white-space:normal;margin-top:0px;margin-bottom:10px;padding:0px;border:0px;font-size:14px;line-height:25px;color:#79848E;font-family:'Microsoft YaHei', 'Heiti SC', simhei, 'Lucida Sans Unicode', 'Myriad Pro', 'Hiragino Sans GB', Verdana;text-indent:2em;background-color:#FFFFFF;">
代收款也是实时到账，无需挂软件，且不会掉线，推荐!每个支付方式收费10元/月。
</p>
<table class="table table-striped table-condensed" width="735" style="color:#666666;font-family:'Helvetica Neue', 'Hiragino Sans GB', 'WenQuanYi Micro Hei', 'Microsoft Yahei', sans-serif;font-size:15.54px;line-height:24.864px;">
<tbody style="box-sizing:border-box;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;">
<tr class="info firstRow" style="box-sizing:border-box;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;">
<td style="box-sizing:border-box;margin:0px;padding-top:11px;padding-right:0px;padding-bottom:11px;border:none;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:17px;font-family:inherit;vertical-align:top;background-color:#D9EDF7;">
<p style="box-sizing:border-box;margin-bottom:10px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#000000;text-indent:2em;">
<strong style="box-sizing:border-box;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;">代收款单笔手续费</strong>
</p>
</td>
<td style="box-sizing:border-box;margin:0px;padding-top:11px;padding-right:0px;padding-bottom:11px;border:none;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:17px;font-family:inherit;vertical-align:top;background-color:#D9EDF7;">
<p style="box-sizing:border-box;margin-bottom:10px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#000000;text-indent:2em;">
<strong style="box-sizing:border-box;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;">软件版单笔手续费</strong>
</p>
</td>
</tr>
<tr style="box-sizing:border-box;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;background-color:#F4F6F8;">
<td style="box-sizing:border-box;margin:0px;padding-top:11px;padding-right:0px;padding-bottom:11px;border:none;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:17px;font-family:inherit;vertical-align:top;">
<p style="box-sizing:border-box;margin-bottom:10px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#000000;text-indent:2em;">
<?=100-$conf['money_rate']?>%
</p>
</td>
<td style="box-sizing:border-box;margin:0px;padding-top:11px;padding-right:0px;padding-bottom:11px;border:none;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:17px;font-family:inherit;vertical-align:top;">
<p style="box-sizing:border-box;margin-bottom:10px;border:0px;font-style:inherit;font-variant:inherit;font-weight:inherit;font-stretch:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#000000;text-indent:2em;">
0.03%
</p>
</td>
</tr>
</tbody></div>
</div>


				<!--开始::内容-->

				<blockquote class="blockquote mb-10">
					<h4><i class="fa fa-bullhorn"></i>&nbsp;常见问题</h4>
				</blockquote>
					</li>
				</ul>					
                    </header>
            <div id="page-content">
				<div class="row">
				<div class="col-sm-12">
                                <div class="block">
                                    <div class="block-title"></div>
                                    <p>
									
									
								</div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">在线支付整个工作流程</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
								在线支付工作流程都为以下几个流程码支付也不例外：<br />
								首先创建订单-->展示付款页-->付款-->通知-->处理订单-->完成<br />
								<img src="/user/help_img/2017_3_2_16_1_43_982_1000.png" title="" alt="流程.png"/>
  									</div>
                                    </div>
                                </div><div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#jsdzapseThree" class="collapsed">为什么付款后没有通知</a>
                                        </h4>
                                    </div>
                                    <div id="jsdzapseThree" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
   <p>答：</p><p><br/></p><p>原因1：因为您使用的是软件版。软件版您需要登录收款账号监听。<span style="color: rgb(255, 0, 0);"><strong>代收款是不用监听的</strong></span></p><p>软件版原理：软件只负责当有付款处理付款人的数据通知您处理。当软件监听到有人付款则会去验证该笔付款是否在订单中存在。 如果存在则会通知您的网站处理业务。</p><p><strong>所以软件版<span style="color: rgb(255, 0, 0);">您没有登录收款账号</span>或者<span style="color: rgb(255, 0, 0);">没有创建订单</span>而直接付款是无法处理通知的。</strong><br/></p><p><br/></p><p>您可能会担心登录账号安全吗？</p><p>软件是经过全世界杀毒软件扫描100%安全 &nbsp;在线扫描http://www.virscan.org/</p><p><br/></p><p>账号是否安全？</p><p>软件版账号是在您本地登录 。我们支持扫码以及快捷无密码登录。不绑定账号支持小号收款。</p><p>不需要您的支付密码。还觉得不安全。 那么我们有代收款业务。不需要软件。 &nbsp;</p><p>当然还有终极解决方案我们可以免费帮软件版用户申请官方接口 独立的接口 详情联系客服&nbsp;&nbsp;</p><p><br/></p><p><br/></p><p>原因2：您的<strong><span style="color: rgb(255, 0, 0);">通知地址无法访问</span></strong>。您可以使用软件版中的调试模式来确定业务处理没问题。</p><p><br/></p><p><br/></p>
  									</div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsedns" class="collapsed">QQ钱包收款二维码制作</a>
                                        </h4>
                                    </div>
                                    <div id="collapsedns" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
										                <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">=================================================</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">准备工作：</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">1：注册或开通支付软件版</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">2：<span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">手机</span>QQ</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box;">=================================================</span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">制作规则：</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">QQ钱包收款二维码</span>制作规则跟微信一样 <br/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">=================================================</span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">教程开始：</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">1：<span style="box-sizing: border-box;">打开<span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">手机</span><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">QQ</span> 点击如图下右上角【+】号 &nbsp;点击收付款</span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">不同版本存在差异 可以找找跟二维码相关的功能里是否有</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><img src="/user/help_img/2017_2_15_19_27_6_575_1044.png" style="white-space: normal;"/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">2：点击右上角的【<span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">三</span>】 在最下面会出现我要收款</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p><img src="/user/help_img/2017_2_15_19_27_6_881_1046.jpg" style=""/></p><p><br/></p><p>3：点击【我要收款】</p><p><img src="/user/help_img/2017_2_15_19_27_6_878_1045.jpg" style=""/></p><p><br/></p><p>4：<span style="background-color: rgb(247, 247, 247); color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif;">截屏保存这个没有金额的收款码</span><a href="https://codepay.fateqq.com/admin/#/uploads.html?act=2" target="_blank" textvalue="上传到云端">上传到云端</a><span style="background-color: rgb(247, 247, 247); color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif;">一次即可</span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">当您没上传指定金额的二维码会使用这个QQ钱包收款二维码。用户自己输入金额即可。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p><br/></p><p><img src="/user/help_img/2017_2_15_19_27_7_444_1047.jpg" style="white-space: normal;"/></p><p><br/></p><p>5：输入金额即可&nbsp;&nbsp;按【确定】</p><p><br/></p><p><img src="/user/help_img/2017_2_15_19_27_7_495_1048.jpg" style=""/></p><p><br/></p><p><br/></p><p>6：截屏保存好二维码到手机相册 IOS系统截屏方法：HOME键加待机键</p><p><br/></p><p><img src="/user/help_img/2017_2_15_19_27_7_697_1049.jpg" style=""/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br style="box-sizing: border-box;"/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box;">7：上传到云端&nbsp;</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">使用电脑上传可将手机相册中的二维码传到电脑版QQ或微信上。进行上传操作。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><br/></p><p><br/></p>
										</div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">微信支付收款二维码制作</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
										                <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">=================================================</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">准备工作：</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">1：<a href="index.php" target="_self" title="http://codepay.fateqq.com:52888/admin/#/vip.html"><strong>1：注册或开通支付软件版</strong></a>。</p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);">2：微信手机APP</p><p><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">=================================================</span></p><p><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><br/></span></p><p><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"></span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(255, 0, 0);">二维码需要制作多少张？</span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box;">答：<span style="box-sizing: border-box; color: rgb(255, 0, 0);">至少1张</span>默认的收款码(单个上传的万能收款码 无金额)&nbsp;</span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box;">注意：这为必传。特点是可以收全部金额。 一张二维码搞定。&nbsp;<span style="box-sizing: border-box;">如：</span></span></p><p><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><img src="/user/help_img/2017_2_15_18_53_30_752_1040.jpg" style="white-space: normal;"/></span><br/></p><p><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><br/></span></p><p><br/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(255, 0, 0);">批量上传需要上传多少张？</span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(255, 0, 0);"><br style="box-sizing: border-box;"/></span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(192, 0, 0);">答：<span style="box-sizing: border-box; font-size: 18px; color: rgb(0, 0, 0);">可以不上传</span>&nbsp;但我们建议做法是将你常用的金额上传 1个面值上传1-3张</span><br style="box-sizing: border-box;"/></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(192, 0, 0);"><br style="box-sizing: border-box;"/></span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(192, 0, 0);"><br style="box-sizing: border-box;"/></span></p><p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; white-space: normal; background-color: rgb(247, 247, 247);"><span style="box-sizing: border-box; color: rgb(192, 0, 0);">微信APP版本：2017年2月15日 ios 最新版 其它版本大致类似</span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><br/></span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">制作教程：</p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">1：<span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">打开微信手机APP 点击如图下右上角【+】号 &nbsp;点击收付款</span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">不同版本存在差异 但都在右上角+号进入</p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"></span></p><p><img src="/user/help_img/2017_2_15_18_53_30_502_1039.png" style=""/></p><p><br/></p><p>2：找到【我要收款】进入 。仔细找找不同版本不一样 也许在右上角菜单栏里。</p><p><br/></p><p><img src="/user/help_img/2017_2_15_18_53_30_770_1041.png" style="white-space: normal;"/></p><p><br/></p><p>3：截屏保存这个没有金额的收款码<a href="/admin/#/uploads.html?act=3" target="_blank" textvalue="上传到云端">上传到云端</a>一次</p><p>当您没上传指定金额的二维码会使用这个微信收款二维码。用户自己输入金额即可。</p><p>不同版本未必一样 如没有保存图片可截屏</p><p><img src="/user/help_img/2017_2_15_18_53_30_752_1040.jpg" style=""/></p><p><br/></p><p>4：输入金额然后下一步。</p><p><br/></p><p><img src="/user/help_img/2017_2_15_18_53_31_391_1042.jpg" style=""/></p><p><br/></p><p>5：保存带有金额的微信收款二维码</p><p><img src="/user/help_img/2017_2_15_18_53_31_500_1043.jpg" style=""/></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><br/></span></p><p style="margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; padding: 0px; color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);"><span style="color: rgb(102, 102, 102); font-family: arial, &quot;Microsoft YaHei&quot;, Tahoma, Helvetica, Arial, 宋体, sans-serif; background-color: rgb(247, 247, 247);">6：上传到云端</span><br/></p>
										</div>
                                    </div>
                                    </div>
                                <!--div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed">软件使用教程</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
 <p><br/></p><p>第一步下载：<a href="/down.html" target="_blank" textvalue="https://codepay.fateqq.com/down.html">https://codepay.fateqq.com/down.html</a>&nbsp;</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_12_949_1001.png" style="white-space: normal;"/></p><hr/><p>第二步：解压</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_12_946_1000.png" style=""/></p><hr/><p><br/></p><p>第三步：运行codepay.exe 登录码支付</p><p><img src="/user/help_img/2018_1_9_4_15_12_978_1002.png" style=""/></p><p><br/></p><hr/><p>第四步：登录支付宝 或者 QQ</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_13_109_1003.png" style=""/></p><p><br/></p><p>PS: 千万别点 <span style="text-decoration: line-through;">进入我的支付</span></p><p><img src="/user/help_img/2018_1_9_4_15_13_141_1005.png" style="white-space: normal;"/></p><p><br/></p><hr/><p>第五步：</p><p>回到监控中心勾选&nbsp;【稳定模式】， 【守护自动启动】，【允许守护进程】&nbsp;</p><p><br/></p><p>频率设置为：30</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_13_137_1004.png" style=""/></p><p><br/></p><p><br/></p><p><br/></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong>恭喜你 已经完成了 ！</strong></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong><br/></strong></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong><br/></strong></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong><br/></strong></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong><br/></strong></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"><strong><br/></strong></span></p><p><span style="color:#ff0000"><span style="font-size: 24px;"><strong>下面是登录不了用户看的：</strong></span></span></p><p><span style="color: rgb(255, 0, 0); font-size: 24px;"></span></p><hr/><p><br/></p><p>如果遇到无法登录 一般是脚本没开启或者证书有问题：</p><p><br/></p><p style="white-space: normal;"><br/></p><p><br/></p><p>打开IE浏览器： (如果找不到 那么直接我的电脑里输入网址会进入)</p><p><img src="/user/help_img/2018_2_3_17_50_6_249_1002.jpg" title="" alt="IE.jpg"/></p><p><br/></p><p><br/></p><p style="white-space: normal;">没出现菜单的 把菜单显示出来</p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="/user/help_img/2018_1_9_4_15_13_268_1007.png"/></p><p><br/></p><p>打开IE浏览器： 工具--Internet选项</p><p><img src="/user/help_img/2018_1_9_4_15_13_281_1008.png" style=""/></p><p><br/></p><p><br/></p><p><br/></p><p>【安全】--【受信任站点】--【站点】--【*.alipay.com】--【添加】 --【*.tenpay.com】--【添加】</p><p><br/></p><p>*.alipay.com</p><p>*.tenpay.com</p><p style="white-space: normal;">分别添加到受信用站点</p><p style="white-space: normal;"><img src="/user/help_img/2018_2_3_17_44_46_190_1001.jpg" title="" alt="QQ截图20180203174154.jpg"/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;">以上域名添加到安全域名中如下图</p><p><br/></p><p>提示需要开启活动脚本解决方法：</p><p><br/></p><p>【安全】--【Internet】--【自定义级别】--【活动脚本--启用】--【确定】--【确定】</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_13_377_1009.png" style=""/></p><p><br/></p><p><br/></p><p>提示证书有问题的设置如下：</p><p><br/></p><p><img src="/user/help_img/2018_1_9_4_15_13_400_1010.png" style=""/></p><p><br/></p>
										</div>
                                    </div>
                                </div-->	

								<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed">微信支付,QQ钱包支付 登录状态会不会失效,如何第一时间知道</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
  <p>答：我们的软件全自动登录 稳定在线率99.9%。但不排除有一些意外情况发生。</p><p><br/></p><p>比如已知的现象：</p><p>财付通会出现一些需要输入验证码才能登录,监听情况。我们软件能自动使用替代方案保证仍可使用。</p><p>但最好还是扫码一次 确保无任何问题出现。</p>                    
										</div>
                                    </div>
                                </div>	

								<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFiveyingshi" class="collapsed">支付宝稳定不稳定,会掉线不,为什么通过支付宝支付钱不到账,为什么不全到账</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFiveyingshi" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
  <p>答：支付宝使用的是企业支付宝才可以签约的分润接口，是不会掉线的，也不需要登录，我们设置快捷登录只是为了获取你支付宝的userid，支付宝UID是支付宝账号对应的支付宝唯一用户号。用户支付后可即时到账你所绑定的支付宝账号！</p><p><br/></p><p>不到账说明：</p><p>1.请确保你所绑定的支付宝账号已经实名认证，否则资金可能无法成功到账！。</p><p>不全到账说明：</p><p>1.每笔交易会有0.06%的手续费，即用户支付100元，实际到账99.04元，最低0.01%。</p>  
                                                      
                      </div>                                 
                	</div>   
                       </div> 
									
                                </div>
                      </section>
                                </div>
								
                                    
   
                            
								
</div>





<?php include 'foot.php';?>
