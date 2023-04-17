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
  <title>Bootstrap Navbar Dropdown Login and Signup Form with Social Buttons</title>
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <title>Contact Us</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .contact-section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f8f8;
        }

        .contact-form {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: none;
        }

        .contact-form button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3DED97;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
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
<section class="contact-section">
  <div class="contact-form">
    <h1>Contact Us</h1>
    <form action="#" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
      <button type="submit">Submit</button>
    </form>
  </div>
</section>
<footer>
  <div class="container">
    <p>&copy; 2023 My Website. All rights reserved.</p>
  </div>
</footer>
<body>
</html>