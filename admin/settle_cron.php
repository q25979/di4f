<?php
require '../core/common.php';
$act=isset($_GET['act'])?$_GET['act']:null;
if($act=='settle')
{
	$limit=1;
	$rs=$DB->query("SELECT * FROM pay_settle WHERE status='0' and nums<='3' order by id asc limit {$limit}");
	while($row=$rs->fetch()){
			transferToAlipay($row['id'], $row['alipay_uid'], $row['money'],$row['bz']);
			$result=array("id"=>$row['id'],"alipay_uid"=>$row['alipay_uid'],"qq"=>$row['qq'],"money"=>$row['money'],"bz"=>$row['bz']);
	}
}

echo json_encode($result);

?>