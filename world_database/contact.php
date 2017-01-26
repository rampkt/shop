<?php
include("config/config.php");
include("functions/dashboard.php");
$dash = new dashboard();
$date=date("Y-m-d");
$totals = $dash->totalCount();
$row_scroll = $dash->cms("scrolling_content");

include("./functions/cms.php");

$cms=new cms();
if(isset($_REQUEST['action'])) {
	if(($_REQUEST['action'])=='contactus') {
	
	$cms->name = $db->escape_string($_REQUEST['name']);
	$cms->email = $db->escape_string($_REQUEST['email']);
	$cms->subject = $db->escape_string($_REQUEST['subject']);
	$cms->message = $db->escape_string($_REQUEST['message']);
	$cms->ipaddr=$_SERVER['REMOTE_ADDR'];
	$adminmail=$cms->getsetting('1','email');
	//echo $adminmail; exit;
	
	$result = $cms->contactussave();
 // print_r($result);exit;
	
	     
	if($result)
	{
		$from = $cms->email;
		$to = array($adminmail);
		$subject = $cms->subject;
   
    $message = '<div style="width:600px;">
    Dear Admin<br>
    <p>Welcome to World Database</p>
    <p>Please check below mentioned customer query. revert back to user as soon as possible</p>
    <br/>
	<table>
	<tr>
	<td>Name :</td>
	<td>'.$cms->name.'</td>
	
	</tr>
	<tr>
	<td>Message :</td>
	<td>'.$cms->message.'</td>
	
	</tr>
	
	</table><br><br>
	
    Thanks & regards,<br />
    <a href="'.HTTP_PATH.'">World Database</a>
    </div>';
		
		$mailler->sendmail($to, $from, $subject, $message);
		
		$from1 = $adminmail;
		$to1 = array($cms->email);
		$subject1 = "World Database: Contact us";
   
    $message1 = '<div style="width:600px;">
    Dear '.$cms->name.'<br><br>
   
    <p>Your Message has been sent to our administator, They will contact as soon.</p>
    <br><br>
	
	
    Thanks & regards,<br />
    <a href="'.HTTP_PATH.'">World Database</a>
    </div>';
		
		$mailler->sendmail($to1, $from1, $subject1, $message1);
		
		
		redirect(HTTP_PATH . "contact.php?success=1");
	}
}
}


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
                  
				  
				  <div> <h3 style="margin-top:0px;">Contact Us</h3></div>
				  <br>
				  
				   <? if(isset($_REQUEST['success']) AND $_REQUEST['success'] == '1') { ?>
    <div class="alert-success"><strong> Success ! </strong>Message has been sent to our administator, they will contact you soon.</div>
    <? } ?>
				<!-- content area -->    
	<section id="content">
    	<form class="form-horizontal" action='' name="contactus" method="POST" data-parsley-validate="">
          <fieldset>
            <div class="control-group">
              <!-- Username -->
              <span class="pull-right" id="name-error"></span>
              <label class="control-label"  for="name">Name</label>
              <div class="controls">
                <input type="text" id="name" name="name" placeholder="" class="form-control input-lg" required data-parsley-errors-container="#name-error" />
                <p class="help-block">Name can contain only Characters</p>
              </div>
            </div>
         
            <div class="control-group">
              <!-- E-mail -->
              <span class="pull-right" id="email-error"></span>
              <label class="control-label" for="email">E-mail</label>
              <div class="controls">
                <input type="email" id="email" name="email" placeholder="" class="form-control input-lg" required data-parsley-errors-container="#email-error" />
                <p class="help-block">Please provide your E-mail</p>
              </div>
            </div>
       
            
            <div class="control-group">
              <!-- subject -->
              <span class="pull-right" id="subject-error"></span>
              <label class="control-label"  for="subject">Subject</label>
              <div class="controls">
                <input type="text" id="subject" name="subject" placeholder="" class="form-control input-lg" required data-parsley-errors-container="#subject-error"  />
                <p class="help-block">Please enter subject here</p>
              </div>
            </div>
            
            <div class="control-group">
              <!-- subject -->
              <span class="pull-right" id="message-error"></span>
              <label class="control-label"  for="message">Message</label>
              <div class="controls">
                <textarea id="message" name="message" style="height:150px;" placeholder="" class="form-control input-lg" required data-parsley-errors-container="#message-error"></textarea>
                <p class="help-block">Please enter your message here</p>
              </div>
            </div>
            
         
            <div class="control-group">
              <!-- Button -->
              <div class="controls">
                <button type="submit" name="action" value="contactus" class="btn btn-success">Submit</button>
              </div>
            </div>
          </fieldset>
        </form>
    </section><!-- #end content area -->
      
      
              <br> <br>   
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
