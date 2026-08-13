<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $changes ="";
    $id = $_POST['memid'];


// Prepare the SELECT statement
$stmt2 = $conn->prepare("SELECT Remarks FROM members WHERE id = ? AND Deleted = 0");
$stmt2->bind_param("s", $id);

// Execute the statement
$stmt2->execute();

// Get the result
$result = $stmt2->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['Remarks'];
    
}
}





?>