<?php 

include("includes/topheader.php");
include("includes/header.php");
?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#">
							<input type="text" placeholder="Name" />
							<input type="email" placeholder="Email Address" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#">
							<div>
							<input type="text" placeholder="Name" required/>
							</div>
							<div>
							<input type="email" placeholder="Email Address" required />
							</div>
							<div>
							<input type="password" placeholder="Password" required />
							</div>
							<div>
							<input type="password" placeholder="Confirm-Password" required />
							</div>
							
							<div>
							<input type="text" placeholder="Mobile" required />
							</div>
							
							<div>
							<input type="text" placeholder="DOB" required/>
							</div>
							<div>
							<input type="text" placeholder="Address line 1" required />
							</div>
							<div>
							<input type="text" placeholder="Address line 2" required />
							</div>
							<div>
							<input type="text" placeholder="Country" required />
							</div>
							<div>
							<input type="text" placeholder="State" required />
							</div>
							<div>
							<input type="text" placeholder="City" required />
							</div>
							
							<div>
							<button type="submit" class="btn btn-default">Signup</button>
							</div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
<?php
include("includes/footer.php");
include("includes/footerbottom.php");
?>
    