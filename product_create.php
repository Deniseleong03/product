<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="http://localhost/project/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="http://localhost/project/product_create.php#">Create Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="http://localhost/project/createcustomers.php">Create Customers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="http://localhost/project/contactus.php">Contact Us</a>
        </ul>
      </div>
    </div>
    </nav>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
      
        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->
        

        <?php
    if ($_POST) {
    // include database connection
    include 'config/database.php';
    try {
        // posted values
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $price = htmlspecialchars(strip_tags($_POST['price']));
        $promotional_price = htmlspecialchars(strip_tags($_POST['promotional_price']));
        $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
        $expired_date = htmlspecialchars(strip_tags($_POST['expired_date']));

        if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price'])|| empty($_POST['manufacture_date'])) 
            echo "<div class='alert alert-danger'>Please fill out all fields.</div>";

         // check if promotion price is less than original price
         if(!empty($promotional_price)){
         if ($promotional_price >= $price) {
            echo "<div class='alert alert-danger'>Promotion price must be cheaper than original price.</div>";
        }
    }
        // check if expiry date is later than manufacture date
        if(!empty($promotional_price)){
        if ($expired_date <= $manufacture_date) {
            echo "<div class='alert alert-danger'>Expiry date must be later than manufacture date.</div>";
        }
    }   else {
            // insert query
            $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created, promotional_price=:promotional_price, manufacture_date=:manufacture_date, expired_date=:expired_date";
            // prepare query for execution
            $stmt = $con->prepare($query);
            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':promotional_price', $promotional_price);
            $stmt->bindParam(':manufacture_date', $manufacture_date);
            $stmt->bindParam(':expired_date', $expired_date);
            // specify when this record was inserted to the database
            $created = date('Y-m-d H:i:s');
            $stmt->bindParam(':created', $created);
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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
        <tr>
            <td>Promotional price</td>
            <td><input type='text' name='promotional_price' class='form-control' /></td>
        </tr>
        <tr>
            <td>Manufacture date</td>
            <td><input type='date' name='manufacture_date' class='form-control' /></td>
        </tr>
        <tr>
            <td>Expired date</td>
            <td><input type='date' name='expired_date' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to read products</a>
            </td>
        </tr>
    </table>
</form>


    </div> 
    <!-- end .container -->  
</body>
</html>
