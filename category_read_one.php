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
    $id = isset($_GET['cateid']) ? $_GET['cateid'] : die('ERROR: Record ID not found.');

    // query to select the category name
    $categories_query = "SELECT categoryname FROM categories WHERE cateid = ?";
    $categories_stmt = $con->prepare($categories_query);
    $categories_stmt->bindParam(1, $id);
    $categories_stmt->execute();
    $categories_row = $categories_stmt->fetch(PDO::FETCH_ASSOC);
    $categories_name = $categories_row['categoryname'];

    // display the header with the category name
    echo "<div class='container'>";
    echo "<div class='page-header'>";
    echo "<h1>" . $categories_name . "</h1>";
    echo "</div>";

    // query to select all products that belong to the category name
    $products_query = "SELECT * FROM products JOIN categories ON products.cateid = categories.cateid WHERE products.cateid = ?";
    $products_stmt = $con->prepare($products_query);
    $products_stmt->bindParam(1, $id);
    $products_stmt->execute();

    // check if more than 0 record found
    $num = $products_stmt->rowCount();

    echo "<a href='category_list.php' class='btn btn-danger'>Back to read categories</a>";

    if ($num > 0) {
        // display products in a table format
        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        echo "<th>Product ID</th>";
        echo "<th>Product Name</th>";
        echo "<th>Description</th>";
        echo "<th>Price</th>";
        echo "</tr>";
        while ($row = $products_stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['firstname'] to just $firstname only
            extract($row);
            // creating new table row per record
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$description}</td>";
            echo "<td>{$price}</td>";
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