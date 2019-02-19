<?php
require '../core/common.php';

$money = number_format((float)$_GET['money'], 2, '.', ''); //金额统一保留2位小数
$pid  = $_GET['pid'];
$type  = $_GET['type'];
if (!$type) $type = 'alipay';
if ($money <= 0) {//这是什么状况 金额都没有。展示no.png
    header('Location: ../qrcode/no.png');
    exit(0);
}

function moneyToFileName($pid, $money, $type)
{	
	$file_txt = "../qrcode/{$pid}_{$type}_{$money}.txt";
	$file_png = "../qrcode/{$pid}_{$type}_{$money}.png";
	
	$index_txt = "../qrcode/{$pid}_{$type}_index.txt";
    $index_png = "../qrcode/{$pid}_{$type}_index.png";
	
	if(file_exists($file_txt)&&strpos(get_curl('http://'.$_SERVER['HTTP_HOST'].'/'.$file_txt),'//')&&$type!='qqpay'){
		$file="http://api.k780.com:88/?app=qr.get&data=".get_curl('http://'.$_SERVER['HTTP_HOST'].'/'.$file_txt)."&level=L&size=10";
		
	}elseif(file_exists($file_png)){
		$qrcode_filename=$file_png;
		
	}elseif(file_exists($index_txt)&&strpos(get_curl('http://'.$_SERVER['HTTP_HOST'].'/'.$index_txt),'//')&&$type!='qqpay'){
		$qrcode_filename="http://api.k780.com:88/?app=qr.get&data=".get_curl('http://'.$_SERVER['HTTP_HOST'].'/'.$index_txt)."&level=L&size=10";
		
	}elseif(file_exists($index_png)){
		$qrcode_filename=$index_png;
		
	}else{
		$qrcode_filename='../qrcode/no.png';
	}
    return $qrcode_filename;
}


$qrcode_filename = moneyToFileName($pid,$money, $type);

header('Location: ' . $qrcode_filename); //跳转到二维码真实地址