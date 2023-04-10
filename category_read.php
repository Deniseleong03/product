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

<body>
    <?php include 'nav.php'; ?>



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
    $id = isset($_GET['cateid']) ? $_GET['cateid'] : die('ERROR: Record ID not found.');

    //include database connection
    include 'config/database.php';

    // read current record's data
    try {
        // prepare select query
        $query = "SELECT cateid, categoryname, categorydescription FROM categories WHERE cateid IN (1, 2, 3, 4)";
        $stmt = $con->prepare($query);

        // execute our query
        $stmt->execute();

        // fetch all rows into an associative array
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // loop through the rows to access each row's data
        foreach ($rows as $row) {
            // values to fill up our form
            $cateid = $row['cateid'];
            $categoryname = $row['categoryname'];
            $categorydescription = $row['categorydescription'];

            // do something with the retrieved data, e.g., display it
            echo "cateid: $cateid, categoryname: $categoryname, categorydescription: $categorydescription<br>";
        }
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
                <td>Category ID</td>
                <td>
                    <?php echo htmlspecialchars($cateid, ENT_QUOTES); ?>
                </td>
            </tr>
            <tr>
                <td>Category Name</td>
                <td>
                    <?php echo htmlspecialchars($categoryname, ENT_QUOTES); ?>
                </td>
            </tr>
            <tr>
                <td>Category Description</td>
                <td>
                    <?php echo htmlspecialchars($categorydescription, ENT_QUOTES); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='category_list.php' class='btn btn-danger'>Back to read Categories</a>
                </td>
            </tr>
        </table>


    </div> <!-- end .container -->

</body>

</html>