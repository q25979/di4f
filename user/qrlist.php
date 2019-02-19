<?php
$title='二维码列表';
include './head.php';
?>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">修改资料</h1>
</div>
<div class="wrapper-md control">
<div class="alert alert-info">
请去除二维码的边框后再上传哟!
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
		<form action="./qrlist.php?my=add_submit" method="post" enctype="multipart/form-data">
<div class="form-group">
<label>选择二维码:</label><span class="glyphicon glyphicon-qrcode"></span>
<label for="file"></label><input type="file" name="file" id="file"/>
</div>
<div class="form-group">
<label>支付类型:</label><br><select class="form-control" name="type"><option value="wxpay">微信</option><option value="alipay">支付宝</option><option value="qqpay">QQ钱包</option></select>
</div>
<div class="form-group">
<label>二维码金额(每种支付方式都要有一张通用二维码):</label><br>
<input type="text" class="form-control" name="money" value="" placeholder="留空则是通用二维码">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
echo '<br/><a href="./qrlist.php">>>返回二维码列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$type=$_POST['type'];
$money=number_format((float)daddslashes($_POST['money']), 2, '.', '');
$money=$money>0?$money:'index';
$extension=explode('.',$_FILES['file']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
if($ext=='png'||$ext=='gif'||$ext=='jpg'||$ext=='jpeg'||$ext=='bmp')$ext='png';
copy($_FILES['file']['tmp_name'], ROOT.'qrcode/'.$Query_pid.'_'.$type.'_'.$money.'.'.$ext);
	$qrcode_url='/qrcode/'.$Query_pid.'_'.$type.'_'.$money.'.'.$ext;
if(/*qrcode('http://'.$_SERVER['HTTP_HOST'].$qrcode_url)*/!file_exists($qrcode_url)){
	$DB->exec("INSERT INTO `pay_qrcode` (`pid`, `qrcode_url`, `type`, `money`, `addtime`) VALUES ('{$Query_pid}', '{$qrcode_url}', '{$type}', '{$money}', '{$date}')");
	exit("<script language='javascript'>alert('成功上传二维码，请确定你的二维码已经去除边框了,否则用户们无法支付，如果没有去除,请删除了重新上传!');location.href='./qrlist.php'</script>");	
}else{
	exit("<script language='javascript'>alert('上传二维码失败,解码二维码不成功(原因:边框过大，识别不出二维码，请剪接里面的二维码出来再上传)!');location.href='./qrlist.php'</script>");
}
}
elseif($my=='delete')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_qrcode where id='$id' limit 1")->fetch();
if(!$rows)
	showmsg('当前记录不存在！',3);
$sql="DELETE FROM pay_qrcode WHERE id='$id' and pid='$Query_pid' limit 1";
if($DB->exec($sql)){
	unlink(ROOT.$rows['qrcode_url']);
	showmsg('删除二维码成功！<br/><br/><a href="./qrlist.php">>>返回二维码列表</a>',1);
		}else{
	showmsg('删除二维码失败！'.$DB->errorCode(),4);
	}
}
else
{

echo '


';

if($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}' and pid='{$Query_pid}'";
	$numrows=$DB->query("SELECT * from pay_qrcode WHERE{$sql}")->rowCount();
	$con='包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 个二维码';
	$link='&my=search&column='.$_GET['column'].'&value='.$_GET['value'];
}else{
	$sql="`pid`='{$Query_pid}'";
	$numrows=$DB->query("SELECT * from pay_qrcode WHERE {$sql}")->rowCount();
	$con='共有 <b>'.$numrows.'</b> 个二维码';
}
echo $con;
?> 
<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">二维码列表</h1>
</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			二维码列表&nbsp;
		</div>
	  <div class="row wrapper">
	    <div class="col-sm-5 m-b-xs">
	      <form action="qrlist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
	        <div class="form-group">
			<select class="input-sm form-control" name="column">
			  <option value="type">类型</option>
			  <option value="money">金额</option>
			</select>
		    </div>
			<div class="form-group">
			  <input type="text" class="input-sm form-control" name="value" placeholder="搜索内容">
			</div>
			 <div class="form-group">
				<button class="btn btn-sm btn-default" type="submit">搜索</button>&nbsp;<a href="./qrlist.php?my=add" class="btn btn-success">添加二维码</a>
			 </div>
		  </form>
		</div>
      </div>
		<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>二维码地址</th><th>支付方式</th><th>金额</th><th>添加时间</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM pay_qrcode WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr>
<td>http://'.$_SERVER['HTTP_HOST'].$res['qrcode_url'].'</td>
<td>'.($res['type']=='wxpay'?'微信':($res['type']=='alipay'?'支付宝':'QQ钱包')).'</td>
<td>'.($res['money']>0?$res['money']:'通用').'</td>
<td>'.$res['addtime'].'</td>
<td><a href="./qrlist.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此二维码吗？\');">删除</a></td>
</tr>';
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
echo '<li><a href="qrlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="qrlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="qrlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="qrlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="qrlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="qrlist.php?page='.$last.$link.'">尾页</a></li>';
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
<?php include './foot.php';?>