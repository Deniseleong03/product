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
</head>
<style>
    .my-card {
    border: 2px solid #33cabb;
    border-radius: 10px;
    margin-bottom: 20px;
    border-color: #33cabb !important;
    padding: 10px;
    
}
    .card-text {
    font-family: 'Varela Round', sans-serif;
    margin: 10px 0;
    padding: 5px;
    font-size: 18px;
}
</style>

<body>
    <?php
    // include database connection
    include 'config/database.php';

    // count total customers
    $query = "SELECT COUNT(*) as total_customers FROM customers";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_customers = $row['total_customers'];

    // count total products
    $query = "SELECT COUNT(*) as total_products FROM products";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_products = $row['total_products'];

    // count total orders
    $query = "SELECT COUNT(*) as total_orders FROM orders";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_orders = $row['total_orders'];
    ?>

   <div class='container'>
    <h2 style='color:#33cabb;'>Statistics</h2>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card my-card' style='width: 50%'>
                
                    <div class='card-body'>
                        
                        <p class="card-text">Total customers: <?php echo $total_customers; ?>
                    </p>
                    <p class="card-text">Total products:
                        <?php echo $total_products; ?>
                    </p>
                    <p class="card-text">Total orders:
                        <?php echo $total_orders; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>