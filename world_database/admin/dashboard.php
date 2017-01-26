<?php
include_once("../config/config.php");
is_admin_login();
include("./includes/access.php");
spl_autoload_register(function($file){
	include("./functions/".$file.".php");
});

$dash = new dashboard();
$date=date("Y-m-d");
$totals = $dash->totalCount();
//$totalstoday = $dash->totalCounttoday($date);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
 .breadcrumb a 
	{
		color:#08c !important;
	}
</style>

	<? include('./includes/head.php'); ?>
</head>

<body>
		<!-- start: Header -->
        <? include('./includes/header.php'); ?>
        <!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<? include('./includes/mainmenu.php'); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			<? //include('./includes/breadcrumb.php'); ?>
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>Dashboard</li>
			</ul>
			
			
			<div><h4>Total Count</h4></div>
			<hr style="margin:5px 0px;border-bottom:2px solid #CCC;" />
			<div class="row-fluid">
			
				
                <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
					<div class="number"><?=$totals['country']?><i class="icon-arrow-up"></i></div>
					<div class="title">Total Countries</div>
					<div class="footer">
						<a href="country.php"> View full Countries</a>
					</div>	
				</div>
				
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number"><?=$totals['state']?><i class="icon-arrow-up"></i></div>
					<div class="title">Total States</div>
					<div class="footer">
						<a href="state.php"> View full States</a>
					</div>
				</div>
				
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number"><?=$totals['city']?><i class="icon-arrow-up"></i></div>
					<div class="title">Total Cities</div>
					<div class="footer">
						<a href="city.php"> views full cities</a>
					</div>
				</div>
				
				
			</div>		
			
			

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
	
    <? include('./includes/footer.php'); ?>
	
	<!-- start: JavaScript-->
	<? include('./includes/footerinclude.php'); ?>
	<!-- end: JavaScript-->
	
</body>
</html>