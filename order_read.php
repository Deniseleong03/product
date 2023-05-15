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



    <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.text-right {
  text-align: right;
}
</style>
<body>
    <?php include 'nav.php'; ?>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <br>
            <h1>Order list</h1>
        </div>
        <a href='order_create.php' class='btn btn-primary m-b-1em' style='float: left;'>Create Orders</a>
                     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div style="text-align: right;">
            <input type="text" name="search" placeholder="Enter keyword"
              style="border: 1px solid #ccc; padding: 8px; border-radius: 4px;">
            <button type="submit"
              style="background-color: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-left: 8px;">Search</button>
          </div>
        </form>
        <br>

        <!-- PHP code to read records will be here -->
        <?php
        // include database connection
        include 'config/database.php';

        


        $query = "SELECT * FROM orders";
        if ($_POST) {
          $search = htmlspecialchars(strip_tags($_POST['search']));
          $query = "SELECT * FROM `orders` WHERE order_id LIKE '%" . $search . "%' OR customer_id = '" . $search . "'";
          echo $search;
        }

        // modify query to sort by order_id in descending order
        $query .= " ORDER BY order_id DESC";
        
        // select all data
        
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();


        //check if more than 0 record found
        if ($num > 0) {

            // data from database will be here
            echo "<table class='table table-hover table-responsive table-bordered'>"; //start table
        
            //creating our table heading
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Customer ID</th>";
            echo "<th>Date</th>";
            echo "<th class='text-center'>Action</th>";
            echo "</tr>";

            // table body will be here
            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$order_id}</td>";
                echo "<td>{$customer_id}</td>";
                echo "<td>{$created}</td>";
                
                
                
                //link button to pages
                echo "<td class='text-center'>";
                echo "<a href='order_detail.php?order_id={$order_id}' class='btn btn-info m-r-1em'>Read</a>&nbsp;";

            

        

            echo "</td>";
                echo "</tr>";
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

    

</body>

</html>