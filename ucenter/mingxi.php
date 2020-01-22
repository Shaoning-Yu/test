<?php 
include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','../login.php');
	};
if ( isset($_POST['save']) ) {
if ($_POST['pay']==1){

//判定会员组别
$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysqli_fetch_array($result)){

$u_points=$row['u_points'];
$u_group=$row['u_group'];
$send = $row['u_end'];

//获取会员卡信息
$card= mysqli_query($conn,'select * from mkcms_userka where id="'.$_POST['cardid'].'"');
if($row2 = mysqli_fetch_array($card)){
$day=$row2['day'];//天数
$userid=$row2['userid'];//会员组
$jifen=$row2['jifen'];//积分
}
//判定会员组
if ($row['u_group']>$userid){ 
alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不需要升级!','mingxi.php');
}

$baoshi=$jifen;//点数
if($u_group>1){//判定已经是会员
	
if ($u_points>=$jifen) {//如果点数大于包时数
$_data['u_points'] =$u_points-$baoshi;//扣点
$_data['u_group'] =$userid;
if($send < time()){
$u_end = time()+ 86400*$day;
}
else{
$u_end = $send + 86400*$day;
}
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysqli_query($conn,$sql)) {
alert_href('续费成功!','mingxi.php');
}

}
	else{
alert_href('您的积分不够，无法续费,请继续赚取积分或其他方式购买会员!','mingxi.php');
}
}
else{//普通会员充值
if ($u_points>=$baoshi) {//如果点数大于包时数
$_data['u_points'] =$u_points-$baoshi;
$_data['u_group'] =$userid;
$u_end = time()+ 86400*$day;
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$_data['u_flag'] =1;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysqli_query($conn,$sql)) {
alert_href('升级成功!','mingxi.php');
}

}
	else{
alert_href('您的积分不够，无法升级到该会员组,请充值!','mingxi.php');
}	
}
}
}
else{
//获取会员卡信息
$card= mysqli_query($conn,'select * from mkcms_userka where id="'.$_POST['cardid'].'"');
if($row2 = mysqli_fetch_array($card)){
$day=$row2['day'];//天数
$userid=$row2['userid'];//会员组
$money=$row2['money'];//积分
}

$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysqli_fetch_array($result)){

$u_points=$row['u_points'];
$u_group=$row['u_group'];
$send = $row['u_end'];
if ($row['u_group']>$userid){ 
alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不需要升级!','mingxi.php');
}
}
require_once("pay/epay.config.php");
require_once("pay/lib/epay_submit.class.php");

/**************************请求参数**************************/
        $notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/ucenter/pay/notify_url.php';
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = 'http://'.$_SERVER['HTTP_HOST'].'/ucenter/pay/return_url.php';
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = date("YmdHis").mt_rand(100,999);
        //商户网站订单系统中唯一订单号，必填


		//支付方式
        $type = $_POST['pay'];
        //用户名
        $name = $_SESSION['user_name'];
		//包月时间
        $money = $money;
		//会员类型
		$group = $userid;
		//站点名称
        $sitename = 'BL云支付测试站点';
        //必填

        //订单描述
//写入记录
$data['p_order'] =$out_trade_no;
$data['p_uid'] =$_SESSION['user_name'];
$data['p_price'] =$money;
$data['p_time'] =time();
$data['p_point'] =$day;//时间
$data['p_group'] =$userid;
$data['p_status'] =0;
$str = arrtoinsert($data);
$sql = 'insert into mkcms_user_pay ('.$str[0].') values ('.$str[1].')';
	if(mysqli_query($conn,$sql)){}

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"group"	=> $group,
		"sitename"	=> $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
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
	<script src="../style/js/html5shiv.js"></script>   
	<script src="../style/js/respond.min.js"></script>  
<![endif]-->
</head>
<body>
<?php include('../template/'.$mkcms_bdyun.'/header.php');?>
<div id="content-container" class="container">

<div class="row row-3-9">
<?php include('left.php');?>
        <div class="col-md-10">	
          <div class="panel panel-default panel-col"> 
	        <div class="panel-heading">会员卡购买</div>
			<?php
					$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
					?>
			<div class="es-section">
                      <div class="coin-text">
                         <strong>当前积分：</strong><?php echo $row['u_points'];?>.00积分
                      </div>
                   </div> 
  <?php }?>
			<?php
					$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
					?>
	           <div class="panel-body">
			    <form class="form-horizontal" action="" method="post">
				<input name="u_points" type="hidden" class="form-control" value="<?php echo $row['u_points'];?>">
					<div class="form-group">
						<label class="col-md-2 control-label">选择会员类型</label>

						<div class="col-md-7 controls radios">

													<?php
							$result = mysqli_query($conn,'select * from mkcms_userka');
							while($row = mysqli_fetch_array($result)){
						?>
						<input type="radio" id="profile_gender_0" name="cardid" required="required" value="<?php echo $row['id']?>" ><?php echo $row['name']?>-<?php echo $row['day']?>天[<?php echo $row['money']?>元]或[<?php echo $row['jifen']?>积分]<br>

<?php
							}
						?>
									
						</div>
					</div>
						<div class="form-group">
							<label class="col-md-2 control-label">选择支付方式</label>
							<div class="col-md-7 controls">
							<div id="profile_gender">
								<input type="radio" id="profile_gender_0" name="pay" required="required" value="1" checked="">
								<label for="profile_gender_0" class="required">积分支付</label>
								<?php if($mkcms_appid!=""){?><input type="radio" id="profile_gender_1" name="pay" required="required" value="alipay">
								<label for="profile_gender_1" class="required">支付宝</label>
								<input type="radio" id="profile_gender_1" name="pay" required="required" value="wxpay">
								<label for="profile_gender_1" class="required">微信</label>
								<input type="radio" id="profile_gender_1" name="pay" required="required" value="qqpay">
								<label for="profile_gender_1" class="required">QQ钱包</label><?php } ?>
							</div>
							</div>
						</div>

					<div class="row">
						<div class="col-md-7 col-md-offset-2">
							<button id="profile-save-btn"  type="submit" name="save" class="btn btn-primary js-ajax-submit">提交</button>
						<a class="btn btn-primary" href="<?php echo $mkcms_qqun;?>" target="_blank">购买卡密</a></div>
					</div>
			    </form>
		       </div>
			   <?php
						}
					?>
	         </div>
          </div>
     </div>
  </div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?>
</body>
</html>
