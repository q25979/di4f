<?php
include '../core/common.php';
if($_GET['act']=='is_alipay'){
	
$sql="update `pay_user` set `is_alipay` ='{$_POST['is_alipay']}' where `pid`='{$Query_pid}'";
if($DB->exec($sql))
	$result=array("code"=>1,"msg"=>"支付宝代收款配置保存成功!");
else
	$result=array("code"=>-1,"msg"=>"支付宝代收款配置保存失败!");
exit(json_encode($result));

}elseif($_GET['act']=='is_wxpay'){
	
$sql="update `pay_user` set `is_wxpay` ='{$_POST['is_wxpay']}' where `pid`='{$Query_pid}'";
if($DB->exec($sql))
	$result=array("code"=>1,"msg"=>"微信代收款配置保存成功!");
else
	$result=array("code"=>-1,"msg"=>"微信代收款配置保存失败!");
exit(json_encode($result));

}elseif($_GET['act']=='is_qqpay'){
	
$sql="update `pay_user` set `is_qqpay` ='{$_POST['is_qqpay']}' where `pid`='{$Query_pid}'";
if($DB->exec($sql))
	$result=array("code"=>1,"msg"=>"QQ钱包代收款配置保存成功!");
else
	$result=array("code"=>-1,"msg"=>"QQ钱包代收款配置保存失败!");
exit(json_encode($result));
	
}elseif($_GET['act']=='duihuan'){
	$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$Query_pid}' limit 1")->fetch();
	if($_POST['duihuan']==1){
		$name='1000额度';
		if($userrow['integral']>=5){
			$Instant_Api->Paymb(1000,$Query_pid,$Query_key);
			$DB->exec("update `pay_user` set `integral` =`integral`-'5' where `pid`='{$Query_pid}'");
			$result=array("code"=>1,"msg"=>"兑换：".$name."成功！");
		}else{
			$result=array("code"=>-1,"msg"=>"积分不足,兑换：".$name."失败！");
		}
	}elseif($_POST['duihuan']==2){
		$name='支付宝代收款';
		if($userrow['integral']>=20){
		$alipay_date = ($userrow['alipay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['alipay_date'])+60*60*24*31));
		$DB->exec("update `pay_user` set `alipay_date` ='{$alipay_date}',`integral` =`integral`-'20' where `pid`='{$Query_pid}'");
			$result=array("code"=>1,"msg"=>"兑换：".$name."成功！");
		}else{
			$result=array("code"=>-1,"msg"=>"积分不足,兑换：".$name."失败！");
		}
	}elseif($_POST['duihuan']==3){
		$name='微信代收款';
		if($userrow['integral']>=20){
		$wxpay_date = ($userrow['wxpay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['wxpay_date'])+60*60*24*31));
		$DB->exec("update `pay_user` set `wxpay_date` ='{$wxpay_date}',`integral` =`integral`-'20' where `pid`='{$Query_pid}'");
			$result=array("code"=>1,"msg"=>"兑换：".$name."成功！");
		}else{
			$result=array("code"=>-1,"msg"=>"积分不足,兑换：".$name."失败！");
		}
	}elseif($_POST['duihuan']==4){
		$name='QQ钱包代收款';
		if($userrow['integral']>=20){
		$qqpay_date = ($userrow['qqpay_date']<$date?date("Y-m-d",strtotime("+1 month")):date('Y-m-d',strtotime($userrow['qqpay_date'])+60*60*24*31));
		$DB->exec("update `pay_user` set `qqpay_date` ='{$qqpay_date}',`integral` =`integral`-'20' where `pid`='{$Query_pid}'");
			$result=array("code"=>1,"msg"=>"兑换：".$name."成功！");
		}else{
			$result=array("code"=>-1,"msg"=>"积分不足,兑换：".$name."失败！");
		}
	}
exit(json_encode($result));

}
$title='用户中心';
include './head.php';
$jOrdersnums=0;
$jOstatusnums=0;
$jOmoneynums=0;

$zOrdersnums=0;
$zOstatusnums=0;
$zOmoneynums=0;

foreach($Orders['data'] as $Onums){
	if($Onums['addtime']>date("Y-m-d 23:59:59",strtotime("-1 days"))){
		$jOrdersnums++; //今日总订单
		if($Onums['status']==1){
			$jOstatusnums++; //今日已支付订单
			$jOmoneynums+=$Onums['money'];//今日收入
		}
	}
	
	if(date("Y-m-d 00:00:00")>=$Onums['addtime']&&$Onums['addtime']>=date("Y-m-d 00:00:00",strtotime("-2 days"))){
		$zOrdersnums++; //昨日总订单
		if($Onums['status']==1){
			$zOstatusnums++; //昨日已支付订单
			$zOmoneynums+=$Onums['money'];//昨日收入
		}
	}
}
?>
<!---------------------------------------------------弹窗公告 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
	  <?php echo $conf['modal']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
if( !$.cookie('zero_op')){
	$('#myModal').modal({
		keyboard: true
	});
	var cookietime = new Date(); 
	cookietime.setTime(cookietime.getTime() + (10*60*1000));
	$.cookie('zero_op', false, { expires: cookietime });
}
</script>
<!---------------------------------------------------弹窗公告 结束------------------------------------------------------------>



<!---------------------------------------------------支付宝 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="alipayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">支付宝代收款</h4>
      </div>

<div class="modal fade" align="left" id="zfbsmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">支付宝代收款请看以下说明</h4>
      </div>
      <div class="modal-body">
1.支付宝UID是支付宝账号对应的支付宝唯一用户号。用户支付后可即时到账你所绑定的支付宝账号！<br/>
2.每笔交易会有<?=100-$conf['money_rate']?>%的手续费，即用户支付100元，实际到账<?=$conf['money_rate']?>元,故为即时到账所以费率较高。<br/>
3.请确保你所绑定的支付宝账号已经实名认证，否则资金可能无法成功到账！<br/>
4.比如我支付宝使用了代收款，软件上就不用挂支付宝了，也不用上传收款二维码到平台<br/>
5.代收款好像支付0.1以上资金才反回商户绑定的收款账号,如果你的商品都是0.01元的 求求你别用了<br/>
6.会员还在有效期，此支付方式就默认使用代收款服务器，会员到期了，就自动转换为需要挂软件<br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<script src="/assets/js/layer/layer.js"></script>
<script type="text/javascript">
function is_alipay(e){
		  	var d = $(e).val();
		  	var ii = layer.load(2, {shade:[0.1,'#fff']});
		  	$.ajax({
				type : "POST",
				url : "index.php?act=is_alipay",
				data : {"is_alipay":d},
				dataType : 'json',
				success : function(data) {					  
					  layer.close(ii);
				layer.alert(data.msg);
				},
				error:function(data){
					layer.close(ii);
					layer.msg('服务器错误');
					}
			});
		  	
}
</script>
      <div class="modal-body">
	  <div class="panel panel-primary">
	  <table class="table table-bordered">
		<tbody>
		<tr>
			<td align="center"><font color="#808080">支付宝代收款绑定(需实名支付宝)：</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><?php echo $userrow['alipay_uid']?'已绑定ID:'.$userrow['alipay_uid'].'（<a href="alipaylogin.php">点此换绑）':'(<a href="alipaylogin.php">点此绑定收款支付</a>)'?></font></td>
		</tr>
			
		<tr>
			<td align="center"><div class="form-group">
		<label>是否开启支付宝代收款(会员到期开启了也无法使用):</label><br><select class="form-control" name="is_alipay"  id="is_alipay" onchange="is_alipay(this);">
		<?php if($userrow['is_alipay']){?>
		<option value="1">1_开启</option>
		<option value="0">0_关闭</option>
		<?php }else{?>
		<option value="0">0_关闭</option>
		<option value="1">1_开启</option>
		<?php }?>
		</select>
		</div>
			</td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080">支付宝代收款会员包月到期时间：<?PHP ECHO $userrow['alipay_date']>$date?$userrow['alipay_date']:'支付已到期';?> (<a href="payapi.php?WIDtotal_fee=<?=$conf['alipay_money']?>&WIDsubject=支付宝代收款|<?=$Query_pid?>" onclick="if(!confirm('支付宝代收款每月<?=$conf['alipay_money']?>元'))return false;"><?=$conf['alipay_money']?>元开通/续费①月</a>)</font></td>
		</tr>
		
		<tr>
		<td align="center"><font color="#808080"><a class="btn btn-block btn-info" href="#" data-toggle="modal" data-target="#zfbsmModal" id="zfbsmModal">支付宝代收款首次必看</a></font>
		</td>
		</tbody>
		</table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------支付宝 结束---------------------------------------------------------------->








<!---------------------------------------------------微信代收款 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="wxpayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">微信代收款</h4>
      </div>
	  
<div class="modal fade" align="left" id="wxsmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">微信代收款请看以下说明</h4>
      </div>
      <div class="modal-body">
1.通过代收款微信支付的钱都会进入你商户绑定的支付宝账户里面(绑定快捷登录的支付宝)，不是返回你到你的微信账户！<br/>
2.每笔交易会有<?=100-$conf['money_rate']?>%的手续费，即用户支付100元，实际到账<?=$conf['money_rate']?>元,故为即时到账所以费率较高。<br/>
3.请确保你所绑定快捷登录的支付宝已经实名认证，否则资金可能无法成功到账！<br/>
4.比如我微信使用了代收款，软件上就不用挂微信了，也不用上传收款二维码到平台<br/>
5.代收款好像支付0.1以上资金才反回商户绑定的收款账号,如果你的商品都是0.01元的 求求你别用了<br/>
6.会员还在有效期，此支付方式就默认使用代收款服务器，会员到期了，就自动转换为需要挂软件<br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function is_wxpay(e){
		  	var d = $(e).val();
		  	var ii = layer.load(2, {shade:[0.1,'#fff']});
		  	$.ajax({
				type : "POST",
				url : "index.php?act=is_wxpay",
				data : {"is_wxpay":d},
				dataType : 'json',
				success : function(data) {					  
					  layer.close(ii);
				layer.alert(data.msg);
				},
				error:function(data){
					layer.close(ii);
					layer.msg('服务器错误');
					}
			});
		  	
}
</script>

      <div class="modal-body">
<div class="panel panel-primary">
	  <table class="table table-bordered">
		<tbody>
		<tr>
			<td align="center"><font color="#808080">微信代收款绑定(商户绑定的QQ号)：</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><?php echo $userrow['alipay_uid']?'已绑定ID:'.$userrow['alipay_uid'].'（<a href="alipaylogin.php">点此换绑）':'(<a href="alipaylogin.php">点此绑定收款支付</a>)'?></font></td>
		</tr>
			
		<tr>
			<td align="center"><div class="form-group">
		<label>是否开启微信代收款(会员到期开启了也无法使用):</label><br></label><br><select class="form-control" name="is_wxpay"  id="is_wxpay" onchange="is_wxpay(this);">
		<?php if($userrow['is_wxpay']){?>
		<option value="1">1_开启</option>
		<option value="0">0_关闭</option>
		<?php }else{?>
		<option value="0">0_关闭</option>
		<option value="1">1_开启</option>
		<?php }?>
		</select>
		</div>
			</td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080">微信代收款会员包月到期时间：<?PHP ECHO $userrow['wxpay_date']>$date?$userrow['wxpay_date']:'微信已到期';?> (<a href="payapi.php?WIDtotal_fee=<?=$conf['wxpay_money']?>&WIDsubject=微信代收款|<?=$Query_pid?>" onclick="if(!confirm('微信代收款每月<?=$conf['wxpay_money']?>元'))return false;"><?=$conf['wxpay_money']?>元开通/续费①月</a>)</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><a class="btn btn-block btn-info" href="#" data-toggle="modal" data-target="#wxsmModal" id="wxsmModal">微信代收款首次必看</a></font></td>
		</tr>
		</tbody>
		</table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<!---------------------------------------------------微信代收款 结束------------------------------------------------------------>


<!---------------------------------------------------QQ钱包代收款 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="qqpayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">QQ钱包代收款</h4>
      </div>
	  
<div class="modal fade" align="left" id="qqsmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">QQ钱包(财付通)代收款请看以下说明</h4>
      </div>
      <div class="modal-body">
1.通过代收款QQ钱包(财付通)支付的钱都会进入你商户支付宝账户里面(绑定快捷登录的支付宝)账户里面！<br/>
2.每笔交易会有<?=100-$conf['money_rate']?>%的手续费，即用户支付100元，实际到账<?=$conf['money_rate']?>元,故为即时到账所以费率较高。<br/>
3.请确保你所绑定快捷登录的支付宝已经实名认证，否则资金可能无法成功到账！<br/>
4.比如我QQ钱包(财付通)使用了代收款，软件上就不用挂QQ钱包(财付通)了，也不用上传收款二维码到平台<br/>
5.代收款支付0.1以上资金才反回商户绑定的收款账号,如果你的商品都是0.01元的 求求你别用代收款服务了<br/>
6.会员还在有效期，此支付方式就默认使用代收款服务器，会员到期了，就自动转换为需要挂软件<br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function is_qqpay(e){
		  	var d = $(e).val();
		  	var ii = layer.load(2, {shade:[0.1,'#fff']});
		  	$.ajax({
				type : "POST",
				url : "index.php?act=is_qqpay",
				data : {"is_qqpay":d},
				dataType : 'json',
				success : function(data) {					  
					  layer.close(ii);
				layer.alert(data.msg);
				},
				error:function(data){
					layer.close(ii);
					layer.msg('服务器错误');
					}
			});
		  	
}
</script>

      <div class="modal-body">
<div class="panel panel-primary">
	  <table class="table table-bordered">
		<tbody>
		<tr>
			<td align="center"><font color="#808080">QQ钱包代收款绑定(商户绑定的QQ号)：</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><?php echo $userrow['alipay_uid']?'已绑定ID:'.$userrow['alipay_uid'].'（<a href="alipaylogin.php">点此换绑）':'(<a href="alipaylogin.php">点此绑定收款支付</a>)'?></font></td>
		</tr>
		
		
		<tr>
			<td align="center"><div class="form-group">
		<label>是否开启QQ钱包代收款(会员到期开启了也无法使用):</label><br></label><br><select class="form-control" name="is_qqpay"  id="is_qqpay" onchange="is_qqpay(this);">
		<?php if($userrow['is_qqpay']){?>
		<option value="1">1_开启</option>
		<option value="0">0_关闭</option>
		<?php }else{?>
		<option value="0">0_关闭</option>
		<option value="1">1_开启</option>
		<?php }?>
		</select>
		</div>
			</td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080">QQ钱包代收款会员包月到期时间：<?PHP ECHO $userrow['qqpay_date']>$date?$userrow['qqpay_date']:'QQ钱包已到期';?> (<a href="payapi.php?WIDtotal_fee=<?=$conf['qqpay_date']?>&WIDsubject=QQ钱包代收款|<?=$Query_pid?>" onclick="if(!confirm('QQ钱包代收款每月<?=$conf['qqpay_money']?>元'))return false;"><?=$conf['qqpay_money']?>元开通/续费①月</a>)</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><a class="btn btn-block btn-info" href="#" data-toggle="modal" data-target="#qqsmModal" id="qqsmModal">QQ钱包代收款首次必看</a></font></td>
		</tr>
		</tbody>
		</table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------QQ钱包代收款 结束------------------------------------------------------------>



<!---------------------------------------------------邀请注册奖励兑换 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="YYzcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">邀请注册奖励兑换</h4>
      </div>
<script type="text/javascript">
function duihuan(e){
		  	var d = $(e).val();
		  	var ii = layer.load(2, {shade:[0.1,'#fff']});
		  	$.ajax({
				type : "POST",
				url : "index.php?act=duihuan",
				data : {"duihuan":d},
				dataType : 'json',
				success : function(data) {					  
					  layer.close(ii);
				layer.alert(data.msg);
				},
				error:function(data){
					layer.close(ii);
					layer.msg('服务器错误');
					}
			});
		  	
}
</script>
<!---------------------------------------------------邀请注册奖励兑换 结束------------------------------------------------------------>

      <div class="modal-body">
<div class="panel panel-primary">
	  <table class="table table-bordered">
		<tbody>
		<tr>
			<td align="center"><font color="#808080">当前积分(成功邀请1人注册得1积分)：</font></td>
		</tr>
			
		<tr>
			<td align="center"><font color="#808080"><?=$userrow['integral']?></font></td>
		</tr>
		
		<tr>
			<td align="center"><font color="#808080">邀请注册链接：<?php echo short_url($siteurl.'reg.php?uid='.$Query_pid);?></font></td>
		</tr>
		
		<tr>
			<td align="center"><div class="form-group">
		<label>选择兑换奖励:</label><br></label><br><select class="form-control" name="duihuan"  id="duihuan" onchange="duihuan(this);">
		<option value="1">0_请选择要兑换的奖励</option>
		<option value="1">1_1000额度(5积分)</option>
		<option value="2">2_支付宝代收款(20积分/月)</option>
		<option value="3">3_微信代收款(20积分/月)</option>
		<option value="4">4_QQ钱包代收款(20积分/月)</option>
		</select>
		</div>
			</td>
		</tr>
		</tbody>
		</table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------注册奖励兑换 结束------------------------------------------------------------>


 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
<div class="bg-light lter b-b wrapper-md hidden-print"> <marquee scrollamount="8" direction="left" align="Middle" style="font-weight: bold;line-height: 20px;font-size: 20px;color: #FF0000;">您遇到问题可以联系我们的官方QQ群：<?php echo $conf['qqun']?> 感谢您的使用。</marquee></div></small>
</div>
                    <div class="wrapper">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel b-a">
                                <div class="panel-heading bg-info dk no-border wrapper-lg"></div>
                                <div class="text-center m-b clearfix">
                                    <div class="thumb-lg avatar m-t-n-xl">
                                        <img alt="image" class="b b-3x b-white" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $Query['qq']?>&spec=100">
                                    </div>
                                    <div class="h4 font-thin m-t-sm"><?php echo $Query['qq']?></div>
                                    <span class="text-muted text-xs block">商户ID:<?php echo $Query_pid?></span>
                                </div>
                                  <li class="list-group-item">
                                    <span class="badge bg-info"><?php echo $Query_key?></span>
                                    <i class="fa fa-asterisk fa-fw text-muted"></i> 商户密钥</li>
                                <li class="list-group-item">
                                    <span class="badge bg-info"><a href="payapi.php?WIDtotal_fee=10&WIDsubject=充值额度|<?=$Query_pid?>|<?=$Query_key?>" class="badge btn-danger btn-xs" onclick="if(!confirm('10元=3000额度'))return false;">充值额度</a></span>
                                    <i class="fa fa-jpy fa-fw text-muted"></i> 
                                    可用额度：<?php echo $Query['paymb']?>￥
                                  </a>
                                  <li class="list-group-item">
                                    <span class="badge bg-info"><a href="#" class="badge btn-danger btn-xs" data-toggle="modal" data-target="#YYzcModal" id="YYzcModal">兑换奖励</a></span>
                                    <i class="fa fa-asterisk fa-fw text-muted"></i> 邀请注册链接：<?php echo short_url($siteurl.'reg.php?uid='.$Query_pid);?></li>
                                  <li class="list-group-item">
                                  <?php if(empty($userrow['social_uid'])){?>
                                  <span class="badge bg-info"><a href="social.php" class="badge btn-danger btn-xs" target="_blank">QQ快捷登录</a></span>
                                  <i class="fa fa-asterisk fa-fw text-muted"></i> 账号绑定</li>
                                  <?php }else{?>
                                  QQ快捷登录:<?php echo $userrow['nickname']?>&nbsp;<span class="badge bg-info"><a href="social.php?unbind=true" class="badge btn-danger btn-xs" onclick="return confirm('解绑后将无法通过QQ一键登录，是否确定解绑？');">解绑账号</a></span>
                                  <?php }?>
                                  <li class="list-group-item">
                                  <?php if(empty($userrow['alipay_uid'])){?>
                                  <span class="badge bg-info"><a href="alipaylogin.php" class="badge btn-danger btn-xs" target="_blank">支付宝快捷登录</a></span>
                                  <i class="fa fa-asterisk fa-fw text-muted"></i> 账号绑定</li>
                                  <?php }else{?>
                                  支付宝快捷登录:<?php echo $userrow['alipay_uid']?>&nbsp;<span class="badge bg-info"><a href="alipaylogin.php" class="badge btn-danger btn-xs" onclick="return confirm('和支付宝绑定的代收款支付宝账号同步,更换也就是更换支付宝的代收账号，确定换绑？');">换绑</a></span>
                                  <?php }?>
                                  </li>
                                </ul>
                                    
                                <div class="btn-group btn-group-justified">
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#alipayModal" id="alipayModal">支付宝代收款</a>
									<a class="btn btn-info" href="#" data-toggle="modal" data-target="#wxpayModal" id="wxpayModal">微信代收款</a>
									<a class="btn btn-success" href="#" data-toggle="modal" data-target="#qqpayModal" id="qqpayModal">QQ钱包代收款</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading font-bold">最新公告</div>
                                <div class="panel-body">
                                
								<a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>代收款用户注意：绑定的收款账号必须实名,否则很可能不到账；</a>
								<!--a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>官方QQ群：---客服QQ：<?php echo $conf['qq']?>------有问题请联系我们。</a-->
								   </div>                         
								</div>  
	  <div class="panel panel-primary">
	  <table class="table table-bordered">
		<tbody>
		<tr>
		<?php
if($userrow['alipay_date']>$date && $userrow['is_alipay']){
		$alipay=$userrow['alipay_uid']?true:false;
	}else{
		$alipay=strpos($Query['login'],'alipay')?true:false;
	}
	if($userrow['wxpay_date']>$date && $userrow['is_wxpay']){
		$wxpay=$userrow['is_wxpay']?true:false;
	}else{
		$wxpay=strpos($Query['login'],'wxpay')?true:false;
	}
	if($userrow['qqpay_date']>$date && $userrow['is_qqpay']){
		$qqpay=$userrow['alipay_uid']?true:false;
	}else{
		$qqpay=strpos($Query['login'],'qqpay')?true:false;
}		
		?>
			<td align="center"><font color="#808080">支付宝通道：<?php echo $alipay?'√':'X';?></i></font></td>
			<td align="center"><font color="#808080">QQ钱包通道：<?php echo $qqpay?'√':'X';?></font></td>
			<td align="center"><font color="#808080">微  信通道：<?php echo $wxpay?'√':'X';?></font></td>
		</tr>
		</tbody>
		</table>
      </div>
								 <div class="panel panel-info">
        <div class="panel-heading"><h3 class="panel-title">在线测试（使用当前登录的商户进行测试）</h3></div>
		<div class="panel-body">
        <form name="alipayment" action="./SDK/epayapi.php" method="post" target="_blank">
		  <div class="form-group">
			<div class="input-group"><div class="input-group-addon">商品名称</div>
			<input type="text" name="WIDsubject" value="测试商品" class="form-control" required/>
		  </div></div>
		  <div class="form-group">
			<div class="input-group"><div class="input-group-addon">付款金额</div>
			<input type="text" name="WIDtotal_fee" value="1.00" class="form-control" required/>
		  </div></div>
		  <dd>
          <label><input type="radio" name="type" value="alipay" checked=""><img src="/assets/img/alipay.gif" style="max-width: 47.5%;display:inline-block;vertical-align:middle;" title="支付宝"/></label>&nbsp;<label><input type="radio" name="type" value="qqpay"><img src="/assets/img/qqpay.jpg" style="max-width: 47.5%;display:inline-block;vertical-align:middle;" title="QQ钱包"/></label>&nbsp;<label><input type="radio" name="type" value="wxpay"><img src="/assets/img/weixin.gif" style="max-width: 47.5%;display:inline-block;vertical-align:middle;" title="微信支付"/></label>
          </dd>
					<button class="btn btn-block btn-info" type="submit">确 认</button>
	    </form>
		</div>
      </div>
		</div>
<?php 
$rs=$DB->query("SELECT * from pay_settle WHERE qq='{$Query['qq']}' or alipay_uid='{$userrow['alipay_uid']}'");
$settle_i=0;
$settle_money=0;
while($row = $rs->fetch())
{
	$settle_i++;
	$settle_money+=$row['money'];
}?>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading font-bold">用户数据统计</div>
                                <div class="panel-body text-center">
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-primary item">
                                            <span class="text-white font-thin h1 block"><?php echo $settle_i?>个</span>
                                            <span class="text-muted text-xs">代收款结算订单</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-info item">
                                            <span class="text-white font-thin h1 block">￥<?php echo $settle_money?></span>
                                            <span class="text-muted text-xs">代收款总金额</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-success item">
                                            <span class="text-white font-thin h1 block"><?php echo $jOrdersnums?>个</span>
                                            <span class="text-muted text-xs">今日订单</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-dark item">
                                            <span class="text-white font-thin h1 block"><?php echo $zOrdersnums?></span>
                                            <span class="text-muted text-xs">昨日订单</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-info item">
                                            <span class="text-white font-thin h1 block">￥<?php echo $jOmoneynums?></span>
                                            <span class="text-muted text-xs">今日收入</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="block panel padder-v bg-primary item">
                                            <span class="text-white font-thin h1 block">￥<?php echo $zOmoneynums?></span>
                                            <span class="text-muted text-xs">昨日收入</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading font-bold">代收款结算记录&nbsp;(<?php 
$numrows=$DB->query("SELECT * from pay_settle WHERE qq='{$Query['qq']}' or qq='{$userrow['alipay_uid']}'")->rowCount();echo $numrows?>)</div>
                                <div class="panel-body text-center">
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
          <thead><tr><th>结算订单</th><th>收款方式</th><th>商户QQ号</th><th>结算账号</th><th>结算金额</th><th>结算时间</th><th>状态</th></tr></thead><tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);
function status_zt($zt,$nums){
	if($zt==1)
		return '<font color=green>实时结算成功</font>';
	elseif($zt==2 or $nums>=3)
		return '<font color=red>实时结算失败</font>';
	else
		return '<font color=6600ff>系统未结算</font>';
}
$list=$DB->query("SELECT * FROM pay_settle WHERE qq='{$Query['qq']}' or alipay_uid='{$userrow['alipay_uid']}' order by id desc limit $offset,$pagesize");
while($res = $list->fetch())
{
	echo '<tr><td>'.$res['id'].'</td><td>'.$res['type'].'</td><td>'.$res['qq'].'</td><td>'.$res['alipay_uid'].'</td><td>￥ <b>'.$res['money'].'</b></td><td>'.$res['endtime'].'</td><td>'.status_zt($res['status']).'</td></tr>';
}
?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="" class="btn btn-default btn-sm">显示最新TOP30</a>
                        </div>
                    </div>
                </div>
            </div>
<?php include './foot.php';?>