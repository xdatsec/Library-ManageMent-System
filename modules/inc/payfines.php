<?php

session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }

include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$accid = $_POST['dataid'];
$paid = $_POST['paid'];
$updateStmt = $conn->prepare("UPDATE returned SET Paid = ? WHERE id = ?");

// Bind the parameters to the placeholders
$updateStmt->bind_param("ii", $paid, $accid);

// Execute the prepared statement
if ($updateStmt->execute()) {

} else {
  echo "Error updating record: " . $updateStmt->error;
}

$updateStmt->close();
        

        
    
    
    $conn->close();
}






?>