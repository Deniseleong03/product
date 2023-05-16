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

            <h1>Update Product</h1>
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
            $query = "SELECT id, name, description, price, promotion_price, manufacture_date, expired_date, cateid FROM products WHERE id = ? ";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $promotion_price = $row['promotion_price'];
            $manufacture_date = $row['manufacture_date'];
            $expired_date = $row['expired_date'];
            $cateid = $row['cateid'];
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
                // get old record's data
                $query = "SELECT name, description, price, promotion_price, manufacture_date, expired_date, cateid FROM products WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

                // get posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $promotion_price = htmlspecialchars(strip_tags($_POST['promotion_price']));
                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expired_date = htmlspecialchars(strip_tags($_POST['expired_date']));
                if (isset($_POST['categoryid']))
                    $categoryid = $_POST['categoryid'];

                // write update query
                $query = "UPDATE products SET ";
                $fieldsToUpdate = array();

                if (!empty($name) && $name != $old_data['name']) {
                    $fieldsToUpdate['name'] = $name;
                }
                if (!empty($description) && $description != $old_data['description']) {
                    $fieldsToUpdate['description'] = $description;
                }
                if (!empty($price) && $price != $old_data['price']) {
                    $fieldsToUpdate['price'] = $price;
                }
                if (!empty($promotion_price) && $promotion_price != $old_data['promotion_price']) {
                    $fieldsToUpdate['promotion_price'] = $promotion_price;
                }
                if (!empty($manufacture_date) && $manufacture_date != $old_data['manufacture_date']) {
                    $fieldsToUpdate['manufacture_date'] = $manufacture_date;
                }
                if (!empty($expired_date) && $expired_date != $old_data['expired_date']) {
                    $fieldsToUpdate['expired_date'] = $expired_date;
                }
                if (isset($categoryid) && $categoryid != $old_data['cateid']) {
                    $fieldsToUpdate['cateid'] = $categoryid;
                }

                if (empty($fieldsToUpdate)) {
                    echo "<div class='alert alert-warning'>No changes made to the record.</div>";
                } else {
                    // build the update query
                    $query .= implode(' = ?, ', array_keys($fieldsToUpdate)) . ' = ?';
                    $query .= " WHERE id = ?";

                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    // bind the parameters
                    $values = array_values($fieldsToUpdate);
                    $values[] = $id;
                    $stmt->execute($values);

                    // check if update was successful
                    if ($stmt->rowCount() > 0) {
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>


        <!-- HTML form to update record will be here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>"
                            class='form-control' /><?php if (isset($name) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "name must be different from old value: {$old_data['name']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description'
                            class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea>
                        <?php if (isset($description) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "description must be different from old value: {$old_data['description']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES); ?>"
                            class='form-control' /><?php if (isset($price) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "price must be different from old value: {$old_data['price']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                <tr>
                    <td>Promotion Price</td>
                    <td>
                        <input type='text' name='promotion_price'
                            value="<?php echo htmlspecialchars($promotion_price, ENT_QUOTES); ?>"
                            class='form-control' />
                        <?php if (isset($promotion_price) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "promotion price must be different from old value: {$old_data['promotion_price']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Manufacture Date</td>
                    <td>
                        <input type='date' name='manufacture_date'
                            value="<?php echo htmlspecialchars($manufacture_date, ENT_QUOTES); ?>"
                            class='form-control' />
                        <?php if (isset($manufacture_date) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "manufacture date must be different from old value: {$old_data['manufacture_date']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Expired Date</td>
                    <td>
                        <input type='date' name='expired_date'
                            value="<?php echo htmlspecialchars($expired_date, ENT_QUOTES); ?>" class='form-control' />
                        <?php if (isset($expired_date) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "expired date must be different from old value: {$old_data['expired_date']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name='categoryid' class="form-control">
                            <option value=''>--Select Category--</option>
                            <?php /*foreach ($categoryname as $category) { */
                            // retrieve category name from database
                            $query = "SELECT cateid, categoryname FROM categories";
                            $stmt = $con->prepare($query);

                            $stmt->execute();
                            while ($categoryrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($categoryrow);
                                ?>
                                <option value="<?php echo $cateid; ?>"><?php echo $categoryname; ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($categoryid) && isset($old_data)) { ?>
                            <span class="text-danger">
                                <?php echo "category must be different: {$old_data['cateid']}"; ?>
                            </span>
                        <?php } ?>
                    </td>
                </tr>

                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>


    </div>
    <!-- end .container -->
</body>

</html>
