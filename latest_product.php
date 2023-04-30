<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html>
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
    <style>
.my-card {
    border: 2px solid #33cabb;
    border-radius: 10px;
    margin-bottom: 20px;
    border-color: #33cabb !important;
}
</style>
</head>
<body>
<?php
    // include database connection
    include 'config/database.php';

    // query to select the lowest selling products
// query to select the latest products
    $latest_query = "SELECT * FROM products ORDER BY created DESC LIMIT 5";
    $latest_stmt = $con->prepare($latest_query);
    $latest_stmt->execute();

    // check if more than 0 record found
    $num = $latest_stmt->rowCount();

    if ($num > 0) {
    // display products in a card format
    echo "<div class='container'>";
    echo "<h2 style='color:#33cabb;'>Latest Products</h2>";
    echo "<div class='row'>";
    echo "<div class='col-md-12'>";
    echo "<div class='card my-card' style='width: 50%'>";
    echo "<div class='card-body'>";
    echo "<table class='table'>";
    echo "<thead><tr><th>Name</th><th>Price</th></tr></thead>";
    echo "<tbody>";

        while ($row = $latest_stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            extract($row);

        // display product in table row format
        echo "<tr>";
        echo "<td><a href='product.php?id={$id}'>{$name}</a></td>";
        echo "<td>{$price}</td>";
        echo "</tr>";

        }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    // if no records found
    else {
        echo "<div class='alert alert-danger'>No records found.</div>";
    }

    ?>
</body>

</html>