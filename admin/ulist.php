<?php
/**
 * 商户列表
**/
include("../core/common.php");
$title='商户列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='edit')
{
$pid=$_GET['pid'];
$row=$DB->query("select * from pay_user where pid='$pid' limit 1")->fetch();
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">管理包月</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=edit_submit&pid='.$pid.'" method="POST">
<div class="form-group">
<label>支付宝包月:</label><br>
<input type="date" class="form-control" name="alipay_date" value="'.$row['alipay_date'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>QQ钱包包月:</label><br>
<input type="date" class="form-control" name="qqpay_date" value="'.$row['qqpay_date'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>微信包月:</label><br>
<input type="date" class="form-control" name="wxpay_date" value="'.$row['wxpay_date'].'" placeholder="可留空">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./ulist.php">>>返回商户列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
}
elseif($my=='edit_submit')
{
$pid=$_GET['pid'];
$rows=$DB->query("select * from pay_user where pid='$pid' limit 1")->fetch();
if(!$rows)
	showmsg('当前记录不存在！',3);
$alipay_date=$_POST['alipay_date'];
$qqpay_date=$_POST['qqpay_date'];
$wxpay_date=$_POST['wxpay_date'];
if($alipay_date==NULL && $qqpay_date==NULL && $wxpay_date==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
$sql="update `pay_user` set `alipay_date` ='{$alipay_date}',`qqpay_date` ='{$qqpay_date}',`wxpay_date` ='{$wxpay_date}' where `pid`='$pid'";
if($DB->exec($sql)||$sqs)
	showmsg('修改商户信息成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('修改商户信息失败！'.$DB->errorCode(),4);
}
}
else
{

echo '<form action="ulist.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="pid">商户号</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>
  </div>
</form>';

if($my=='search'||$_GET['value']) {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from pay_user WHERE{$sql}")->rowCount();
	$con='包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 个商户';
}else{
	$numrows=$DB->query("SELECT * from pay_user WHERE 1")->rowCount();
	$sql=" 1";
	$con='登录前端的共有 <b>'.$numrows.'</b> 个商户';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>商户号</th><th>绑定QQ号</th><th>支付宝包月状态</th><th>QQ钱包包月状态</th><th>微信包月状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM pay_user WHERE{$sql} order by pid desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
$userrow=$DB->query("SELECT * FROM pay_user WHERE pid='{$res['pid']}' limit 1")->fetch();
$Query=json_decode(base64_decode($userrow['_Query']),true);
$Orders=json_decode(base64_decode($userrow['_Orders']),true);
echo '<tr>
<td><b>'.$res['pid'].'</b></td>
<td>'.($Query['qq']?'<font color=green>'.$Query['qq'].'</font>':'<font color=red>未绑定</font>').'</td>
<td>'.($res['alipay_date']>$date?'<font color=green>到期：'.$res['alipay_date'].'</font>':'<font color=red>已到期</font>').'</td>
<td>'.($res['qqpay_date']>$date?'<font color=green>到期：'.$res['qqpay_date'].'</font>':'<font color=red>已到期</font>').'</td>
<td>'.($res['wxpay_date']>$date?'<font color=green>到期：'.$res['wxpay_date'].'</font>':'<font color=red>已到期</font>').'</td>
<td><a href="./ulist.php?my=edit&pid='.$res['pid'].'" class="btn btn-xs btn-info">管理包月</a></td></tr>';
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
echo '<li><a href="ulist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="ulist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="ulist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="ulist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>