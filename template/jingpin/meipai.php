<?php include 'head.php';?>
<title>美拍视频-<?php echo $mkcms_seoname;?></title>
<meta name="description" content="<?php echo $mkcms_description;?>">
<link href="//cdn.staticfile.org/aplayer/1.10.1/APlayer.min.css" rel="stylesheet" type="text/css" />
<link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.plr10{padding-left:10px;padding-right:10px;max-width:620px;min-width:300px;margin:10px auto;background-color:#fff;}
</style>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body>
<?php  include 'header.php';?>
<div class="container">
<div class="row">
<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html;charset=utf-8");
date_Default_TimeZone_set("PRC");
echo '<div class="plr10"><script type="text/javascript" src="pai.php" charset="utf-8"></script></div>';
?>
</div>
</div>
<?php  include 'footer.php';?>