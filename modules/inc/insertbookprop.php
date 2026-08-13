<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $itemno = $_POST["itemno"];
    $courseid = $_POST["courseid"];
    $cpyear = $_POST["cpyear"];
    $daterecive = $_POST["daterecives"];
    $isbn = $_POST["isbn"];
    $editionnumber = $_POST["editionnumber"];
    $pprice = $_POST["pprice"];
    $supplier = $_POST["supplier"];
    $recomend = $_POST["recomend"];
    $bpages = $_POST["bpages"];
    $encoder = $_POST["encoder"];
    $bookid = $_POST["bookid"];

    if($editionnumber == ""){
        $editionnumber = 0;
    }else{
        $editionnumber = $_POST["editionnumber"]."nd Edition";
    }



    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO `books sub table` (BookID, ItemNo, CourseID , CopyrightYear, DateReceived, ISBNNumber, EditionNumber, PurchasePrice, Supplier, Recommendedby, BPages, Encoder, Deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssssssssssss",$bookid, $itemno, $courseid, $cpyear, $daterecive, $isbn, $editionnumber, $pprice, $supplier, $recomend, $bpages, $encoder);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
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
        $loginname = $_SESSION["username"] . ' has  ADDED BookS Subtable with ItemNO -'.$itemno;
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

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
