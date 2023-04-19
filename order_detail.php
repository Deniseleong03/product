<?php
// Start the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or show an error message
    header('Location: loginform/signin.php?action=1');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>
    <?php include 'nav.php'; ?>
    
    <!-- container -->
    <div class="container">

        <!-- PHP code to read records will be here -->
        <!-- PHP read one record will be here -->
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        // include database connection
        include 'config/database.php';

        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record ID not found.');

        // query to select the category name
        $orders_query = "SELECT order_id FROM orderdetails WHERE order_id = ?";
        $orders_stmt = $con->prepare($orders_query);
        $orders_stmt->bindParam(1, $order_id);
        $orders_stmt->execute();
        $orders_row = $orders_stmt->fetch(PDO::FETCH_ASSOC);
       

        // display the header with the category name
        echo "<div class='container'>";
        echo "<div class='page-header'>";
        echo "<h1>" . $order_id . "</h1>";
        echo "</div>";

        // query to select all products that belong to the category name
        $orderdetails_query = "SELECT * FROM orderdetails JOIN orders ON orderdetails.order_id = orders.order_id WHERE orderdetails.order_id = ?";
        $orderdetails_stmt = $con->prepare($orderdetails_query);
        $orderdetails_stmt->bindParam(1, $id);
        $orderdetails_stmt->execute();

        // check if more than 0 record found
        $num = $orderdetails_stmt->rowCount();

        echo "<a href='order_read.php' class='btn btn-danger'>Back to read orders</a>";

        if ($num > 0) {
            // display products in a table format
            echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
            echo "<th>Order Details ID</th>";
            echo "<th>Order ID</th>";
            echo "<th>Product ID</th>";
            echo "<th>Quantity</th>";
            echo "<th>Date</th>";
            echo "</tr>";
            while ($row = $orderdetails_stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$orderdetail_id}</td>";
                echo "<td>{$order_id}</td>";
                echo "<td>{$product_id}</td>";
                echo "<td>{$quantity}</td>";
                echo "<td>{$date}</td>";
                echo "<td>";


                // we will use this links on next part of this post
                echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // end table
            echo "</table>";
        }
        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";

        }
        ?>



    </div> <!-- end .container -->

    <!-- confirm delete record will be here -->

</body>

</html>