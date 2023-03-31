<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Navbar Dropdown Login and Signup Form with Social Buttons</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: 'Varela Round', sans-serif;
    }

    .form-control {
      box-shadow: none;
      font-weight: normal;
      font-size: 13px;
    }

    .form-control:focus {
      border-color: #33cabb;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .navbar {
      background: #fff;
      padding-left: 16px;
      padding-right: 16px;
      border-bottom: 1px solid #dfe3e8;
      border-radius: 0;
    }

    .nav img {
      border-radius: 50%;
      width: 36px;
      height: 36px;
      margin: -8px 0;
      float: left;
      margin-right: 10px;
    }

    .navbar .navbar-brand,
    .navbar .navbar-brand:hover,
    .navbar .navbar-brand:focus {
      padding-left: 0;
      font-size: 20px;
      padding-right: 50px;
    }

    .navbar .navbar-brand b {
      font-weight: bold;
      color: #33cabb;
    }

    .navbar .form-inline {
      display: inline-block;
    }

    .navbar .nav li {
      position: relative;
    }

    .navbar .nav li a {
      color: #888;
    }

    .search-box {
      position: relative;
    }

    .search-box input {
      padding-right: 35px;
      border-color: #dfe3e8;
      border-radius: 4px !important;
      box-shadow: none
    }

    .search-box .input-group-addon {
      min-width: 35px;
      border: none;
      background: transparent;
      position: absolute;
      right: 0;
      z-index: 9;
      padding: 7px;
      height: 100%;
    }

    .search-box i {
      color: #a0a5b1;
      font-size: 19px;
    }

    .navbar .nav .btn-primary,
    .navbar .nav .btn-primary:active {
      color: #fff;
      background: #33cabb;
      padding-top: 8px;
      padding-bottom: 6px;
      vertical-align: middle;
      border: none;
    }

    .navbar .nav .btn-primary:hover,
    .navbar .nav .btn-primary:focus {
      color: #fff;
      outline: none;
      background: #31bfb1;
    }

    .navbar .navbar-right li:first-child a {
      padding-right: 30px;
    }

    .navbar ul li i {
      font-size: 18px;
    }

    .navbar .dropdown-menu i {
      font-size: 16px;
      min-width: 22px;
    }

    .navbar ul.nav li.active a,
    .navbar ul.nav li.open>a {
      background: transparent !important;
    }

    .navbar .nav .get-started-btn {
      min-width: 120px;
      margin-top: 8px;
      margin-bottom: 8px;
    }

    .navbar ul.nav li.open>a.get-started-btn {
      color: #fff;
      background: #31bfb1 !important;
    }

    .navbar .dropdown-menu {
      border-radius: 1px;
      border-color: #e5e5e5;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
    }

    .navbar .nav .dropdown-menu li {
      color: #999;
      font-weight: normal;
    }

    .navbar .nav .dropdown-menu li a,
    .navbar .nav .dropdown-menu li a:hover,
    .navbar .nav .dropdown-menu li a:focus {
      padding: 8px 20px;
      line-height: normal;
    }

    .navbar .navbar-form {
      border: none;
    }

    .navbar .dropdown-menu.form-wrapper {
      width: 280px;
      padding: 20px;
      left: auto;
      right: 0;
      font-size: 14px;
    }

    .navbar .dropdown-menu.form-wrapper a {
      color: #33cabb;
      padding: 0 !important;
    }

    .navbar .dropdown-menu.form-wrapper a:hover {
      text-decoration: underline;
    }

    .navbar .form-wrapper .hint-text {
      text-align: center;
      margin-bottom: 15px;
      font-size: 13px;
    }

    .navbar .form-wrapper .social-btn .btn,
    .navbar .form-wrapper .social-btn .btn:hover {
      color: #fff;
      margin: 0;
      padding: 0 !important;
      font-size: 13px;
      border: none;
      transition: all 0.4s;
      text-align: center;
      line-height: 34px;
      width: 47%;
      text-decoration: none;
    }

    .navbar .social-btn .btn-primary {
      background: #507cc0;
    }

    .navbar .social-btn .btn-primary:hover {
      background: #4676bd;
    }

    .navbar .social-btn .btn-info {
      background: #64ccf1;
    }

    .navbar .social-btn .btn-info:hover {
      background: #4ec7ef;
    }

    .navbar .social-btn .btn i {
      margin-right: 5px;
      font-size: 16px;
      position: relative;
      top: 2px;
    }

    .navbar .form-wrapper .form-footer {
      text-align: center;
      padding-top: 10px;
      font-size: 13px;
    }

    .navbar .form-wrapper .form-footer a:hover {
      text-decoration: underline;
    }

    .navbar .form-wrapper .checkbox-inline input {
      margin-top: 3px;
    }

    .or-seperator {
      margin-top: 32px;
      text-align: center;
      border-top: 1px solid #e0e0e0;
    }

    .or-seperator b {
      color: #666;
      padding: 0 8px;
      width: 30px;
      height: 30px;
      font-size: 13px;
      text-align: center;
      line-height: 26px;
      background: #fff;
      display: inline-block;
      border: 1px solid #e0e0e0;
      border-radius: 50%;
      position: relative;
      top: -15px;
      z-index: 1;
    }

    .navbar .checkbox-inline {
      font-size: 13px;
    }

    .navbar .navbar-right .dropdown-toggle::after {
      display: none;
    }

    @media (min-width: 1200px) {
      .form-inline .input-group {
        width: 300px;
        margin-left: 30px;
      }
    }

    @media (max-width: 768px) {
      .navbar .dropdown-menu.form-wrapper {
        width: 100%;
        padding: 10px 15px;
        background: transparent;
        border: none;
      }

      .navbar .form-inline {
        display: block;
      }

      .navbar .input-group {
        width: 100%;
      }

      .navbar .nav .btn-primary,
      .navbar .nav .btn-primary:active {
        display: block;
      }
    }
  </style>
  <script>
    // Prevent dropdown menu from closing when click inside the form
    $(document).on("click", ".navbar-right .dropdown-menu", function (e) {
      e.stopPropagation();
    });
  </script>
</head>

<body>
  <nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Brand<b>Name</b></a>
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/project/home.php">Home</a></li>
        <li><a href="http://localhost/project/contactus.php">Contact Us</a></li>
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="http://localhost/project/product_create.php#">Create
            Product <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/project/product_create.php">Create Products</a></li>
            <li><a href="http://localhost/project/product_read.php">List All Product</a></li>
            <li><a href="http://localhost/project/product_read_one.php#">Read One Product's Details</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="http://localhost/project/createcustomers.php">Create
            Customers <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/project/createcustomers.php">Create Customers</a></li>
            <li><a href="#">List All Customer</a></li>
            <li><a href="#">Read One Customer's Details</a></li>
          </ul>
        </li>


      </ul>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <br>
      <h1>Create Product</h1>
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
                if (!isset($name_error) && !isset($description_error) && !isset($price_error) && !isset($promotion_price_error) && !isset($manufacture_date_error) && !isset($expired_date_error)) {


                  // insert query
                  $query = "INSERT INTO products SET name=:name, description=:description, price=:price, promotion_price=:promotion_price, manufacture_date=:manufacture_date, expired_date=:expired_date, created=:created"; // info insert to blindParam
            
    
                  // prepare query for execution
                  $stmt = $con->prepare($query);

                  // bind the parameters
                  $stmt->bindParam(':name', $name);
                  $stmt->bindParam(':description', $description);
                  $stmt->bindParam(':price', $price);
                  $stmt->bindParam(':promotion_price', $promotion_price);
                  $stmt->bindParam(':manufacture_date', $manufacture_date);
                  $stmt->bindParam(':expired_date', $expired_date);

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