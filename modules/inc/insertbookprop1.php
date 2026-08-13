<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store the names of empty fields
   
        $sql = "INSERT INTO `books accession` (ItemNo, AccessionNo, Copies, `Location`, BookLocation, Source, Donor, SubClass1, SubClass2, SubClass3, SubClass4, Replacedfor, Remarks, `MR Page`, `Status`, Encoder, IDNo, Deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Bind the values to the statement
        $stmt = $conn->prepare($sql);

        $bookid = $_POST["bookid"];
        $itemno = $_POST["itemno"];
        $accessionno = $_POST["accessionno"];
        $copies = $_POST["copies"];
        $location = $_POST["location"];
        $booklocation = $_POST["booklocation"];
        $source = $_POST["source"];
        $donor = $_POST["donor"];
        $subclass1 = $_POST["subclass1"];
        $subclass2 = $_POST["subclass2"];
        $subclass3 = $_POST["subclass3"];
        $subclass4 = $_POST["subclass4"];
        $replacedFor = $_POST["replacefor"];
        $remarks = $_POST["remarks"];
        $mrpage = $_POST["mrpage"];
        $status = $_POST["status"];
        $idno = $_POST["idno"];
        $encoder = $_POST["encoder"];
        $deleted = 0;

        // Bind the parameters
        $stmt->bind_param("sissssssssssssssss", $itemno, $accessionno, $copies, $location, $booklocation, $source, $donor, $subclass1, $subclass2, $subclass3, $subclass4, $replacedFor, $remarks, $mrpage, $status, $encoder, $idno, $deleted);

        // Execute the statement
        if ($stmt->execute()) {

      
$newValue = $accessionno;

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
        $loginname = $_SESSION["username"] . ' has  ADDED BookS Acession with Accession No -'.$accessionno;
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
        echo "Error updating column: " . $conn->error;
    }
} else {
    echo "No data found for the specified book ID.";
}

        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    
} else {
    echo "Invalid request method.";
}
?>
