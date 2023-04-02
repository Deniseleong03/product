<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>

 <!-- container -->
    <div class="container">

	<!-- PHP signin will be here -->
       <?php
	   session_start(); // Start the session
	   
	   // Check if the form has been submitted
	   if ($_POST) {
		   // include database connection
	   	include 'config/database.php';
		   // Get the form data
	   	$username = htmlspecialchars(strip_tags($_POST['username']));
		   $pass = htmlspecialchars(strip_tags($_POST['pass']));

		   // Check if both fields are filled
	   	if (empty($username)) {
            $error_message = "Username is required";
          }
		   if (empty($pass)) {
			   $error_message = "Password is required";
		   }else {
			   // Execute the query to retrieve the user's information
	   		$query = "SELECT * FROM customers WHERE (username='$username' OR email='$username') AND status='active'";
			   $result = mysqli_query($conn, $query);

			   // Check if the query returned exactly one row
	   		if (mysqli_num_rows($result) == 1) {
				   $user = mysqli_fetch_assoc($result);

				   // Verify the password hash
	   			if (password_verify($pass, $user['pass'])) {
					
					   // Password is correct, set the session variable and redirect to home page
	   				$_SESSION['user_id'] = $user['id'];
					   header('Location: home.php');
					   exit();
				   } else {
					   // Password is incorrect
	   				$error_message = 'Incorrect password.';
				   }
			   } else {
				   // Username/email not found or account is inactive
	   			$error_message = 'Incorrect username/email or account is inactive.';
			   }
			   
		   }
	   }

	   ?>


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								
			      	</div>
							<form action="#" class="signin-form">
			      		<div class="form-group mt-3">
			      			<input type="text" class="form-control" required>
			      			<label class="form-control-placeholder" for="username">Username</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
		          <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<!-- Display an error message if the login failed -->
<?php if (isset($error_message)) { ?>
		<p>
			<?php echo $error_message; ?>
		</p>
	<?php } ?>





	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  
</div><!--the end of container-->
	</body>

</html>

