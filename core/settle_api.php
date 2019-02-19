<?php
require '../core/common.php';
$act=isset($_GET['act'])?$_GET['act']:null;
if($act=='settle')
{
	$limit=1;
			$rs=$DB->query("SELECT * FROM pay_settle WHERE status='0' and nums<='3' order by id asc limit {$limit}");
			while($row=$rs->fetch()){
				if($row['type']=='qqpay' or $row['type']='wxpay'){
					if($row['type']!='alipay'){
				$DB->exec("update `pay_settle` set `nums`=`nums`+'1' where id='{$row['id']}' limit 1");
			$result=array("id"=>$row['id'],"alipay_uid"=>$row['alipay_uid'],"qq"=>$row['qq'],"money"=>$row['money'],"bz"=>$row['bz']);
					}
				}
			}
}
elseif($act=='status')
{
	$id=$_GET['id'];
$DB->exec("update `pay_settle` set `status`='1',`endtime`='{$date}' where id='{$id}' limit 1");
}
/*elseif($act=='add')
{
	$qq=$_GET['qq']?$_GET['qq']:272341207;
	$money=$_GET['money']?$_GET['money']:0.1;
	$bz=$_GET['bz']?$_GET['bz']:'零度即时到账结算';
	$type=$_GET['type']?$_GET['bz']:'qqpay';
	$sds=$DB->exec("INSERT INTO `pay_settle` (`qq`, `money`, `bz`, `type`, `addtime`) VALUES ('{$qq}', '{$money}', '{$bz}', '{$type}', '{$date}')");
	if($sds){
		$result=array("code"=>1,"msg"=>"添加结算信息成功!");
	}else{
		$result=array("code"=>-1,"msg"=>"添加结算信息失败!");
	}
}*/
else
{
	$result=array("code"=>-5,"msg"=>"No Act!");
}

echo json_encode($result);

?>