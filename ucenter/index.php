<?php include('../system/inc.php');
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','login.php');
	};
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
	<script src="../style/js/html5shiv.js"></script>   
	<script src="../style/js/respond.min.js"></script>  
<![endif]-->
</head>
<body>
<?php include('../template/'.$mkcms_bdyun.'/header.php');?>
<div id="content-container" class="container">
      <div class="row row-3-9">
<?php include('left.php');?>
<?php
					$result = mysqli_query($conn,'select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysqli_fetch_array($result)){
					?>
 <div class="col-md-10">	
          <div class="panel panel-default panel-col">
	        <div class="panel-heading">我的账号</div>
               <div class="es-section">
                  <span class="label label-primary label-md">账号积分</span> <span class="label label-primary label-md"><?php
							$result = mysqli_query($conn,'select * from mkcms_user_group where ug_id='.$row['u_group'].'');
							while($row1 = mysqli_fetch_array($result)){
						?>
						会员类型：<?php echo $row1['ug_name']?>
<?php
							}
						?></span>
                    <br>
                    <div class="coin-block clearfix">
                      <div class="coin-text">
                         <strong><?php echo $row['u_points'];?>.00积分</strong>
                      </div>
                      <div class="coin-btn">
                          <?php if($row['u_group']>1){ echo"<a  class='mll btn btn-default'>到期时间：";echo date('Y-m-d',$row['u_end']);echo"</a>";};?>
                      </div>
                   </div>
                    <form id="user-search-form" class="form-inline well well-sm clearfix" action="" method="get" novalidate>
                      <div class="form-group">
                       <div class="nav-btn-tab" style="border:0px;">
                         <ul class="nav nav-pills" id="myTab" >
                           <li role="presentation"  class="active"><a href="kami.php">卡密兑换</a></li>
                           <li role="presentation" style="margin-left:10px;"><a href="mingxi.php">购买VIP</a></li>
                         </ul>
                       </div>    
                      </div>
                      <div class="control-label pull-right" style="padding-top: 8px;">
                                                                  登录时间：<span style="color:#1bb974;"><?php echo $row['u_logintime'];?></span>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                  登陆IP：<span style="color:#ff7b0e;"><?php echo $row['u_loginip'];?></span>
                      </div>
                   </form>                   <div class="table-responsive">
                   <div id="myTabContent" class="tab-content" >
                   
                    <div class="tab-pane fadee active" id="inflow">
                 
                     <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>类型</th>
                            <th>金额</th>
                            <th>操作时间</th>
                         </tr>
                        </thead>
                        <tbody>
<?php
									$sql1 = 'select * from mkcms_user_pay where p_uid="'.$row['u_name'].'" order by p_id desc';
									$pager = page_handle('page',10,mysqli_num_rows(mysqli_query($conn,$sql1)));
									$result1 = mysqli_query($conn,$sql1.' limit '.$pager[0].','.$pager[1].'');

							while($row1= mysqli_fetch_array($result1)){
?>
                          <tr style="word-break: break-all;word-wrap: break-word;">
                           <td><span class="text-muted text-sm">购买会员<?php echo $row1['p_point'];?>天</span></td>
                           <td><span class="money-text"><?php echo $row1['p_price'];?>.00</span></td>
                           <td><span class="text-muted text-sm"><?php echo date('Y-m-d',$row1['p_time']);?></span></td>
                          </tr>
							<?php } ?>
                         </tbody>
                       </table>
 <nav class="text-center"><div class="pagination text-center"><?php echo page_shows($pager[2],$pager[3],$pager[4],2);?></div></nav>
                      </div>  
                      <div class="tab-pane fadee" id="outflow">

                      </div> 
                      </div>
                    </div>
               </div>
	        </div>
          </div>
		  <?php
						}
					?>
       </div>
    </div>
<?php include('../template/'.$mkcms_bdyun.'/footer.php');?>  
</body>
</html>