<?php
include('system/inc.php');
$title = $_GET['title'];
$dizhi = $_GET['dizhi'];
$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysqli_fetch_array($result)){
    $u_id=$row['u_id'];
	$_data['name'] =$title;
	$_data['url'] =$dizhi ;
	$_data['userid'] =$u_id;
	$str = arrtoinsert($_data);
	$sql = 'insert into mkcms_fav ('.$str[0].') values ('.$str[1].')';
	if (mysqli_query($conn,$sql)) {
echo '<script>alert("收藏成功！");window.history.go(-1);</script>';
	}
	}
	else{
alert_href('请登陆后进入','login.php');
	}
?>