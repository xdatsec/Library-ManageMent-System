<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$empId = $_REQUEST['empId'];
$newValue = $_REQUEST['newValue'];
$colName = $_REQUEST['colName'];
if($colName == 'MiddleName'){
    $newValue = $newValue.'.';
}
if ($empId != '' && $newValue != '' && $colName != '') {
    $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where id = " . (int)$empId;
    if ($conn->query($update)) {
        echo 'Updated successfully';
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
        $loginname = $_SESSION["username"] . ' has  Updated Member on'.$colName.'with new Value'.$newValue;
        $type = 'UPDATE'; // Adjust the type value as needed
      
      
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
        echo 'Error in Updation';
    }
}

$conn->close();
}
?>
