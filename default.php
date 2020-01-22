<?php include('system/inc.php');
if(!file_exists('./install/install.lock')){
header('location:/install/');
}
$url = $mkcms_cxzy."?p=".$_GET['page'];
$data=json_decode(file_get_contents($url),true);
$recordcount = $data['page']['recordcount'];
$pagesize = $data['page']['pagesize'];
$surl='https://youku.com/';
$rurl=fileget2($surl,5);
$szz1='#<div class="swiper-slide"><a data-scm="(.*?)" data-spm="(.*?)" data-name="a_pos" href="(.*?)" target="_blank" title="(.*?)">#';
$szz2='#class="focusswiper_focus_item" style="position:relative;background-image:url\((.*?)\);background-color:(.*?)">#';
$szz3='#<div class="sub_title focusswiper_sub_title">(.*?)</div>#';
preg_match_all($szz1,$rurl,$sarr1);
preg_match_all($szz2,$rurl,$sarr2);
preg_match_all($szz3,$rurl,$sarr3);
$one=$sarr1[4];//链接
$two=$sarr2[1];//图片
$three=$sarr3[1];//简介
include('template/'.$mkcms_bdyun.'/index.php');?>