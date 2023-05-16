<?php
// Start the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or show an error message
    header('Location: signin.php?action=1');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

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


    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Update Customer</h1>
        </div>
        <!-- PHP read record by ID will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        
        ?>
        
        <?php
        // check if form was submitted
        $old_pass = '';
        $new_pass = '';
        $confirm_pass = '';
        $error = 0;
        if ($_POST) {
            try {
                // get old record's data
                $query = "SELECT firstname, lastname, gender, dob, pass FROM customers WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

                // get posted values
                $new_firstname = htmlspecialchars(strip_tags($_POST['firstname']));
                $new_lastname = htmlspecialchars(strip_tags($_POST['lastname']));
                $new_gender = isset($_POST['gender']) ? htmlspecialchars(strip_tags($_POST['gender'])) : '';
                $new_dob = htmlspecialchars(strip_tags($_POST['dob']));
                $old_pass = htmlspecialchars(strip_tags($_POST['old_pass']));
                $new_pass = htmlspecialchars(strip_tags($_POST['new_pass']));
                $confirm_pass = htmlspecialchars(strip_tags($_POST['confirm_pass']));

                // check if new values are different from old values
                if ($new_firstname == $old_data['firstname'] && $new_lastname == $old_data['lastname'] && $new_gender == $old_data['gender'] && $new_dob == $old_data['dob']) {
                    $error_msg = "<div class='alert alert-warning'>No changes made to the record.</div>";
                   
                }
                // check if password fields are filled out
                if(!empty($old_pass) || !empty($new_pass) || !empty($confirm_pass)){
                    if (empty($new_pass) || empty($confirm_pass)) {
                        echo "<div class='alert alert-danger'>Please fill out all password fields.</div>";
                        $error = 1;
                    }else{
                        // check if old password matches the one in the database
                        if (md5($old_pass) != $old_data['pass']) {
                            $old_pass_error = "<div class='alert alert-danger'>Old password is incorrect.</div>";
                            
                        } else if (md5($new_pass) == $old_data['pass']) {
                            $new_pass_error = "<div class='alert alert-danger'>New password cannot be the same as the old password.</div>";
                            
                        } else if ($new_pass != $confirm_pass) {
                            $confirm_pass_error = "<div class='alert alert-danger'>New password and confirm password do not match.</div>";
                            
                        } 
                    }
                    
                }

                if(empty($old_pass_error) && empty($new_pass_error) && empty($confirm_pass_error) && $error == 0){
                    // write update query
                    $query = "UPDATE customers SET ";

                    // add fields to the query if they are provided
                    if (!empty($new_firstname)) {
                        $query .= "firstname=:firstname, ";
                    }
                    if (!empty($new_lastname)) {
                        $query .= "lastname=:lastname, ";
                    }
                    if (!empty($new_gender)) {
                        $query .= "gender=:gender, ";
                    }
                    if (!empty($new_dob)) {
                        $query .= "dob=:dob, ";
                    }

                    if(!empty($new_pass)){
                        $query .= "pass=:pass, ";
                    }

                    // remove trailing comma from query string
                    $query = rtrim($query, ", ");

                    // add WHERE clause and prepare query for execution
                    $query .= " WHERE id = :id";
                    $stmt = $con->prepare($query);

                    $stmt->bindParam(':id', $id);
                    // bind the parameters
                    if (!empty($new_firstname)) {
                        $stmt->bindParam(':firstname', $new_firstname);
                    }
                    if (!empty($new_lastname)) {
                        $stmt->bindParam(':lastname', $new_lastname);
                    }
                    if (!empty($new_gender)) {
                        $stmt->bindParam(':gender', $new_gender);
                    }
                    if (!empty($new_dob)) {
                        $stmt->bindParam(':dob', $new_dob);
                    }
                    if(!empty($new_pass)){
                        $new_password_md5 = md5($new_pass);
                        $stmt->bindParam(':pass', $new_password_md5);
                    }
                    

                


                    // execute the query and check if it was successful
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record.</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Unable to update record...</div>";
                
                }
                    
                    
                
               
            } catch (PDOException $exception) {
                die('Error: ' . $exception->getMessage());
            }
        }

        try {
            // prepare select query
            $query = "SELECT firstname, lastname, gender, dob, pass FROM customers WHERE id = ? ";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $pass = $row['pass'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>




        <!-- HTML form to update record will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>First name</td>
                    <td><input type='text' name='firstname' value="<?php echo htmlspecialchars($firstname, ENT_QUOTES); ?>"
                            class='form-control' />
                        <?php if (isset($error_msg)) { ?>
                            <span class="text-danger">
                                <?php echo $error_msg; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='lastname' value="<?php echo htmlspecialchars($lastname, ENT_QUOTES); ?>"
                            class='form-control' />
                        <?php if (isset($error_msg)) { ?>
                            <span class="text-danger">
                                <?php echo $error_msg; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                 <tr>
            <td>Enter old Password</td>
            <td><input type="password" name='old_pass' class='form-control'><?php if (isset($old_pass_error)) { ?>
                            <span class="text-danger">
                                <?php echo $old_pass_error; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Enter New Password</td>
                    <td><input type="password" name='new_pass' value="<?php echo htmlspecialchars($new_pass, ENT_QUOTES); ?>"
                            class='form-control' /><?php if (isset($new_pass_error)) { ?>
                            <span class="text-danger">
                                <?php echo $new_pass_error; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Confirm New Password</td>
                    <td><input type="password" name='confirm_pass' value="<?php echo htmlspecialchars($confirm_pass, ENT_QUOTES); ?>"
                            class='form-control' /><?php if (isset($confirm_pass_error)) { ?>
                            <span class="text-danger">
                                <?php echo $confirm_pass_error; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
            <td><label>Gender</label></td>
            <td>
              <input type="radio" name="gender" id="male" value="male"  <?php if ($gender == "male") {
                  echo 'checked';
              } ?>><label for="male">Male</label>
              <input type="radio" name="gender" id="female" value="female" <?php if ($gender == "female") {
                  echo 'checked';
              } ?>><label for="female" >Female</label>
              
            <br>
            <?php if (isset($error_msg)) { ?>
              <span class="text-danger"><?php echo $error_msg; ?></span>
            <?php } ?> 
          </td>
          </tr>
                <tr>
            <td><label for="$dob" class="form-label">Date of Birth</label></td>
            <td><input type="date" name="dob" value="<?php echo $dob  ?>"><br>
            <?php if (isset($error_msg)) { ?>
                            <span class="text-danger">
                                <?php echo $error_msg; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='customer_read.php' class='btn btn-danger'>Back to read customers</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
</body>

</html>