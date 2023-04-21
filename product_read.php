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
    
    </head>
<body>
  <?php include 'nav.php'; ?>
    <!-- container -->
    
    <div class="container">
        <div class="page-header">
          <br>
            <h1>Read Products</h1>
        </div>
         
          <a href='product_create.php' class='btn btn-primary m-b-1em' style='float: left;'>Create New Product</a>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class ="float-end">
              <input type="text" name="search" placeholder="Enter keyword"
                style="border: 1px solid #ccc; padding: 8px; border-radius: 4px;">
              <button type="submit" 
                style="background-color: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-left: 8px;">Search</button>
            </div>
          </form>
        





        <!-- PHP code to read records will be here -->
      <?php
      // include database connection
      include 'config/database.php';

     
      $query = "SELECT * FROM products";
      if ($_POST) {
        $search = htmlspecialchars(strip_tags($_POST['search']));
        $query = "SELECT * FROM `products` WHERE name LIKE  '%" . $search . "%'";
        echo $search;
      }

     

      $stmt = $con->prepare($query);
      $stmt->execute();

      // get number of rows returned
      $num = $stmt->rowCount();

      // link to create record form
      
      // check if more than 0 records found
      if ($num > 0) {
        // data from database will be here
        echo "<table class='table table-hover table-responsive table-bordered'>"; //start table
      
        // creating our table heading
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "<th class='text-right'>Price</th>"; // align to right
        echo "<th class='text-right'>Promotion Price</th>"; // align to right
        echo "</tr>";

        // table body will be here
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          // extract row
          extract($row);
           if($promotion_price == 0.00){
            $promotion_price ="-";
          }
          // creating new table row per record
          echo "<tr>";
          echo "<td>{$id}</td>";
          echo "<td>{$name}</td>";
          echo "<td>{$description}</td>";
          echo "<td class='text-right'>{$price}</td>"; // align to right
          echo "<td class='text-right'>".$promotion_price. "</td>"; // align to right, display dash if no promotion price
          echo "<td>";

          // read one record
          echo "<a href='product_read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

          // we will use this links on next part of this post
          echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

          // we will use this links on next part of this post
          echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
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

    <!-- confirm delete record will be here -->

</body>

</html>