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
  <title>Home</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Welcome to My Website</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f8f8;
        }

        .hero-section h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .hero-section p {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #3DED97;
            color: #fff;
            font-size: 24px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #99EDC3;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
  <?php include 'nav.php'; ?>
 <section class="hero-section">
        <h1>Welcome</h1>
        <p>Let's Get Started!</p>
        <a href="#" class="cta-button">Get Started</a>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2023 My Website. All rights reserved.</p>
        </div>
    </footer>
 
  </body>
</html>