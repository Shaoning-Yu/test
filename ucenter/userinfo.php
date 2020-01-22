<?php include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','login.php');
	};
if ( isset($_POST['save']) ) {
	null_back($_POST['u_password'],'请填写登录密码');
	$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
    if($row = mysqli_fetch_array($result)){
if ($_POST['u_password'] != $row['u_password']) {
$_data['u_password'] = md5($_POST['u_password']);
	}
	else{
$_data['u_password'] = $_POST['u_password'];	
	}
	}

	$_data['u_email'] = $_POST['u_email'];
	$_data['u_phone'] = $_POST['u_phone'];
	$_data['u_qq'] = $_POST['u_qq'];
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
	if (mysqli_query($conn,$sql)) {
		alert_href('修改成功!','userinfo.php');
	} else {
		alert_back('修改失败!');
	}
}
?>
<?php include('../template/'.$mkcms_bdyun.'/head.php');?>
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
<div class="row row-3-10">
<?php include('left.php');?>
        <div class="col-md-9">	
          <div class="panel panel-default panel-col">
	        <div class="panel-heading">基础信息</div>
	           <?php
					$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
					?><div class="panel-body">
			     <form class="form-horizontal" action="" method="post">
					<div class="form-group">
					  <label class="col-md-2 control-label" for="profile_truename">用户名</label>
					  <div class="col-md-7 controls radios">
              	        <input type="text"  name="u_name" class="form-control"  value="<?php echo $row['u_name'];?>">
              	        <div class="help-block" style="display:none;"></div>
            	      </div> 
            		</div>
					<div class="form-group">
						<label class="col-md-2 control-label">密码</label>
						<div class="col-md-7 controls radios">
<input name="u_password" type="password" class="form-control"  value="<?php echo $row['u_password'];?>">
              	        <div class="help-block" style="display:none;"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="profile_mobile" class="col-md-2 control-label">手机号码</label>
							<div class="col-md-7 controls">
		           	             
								  <input type="text"  name="u_phone" class="form-control" value="<?php echo $row['u_phone'];?>">

							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">QQ</label>
							<div class="col-md-7 controls">
								<input type="text" id="profile_weixin" name="u_qq" class="form-control" value="<?php echo $row['u_qq'];?>">
								<div class="help-block" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">email</label>
							<div class="col-md-7 controls">
					<input type="text" id="profile_weixin" name="u_email" class="form-control" value="<?php echo $row['u_email'];?>">
								<div class="help-block" style="display:none;"></div>
							</div>
						</div>

					<div class="row">
						<div class="col-md-7 col-md-offset-2">
							<button id="profile-save-btn" name="save" type="submit" class="btn btn-primary js-ajax-submit">保存</button>
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