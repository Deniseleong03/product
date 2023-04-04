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
	session_start();

	// Check if the form has been submitted
	if (isset($_POST['submit'])) {
		 // include database connection
	 	include 'config/database.php';

		try {


			// Get the form data
			$username = htmlspecialchars(strip_tags($_POST['username']));
			$pass = htmlspecialchars(strip_tags($_POST['pass']));

			// Initialize error message variable
			$error_message = '';

			// Check if both fields are filled
			if (empty($username)) {
				$usernameErr = "Username is required";
				$error_message .= "<div class='alert alert-danger'>$usernameErr</div>";
			}
			if (empty($pass)) {
				$passErr = "Password is required";
				$error_message .= "<div class='alert alert-danger'>$passErr</div>";
			}

			// check if there are any errors
			if (empty($error_message)) {

				// Execute the query to retrieve the user's information
				$query = "SELECT * FROM customers WHERE username = :username AND pass = :pass";

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
						header("Location:home.php");
						exit();

					} else {
						//acc inactive
						$error_message .= "<div class='alert alert-danger'>Your account is inactive</div>";
					}
				} else {
					// Username/password not found
					$error_message .= "<div class='alert alert-danger'>Invalid username or password</div>";
				}
			}
		} catch (PDOException $exception) {
			 die('ERROR: ' . $exception->getMessage());
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
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">
							<div class="form-group mt-3">
								<input type="text" name="username" class="form-control" required>
									<label class="form-control-placeholder" for="username">Username</label>
										<?php if (isset($usernameErr)) { ?>
										<span class="text-danger">
											<?php echo $usernameErr; ?>
										</span>
									<?php } ?>
								</div>
								<div class="form-group">
									<input id="password-field" type="password" name="pass" class="form-control" required>
									<label class="form-control-placeholder" for="password">Password</label>
									<span toggle="#password-field"
										class="fa fa-fw fa-eye field-icon toggle-password"></span>
									<?php if (isset($passErr)) { ?>
										<span class="text-danger">
											<?php echo $passErr; ?>
										</span>
									<?php } ?>
								</div>
								<div class="form-group">
									<button type="submit" name='submit'
										class="form-control btn btn-primary rounded submit px-3">Sign In</button>
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

