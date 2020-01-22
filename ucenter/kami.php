<?php include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','../login.php');
	};
if ( isset($_POST['save']) ) {
null_back($_POST['c_number'],'请填写充值卡号');

//判定卡号是否存在
$result = mysqli_query($conn,'select * from mkcms_user_card where c_number = "'.$_POST['c_number'].'" and c_used=0');
if($row = mysqli_fetch_array($result)){
$day1= $row['c_money'];//天数
$group= $row['c_userid'];//会员组id
//获取会员组的参数

$day=round($day1);//除法取整
//获取会员开通天数
$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysqli_fetch_array($result)){
$u_group=$row['u_group'];//会员组
$send = $row['u_end'];//截止时间
}
if ($u_group>$group){alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不能降级!','kami.php');}
//判定时间是否到期
if($send < time()){
$u_end = time()+ 86400*$day;//到期增加天数
}
else{
$u_end = $send + 86400*$day;//没到期增加天数
}
//更新数据
$_data['u_group'] =$group;
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';	
	if (mysqli_query($conn,$sql)) {
$data['c_used'] = 1;
$data['c_user'] = $_SESSION['user_name'];
$data['c_usetime'] =time();

$sql = 'update mkcms_user_card set '.arrtoupdate($data).' where c_number = "'.$_POST['c_number'].'"';	
if (mysqli_query($conn,$sql)) {
		alert_href('激活成功!','kami.php');
}	} else {
		alert_back('激活失败!');
	}
}
else{
	alert_back('卡号不存在,或者已经使用');
	}
}
?>
<?php include('../template/'.$mkcms_bdyun.'/head.php');
?>
<title>会员中心</title>
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
        <div class="col-md-9">	
          <div class="panel panel-default panel-col">
	        <div class="panel-heading">兑换码激活卡</div>
<?php
					$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
					?><div class="panel-body">
			     <form class="form-horizontal" action="" method="post">
				 <input name="u_points" type="hidden" class="form-control" value="<?php echo $row['u_points'];?>">
				  <input type="hidden"  name="u_name" class="form-control"  value="<?php echo $row['u_name'];?>" disabled>

					<div class="form-group">
						<label class="col-md-2 control-label">兑换码</label>
						<div class="col-md-7 controls radios">
<input name="c_number" type="text" class="form-control" value="">
              	        <div class="help-block" style="display:none;"></div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-7 col-md-offset-2">
							<button id="profile-save-btn" type="submit" name="save" class="btn btn-primary js-ajax-submit">激活会员卡</button>
						</div>
					</div>
			    </form>
		       </div><?php
						}
					?>
	         </div>
          </div>
     </div>
  </div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?> 
</body>
</html>
