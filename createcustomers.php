<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Navbar Dropdown Login and Signup Form with Social Buttons</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: 'Varela Round', sans-serif;
    }

    .form-control {
      box-shadow: none;
      font-weight: normal;
      font-size: 13px;
    }

    .form-control:focus {
      border-color: #33cabb;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .navbar {
      background: #fff;
      padding-left: 16px;
      padding-right: 16px;
      border-bottom: 1px solid #dfe3e8;
      border-radius: 0;
    }

    .nav img {
      border-radius: 50%;
      width: 36px;
      height: 36px;
      margin: -8px 0;
      float: left;
      margin-right: 10px;
    }

    .navbar .navbar-brand,
    .navbar .navbar-brand:hover,
    .navbar .navbar-brand:focus {
      padding-left: 0;
      font-size: 20px;
      padding-right: 50px;
    }

    .navbar .navbar-brand b {
      font-weight: bold;
      color: #33cabb;
    }

    .navbar .form-inline {
      display: inline-block;
    }

    .navbar .nav li {
      position: relative;
    }

    .navbar .nav li a {
      color: #888;
    }

    .search-box {
      position: relative;
    }

    .search-box input {
      padding-right: 35px;
      border-color: #dfe3e8;
      border-radius: 4px !important;
      box-shadow: none
    }

    .search-box .input-group-addon {
      min-width: 35px;
      border: none;
      background: transparent;
      position: absolute;
      right: 0;
      z-index: 9;
      padding: 7px;
      height: 100%;
    }

    .search-box i {
      color: #a0a5b1;
      font-size: 19px;
    }

    .navbar .nav .btn-primary,
    .navbar .nav .btn-primary:active {
      color: #fff;
      background: #33cabb;
      padding-top: 8px;
      padding-bottom: 6px;
      vertical-align: middle;
      border: none;
    }

    .navbar .nav .btn-primary:hover,
    .navbar .nav .btn-primary:focus {
      color: #fff;
      outline: none;
      background: #31bfb1;
    }

    .navbar .navbar-right li:first-child a {
      padding-right: 30px;
    }

    .navbar ul li i {
      font-size: 18px;
    }

    .navbar .dropdown-menu i {
      font-size: 16px;
      min-width: 22px;
    }

    .navbar ul.nav li.active a,
    .navbar ul.nav li.open>a {
      background: transparent !important;
    }

    .navbar .nav .get-started-btn {
      min-width: 120px;
      margin-top: 8px;
      margin-bottom: 8px;
    }

    .navbar ul.nav li.open>a.get-started-btn {
      color: #fff;
      background: #31bfb1 !important;
    }

    .navbar .dropdown-menu {
      border-radius: 1px;
      border-color: #e5e5e5;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
    }

    .navbar .nav .dropdown-menu li {
      color: #999;
      font-weight: normal;
    }

    .navbar .nav .dropdown-menu li a,
    .navbar .nav .dropdown-menu li a:hover,
    .navbar .nav .dropdown-menu li a:focus {
      padding: 8px 20px;
      line-height: normal;
    }

    .navbar .navbar-form {
      border: none;
    }

    .navbar .dropdown-menu.form-wrapper {
      width: 280px;
      padding: 20px;
      left: auto;
      right: 0;
      font-size: 14px;
    }

    .navbar .dropdown-menu.form-wrapper a {
      color: #33cabb;
      padding: 0 !important;
    }

    .navbar .dropdown-menu.form-wrapper a:hover {
      text-decoration: underline;
    }

    .navbar .form-wrapper .hint-text {
      text-align: center;
      margin-bottom: 15px;
      font-size: 13px;
    }

    .navbar .form-wrapper .social-btn .btn,
    .navbar .form-wrapper .social-btn .btn:hover {
      color: #fff;
      margin: 0;
      padding: 0 !important;
      font-size: 13px;
      border: none;
      transition: all 0.4s;
      text-align: center;
      line-height: 34px;
      width: 47%;
      text-decoration: none;
    }

    .navbar .social-btn .btn-primary {
      background: #507cc0;
    }

    .navbar .social-btn .btn-primary:hover {
      background: #4676bd;
    }

    .navbar .social-btn .btn-info {
      background: #64ccf1;
    }

    .navbar .social-btn .btn-info:hover {
      background: #4ec7ef;
    }

    .navbar .social-btn .btn i {
      margin-right: 5px;
      font-size: 16px;
      position: relative;
      top: 2px;
    }

    .navbar .form-wrapper .form-footer {
      text-align: center;
      padding-top: 10px;
      font-size: 13px;
    }

    .navbar .form-wrapper .form-footer a:hover {
      text-decoration: underline;
    }

    .navbar .form-wrapper .checkbox-inline input {
      margin-top: 3px;
    }

    .or-seperator {
      margin-top: 32px;
      text-align: center;
      border-top: 1px solid #e0e0e0;
    }

    .or-seperator b {
      color: #666;
      padding: 0 8px;
      width: 30px;
      height: 30px;
      font-size: 13px;
      text-align: center;
      line-height: 26px;
      background: #fff;
      display: inline-block;
      border: 1px solid #e0e0e0;
      border-radius: 50%;
      position: relative;
      top: -15px;
      z-index: 1;
    }

    .navbar .checkbox-inline {
      font-size: 13px;
    }

    .navbar .navbar-right .dropdown-toggle::after {
      display: none;
    }

    @media (min-width: 1200px) {
      .form-inline .input-group {
        width: 300px;
        margin-left: 30px;
      }
    }

    @media (max-width: 768px) {
      .navbar .dropdown-menu.form-wrapper {
        width: 100%;
        padding: 10px 15px;
        background: transparent;
        border: none;
      }

      .navbar .form-inline {
        display: block;
      }

      .navbar .input-group {
        width: 100%;
      }

      .navbar .nav .btn-primary,
      .navbar .nav .btn-primary:active {
        display: block;
      }
    }
  </style>
  <script>
    // Prevent dropdown menu from closing when click inside the form
    $(document).on("click", ".navbar-right .dropdown-menu", function (e) {
      e.stopPropagation();
    });
  </script>
</head>

<body>
  <nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Brand<b>Name</b></a>
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/project/home.php">Home</a></li>
        <li><a href="http://localhost/project/contactus.php">Contact Us</a></li>
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="http://localhost/project/product_create.php#">Create
            Product <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/project/product_create.php">Create Products</a></li>
            <li><a href="http://localhost/project/product_read.php">List All Product</a></li>
            <li><a href="http://localhost/project/product_read_one.php#">Read One Product's Details</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="http://localhost/project/createcustomers.php">Create
            Customers <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/project/createcustomers.php">Create Customers</a></li>
            <li><a href="#">List All Customer</a></li>
            <li><a href="#">Read One Customer's Details</a></li>
          </ul>
        </li>


      </ul>


  <body>
    <!-- container -->
    <div class="container">

     <div class="page-header">
      <br>
      <h1>Create Customers</h1>
    </div>

      <?php
      // Check if the form has been submitted
      if ($_POST) {
        // include database connection
        include 'config/database.php';
        try {

          
          // Get the form data
          $username = htmlspecialchars(strip_tags($_POST['username']));
          $pass = htmlspecialchars(strip_tags($_POST['pass']));
          $confpassword = htmlspecialchars(strip_tags($_POST['confpassword']));
          $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
          $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
          if (isset($_POST['gender'])){
          $gender = htmlspecialchars(strip_tags($_POST['gender']));
        }
          $dob = htmlspecialchars(strip_tags($_POST['dob']));
          if (isset($_POST['accstatus'])){
          $accstatus = htmlspecialchars(strip_tags($_POST['accstatus']));
          }

             
          // Validate the form data
          if (empty($username)) {
            $usernameErr = "Username is required";
          } elseif (strlen($username) < 6) {
            $usernameErr = "Username must be at least 6 characters long";
          }elseif (!preg_match("/^[a-zA-Z]+$/", $username)) {
            // If the username contains anything other than alphabets, display an error message
            $usernameErr = "Username can only contain alphabets";
          }

          if (empty($pass)) {
            $passErr = "Password is required";
          } elseif (strlen($password) >= 6 && preg_match('/[A-Za-z]/', $password) && preg_match('/\d/', $password)) {
            $passErr = "Password must contain at least 6 characters (at least 1 number + 1 alphabet)";
          }

          if (empty($confpassword)) {
            $confpasswordErr = "Confirm Password is required";
          } elseif ($pass != $confpassword) {
            $confpasswordErr = "Passwords do not match";
          }

          if (empty($firstname)) {
            $firstnameErr = "First Name is required";
          }

          if (empty($lastname)) {
            $lastnameErr = "Last Name is required";
          }

          if (empty($gender)) {
            $genderErr = "Gender is required";
          }

          if (empty($dob)) {
            $dobErr = "Date of Birth is required";
          }

          if (empty($accstatus)) {
            $accountstatusErr = "Account status is required";
          }
          
          //check if got any error
          if (!isset($usernameErr) && !isset($passErr) && !isset($confpasswordErr) && !isset($firstnameErr) && !isset($lastnameErr) && !isset($genderErr) && !isset($dobErr) && !isset($accountstatusErr)) {

            // insert query
            $query = "INSERT INTO customers SET username=:username, pass=:pass, firstname=:firstname, lastname=:lastname, gender=:gender, dob=:dob, regdatetime=:regdatetime, accstatus=:accstatus";

            // prepare query for execution
            $stmt = $con->prepare($query);

            // bind the parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':accstatus', $accstatus);

            // specify when this record was inserted to the database
            $regdatetime = date('Y-m-d H:i:s');
            $stmt->bindParam(':regdatetime', $regdatetime);
            

            // Execute the query
            if ($stmt->execute()) {
              echo "<div class='alert alert-success'>Record was saved.</div>";

            } else {
              echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
          }

        }

        // show error
              catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
              }
      }
      ?>

      <!-- html form here where the product information will be entered -->

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class='table table-hover table-responsive table-bordered'>
          <tr>
            <td> Username (at least 6 characters)</td>
            <td><input type="text" class="form-control" name="username" minlength="6" required  
            value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" />
            <?php if (isset($usernameErr)) { ?><span class="text-danger">
              <?php echo $usernameErr; ?>
            </span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td><label for="pass" class="form-label">Password (at least 6 characters, 1 letter, 1 number):</label></td>
            <td><input type="password" name='pass' class="form-control" id="pass" pattern="(?=.*\d)(?=.*[a-zA-Z]).{6,}" required
            value="<?php echo isset($pass) ? htmlspecialchars($pass) : ''; ?>" />
            <?php if (isset($passErr)) { ?><span class="text-danger">
                <?php echo $passErr; ?>
              </span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td><label for="confpassword" class="form-label">Confirm Password</label></td>
            <td><input type="password" name='confpassword' class="form-control" id="confpassword" required>
            <?php if (isset($confpasswordErr)) { ?>
              <span class="text-danger"><?php echo $confpasswordErr; ?></span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td> <label for="firstname" class="form-label">First Name</label></td>
            <td> <input type="text" class="form-control" id="firstname" name="firstname" required>
            <?php if (isset($firstnameErr)) { ?>
              <span class="text-danger"><?php echo $firstnameErr; ?></span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td><label for="lastname" class="form-label">Last Name</label></td>
            <td> <input type="text" class="form-control" id="lastname" name="lastname" required>
            <?php if (isset($lastnameErr)) { ?>
              <span class="text-danger"><?php echo $lastnameErr; ?></span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td><label>Gender</label></td>
            <td>
              <input type="radio" name="gender" id="male" value="male"><label for="male">Male</label>
              <input type="radio" name="gender" id="female" value="female"><label for="female">Female</label>
              
            <br>
            <?php if (isset($genderErr)) { ?>
              <span class="text-danger"><?php echo $genderErr; ?></span>
            <?php } ?> 
          </td>
          </tr>

          <tr>
            <td><label for="$dob" class="form-label">Date of Birth</label></td>
            <td><input type="date" name="dob" id="dob"><br>
            <?php if (isset($dobErr)) { ?>
              <span class="text-danger"><?php echo $dobErr; ?></span>
            <?php } ?>
          </td>
          </tr>

          <tr>
            <td><label for="accstatus">Account Status</label></td>
            <td>
              
                <input type="radio" name="accstatus" id="accstatus" value="accstatus"><label for="accstatus">Active</label>
                <input type="radio" name="accstatus" id="accstatus" value="accstatus"><label for="accstatus">Inactive</label>
                
            
           <br>
            <?php if (isset($accountstatusErr)) { ?>
              <span class="text-danger">
                <?php echo $accountstatusErr; ?>
              </span>
            <?php } ?> 
          </td>
          </tr>

          <tr>
          
          <td>
            <input type='submit' value='Submit' class='btn btn-primary' />
          </td>
        </tr>

        </table>
      </form>



  </body>

</html>