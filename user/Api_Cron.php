<?php
require '../core/common.php';
if($_GET['pid']){
$Query = $Instant_Api->Find($_GET['pid']);//同步终端的用户数据
$Query_encode = base64_encode(json_encode($Query));
$DB->query("update `pay_user` set `_Query` ='{$Query_encode}' where `pid`='{$_GET['pid']}'");
}else{
$Query = $Instant_Api->Query();//同步终端的用户数据
$Query_encode = base64_encode(json_encode($Query));
$DB->query("update `pay_user` set `_Query` ='{$Query_encode}' where `pid`='{$Query_pid}'");

$Orders = $Instant_Api->Orders(999);//同步终端的订单数据
$Orders_encode = base64_encode(json_encode($Orders));
$DB->query("update `pay_user` set `_Orders` ='{$Orders_encode}' where `pid`='{$Query_pid}'");
}

exit($date);
