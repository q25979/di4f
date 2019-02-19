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
if(!$my)
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">管理包月</h3></div>';
echo '<div class="panel-body">';
echo '<form action="?my=edit_submit" method="POST">
<div class="form-group">
<label>商户ID:</label><br>
<input type="text" class="form-control" name="pid" value="" placeholder="请填写要充值的商户id">
</div>
<div class="form-group">
<label>商户密钥:</label><br>
<input type="text" class="form-control" name="key" value="" placeholder="请填写要充值的商户密钥">
</div>
<div class="form-group">
<label>充值的额度:</label><br>
<input type="text" class="form-control" name="mb" value="" placeholder="请输入要充值的额度数量">
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定充值"></form>
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
$pid=$_POST['pid'];
$rows=$DB->query("select * from pay_user where pid='$pid' limit 1")->fetch();
if(!$rows)
	showmsg('此商户id不存在！',3);
$key=$_POST['key'];
$mb=$_POST['mb'];

if($mb==NULL && $pid==NULL && $key==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
if($Instant_Api->Paymb($mb,$pid,$key)['code']==1)
	showmsg('充值'.$mb.'额度成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('额度充值失败！'.$DB->errorCode(),4);
}
}
?>
    </div>
  </div>