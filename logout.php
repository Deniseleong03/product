<?php
// logout.php

// Start the session
session_start();

// remove all session variables
session_unset();

// Destroy all session data
session_destroy();

// Redirect to login page
header('Location: signin.php');
exit;
?>