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
        try {
            // prepare select query
            $query = "SELECT id, username, pass FROM customers WHERE id = ? ";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $pass = $row['pass'];
            $old_pass = '';
            $new_pass = '';
            $confirm_new_pass = '';
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
        
        <?php
        // check if form was submitted
        if ($_POST) {
            try {
                // write update query
                $query = "UPDATE customers SET";

                // check if the entered username is different from the old username
                $new_username = htmlspecialchars(strip_tags($_POST['username']));
                if ($new_username === $username) {
                    $username_error = 'New username cannot be the same as old username.';
                } else {
                    $username = $new_username;
                    $query .= " username=:username";
                }

                // check if password fields are filled in
                $old_pass = htmlspecialchars(strip_tags($_POST['old_pass']));
                $new_pass = htmlspecialchars(strip_tags($_POST['new_pass']));
                $confirm_new_pass = htmlspecialchars(strip_tags($_POST['confirm_new_pass']));

                // retrieve user's current password hash from database
                $stmt = $con->prepare("SELECT pass FROM customers WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $pass_hash = $row['pass'];

                if (!empty($old_pass) && !empty($new_pass) && !empty($confirm_new_pass)) {
                    // check if old password is correct
                    if (md5($old_pass) !== $pass_hash) {
                        $old_pass_error = 'Old password is incorrect.';
                    }

                    // check if new password is different from old password
                    if ($new_pass === $pass_hash) {
                        $new_pass_error = 'New password cannot be the same as old password.';
                    }
                    // check if new password and confirm new password match
                    if ($new_pass !== $confirm_new_pass) {
                        $confirm_pass_error = 'New password and confirm new password do not match.';
                    }
                    // add password fields to update query
                    $new_pass = md5($new_pass); // hash the new password
                    $query .= ", pass=:new_pass";
                }

                $query .= " WHERE id = :id";
                // prepare query for execution
                $stmt = $con->prepare($query);
                // bind the parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':id', $id);
                // bind password fields if they exist
                if (!empty($old_pass) && !empty($new_pass) && !empty($confirm_new_pass)) {
                    $stmt->bindParam(':new_pass', $new_pass);
                }
                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }
            // show errors
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>



        <!-- HTML form to update record will be here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' value="<?php echo htmlspecialchars($username, ENT_QUOTES); ?>"
                            class='form-control' />
                            <?php if (isset($username_error)) { ?>
                                <span class="text-danger">
                                    <?php echo $username_error; ?>
                                </span>
                            <?php } ?>
                        </td>
                </tr>
                <tr>
                    <td>Enter old Password</td>
                    <td><textarea name='old_pass'
                            class='form-control'><?php echo htmlspecialchars($old_pass, ENT_QUOTES); ?></textarea><?php if (isset($old_pass_error)) { ?>
                                <span class="text-danger">
                                    <?php echo $old_pass_error; ?>
                                </span>
                            <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Enter New Password</td>
                    <td><input type='text' name='new_pass' value="<?php echo htmlspecialchars($new_pass, ENT_QUOTES); ?>"
                            class='form-control' /><?php if(isset($new_pass_error)) { ?>
            <span class="text-danger"><?php echo $new_pass_error; ?></span>
        <?php } ?></td>
                </tr>
                <tr>
                    <td>Comfirm Password </td>
                    <td><input type='text' name='confirm_new_pass' value="<?php echo htmlspecialchars($confirm_new_pass, ENT_QUOTES); ?>"
                            class='form-control' /><?php if(isset($confirm_pass_error)) { ?>
            <span class="text-danger"><?php echo $confirm_pass_error; ?></span>
        <?php } ?></td>
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