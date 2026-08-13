<?php

session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }

include 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $changes ="";
    $id = $_POST['memid'];
    $memberid = $_POST['memberid'];


// Prepare the SELECT statement
$stmt2 = $conn->prepare("SELECT id FROM members WHERE MemberID = ? AND Deleted = 0");
$stmt2->bind_param("s", $memberid);

// Execute the statement
$stmt2->execute();

// Get the result
$result = $stmt2->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['id'] != $id ) {
        echo "Member ID already exists.";
        exit;
    }
    
}
}





?>