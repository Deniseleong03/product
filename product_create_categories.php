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
      <h1>Create Product Categories</h1>
    </div>

    <!-- html form to create product will be here -->
    <!-- PHP insert code will be here -->


            <?php

            if ($_POST) {
              // include database connection
              include 'config/database.php';
              try {


                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $promotion_price = htmlspecialchars(strip_tags($_POST['promotion_price']));
                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expired_date = htmlspecialchars(strip_tags($_POST['expired_date']));
                $categories = (isset($_POST['categories'])) ? htmlspecialchars(strip_tags($_POST['categories'])) : "";
              

                // check if any field is empty
                if (empty($name)) {
                  $name_error = "Please enter product name";
                }
                if (empty($description)) {
                  $description_error = "Please enter product description";
                }
                if (empty($price)) {
                  $price_error = "Please enter product price";
                }
                if (empty($manufacture_date)) {
                  $manufacture_date_error = "Please enter manufacture date";
                }
                if (empty($categories)) {
                  $categories_error = "Please choose a category";
                }

                // check if expired date  fill up & later than manufacture date
                if (!empty($expired_date)) {
                  if (strtotime($expired_date) <= strtotime($manufacture_date)) {
                    $expired_date_error = "Expired date should be later than manufacture date";
                  }
                }

                // check if user fill up promotion price & must cheaper than original price 
                if (!empty($promotion_price)) {
                  if ($promotion_price >= $price) {
                    $promotion_price_error = "Promotion price must be cheaper than original price";
                  }
                }

                // check if there are any errors
                    if (!isset($name_error) && !isset($description_error) && !isset($price_error) && !isset($promotion_price_error) && !isset($manufacture_date_error) && !isset($expired_date_error) && !isset($categories_error)) {



                        // insert query
                  $query = "INSERT INTO products SET name=:name, description=:description, price=:price, promotion_price=:promotion_price, manufacture_date=:manufacture_date, expired_date=:expired_date, categories=:categories, created=:created"; // info insert to blindParam
            
    
                  // prepare query for execution
                  $stmt = $con->prepare($query);

                  // bind the parameters
                  $stmt->bindParam(':name', $name);
                  $stmt->bindParam(':description', $description);
                  $stmt->bindParam(':price', $price);
                  $stmt->bindParam(':promotion_price', $promotion_price);
                  $stmt->bindParam(':manufacture_date', $manufacture_date);
                  $stmt->bindParam(':expired_date', $expired_date);
                  $stmt->bindParam(':categories', $categories);

                  // specify when this record was inserted to the database
                  $created = date('Y-m-d H:i:s');
                  $stmt->bindParam(':created', $created);

                  // Execute the query
                  if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                    $name = "";
                    $description = "";
                    $price = "";
                    $promotion_price = "";
                    $manufacture_date = "";
                    $expired_date = "";
                    $categories = "";
                    
                  } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                  }
                } else {
                  echo "<div class='alert alert-danger'>Unable to save record. Please fill in all required fields.</div>";
                }
              }

              // show error
              catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
              }
            }
            ?>
            
            <!-- html form here where the product information will be entered -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <table class='table table-hover table-responsive table-bordered'>
                <tr>
                  <td>Name</td>
                  <td><input type='text' name='name' class="form-control"
                      value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" />
                    <?php if (isset($name_error)) { ?><span class="text-danger">
                        <?php echo $name_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Description</td>
                  <td><textarea name='description' class="form-control"
                      value="<?php echo isset($description) ? htmlspecialchars($description) : ''; ?>"></textarea>
                    <?php if (isset($description_error)) { ?><span class="text-danger">
                        <?php echo $description_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Price</td>
                  <td><input type="number" name="price" class="form-control"
                      value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" />
                    <?php if (isset($price_error)) { ?><span class="text-danger">
                        <?php echo $price_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Promotion Price</td>
                  <td><input type="number" name="promotion_price" class="form-control"
                      value="<?php echo isset($promotion_price) ? htmlspecialchars($promotion_price) : ''; ?>" />
                    <?php if (isset($promotion_price_error)) { ?><span class="text-danger">
                        <?php echo $promotion_price_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Manufacture Date</td>
                  <td><input type="date" name="manufacture_date" class="form-control"
                      value="<?php echo isset($manufacture_date) ? htmlspecialchars($manufacture_date) : ''; ?>" />
                    <?php if (isset($manufacture_date_error)) { ?><span class="text-danger">
                        <?php echo $manufacture_date_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Expired Date</td>
                  <td><input type="date" name="expired_date" class="form-control"
                      value="<?php echo isset($expired_date) ? htmlspecialchars($expired_date) : ''; ?>" />
                    <?php if (isset($expired_date_error)) { ?><span class="text-danger">
                        <?php echo $expired_date_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
                     <tr>
                    <td>Category</td>
  <td><select name="categories" class="form-control">
      <option value="">Select category</option>
      <option value="category1">Clothing and Accessories</option>
      <option value="category2">Sports and Fitness</option>
      <option value="category3">Food and Beverage</option>
      <option value="category4">Electronics</option>
      
    </select>
    <?php if (isset($categories_error)) { ?>
                                <span class="text-danger">
                                    <?php echo $categories_error; ?>
                                </span>
                            <?php } ?>
                        </td>
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


  </div><!--the end of container-->

</body>

</html>