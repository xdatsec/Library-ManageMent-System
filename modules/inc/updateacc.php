<?php
include "connection.php";
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}

$bookid = $_GET['bookid'];
$newValue = $_GET['newvalue'];

// Fetch the current AccessionNo values associated with the specified book ID
$sql = "SELECT AccessionNo FROM books WHERE BookID = $bookid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentValues = $row['AccessionNo'];

    // Append the new value to the current values
    if ($currentValues) {
        $currentValues .= ", " . $newValue;
    } else {
        $currentValues = $newValue;
    }

    // Update the database with the modified values
    $updateSql = "UPDATE books SET AccessionNo = '$currentValues' WHERE BookID = $bookid";

    if ($conn->query($updateSql) === TRUE) {
        echo "Column updated successfully";
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
        $loginname = $_SESSION["username"] . ' has  Updated BookS Acession with Accession No'.$newValue;
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
        echo "Error updating column: " . $conn->error;
    }
} else {
    echo "No data found for the specified book ID.";
}

// Close the database connection
$conn->close();
?>
