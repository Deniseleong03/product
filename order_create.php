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
                $customer_id = $products = $quantities = array();

                // Get values from form and assign to variables
                if (isset($_POST['customer_id'])) {
                    $customer_id = $_POST['customer_id'];
                }
                if (isset($_POST['products'])) {
                    $products = $_POST['products'];
                }
                if (isset($_POST['quantities'])) {
                    $quantities = $_POST['quantities'];
                }

                // check if any field is empty
                if (empty($customer_id)) {
                    $customer_id_error = "Please pick a name";
                }
                if (empty($products) || count($products) < 1) {
                    $products_error = "Please select at least one product";
                }




            
                // check if there are any errors
                if (!isset($customer_id_error) && !isset($products_error)) {
                    

                    // insert query for order table
                    $order_query = "INSERT INTO orders (customer_id, created) VALUES (:customer_id, :created)";

                    // prepare query for execution
                    $order_stmt = $con->prepare($order_query);

                    // specify when this record was inserted to the database
                    $created = date('Y-m-d H:i:s');

                    // bind the parameters for order table
                    $order_stmt->bindParam(':customer_id', $customer_id);
                    $order_stmt->bindParam(':created', $created);
                    $order_stmt->execute();

                    // get the order_id
                    $order_id = $con->lastInsertId();

                    // insert query for orderdetails table
                    $orderdetails_query = "INSERT INTO orderdetails (order_id, product_id, quantity, created) VALUES (:order_id, :product_id, :quantity, :created)";



                    // prepare query for execution
                    $orderdetails_stmt = $con->prepare($orderdetails_query);

                    // iterate over products and quantities and insert each record into the orderdetails table
                    foreach ($products as $key => $product) {
                        $quantity = $quantities[$key];

                        // select product_id from products table
                        $product_query = "SELECT id FROM products WHERE id = :product_id LIMIT 1";
                        $product_stmt = $con->prepare($product_query);
                        $product_stmt->bindParam(':product_id', $product);
                        $product_stmt->execute();
                        $product_id = $product_stmt->fetchColumn();

                        // bind the parameters for the current product in orderdetails table
                        $orderdetails_stmt->bindParam(':order_id', $order_id);
                        $orderdetails_stmt->bindParam(':product_id', $product_id);
                        $orderdetails_stmt->bindParam(':quantity', $quantity);
                        $orderdetails_stmt->bindParam(':created', $created);
                        $orderdetails_stmt->execute();
                        // clear the statement for the next iteration
                        $product_stmt = null;
                    }


                    // check if any record was inserted successfully
                    if ($orderdetails_stmt->rowCount() > 0) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            } catch (PDOException $exception) {
                echo "<div class='alert alert-danger'>{$exception->getMessage()}</div>";
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
                    <td>Products</td>
                        <td>
                            <?php
                        // retrieve product names from database
                        $query = "SELECT id, name FROM products";
                        $stmt = $con->prepare($query);
                        $stmt->execute();
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 1; $i <= 3; $i++) { // change 5 to the maximum number of products allowed
                            ?>
                            <select name='products[]' class="form-control">
                                <option value=''>--Select Product--</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="number" name="quantities[]" class="form-control" value="1" min="1">
                            <?php if (isset($products_error) && $i == 1) { ?>
                                    <span class="text-danger">
                                        <?php echo $products_error; ?>
                                </span>
                            <?php } ?>
                            <br>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
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