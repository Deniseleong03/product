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
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
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
        <div class="page-header">
            <br>
            <h1>Create Orders</h1>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->


        <?php
        include 'config/database.php';

        if ($_POST) {
            try {
                // Initialize variables
                $customer_id = $price = $product1 = $product2 = $product3 = $quantity1 = $quantity2 = $quantity3 = "";

                // Get values from form and assign to variables
                if (isset($_POST['customer_id'])) {
                    $customer_id = $_POST['customer_id'];
                }
                if (isset($_POST['price'])) {
                    $price = $_POST['price'];
                }
                if (isset($_POST['product1'])) {
                    $product1 = $_POST['product1'];
                }
                if (isset($_POST['product2'])) {
                    $product2 = $_POST['product2'];
                }
                if (isset($_POST['product3'])) {
                    $product3 = $_POST['product3'];
                }
                if (isset($_POST['quantity1'])) {
                    $quantity1 = $_POST['quantity1'];
                }
                if (isset($_POST['quantity2'])) {
                    $quantity2 = $_POST['quantity2'];
                }
                if (isset($_POST['quantity3'])) {
                    $quantity3 = $_POST['quantity3'];
                }

                // check if any field is empty
                if (empty($customer_id)) {
                    $customer_id_error = "Please pick a name";
                }
                if (empty($product1)) {
                    $product1_error = "Please pick a product";
                }
                if (empty($quantity1)) {
                    $quantity1_error = "Please enter a quantity";
                }

                // check if there are any errors
                if (!isset($customer_id_error) && !isset($product1_error) && !isset($quantity1_error)) {

                    // insert query for order table
                    $order_query = "INSERT INTO orders (customer_id, date) VALUES (:customer_id, :date)";

                    // prepare query for execution
                    $order_stmt = $con->prepare($order_query);

                    // specify when this record was inserted to the database
                    $date = date('Y-m-d H:i:s');

                    // bind the parameters for order table
                    $order_stmt->bindParam(':customer_id', $customer_id);
                    $order_stmt->bindParam(':date', $date);
                    $order_stmt->execute();

                    // get the order_id
                    $order_id = $con->lastInsertId();

                    // insert query for orderdetails table
                    $orderdetails_query = "INSERT INTO orderdetails (order_id, product_id, price, product_name, quantity, date)
                    SELECT :order_id, products.id, :price, products.name, :quantity, :date
                    FROM products 
                    WHERE products.name = :product_name";

                    // prepare query for execution
                    $orderdetails_stmt = $con->prepare($orderdetails_query);

                    // bind the parameters for product 1
                    if (!empty($product1)) {
                        $product_name = $product1; // define $product_name variable
                        $orderdetails_stmt->bindParam(':order_id', $order_id);
                        $orderdetails_stmt->bindParam(':product_name', $product_name);
                        $orderdetails_stmt->bindParam(':price', $price);
                        $orderdetails_stmt->bindParam(':quantity', $quantity1);
                        $orderdetails_stmt->bindParam(':date', $date);
                        $orderdetails_stmt->execute();
                    }

                    // bind the parameters for product 2
                    if (!empty($product2)) {
                        $product_name = $product2; // define $product_name variable
                        $orderdetails_stmt->bindParam(':order_id', $order_id);
                        $orderdetails_stmt->bindParam(':product_name', $product_name);
                        $orderdetails_stmt->bindParam(':price', $price);
                        $orderdetails_stmt->bindParam(':quantity', $quantity2);
                        $orderdetails_stmt->bindParam(':date', $date);
                        $orderdetails_stmt->execute();
                    }

                    // bind the parameters for product 3
                    if (!empty($product3)) {
                        $product_name = $product3; // define $product_name variable
                        $orderdetails_stmt->bindParam(':order_id', $order_id);
                        $orderdetails_stmt->bindParam(':product_name', $product_name);
                        $orderdetails_stmt->bindParam(':price', $price);
                        $orderdetails_stmt->bindParam(':quantity', $quantity3);
                        $orderdetails_stmt->bindParam(':date', $date);
                        $orderdetails_stmt->execute();
                    }
                    // check if any record was inserted successfully
                    if ($orderdetails_stmt->rowCount() > 0) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            } catch (PDOException $exception) {
                echo "<div class='alert alert-danger'>Error: " . $exception->getMessage() . "</div>";
            }
        }
        ?>
        
       

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Customer Name</td>
            <td>
                <select name='customer_id' class="form-control">
                    <option value=''>--Select Name--</option>
                    <?php 
                    // retrieve category name from database
                    $query = "SELECT id, firstname, lastname FROM customers";
                    $stmt = $con->prepare($query);

                    $stmt->execute();
                    while ($customersrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($customersrow);
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $firstname; ?><?php echo $lastname; ?></option>
                    <?php } ?>
                </select>
                <?php if (isset($customer_id_error)) { ?><span class="text-danger">
                        <?php echo $customer_id_error; ?>
                    </span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Product 1</td>
            <td>
                    <!-- Product 1 dropdown -->
                <select name='product1' class="form-control">
                        <option value=''>--Select Product--</option>
                        <?php
                        // retrieve product names from database
                        $query = "SELECT id, name FROM products";
                        $stmt = $con->prepare($query);
                        $stmt->execute();
                        while ($productsrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($productsrow);
                            ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <input type="number" name="quantity1" class="form-control" value="1" min="1">
                    
                    <?php if (isset($product_id_error)) { ?><span class="text-danger">
                            <?php echo $product_id_error; ?>
                        </span>
                    <?php } ?>
                    </td>
                    </tr>
                    
                    <tr>
                        <td>Product 2</td>
                        <td>
                            <!-- Product 1 dropdown -->
                            <select name='product2' class="form-control">
                                <option value=''>--Select Product--</option>
                                <?php
                                // retrieve product names from database
                                $query = "SELECT id, name FROM products";
                                $stmt = $con->prepare($query);
                                $stmt->execute();
                                while ($productsrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($productsrow);
                                    ?>
                                    <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                            <input type="number" name="quantity2" class="form-control" value="1" min="1">
                    
                    
                            <?php if (isset($product_id_error)) { ?><span class="text-danger">
                                    <?php echo $product_id_error; ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Product 3</td>
                        <td>
                            <!-- Product 1 dropdown -->
                            <select name='product3' class="form-control">
                                <option value=''>--Select Product--</option>
                                <?php
                                // retrieve product names from database
                                $query = "SELECT id, name FROM products";
                                $stmt = $con->prepare($query);
                                $stmt->execute();
                                while ($productsrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($productsrow);
                                    ?>
                                    <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                            <input type="number" name="quantity3" class="form-control" value="1" min="1">

                        <?php if (isset($product_id_error)) { ?><span class="text-danger">
                                <?php echo $product_id_error; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='home.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>


    </div><!--the end of container-->

</body>

</html>