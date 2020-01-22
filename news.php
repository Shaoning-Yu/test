<?php include('system/inc.php');
$page=$_GET['page'];
if (empty($page)){$page=1;}//页数 
$seach='http://www.1905.com/list-p-catid-220.html?page='.$page;
$rurl = fileget($seach,5);
$szz='#<a data-hrefexp="fr=wwwnews_newslist_news_([0-9]+)_201504" href="https://www.1905.com/news/([0-9]+)/([0-9]+).shtml" target="_blank" class="pic-url">[\s]+?<img src="(.*)" alt="(.*)" >[\s]+?</a>#';
$szz1='#<p>(.*)</p>#';
$sj='#<div class="rel-other clear"><span class="timer fl">(.*)</span>#';
preg_match_all($szz,$rurl,$sarr);
preg_match_all($szz1,$rurl,$sarr1);
preg_match_all($sj,$rurl,$sarr2);
$one=$sarr[5];//标题
$one1=$sarr[2];//地址
$one2=$sarr[3];//地址
$one3=$sarr[4];//图片
$nr=$sarr1[1];//内容
$sj=$sarr2[1];//时间
include('template/'.$mkcms_bdyun.'/news.php');?>