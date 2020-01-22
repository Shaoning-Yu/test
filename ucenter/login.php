<?php 
include('../system/inc.php');
if(isset($_SESSION['user_name'])){
header('location:index.php');
};
if(isset($_POST['submit'])){
	null_back($_POST['u_name'],'请输入用户名');
	null_back($_POST['u_password'],'请输入密码');
	$u_name = $_POST['u_name'];
	$u_password = $_POST['u_password'];
	$sql = 'select * from mkcms_user where u_name = "'.$u_name.'" and u_password = "'.md5($u_password).'" and u_status=1';
	$result = mysqli_query($conn,$sql);
	if(!! $row = mysqli_fetch_array($result)){
		
	$_data['u_loginnum'] = $row['u_loginnum']+1; 
	$_data['u_loginip'] =$_SERVER["REMOTE_ADDR"]; 
	$_data['u_logintime'] =date('y-m-d h:i:s',time());
	if(!empty($row['u_end'])) $u_end= $row['u_end'];
	if(time()>$u_end){
	$_data['u_flag'] =="0";
	$_data['u_start'] =="";
	$_data['u_end'] =="";
	$_data['u_group'] =1;
	}else{
	$_data['u_flag'] ==$row["u_flag"];
	$_data['u_start'] ==$row["u_start"];
	$_data['u_end'] ==$row["u_end"];
	$_data['u_group'] =$row["u_group"];
	}
	mysqli_query($conn,'update mkcms_user set '.arrtoupdate($_data).' where u_id ="'.$row['u_id'].'"');
	$_SESSION['user_name']=$row['u_name'];
	$_SESSION['user_group']=$row['u_group'];
	if($_POST['brand1']){ 
setcookie('user_name',$row['u_name'],time()+3600 * 24 * 365); 
setcookie('user_password',$row['u_password'],time()+3600 * 24 * 365); 
} 
		header('location:index.php');
	}else{
		alert_href('用户名或密码错误或者尚未激活','login.php');
	}
}?>
<?php include('../template/'.$mkcms_bdyun.'/head.php');
?>
<title>会员登录-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
<link rel="stylesheet" media="screen" href="css/main.css" />
<style type="text/css">
.p-imgcon {margin-top: -30px;height: 500px;background-color: #e6e6e6;background: #fff url(<?php
$text=file_get_contents('https://i.360kan.com/login'); 
$link="#<a href='https://www.360kan.com/(.*?)'></a>#";
preg_match_all($link,$text,$sarr);
$link1=$sarr[1][0];
$link2="/vod/".$link1;
preg_match('/https[^>]*jpg/Ui', $text, $match);
print($match[0]);
?>) center 0 no-repeat;}
.login-section {margin: 30px 15px 0 auto;}
@media (max-width: 768px){ #imgcon1{display:none;}}
#imgcon1 a{ display:block; width:48%;height:500px; position:absolute;z-index:999;}
</style>
</head>
<body style="padding-top: 60px;">
<?php include('../template/'.$mkcms_bdyun.'/header.php');?>
<div id="imgcon1">
<a href="<?php echo $link2;?>" target="_blank"></a></div>
<div id="wrapper" class="pad-bottom p-imgcon">
   <div id="content-container" class="container">
        <div class="es-section login-section">
  <div class="logon-tab clearfix">
    <a class="active">登录账号</a>
    <a href="reg.php">注册账号</a>
  </div>
  <div class="login-main">
    <form class="form-horizontal js-ajax-form" method="post">
        <label class="control-label" for="login_username">账号</label>
        <div class="controls">
          <input class="form-control input-lg span4" id="login_username" type="text" name="u_name" value="" required placeholder='请输入账号' />
          <div class="help-block"></div>
        </div>
        <label class="control-label" for="login_password">密码</label>
        <div class="controls" style="margin-bottom:10px;">
        <input class="form-control input-lg span4" id="login_password" type="password" name="u_password" required placeholder='请输入密码'/>
        </div>
		<label class="control-label" for="login_password"><input type="checkbox" name="brand1" value="">记住密码</label>

        <button type="submit" class="btn btn-primary btn-lg btn-block js-ajax-submit" name="submit" style="margin-left: 0px;margin-top:30px;margin-bottom:10px;width: 100%;">登录</button>
    </form>
    <div class="mbl">
	  <a href="repass.php">找回密码</a>
      <span class="text-muted mhs">|</span>
      <span class="text-muted">还没有注册账号？</span>
      <a href="reg.php">立即注册</a>
    </div>
    <div class="social-login">
        <div class="line"></div>
    </div>
   </div>
  </div>
</div>
</div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?>
</body>
</html>