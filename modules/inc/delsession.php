<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Delete all cookies by setting their expiration time to a past date
setcookie('username', '', time() - 3600, '/');
setcookie('loggedin', '', time() - 3600, '/');
setcookie('staff_name', '', time() - 3600, '/');
setcookie('isSuperAdmin', '', time() - 3600, '/');
// ... add more cookies as needed ...

// Redirect the user to the login page
header('Location: signin.php');
exit;
?>