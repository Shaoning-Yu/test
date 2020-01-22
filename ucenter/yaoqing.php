<?php include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','../reg.php');
	};
$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
$u_id=$row['u_id'];
}
?>
<?php include('../template/'.$mkcms_bdyun.'/head.php');
?>
<title>会员中心-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
<link href="css/bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" media="screen" href="css/main.css" />
<link rel="stylesheet" media="screen" href="css/iconfont.css" />
<link rel="stylesheet" media="screen" href="css/theme.css" /> 
<!--[if lt IE 9]>    
	<script src="js/html5shiv.js"></script>   
	<script src="js/respond.min.js"></script>  
<![endif]-->
</head>
<body>
<?php include('../template/'.$mkcms_bdyun.'/header.php');?>
<div id="content-container" class="container">
<div class="row row-3-9">
<?php include('left.php');?>
        <div class="col-md-10">	
          <div class="panel panel-default panel-col">
	        <div class="panel-heading">我邀请的会员（推广赚积分）</div>
<div class="panel-body">
<div class="form-group">
									<label class="col-md-12 control-label" for="name">我的推广链接：<?php echo $mkcms_domain;?>ucenter/reg.php?tg=<?php echo $u_id ?></label>
									
								</div>
								
					<div class="form-group">
<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>会员名称</th>
								<th>注册时间</th>
								<th>登录次数</th>

							</tr>
							<?php
                            $result = mysqli_query($conn,'select * from mkcms_user where u_qid="'.$u_id.'"');
							while($row= mysqli_fetch_array($result)){
							?>
							<tr>
								<td><?php echo $row['u_id'] ?></td>
								<td><?php echo $row['u_name'] ?></td>
								<td><?php if($row['u_regtime']>0){ echo"";echo date('Y-m-d',$row['u_regtime']);;};?></td>
								<td><?php echo $row['u_loginnum'] ?>
								</td>
								
							</tr>
							<?php } ?>

						</table>
<p>我不想邀请，直接购买充值卡充值：<a class="btn btn-primary" href="<?php echo $mkcms_qqun;?>" target="_blank">点此购买</a></p>
            		</div>
		       </div>
	         </div>
          </div>
     </div>
  </div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?> 
</body>
</html>