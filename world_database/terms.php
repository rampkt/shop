<?php
include("config/config.php");
include("functions/dashboard.php");
$dash = new dashboard();
$date=date("Y-m-d");
$totals = $dash->totalCount();
$row_scroll = $dash->cms("scrolling_content");
?>

<?php
include("includes/header.php");
 ?>
    <!-- Page Content -->
    <div class="container" style="min-height:522px;height:auto;">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">All List</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Country (<?php echo $totals['country']?>)</a>
                    <a href="#" class="list-group-item">State (<?php echo $totals['state']?>)</a>
                    <a href="#" class="list-group-item">City (<?php echo $totals['city']?>)</a>
                </div>
            </div>

            <div class="col-md-9">

                 <div class="row formcenter">
                  
				  <div> <h3 style="margin-top:0px;"> Terms & Conditions</h3></div>
				  <br>
				 <div class="text-top">
				 <?php 
				$terms=$dash->cms("terms");
				 
				 ?>
				 <?=html_entity_decode($terms)?>
				 </div>
				 
                  
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
<div style="background:#000;">
    <div class="container">

        <!-- Footer -->
       <?php include("includes/footer.php");?>
    </div>
 </div>
    <!-- /.container -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
   <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
