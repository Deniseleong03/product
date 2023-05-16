<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>
        .login-form {
            max-width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }

        .login-form form {
            height: 100%;
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>

<body>

	<!-- container -->
	<div class="container">

		<!-- PHP signin will be here -->
		<?php
		session_start();
		// Initialize error message variable
		$error_message = '';

		if (isset($_GET['action'])) {
			if ($_GET['action'] == 1) {
				$error_message .= "<div class='alert alert-danger'>Please login your account</div>";
			}
		}

		// Check if the form has been submitted
		if (isset($_POST['submit'])) {
			// include database connection
			include 'config/database.php';

			try {


				// Get the form data
				$username = htmlspecialchars(strip_tags($_POST['username']));
				$pass = htmlspecialchars(strip_tags($_POST['pass']));



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
					$query = "SELECT * FROM customers WHERE username = :username";

					$stmt = $con->prepare($query);
					$stmt->bindParam(':username', $username);
					$stmt->execute();

					//if return result
					$result = $stmt->rowCount();

					if ($result == 1) {
						// Check if the query returned exactly one row
						$user = $stmt->fetch(PDO::FETCH_ASSOC);

						if ($user['pass'] == md5($pass)) {
							if ($user['accstatus'] == 'active') {


								$_SESSION['username'] = $username;
								header("Location:index.php");
								exit();

							} else {
								//acc inactive
								$error_message .= "<div class='alert alert-danger'>Your account is inactive</div>";
							}
						} else {
							// Username/password not found
							$error_message .= "<div class='alert alert-danger'>Incorrect password</div>";
						}
					} else {
						// Incorrect username / email
						$error_message .= "<div class='alert alert-danger'>Incorrect username / email</div>";
					}
				}
			} catch (PDOException $exception) {
				die('ERROR: ' . $exception->getMessage());
			}
		}
		?>



		<div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">
		<h2 class="text-center">Log in</h2>       
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Username" name="username" id="username" >
			<?php if (isset($usernameErr)) { ?>
									<span class="text-danger">
										<?php echo $usernameErr; ?>
									</span>
								<?php } ?>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="pass" id="password" >
			<?php if (isset($passErr)) { ?>
				<span class="text-danger">
					<?php echo $passErr; ?>
				</span>
			<?php } ?>
		</div>
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
		</div>
		      
	</form>
	
</div>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



	</div><!--the end of container-->
</body>

</html>

