<?php  include 'head.php';
$cx='active';
$mjk=$mkcms_mjk;
$d_scontent=explode(',',$mkcms_shoufei);
$timu=$data['data'][0]['vod_name'];
for($i=0;$i<count($d_scontent);$i++)
{
if($timu==$d_scontent[$i]){
//提示错误值
alert_href('对不起,您观看的视频已经下架,请到官网观看.谢谢!',''.$mkcms_domain.'');
}
}?>
<title><?php echo $data['data'][0]['vod_name'];?>-正在播放-高清完整版抢先<?php echo $data['data'][0]['list_name'];?>免费在线观看-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $data['data'][0]['vod_name'];?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $data['data'][0]['vod_name'];?>,主要讲述<?php echo mb_substr(preg_replace("/<(.*?)>/si", "",$data['data'][0]['vod_content']),0,85,'utf-8').'...'; ?>">
<script type="text/javascript" src="/template/jingpin/js/mytheme-ui.js"></script>
<style type="text/css">
#timer{background: rgba(0, 0, 0, 0.59);padding: 5px;text-align: center;width: 30px;position: absolute;top: 5%;right: 2%;color: #fff;font-size: 16px;border-radius: 50%;height: 30px;line-height: 20px}
#xiang{background: rgba(177, 13, 13, 0.87);padding: 5px;text-align: center;width: auto;position: absolute;bottom: 2%;right: 1%;color: #fff;font-size: 16px;border-radius: 10px;height: 20px;line-height: 9px}
#ys,.jkbtn1{border: 1px solid #FF9900;background-color: #FF9900;color: #FFFFFF;}
.stui-player__video {margin-bottom: 10px;}
.embed-responsive{ padding-bottom: 56.25%;}
</style>
</head>
<body>
<?php include 'header.php';?>
<div class="container">
<div class="row">
<div class="col-lg-wide-75 col-xs-1">
			<div class="stui-player__item myui-player__item clearfix" style="background-color: #fff;">
				<div id="player-left" class="stui-player__video embed-responsive embed-responsive-16by9 clearfix">
				  <div class="myui-player__box player-fixed"> <a class="player-fixed-off" href="javascript:;" style="display: none;"><i class="icon iconfont icon-close"></i></a>
                   <div class="embed-responsive clearfix">
					<div id="shiping_box"></div>
<script type="text/javascript">
            function run(){
			var s = document.getElementById("timer");
		if(!s){
			return false;
			}else{
			s.innerHTML = s.innerHTML * 1 - 1;
		 }
		}
	window.setInterval("run();", 1000);
	$('#shiping_box').html('<div style="text-align:center;width:100%;"></div>');
	//设置延时函数
	function adsUp(){
        $("#shiping_box").html('<iframe id="video" src=""  allowfullscreen="true" allowtransparency="true" style="width:100%;border:none"></iframe>');
    }
    //五秒钟后自动收起
    var t = setTimeout(adsUp,<?php echo $mkcms_miaoshu*1000;?>);
</script>
</div></div></div>
<?php 
	if(empty($data['data'][0]['vod_year'])) {$nian=$data['data'][0]['d_year'];} else{$nian=$data['data'][0]['vod_year'];}
	if(!empty($data['data'][0]['vod_director'])) {$daoyan='导演：'.$data['data'][0]['vod_director'];}
	if(!empty($data['data'][0]['vod_actor'])) {$zhuyan='主演：'.$data['data'][0]['vod_actor'];}
	if(!empty($data['data'][0]['vod_continu'])) {$zuyuangx='状态：'.$data['data'][0]['vod_continu'];}
?>
<div class="stui-player__detail detail" id="dianshijuid">
				<ul class="more-btn">
				<li id="xlus"><a href="javascript:void(0)" onclick="xldata(this)" data-jk="" class="btn btn-sm btn-default" title="刷新">刷新</a></li>
				<li><a href="<?php echo $mkcms_domain;?>addfav.php?title=<?php echo $data['data'][0]['vod_name'];?>&dizhi=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" class="btn btn-sm btn-default" title="收藏">收藏</a></li>
				<li><a href="javascript:scroll(0,0)" class="btn btn-default" id="btn-prev" title="上一集"><i class="icon iconfont icon-back hidden-xs"></i> 上一集</a></li>
				<li><a href="javascript:scroll(0,0)" class="btn btn-default" id="btn-next" title="下一集">下一集 <i class="icon iconfont icon-more hidden-xs"></i></a></li>
				</ul>
				<h1 class="title" id="xuji"><a href="/seacher-<?php echo $data['data'][0]['vod_name'];?>.html" title="<?php echo $data['data'][0]['vod_name'];?>"><?php echo $data['data'][0]['vod_name'];?></a><span class="js"></span></h1>
				<span class="text-muted">地区：</span><?php echo $data['data'][0]['vod_area'];?><span class="split-line"></span>
				<span class="text-muted">年份：</span><?php echo $nian;?>
				<?php if(!empty($data['data'][0]['vod_continu'])){echo '<span class="split-line"></span>';}?>
				<span class="text-muted"><?php echo $zuyuangx;?></span>
				</div>
</div>
<!-- 播放器-->
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box b playlist mb">
<div class="stui-pannel_hd">
<div class="stui-pannel__head bottom-line active clearfix">
<span class="more text-muted pull-right">无需安装任何插件，即可快速播放</span>
<h3 class="title"><svg class="iconm" aria-hidden="true"><use xlink:href="#icon-play"></use></svg>播放列表</h3>
</div>
</div>
<div class="stui-pannel_bd col-pd clearfix dianshijua" id="dianshijuid">
<ul class="stui-content__playlist column10 clearfix" id="playlist">
<?php
				$str = $data['data'][0]['vod_url'];
				$strname = $data['data'][0]['vod_name'];
				$suArr = explode("$$$",$str);
				foreach($suArr as $a=>$b){  
				    $v = explode("\n",$b);
				    $d[] =$v; 
				}
				foreach($d as $k=>$v){    
				    foreach ($v as $cc){
				         $u = explode("$",$cc);
						if(strpos($u[1] ,'m3u8')){
                 		$urls= $u[1];
                 		$title= $u[0];
						echo
						'<li class="active"><a href="https://jx.inpower.cc/?url='.$urls.'" class="btn-play-source" title="'.$strname.' '.$title.'">'.$title.'</a></li>';
						}
					}	
				}
				if (empty($urls)){
				$suArr2 = explode("$$$",$str);
				foreach($suArr2 as $a2=>$b2){  
				    $v2 = explode("\n",$b2);
				    $d2[] =$v2;
				}
				foreach($d2 as $k2=>$v2){    
				    foreach ($v2 as $cc2){
				         $u2 = explode("$",$cc2);
						if(strpos($u2[1] ,'share')){
                 		$urls2= $u2[1];
                 		$title2= $u2[0];
						echo
						'<li class="active"><a href="'.$urls2.'" class="btn-play-source" title="'.$strname.' '.$title2.'">
						'.$title2.'
						</a>
						</li>';
						}
					}	
				}
			}
?>
</ul>
</div>
</div>
</div>
<!-- 播放地址-->
<div class="stui-pannel stui-pannel-bg clearfix">
	<div class="stui-pannel-box">
		<div class="stui-pannel__head bottom-line active clearfix">
			<div class="stui-pannel__head clearfix">
			<span class="more text-muted pull-right">添加时间：<?php echo $data['data'][0]['vod_addtime']; ?></span>
				<h3 class="title">
					<svg class="iconm" aria-hidden="true"><use xlink:href="#icon-jie"></use></svg>
					剧情简介
				</h3>
			</div>
		</div>
	</div>
	<div class="stui-pannel-box">
		<div class="stui-content__thumb">
			<a class="stui-vodlist__thumb picture v-thumb" href="#" title="<?php echo $data['data'][0]['vod_name'];?>">
			<img src="<?php echo $data['data'][0]['vod_pic']; ?>" data-original="<?php echo $data['data'][0]['vod_pic']; ?>" class="lazyload" alt="<?php echo $data['data'][0]['vod_name'];?>" title="<?php echo $data['data'][0]['vod_name'];?>" width="100%"/>
			<span class="pic-text text-right"></span>
			</a>
		</div>
	<div class="stui-content__detail">
	<h1 class="title"><a href="<?php echo $mkcms_domain; ?>seacher-<?php echo $data['data'][0]['vod_name'];?>.html" title="<?php echo $data['data'][0]['vod_name'];?>"><?php echo $data['data'][0]['vod_name'];?></a></h1>
	<p class="data">地区：<?php echo $data['data'][0]['vod_area'];?></p>
	<p class="data">年代：<?php echo $nian;?></p>
	<p class="data"><?php echo $zuyuangx;?></p>
	<p class="data"><?php echo $daoyan;?></p>
	<p class="data"><?php echo $zhuyan;?></p>
	</div>
	<?php if(!empty($data['data'][0]['vod_content'])){ ?>
	<div class="stui-pannel_bd">
		<p class="col-pd detail">
		<span class="detail-sketch">简介：<?php echo $data['data'][0]['vod_content'];?></span>';
		</p>
	</div><?php } ?>
	</div>
</div><!-- 剧情简介-->
</div>
<script>
 $(function () {
	 $.each($('.dianshijua'),function () {
		var al = $('.stui-content__playlist a');
		al.attr('class','btn-play-source am-btn am-btn-default lipbtn');
		});
		$.each($('.lipbtn'),function () {
			var url = $(this).attr('href');
			$(this).attr('data-href',url);
			$(this).attr('href','javascript:;');
			$(this).attr('onclick','bofang(this)');
			});
			$('#xlus').children('a:eq(0)').addClass('jkbtn0');
			var autourl = $('.lipbtn:eq(0)').attr('data-href');
			$('.lipbtn:eq(0)').attr('id','ys');
			var text = $('.lipbtn:eq(0)').text();
			$('.js').text('-'+text+'');
			var jiekou = $('#xlus').children('a:eq(0)').attr('data-jk');
			if(autourl!=''||autourl!=null){
				setTimeout(function () {
					$('#video').attr('src', jiekou + autourl);
					},0)
					}
		// 上一集
		$("#btn-pre").click(function() {
			$("#ys.btn-play-source").prev().click();
			});
		// 下一集
		$("#btn-next").click(function() {
		$("#ys.btn-play-source").next().click();
		});
		// 上一集
		$("#btn-pre1").click(function() {
		$("#ys.btn-play-source").prev().click();
		});
	// 下一集
	$("#btn-next1").click(function() {
		$("#ys.btn-play-source").next().click();
		});})
</script>
<script>
function bofang(obj) {
var href = $(obj).attr('data-href');
var text = $(obj).text();
$('.js').text('-' + text+'');
$.each($('.lipbtn'), function () {
$(this).attr('id','');
});
$(obj).attr('id','ys');
var jiekou = $('.jkbtn0').attr('data-jk');
if (href != '' || href != null) {
setTimeout(function () {
$('#video').attr('src', jiekou + href);
},0)}}
function xldata(obj) {
	var url = $(obj).attr('data-jk');
	$.each($('.jkbtn0'), function () {
		$(this).removeClass('jkbtn0');});
		$(obj).addClass('jkbtn0');
		var src = $('#ys').attr('data-href');
		$('#video').attr('src', url + src);}
		</script>
			<script>
                $(function () {
                    $('#btn-prev').click(function () {
                        $('#ys').parent().prev().children('a:eq(0)').click();
                    })//上一集
                    $('#btn-next').click(function () {
                        $('#ys').parent().next().children('a:eq(0)').click();
                    })//上一集
                })
            </script>
<div class="col-lg-wide-25 col-xs-1 stui-pannel-side hidden-sm hidden-xs">
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box clearfix">
<div class="col-pd text-center" style="border: 1px solid #eee; border-radius: 5px;">
<p style="padding: 30px; margin: 0;"><img src="<?php echo $mkcms_appbt;?>"></p><p><?php echo $mkcms_apppic;?></p>
</div>
	</div>
</div><!-- 扫码-->
     <div class="stui-pannel stui-pannel-bg clearfix">
      <div class="stui-pannel-box">
       <div class="stui-pannel_hd">
        <div class="stui-pannel__head active bottom-line clearfix">
         <h3 class="title"><svg class="iconm" aria-hidden="true"><use xlink:href="#icon-bang"></use></svg>影视热度排行榜</h3>
        </div>
       </div>
       <div class="stui-pannel_bd clearfix">
	    <ul class="stui-vodlist__text active col-pd clearfix">
      <?php
	  include './data/bangdan.php';
      foreach ($bdArr['dy']['title'] as $k=>$title){
						$bdurl=$bdArr['dy']['url'][$k];

						$bdurl = str_replace("https://www.360kan.com", "", $bdurl);
						$bdnum=$bdArr['dy']['num'][$k];
						$topnum=$bdArr['dy']['top'][$k];
		  echo "<li class='col-xs-1 padding-0'><a class='text-overflow' href='/vod$bdurl' title='$title'><span class='am-badge am-round pull-left'>$topnum</span><span class='text-muted pull-right'>$bdnum</span><em class='text-red'></em>&nbsp;$title</a></li>";
		}
		?>
	</ul>
	</div>
	</div>
	</div>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box clearfix">
<div class="col-pd text-center">
<?php echo $mkcms_ad22; ?>
</div>
</div>
</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript" src="/template/jingpin/js/history.js"></script>
<script type="text/javascript">var vod_name='<?php echo $data['data'][0]['vod_name'];?>',vod_url=window.location.href,vod_part='1';</script>
<?php include 'footer.php'; ?>