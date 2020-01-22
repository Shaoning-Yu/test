<?php include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','../login.php');
	};
$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row =  mysqli_fetch_array($result)){
$u_id=$row['u_id'];
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
	    <div class="panel-heading">我的收藏</div>
<div class="panel-body">
					<div class="form-group">
<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>名称</th>
								<th>地址</th>
								<th>操作</th>
							</tr>
							<?php
          $result = mysqli_query($conn,'select * from mkcms_fav where userid="'.$u_id.'"');
		  if (isset($_GET['del'])) {
			  $sql = 'delete from mkcms_fav where id = ' . $_GET['del'] . '';
			  if (mysqli_query($conn,$sql)) {
				  alert_href('删除成功!', 'fav.php');
				  } else {
					  alert_back('删除失败！');
	}
}

							while($row=  mysqli_fetch_array($result)){
								
							?>
							<tr>
								<td><?php echo $row['id'] ?></td>
								<td><?php echo $row['name'] ?></td>
								<td><a href="<?php echo $row['url'] ?>">继续观看</a></td>
								</td>
								<td><a class="text-red" href="?del=<?php echo $row['id'];?>" onclick="return confirm('确认要删除吗？')" class="delete">删除</a></td>
							</tr>
							<?php } ?>
						</table>
    		</div>
			</div>
	   </div>
    </div>
   </div>
  </div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?> 
</body>
</html>