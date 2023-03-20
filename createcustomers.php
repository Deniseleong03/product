<!DOCTYPE html>
<html>
<head>
<title>Create customers</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://localhost/project/home.php">Project</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/project/home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/project/product_create.php">Create Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/project/createcustomers.php">Create Customer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/project/contactus.php">Contact Us</a>
      </li>
    </ul>
  </div>
</nav>  
<body>
     <!-- container -->
     <div class="container">
  <h1>Create Customer</h1>
  <form action="insert_customer.php" method="POST">
    <div class="mb-3">
      <label for="username" class="form-label">Username (at least 6 characters)</label>
      <input type="text" class="form-control" id="username" name="username" minlength="6" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Gender</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
          <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
          <label class="form-check-label" for="female">Female</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="other" value="Other" required>
          <label class="form-check-label" for="other">Other</label>
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="date_of_birth" class="form-label">Date of Birth</label>
      <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
     </div>
    <!-- end .container -->  


</body>
</html>