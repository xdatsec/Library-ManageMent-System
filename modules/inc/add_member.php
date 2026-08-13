<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $middleName = $_POST['mname'].".";
    $memberid = $_POST['memberid'];
    $phoneno = $_POST['phoneno'];
// Prepare the SELECT statement
$stmt2 = $conn->prepare("SELECT MemberID FROM members WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Deleted = 0");

$stmt2->bind_param("sss", $lastName, $firstName, $middleName);

// Execute the statement
$stmt2->execute();

// Get the result
$result = $stmt2->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    echo "The First Name , Last Name and MiddleName for this user already exist.";
    exit;
} else {
    $stmt3 = $conn->prepare("SELECT LastName, FirstName, MiddleName FROM members WHERE MemberID = ? AND Deleted = 0");
$stmt3->bind_param("s", $memberid);

// Execute the statement
$stmt3->execute();

// Get the result
$result = $stmt3->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    echo "This Member ID already used";
    exit;
} else {
 
}
}
$phoneRegex = '/^(09|\+639)\d{9}$/';
if (!preg_match($phoneRegex, $phoneno)) {
  echo "Invalid phone number".$phoneno;
  exit;
}

// Prepare an SQL query with placeholders
$sql = "INSERT INTO members (encoder, MemberID, LastName, FirstName, MiddleName, Address, PhoneNo, TypeId , CourseID , Remarks, Deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the parameters
$stmt->bind_param("sssssssssss", $staffname, $memberid, $lastName, $firstName, $middleName, $address, $phoneno, $type, $courseid, $remarks, $deleted);

// Set the parameter values
$staffname = $_SESSION["username"];
$deleted = 0;

$address = $_POST['address'];

$type = $_POST['typeid'];
$courseid = $_POST['courseid'];
$remarks = $_POST['remarks'];

// Execute the statement
if ($stmt->execute()) {
    echo "ok";
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
  $loginname = $_SESSION["username"] . ' has  Added Member with Name '.$firstName.' '.$lastName.' '.$middleName;
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
    echo "Error: " . $stmt->error;
}

// Close the statement and the database connection
$stmt->close();

$conn->close();

}


?>