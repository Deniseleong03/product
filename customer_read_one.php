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
                    <a data-toggle="dropdown" class="dropdown-toggle"
                        href="http://localhost/project/product_create.php#">Create
                        Product <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/project/product_create.php">Create Products</a></li>
                        <li><a href="http://localhost/project/product_read.php">List All Product</a></li>
                        <li><a href="http://localhost/project/product_read_one.php#">Read One Product's Details</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle"
                        href="http://localhost/project/createcustomers.php">Create
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
                    <h1>Read Product</h1>
                </div>

                <!-- PHP read one record will be here -->
                
                <?php
                // get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
                $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

                //include database connection
                include 'config/database.php';

                // read current record's data
                try {
                    // prepare select query
                    $query = "SELECT id, username, pass, accstatus FROM customers WHERE id = ? LIMIT 0,1";
                    $stmt = $con->prepare($query);

                    // this is the first question mark
                    $stmt->bindParam(1, $id);

                    // execute our query
                    $stmt->execute();

                    // store retrieved row to a variable
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // values to fill up our form
                    $id = $row['id'];
                    $username = $row['username'];
                    $pass = $row['pass'];
                    $accstatus = $row['accstatus'];
                }

                // show error
                catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
                ?>


                <!-- HTML read one record table will be here -->
                <!--we have our html table here where the record will be displayed-->
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>id</td>
                        <td>
                            <?php echo htmlspecialchars($id, ENT_QUOTES); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>
                            <?php echo htmlspecialchars($username, ENT_QUOTES); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Pass</td>
                        <td>
                            <?php echo htmlspecialchars($pass, ENT_QUOTES); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Accstatus</td>
                        <td>
                            <?php echo htmlspecialchars($accstatus, ENT_QUOTES); ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href='home.php' class='btn btn-danger'>Back to read customers</a>
                        </td>
                    </tr>
                </table>


            </div> <!-- end .container -->

</body>

</html>