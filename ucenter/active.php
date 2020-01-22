<?php
include('../system/inc.php');
$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysqli_query($conn,"select u_id from mkcms_user where u_question='$verify'");
$row = mysqli_fetch_array($query);
if($row){
	echo $row['u_id'];
$sql = 'update mkcms_user set u_status=1 where u_id="'.$row['u_id'].'"';
if (mysqli_query($conn,$sql)) {
	
alert_href('激活成功!','login.php');
}
}else{
$msg = 'error.';
}
echo $msg;
?>