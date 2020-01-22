<?php include('system/inc.php');
error_reporting(0);
header('Content-Type:text/html;charset=UTF-8');
if(empty($_GET['page'])){
	$_GET['page']='1';
}
if (empty($_GET['cid'])) {
	$cxurl = $mkcms_cxzy;
    $url = $cxurl."?p=".$_GET['page'];
} else {
	$cxurl = $mkcms_cxzy."?cid=".$_GET["cid"];
	$url = $mkcms_cxzy."?p=".$_GET['page']."&cid=".$_GET['cid'];
}

$list=json_decode(file_get_contents($cxurl),true);
$data=json_decode(file_get_contents($url),true);
$recordcount = $data['page']['recordcount'];
$pagesize = $data['page']['pagesize'];
include('template/'.$mkcms_bdyun.'/cx.php');?>