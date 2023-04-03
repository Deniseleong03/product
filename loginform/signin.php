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

	// Check if the form has been submitted
	if (isset($_POST['login'])) {

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
		} else {
			// Execute the query to retrieve the user's information
			$query = "SELECT * FROM customers WHERE username=:username, pass=:pass";

			$stmt = $con->prepare($query);
			$stmt->bindParam(':pass', $pass);
			$stmt->bindParam(':username', $username);
			$stmt->execute();

			//if return result
			$result = $stmt->rowCount();

			if ($result == 1) {
				// Check if the query returned exactly one row
				$user = $stmt->fetch(PDO::FETCH_ASSOC);


				if ($user['accstatus'] == 'active') {

					$_SESSION['username'] = $username;

					header("Location: home.php");
					exit();

				} else {
					//acc inactive
					$error_message = 'Your account is inactive';
				}
			} else {
				// Username/password not found
				$error_message = 'Invalid username or password';
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
		            	<button type="submit" name='login' class="form-control btn btn-primary rounded submit px-3">Sign In</button>
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
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>







	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  
</div><!--the end of container-->
	</body>

</html>

