<?php
$title='订单记录';
include './head.php';
if($_GET['DO']=='Submit_status')
{
	$out_trade_no=$_GET['out_trade_no'];
	$trade_no=$_GET['trade_no'];
	$code=$Instant_Api->Submit_status($out_trade_no,$trade_no);
	if($code['code']==1){
		exit("<script language='javascript'>alert('补单成功!');location.href='./list.php'</script>");
	}else{
		exit("<script language='javascript'>alert('补单失败!');location.href='./list.php'</script>");	
	}
}
?>
<!---------------------------------------------------弹窗公告 开始------------------------------------------------------------>
<div class="modal fade" align="left" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
      </div>
      <div class="modal-body">
	  2018-03-02<br>
	  1.加入了自动补单功能，怎么个自动补单呢，说明如下：<br>
	  就是用户付款成功了，然后平台通知你的异步通知，寻找如果不见有“success”成功识标的话，系统每3分钟再次通知一次你的异步通知地址，直到成功返回“success”成功识标或者超出30分钟为止
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">我知道了</button>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
if( !$.cookie('zero_oop')){
	$('#myModal_1').modal({
		keyboard: true
	});
	var cookietime = new Date(); 
	cookietime.setTime(cookietime.getTime() + (10*60*1000));
	$.cookie('zero_oop', false, { expires: cookietime });
}
</script>
<!---------------------------------------------------弹窗公告 结束------------------------------------------------------------>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">订单记录</h1>
</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			订单记录&nbsp;
		</div>
	  <div class="row wrapper">
	    <div class="col-sm-5 m-b-xs">
	      <form action="order.php" method="GET" class="form-inline">
	        <div class="form-group">
			<select class="input-sm form-control" name="type">
			  <option value="1">交易号</option>
			  <option value="2">商户订单号</option>
			  <option value="3">商品名称</option>
			  <option value="4">商品金额</option>
			  <option value="5">支付方式</option>
			</select>
		    </div>
			<div class="form-group">
			  <input type="text" class="input-sm form-control" name="kw" placeholder="搜索内容">
			</div>
			 <div class="form-group">
				<button class="btn btn-sm btn-default" type="submit">搜索</button>
			 </div>
		  </form>
		</div>
      </div>
		<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>交易号/商户订单号</th><th>商品名称/用户ID</th><th>价格/付款金额</th><th>支付方式</th><th>创建时间/完成时间</th><th>状态/通知状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
function fs_status_zt($zt){
	if($zt==1)
		return '<font color=green>通知成功</font>';
	elseif($zt==2)
		return '<font color=red>通知失败</font>';
	else
		return '<font color=6600ff>还未通知</font>';
}
foreach($Orders['data'] as $res){
	echo '<tr>
	<td>'.$res['trade_no'].'<br/>'.$res['out_trade_no'].'</td>
	<td>'.$res['name'].'<br/>'.$res['pay_id'].'</td>
	<td>￥ <b>'.$res['price'].'<br/></b>￥<b> '.$res['money'].'</b></td>
	<td><b>'.$res['type'].'</b></td>
	<td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td>
	<td>'.($res['status']==1?'<font color=green>已付款</font>':'<font color=red>未付款</font>').'<br/>'.fs_status_zt($res['fs_status']).'</td>';
	echo '<td><a href="./order.php?DO=Submit_status&out_trade_no='.$res['out_trade_no'].'&trade_no='.$res['trade_no'].'" class="btn btn-info btn-xs" onclick="return confirm(\'补单就是系统再次发送数据到你的集成程序的异步通知地址去,你确定继续操作吗？\');">补单</a></td></tr>';
}
?>
		  </tbody>
        </table>
      </div>

	<footer class="panel-footer">
<?php
/*echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="order.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="order.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="order.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="order.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
*/?>
</footer>
	</div>
</div>
    </div>
  </div>

<?php include 'foot.php';?>