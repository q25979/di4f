<?php
/**
 * 结算列表
**/
include("../core/common.php");
$title='结算列表';
if($conf['zid']!=1)sysmsg("<h4>你一个分站还想上天?想获取更高的权限，请联系主站管理员开启...</h4>",true);
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if($conf['zid']!=1)sysmsg('<h2>你一个分站还想上天，想获取更高的权限，请联系主站管理员开启...<br/>',true);
?>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">删除指定结算支付宝ID或者QQ旗下的所有结算记录</h4>
      </div>
      <div class="modal-body">
      <form action="slistlist.php" method="GET">
<input type="text" class="form-control" name="zhanghao" placeholder="请输入支付宝ID或者QQ号"><br/>
<input type="submit" class="btn btn-primary btn-block" value="清空"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

echo '<form action="slistlist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="id">订单号</option><option value="type">结算方式</option><option value="qq">结算账号</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>&nbsp;<a href="./slistlist.php?my=yijianwc" class="btn btn-info btn-xs" onclick="return confirm(\'一键完成就是改变所有结算订单为已完成状态,你确定继续操作吗？\');">一键完成</a>&nbsp;<a href="./slistlist.php?my=yijianbjs" class="btn btn-info btn-xs" onclick="return confirm(\'一键补结算就是把所有结算失败的订单改为未结算状态，这样系统会自动重新补结算,你确定继续操作吗？\');">一键补结算</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">删除指定结算支付宝ID或者QQ旗下的所有结算记录</a>
</form>';

if ($_GET['zhanghao']) {
    $zhanghao = $_GET['zhanghao'];
	$sql = "DELETE FROM pay_settle WHERE alipay_uid='{$zhanghao}' or  qq='{$zhanghao}'";
    if ($DB->query($sql)) {
        showmsg('清空指定结算支付宝ID或者QQ旗下的所有结算记录成功！<br/><br/><a href="./slistlist.php">>>返回列表</a>', 1);
    } else {
        showmsg('清空失败！' . $DB->error(), 4);
    }
} elseif($my=='yijianwc') {
	$DB->query("update `pay_settle` set `status` ='1',`nums` ='0'");
	exit("<script language='javascript'>alert('一键改变已结算完成状态成功');window.location.href='./slistlist.php';</script>");
}elseif($my=='yijianbjs') {
	$DB->query("update `pay_settle` set `status` ='0',`nums` ='0' where `status`='2' or `nums`='4'");
	exit("<script language='javascript'>alert('一键补结算成功');window.location.href='./slistlist.php';</script>");
}elseif($my=='status') {
	$DB->query("update `pay_settle` set `status` ='1',`nums` ='0' where `id`='{$_GET['id']}'");
	exit("<script language='javascript'>alert('修改状态成功');window.location.href='./slistlist.php';</script>");
}elseif($my=='budan') {
	$DB->query("update `pay_settle` set `status` ='0',`nums` ='0' where `id`='{$_GET['id']}'");
	exit("<script language='javascript'>alert('补单成功');window.location.href='./slistlist.php';</script>");
}elseif($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from pay_settle WHERE{$sql}")->rowCount();
	$status=$DB->query("SELECT * from pay_settle WHERE status='1'")->rowCount();
	$rs=$DB->query("SELECT * from pay_settle WHERE {$sql} and status='0' or nums>=3");
	$money=0;
	while($row = $rs->fetch())
	{
		$money+=$row['money'];
	}
	$con='包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 条记录,结算的有'.$status.'条订单,未结算的有'.$money.'元';
}else{
	$numrows=$DB->query("SELECT * from pay_settle")->rowCount();
	$status=$DB->query("SELECT * from pay_settle WHERE status='1'")->rowCount();
	$rs=$DB->query("SELECT * from pay_settle WHERE status='0' or nums>=3");
	$money=0;
	while($row = $rs->fetch())
	{
		$money+=$row['money'];
	}
	$sql="1";
	$con='共有 <b>'.$numrows.'</b> 条记录,结算的有'.$status.'条订单,未结算的有'.$money.'元';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>结算订单号</th><th>商户QQ</th><th>结算方式</th><th>结算账户</th><th>结算金额</th><th>创建时间</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
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
$rs=$DB->query("SELECT * FROM pay_settle WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr>
<td><b>'.$res['id'].'</b></td>
<td>'.$res['qq'].'</td>
<td>'.$res['type'].'</td>
<td>'.$res['alipay_uid'].'</td>
<td>￥<b>'.$res['money'].'</b></td>
<td>'.$res['addtime'].'</td>
<td>'.status_zt($res['status'],$res['nums']).'</td>';
echo '<td><a href="./slistlist.php?my=status&id='.$res['id'].'" class="btn btn-info btn-xs">完成</a>&nbsp;<a href="./slistlist.php?my=budan&id='.$res['id'].'" class="btn btn-info btn-xs" onclick="return confirm(\'补单就是系统再次发送提交结算数据,你确定继续操作吗？\');">补单</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="slistlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="slistlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="slistlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="slistlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="slistlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="slistlist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>