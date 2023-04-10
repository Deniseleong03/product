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
                <!-- container -->
                <div class="container">
                    <div class="page-header">
                        <br>
                        <h1>Electronics</h1>
                    </div>

                    <!-- PHP code to read records will be here -->
                    <?php
                    // include database connection
                    include '../config/database.php';

                    // delete message prompt will be here
                    
                    // select all data
                    $query = "SELECT * FROM products WHERE categories = 'category4'";
                    $stmt = $con->prepare($query);
                    $stmt->execute();


                    // this is how to get number of rows returned
                    $num = $stmt->rowCount();

                    // link to create record form
                    echo "<a href='../category_list.php' class='btn btn-primary m-b-1em'>Back to category list</a>";

                    //check if more than 0 record found
                    if ($num > 0) {

                        // data from database will be here
                        echo "<table class='table table-hover table-responsive table-bordered'>"; //start table
                    
                        //creating our table heading
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>Description</th>";
                        echo "<th>Price</th>";
                        echo "</tr>";

                        // table body will be here
                        // retrieve our table contents
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // extract row
                            // this will make $row['firstname'] to just $firstname only
                            extract($row);
                            // creating new table row per record
                            echo "<tr>";
                            echo "<td>{$id}</td>";
                            echo "<td>{$name}</td>";
                            echo "<td>{$description}</td>";
                            echo "<td>{$price}</td>";
                            echo "<td>";
                           
                        }

                        // end table
                        echo "</table>";

                    }
                    // if no records found
                    else {
                        echo "<div class='alert alert-danger'>No records found.</div>";
                    }
                    ?>



                </div> <!-- end .container -->

                <!-- confirm delete record will be here -->

            </body>

</html>