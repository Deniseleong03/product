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
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.text-right {
  text-align: right;
}
</style>
<body>
    <?php include 'nav.php'; ?>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    // include database connection
    include 'config/database.php';

    // get passed parameter value, in this case, the record ID
    // isset() is a PHP function used to verify if a value is there or not
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record ID not found.');

    // query to select the category name
    $orders_query = "SELECT customers.firstname as fname, customers.lastname as lastname FROM orders JOIN customers ON orders.customer_id = customers.id WHERE order_id = ?";
    $orders_stmt = $con->prepare($orders_query);
    $orders_stmt->bindParam(1, $order_id);
    $orders_stmt->execute();
    $orders_row = $orders_stmt->fetch(PDO::FETCH_ASSOC);
    extract($orders_row);

    // display the header with the category name
    echo "<div class='container'>";
    echo "<div class='page-header'>";
    echo "<h1>" . $order_id . "</h1>";
    echo "<h3>Customer Name:$fname $lastname</h3>";
    echo "</div>";

    // query to select all products that belong to the category name
    $orderdetails_query = "SELECT orderdetails.orderdetail_id, orderdetails.order_id, orderdetails.product_id, products.name as product_name, orderdetails.quantity, products.price FROM orderdetails JOIN products ON orderdetails.product_id = products.id WHERE orderdetails.order_id = ?";
    $orderdetails_stmt = $con->prepare($orderdetails_query);
    $orderdetails_stmt->bindParam(1, $order_id);
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
        echo "<th>Product Name</th>";
        echo "<th>Quantity</th>";
        echo "<th class='text-right'>Price</th>";
        echo "<th class='text-right'>Total</th>";
        echo "</tr>";

        $total_price = 0;

        while ($row = $orderdetails_stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['firstname'] to just $firstname only
            extract($row);

            // calculate total
            $total = $quantity * $price;
            $total_price += $total;

            // creating new table row per record
            echo "<tr>";
            echo "<td>{$orderdetail_id}</td>";
            echo "<td>{$order_id}</td>";
            echo "<td>{$product_id}</td>";
            echo "<td>{$product_name}</td>";
            echo "<td>{$quantity}</td>";
            echo "<td class='text-right'>{$price}</td>";
            echo "<td class='text-right'>{$total}</td>";
            echo "</tr>";
        }

        // display total price
        echo "<tr>";
        echo "<td colspan='6' class='text-right'>Total Price:</td>";
        echo "<td class='text-right'>{$total_price}</td>";
        echo "</tr>";

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