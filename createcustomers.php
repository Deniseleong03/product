<?php
// Start the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['username'])) {
  // Redirect to login page or show an error message
  header('Location: signin.php?action=1');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDO - Create a Record - PHP CRUD Tutorial</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<body>
<?php include 'nav.php';?>


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
          $pass = $_POST['pass'];
          $confpassword = $_POST['confpassword'];
          $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
          $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
          if (isset($_POST['gender'])){
          $gender = htmlspecialchars(strip_tags($_POST['gender']));
        }
          $dob = htmlspecialchars(strip_tags($_POST['dob']));
          if (isset($_POST['accstatus'])){
          $accstatus = htmlspecialchars(strip_tags($_POST['accstatus']));
          }

          $uppercase = preg_match('@[A-Z]@', $password);
          $lowercase = preg_match('@[a-z]@', $password);
          $number = preg_match('@[0-9]@', $password);

             
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
          } elseif (!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
            $passErr = "Password must contain at least 6 characters (at least 1 number + 1 alphabet)";
          }

          if (empty($confpassword)) {
            $confpasswordErr = "Confirm Password is required";
          } elseif ($pass != $confpassword) {
            $confpasswordErr = "Passwords do not match";
          }else{
            $pass = md5($pass);
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
              
                <input type="radio" name="accstatus" id="active" value="active"><label for="active">Active</label>
                <input type="radio" name="accstatus" id="inactive" value="inactive"><label for="inactive">Inactive</label>
                
            
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