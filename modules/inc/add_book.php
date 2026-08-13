<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
// Insert the new book record
$title2 = $_POST['title2'];
$lastname2 = $_POST['lastname2'];
$firstname2 = $_POST['firstname2'];
$middlename2 = $_POST['middlename2'];
$joint_lastname2 = $_POST['joint_lastname2'];
$joint_firstname2 = $_POST['joint_firstname2'];
$joint_middlename2 = $_POST['joint_middlename2'];
$joint_lastname22 = $_POST['joint_lastname22'];
$joint_firstname22 = $_POST['joint_firstname22'];
$joint_middlename22 = $_POST['joint_middlename22'];
$subject2 = $_POST['subject2'];
$publisher2 = $_POST['publisher2'];
$place_of_publication2 = $_POST['place_of_publication2'];
$booknumber2 = $_POST['booknumber2'];
$authornumber2 = $_POST['authornumber2'];
$encoder2 = $_POST['encoder2'];

$sql = "INSERT INTO books (Title, Author1LN, Author1FN, Author1MI, Author2LN, Author2FN, Author2MI, Author3LN, Author3FN, Author3MI, SubjectID, PublisherName, PlaceofPublication, CallNum1, CallNum2, Encoder, DateEncoded, Deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0)";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Bind the parameters to the statement
mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $title2, $lastname2, $firstname2, $middlename2, $joint_lastname2, $joint_firstname2, $joint_middlename2, $joint_lastname22, $joint_firstname22, $joint_middlename22, $subject2, $publisher2, $place_of_publication2, $booknumber2, $authornumber2, $encoder2);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
  echo 'New book record created successfully';
  function getOperatingSystem()
  {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    $os = "Unknown OS";

    if (strpos($userAgent, 'Windows') !== false) {
      $os = 'Windows';
    } elseif (strpos($userAgent, 'Macintosh') !== false) {
      $os = 'Macintosh';
    } elseif (strpos($userAgent, 'Android') !== false) {
      $os = 'Android';
    } elseif (strpos($userAgent, 'iOS') !== false || strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
      $os = 'iOS';
    } elseif (strpos($userAgent, 'Linux') !== false) {
      $os = 'Linux';
    }

    return $os;
  }

  // Get and print the OS
  $computername = getOperatingSystem();


  // Get IP address
  $ip = $_SERVER['REMOTE_ADDR'];
  $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
  $loginname = $_SESSION["username"] . ' has  Added Book with Title '.$title2;
  $type = 'insert'; // Adjust the type value as needed


  $logentry = "INSERT INTO logs (action, date, type, devicetype, ip) VALUES (?, NOW(), ?, ?, ?)";
  $lognstmt = mysqli_prepare($conn, $logentry);

  if ($lognstmt) {
    mysqli_stmt_bind_param($lognstmt, 'ssss',  $loginname, $type, $computername, $ip);
    mysqli_stmt_execute($lognstmt);
  } else {
    // Handle the case where the prepared statement fails
    echo "Error preparing statement: " . mysqli_error($conn);
  }

} else {
  echo 'Error: ' . mysqli_stmt_error($stmt);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
?>