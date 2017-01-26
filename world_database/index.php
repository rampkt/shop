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
                  
				  <div> <h3 style="margin-top:0px;"> Type and get country, state, city</h3></div>
				  <br>
				 <div class="text-top">
				 <input type="text" name="country" id="search-box" class="text-lg" placeholder="Enter Country" autocomplete="off">
				 <input type="hidden" name="countryid" id="countryid">
                 <div id="suggesstion-box"></div>
				 </div>
				 <div class="text-top">
				 <input type="text" name="state" id="search-box2" class="text-lg" placeholder="Enter State" autocomplete="off">
				  <input type="hidden" name="stateid" id="stateid">
				 <div id="suggesstion-box2"></div>
				 </div>
				 <div class="text-top">
				 <input type="text" name="city" id="search-box3" class="text-lg" placeholder="Enter City" autocomplete="off">
				 <div id="suggesstion-box3"></div>
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
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readCountry.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 280px");
		},
		success: function(data){
			//alert(data);
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
	
	$("#search-box2").keyup(function(){
		var country=$('#countryid').val();
		//alert($(this).val());
		$.ajax({
		type: "POST",
		url: "readState.php",
		data:'country='+country+'&keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box2").css("background","#FFF url(LoaderIcon.gif) no-repeat 280px");
		},
		success: function(data){
			//alert(data);
			$("#suggesstion-box2").show();
			$("#suggesstion-box2").html(data);
			$("#search-box2").css("background","#FFF");
		}
		});
	});
	
	$("#search-box3").keyup(function(){
		var state=$('#stateid').val();
		//alert(state);
		$.ajax({
		type: "POST",
		url: "readCity.php",
		data:'state='+state+'&keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box3").css("background","#FFF url(LoaderIcon.gif) no-repeat 280px");
		},
		success: function(data){
			//alert(data);
			$("#suggesstion-box3").show();
			$("#suggesstion-box3").html(data);
			$("#search-box3").css("background","#FFF");
		}
		});
	});
	
	
});

function selectCountry(val,id) {
$("#search-box").val(val);
$("#countryid").val(id);
$("#suggesstion-box").hide();
}
function selectstate(val,id) {
$("#search-box2").val(val);
$("#stateid").val(id);
$("#suggesstion-box2").hide();
}
function selectcity(val) {
$("#search-box3").val(val);
$("#suggesstion-box3").hide();
}
</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
