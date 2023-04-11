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


                $categoryname = htmlspecialchars(strip_tags($_POST['categoryname']));
                $categorydescription = htmlspecialchars(strip_tags($_POST['categorydescription']));
                
              

                // check if any field is empty
                if (empty($categoryname)) {
                  $categoryname_error = "Please enter category name";
                }
                if (empty($categorydescription)) {
                  $categorydescription_error = "Please enter category description description";
                }
                


                // check if there are any errors
                    if (!isset($categoryname_error) && !isset($categorydescription_error)) {



                        // insert query
                  $query = "INSERT INTO categories SET categoryname=:categoryname, categorydescription=:categorydescription, created=:created"; // info insert to blindParam
            
    
                  // prepare query for execution
                  $stmt = $con->prepare($query);

                  // bind the parameters
                  $stmt->bindParam(':categoryname', $categoryname);
                  $stmt->bindParam(':categorydescription', $categorydescription);
                  

                  // specify when this record was inserted to the database
                  $created = date('Y-m-d H:i:s');
                  $stmt->bindParam(':created', $created);

                  // Execute the query
                  if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                    $categoryname = "";
                    $categorydescription = "";
                    
                    
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
                  <td>Category Name</td>
                  <td><input type='text' name='name' class="form-control"
                      value="<?php echo isset($categoryname) ? htmlspecialchars($categoryname) : ''; ?>" />
                    <?php if (isset($categoryname_error)) { ?><span class="text-danger">
                        <?php echo $categoryname_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
                <tr>
                  <td>Category Description</td>
                  <td><textarea name='description' class="form-control"
                      value="<?php echo isset($categorydescription) ? htmlspecialchars($categorydescription) : ''; ?>"></textarea>
                    <?php if (isset($categorydescription_error)) { ?><span class="text-danger">
                        <?php echo $categorydescription_error; ?>
                      </span>
                    <?php } ?>
                  </td>
                </tr>
            
               

               
            
                <tr>
                  <td></td>
                  <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                  </td>
                </tr>
              </table>
            </form>


  </div><!--the end of container-->

</body>

</html>