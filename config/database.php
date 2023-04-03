<?php
// used to connect to the database
$host = "localhost";
$db_name = "deniseleong03";
$username = "deniseleong03";
$password = "nd1.icy!9ZNoKvLq";

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
   echo"";
}


// show error
catch(PDOException $exception){
    echo "Connection error: ".$exception->getMessage();
}
?>
