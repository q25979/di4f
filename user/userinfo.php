<?php
$title='资料设置';
include 'head.php';
?>
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod=='user_n'){
	$key=daddslashes($_POST['key']);
	$qq=daddslashes($_POST['qq']);
	$outtime=daddslashes($_POST['outtime']);
	$repeat=daddslashes($_POST['repeat']);
	if(!$key or !$qq or !$outtime or !$repeat){
		echo'<script>alert("key.qq不能为空!");location.href="?"</script>';
	}else{
		$Query = $Instant_Api->Change($key,$qq,$outtime,$repeat);
		if($Query['code']==1){
		$Instant_Api->Query($Query_pid,$key,1);
		echo'<script>alert("修改成功，如果你正在挂软件,修改了key，需要请重登录软件，否则无法同步数据!");location.href="./"</script>';
		}else{
		echo'<script>alert("修改失败:'.$Query['msg'].'!");location.href="?"</script>';
		}
	}
}elseif($mod=='user'){
?>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">修改资料</h1>
</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			基本资料
		</div>
		<div class="panel-body">
			<form class="form-horizontal devform" action="./userinfo.php?mod=user_n" method="post">
				<h4>商户信息查看：</h4>
				<div class="form-group">
					<label class="col-sm-2 control-label">商户ID</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" value="<?php echo $Query_pid?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">商户密钥</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="key" value="<?php echo $Query_key?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ＱＱ账号</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="qq" value="<?php echo $Query['qq']?>">
					</div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<h4>支付设置：</h4>
				<div class="form-group">
					<label class="col-sm-2 control-label">防刷单模式</label>
					<div class="col-sm-9">
					<select class="form-control" name="repeat"><?php if($Query['repeat']==1){?>
	<option value="1">1_开启</option><option value="2">2_关闭</option><?php }else{?><option value="2">2_关闭</option><option value="1">1_开启</option><?php }?></select>
	<pre><font color="green">防刷单模式说明:防刷单就是比如关闭防刷单模式，那么我提交0.1金额系统就会记录一条订单 ，我提交0.2系统也会记录成新的一条订单，那么其他用户支付0.01或者0.2都会提高0.01的金额，坏处是刷金额提升，好处是可以同时支付那些提交的订单，开启则在原来还没有失效的订单上修改信息，好处是不会刷金额的提升，坏处就是每次只能付款一条订单</font></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">订单有效时间(单位:秒)</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="outtime" value="<?php echo $Query['outtime']?>">
					</div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="submit" name="submit" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group">
					<label class="col-sm-2"></label>
					<div class="col-sm-6">
					<!--h4><span class="glyphicon glyphicon-info-sign"></span>注意事项</h4>
						1.支付宝账户和支付宝真实姓名请仔细核对，一旦错误将无法结算到账！<br/>2.每笔交易会有<?php echo (100-$conf['money_rate'])?>%的手续费，即用户支付100元，实际到账<?php //echo $conf['money_rate']?>元。<br/>3.结算是通过支付宝进行结算，每天满<?php //echo $conf['settle_money']?>元第二天自动结算<br/>4.如有问题请联系客服QQ<?php //echo $conf['web_qq']?>
					</div-->
				</div>
			</form>
		</div>
	</div>
</div>
    </div>
  </div>
<?php
}elseif($mod=='pay_n'){
	$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$Query_pid}' limit 1")->fetch();
	$pay_gg=daddslashes(strip_tags($_POST['pay_gg']));
	$soft_name=daddslashes(strip_tags($_POST['soft_name']));
	if($pay_gg==null||$soft_name==null){
		exit("<script language='javascript'>alert('请确保各项不能为空');history.go(-1);</script>");
	}else{
		$sds=$DB->query("update pay_user set pay_gg='$pay_gg',soft_name='$soft_name' where pid='{$Query_pid}'");
		if($sds)exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
		else exit("<script language='javascript'>alert('修改保存失败:".$DB->error()."');history.go(-1);</script>");
	}
}elseif($mod=='pay'){
?>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">支付设置</h1>
</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			支付设置
		</div>
		<div class="panel-body">
			<form class="form-horizontal devform" action="./userinfo.php?mod=pay_n" method="post">
				<h4>支付设置</h4>
				<div class="form-group">
					<label class="col-sm-2 control-label">支付页面公告</label>
					<div class="col-sm-9">
						<textarea class="form-control" name="pay_gg" rows="6"><?php echo htmlspecialchars($userrow['pay_gg']);?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">辅助软件名称</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="soft_name" value="<?php echo $userrow['soft_name']?>">
					</div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="submit" name="submit" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group">
					<label class="col-sm-2"></label>
					<div class="col-sm-6">
					<!--h4><span class="glyphicon glyphicon-info-sign"></span>注意事项</h4>
						1.支付宝账户和支付宝真实姓名请仔细核对，一旦错误将无法结算到账！<br/>2.每笔交易会有<?php echo (100-$conf['money_rate'])?>%的手续费，即用户支付100元，实际到账<?php //echo $conf['money_rate']?>元。<br/>3.结算是通过支付宝进行结算，每天满<?php //echo $conf['settle_money']?>元第二天自动结算<br/>4.如有问题请联系客服QQ<?php //echo $conf['web_qq']?>
					</div-->
				</div>
			</form>
		</div>
	</div>
</div>
    </div>
  </div>
<?php } ?>
<?php include 'foot.php';?>