<?php

session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }

include 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['memberID'];
    $memberid = $_POST['memberID'];
$coursename ='';

// Prepare the SELECT statement
$stmt2 = $conn->prepare("SELECT LastName, FirstName, MiddleName, CourseID  FROM members WHERE MemberID = ? AND Deleted = 0");
$stmt2->bind_param("s", $memberid);

// Execute the statement
$stmt2->execute();

// Get the result
$result = $stmt2->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['CourseID'] == 0){
        $coursename = 'N/A';
    }else{
    $getcourse = $conn->prepare("SELECT * FROM course WHERE CourseID = ?");
    
    // Bind the parameter to the statement
    $getcourse->bind_param("i", $row['CourseID']);
    
    // Execute the statement
    $getcourse->execute();
    $courseresult = $getcourse->get_result();
    
    // Check if any rows are returned
    if ($courseresult->num_rows > 0) {
        // Loop through the rows and output the data
        while ($courserow = $courseresult->fetch_assoc()) {
            $coursename = $courserow['Course'];
        }
    } else {
        $coursename = 'N/A';
    }
    $getcourse->close();
    }


 
    echo $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . " - " . $coursename;
    
}
}





?>