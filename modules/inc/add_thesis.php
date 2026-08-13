<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $accession = $_POST['accession'];
    $itemno = $_POST['itemno'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $subject = $_POST['subject'];
    $remarks = $_POST['remarks'];
    $copyrightyear = $_POST['copyrightyear'];
    $source = $_POST['source'];
    $daterecieve = $_POST['daterecieve'];
    $quantity = $_POST['quantity'];
    $encoder = $_SESSION['username'];

    $stmt3 = $conn->prepare("SELECT Title FROM thesis WHERE AccessionNo = ? AND Deleted = 0");
$stmt3->bind_param("s", $accession);

// Execute the statement
$stmt3->execute();

// Get the result
$result = $stmt3->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    echo "This Accession ID already used";
    exit;
} else {
 
}



// Prepare an SQL query with placeholders
$sql = "INSERT INTO thesis (ItemNo,AccessionNo,Title,Author,`Subject`, Remarks, CopyrightYear, Source, DateReceived, Quantity, Encoder, `Type`, `Deleted`, `DateEncoded`, Borrowed, ExistingB) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, NOW(), ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$type = "Thesis";
$deleted = 0;

$borrowed = 0;
$existingb = 0;
$stmt->bind_param("sssssssssssssss", $itemno, $accession, $title, $author, $subject, $remarks, $copyrightyear, $source, $daterecieve, $quantity, $encoder, $type, $deleted, $borrowed, $existingb);

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
  $loginname = $_SESSION["username"] . ' has  Added Thesis with Title '.$title;
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