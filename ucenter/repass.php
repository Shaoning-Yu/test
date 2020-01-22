<?php 
include('../system/inc.php');
if(isset($_SESSION['user_name'])){
header('location:index.php');
};
if(isset($_POST['submit'])){
$username = stripslashes(trim($_POST['name']));
$email = trim($_POST['email']);
// 检测用户名是否存在
$query = mysqli_query($conn,"select u_id from mkcms_user where u_name='$username' and u_email='$email'");
if(!! $row = mysqli_fetch_array($query)){
$num=rand(10000,99999);//获取一串随机数
$_data['u_password'] = md5($num);
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$username.'"';
if (mysqli_query($conn,$sql)) {
$token =$row['u_question'];
include("emailconfig.php");
    //创建$smtp对象 这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp = new Smtp($MailServer, $MailPort, $smtpuser, $smtppass, true); 
    $smtp->debug = false; 
    $mailType = "HTML"; //信件类型，文本:text；网页：HTML
    $email = $email;  //收件人邮箱
    $emailTitle = "".$mkcms_name."用户找回密码"; //邮件主题
    $emailBody = "亲爱的".$username."：<br/>感谢您在我站注册账号。<br/>您的初始密码为".$num."<br/>如果此次找回密码请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- ".$mkcms_name." 敬上</p>";
    // sendmail方法
    // 参数1是收件人邮箱
    // 参数2是发件人邮箱
    // 参数3是主题（标题）
    // 参数4是邮件主题（标题）
    // 参数4是邮件内容  参数是内容类型文本:text 网页:HTML
    $rs = $smtp->sendmail($email, $smtpMail, $emailTitle, $emailBody, $mailType);
if($rs==true){
echo '<script>alert("请登录到您的邮箱查看您的密码！");window.history.go(-1);</script>';
}else{
echo "找回密码失败";
}
}
}
}
?>
<?php include('../template/'.$mkcms_bdyun.'/head.php');
?>
<title>找回密码-<?php echo $mkcms_seoname;?></title>
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
<script type="text/javascript">
function chk_form(){
var user = document.getElementById("user");
if(user.value==""){
alert("用户名不能为空！");
return false;
//user.focus();
}
var email = document.getElementById("email");
if(email.value==""){
alert("Email不能为空！");
return false;
//email.focus();
}
var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
if(!preg.test(email.value)){ 
alert("Email格式错误！");
return false;
//email.focus();
}
}
</script>
</head>
<body style="padding-top: 60px;">
<?php include('../template/'.$mkcms_bdyun.'/header.php');?>
<div id="imgcon1">
<a href="<?php echo $link2;?>" target="_blank"></a></div>
<div id="wrapper" class="pad-bottom p-imgcon">
   <div id="content-container" class="container">
        <div class="es-section login-section">
  <div class="logon-tab clearfix">
    <a class="active">找回密码</a>
<a href="login.php">登录账号</a>
  </div>
  <div class="login-main">
    <form class="form-horizontal js-ajax-form" method="post" onsubmit="return chk_form();">
        <label class="control-label" for="login_username">账号</label>
        <div class="controls">
           <input type="text" name="name" id="user" placeholder="账号" value="" class="form-control input-lg span4">
          <div class="help-block"></div>
        </div>
        <label class="control-label" for="login_password">邮箱</label>
        <div class="controls" style="margin-bottom:10px;">
          <input type="text" name="email" id="email" placeholder="邮箱" class="form-control input-lg span4">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block js-ajax-submit" name="submit" style="margin-left: 0px;margin-top:30px;margin-bottom:10px;">找回密码</button>
    </form>
    <div class="mbl">
	  <a href="login.php">登录</a>
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