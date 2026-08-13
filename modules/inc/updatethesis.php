<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  // Your code here
} else {
  header('Location: /signin.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if($_SESSION['isSuperAdmin'] == 1){

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

    $empId = $_REQUEST['empId'];
    $newValue = $_REQUEST['newValue'];
    $colName = $_REQUEST['colName'];
    $username = $_SESSION['username'];
    $computerName = gethostname();
    $changes = '';
    $empidh = $empId.'.thesis';
    $acid = 0;
    // Check if $conn is a valid database connection

    if ($colName == 'AccessionNo') {
  
        // Prepare the SELECT statement
        $checkDuplicate = $conn->prepare("SELECT COUNT(*) as count FROM thesis WHERE AccessionNo = ? AND Deleted = 0 AND Type ='Thesis'");
        $checkDuplicate->bind_param("i", $newValue);
        $checkDuplicate->execute();
        $duplicateResult = $checkDuplicate->get_result();
        $count = $duplicateResult->fetch_assoc()['count'];
        
        if ($count > 0) {
            echo "Accession Number already exists";
            exit;
        } else {

        
            if ($empId != '' && $newValue != '' && $colName != '') {
                $update = "update thesis set " . $colName . " = ? where AccessionNo = ?";
                $stmt = $conn->prepare($update);
                $stmt->bind_param("ii", $newValue, $empId);
                if ($stmt->execute()) {
                    $rowsec = "IDNo";
                    $update = "update history set " . $rowsec . " = ? where IDNo = ?";
                    $stmt = $conn->prepare($update);
                    $stmt->bind_param("ii", $newValue, $empidh);
                    if ($stmt->execute()) {
                        // Update successful
                        $computername = getOperatingSystem();
      
      
                        // Get IP address
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
                        $loginname = $_SESSION["username"] . ' has  Updated Thesis on '.$colName .' with '.$newValue.' ID-'.$empId;
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
                } else {
                    echo 'Error in Updation';
                }
            }
        }
    } else {
        if ($newValue == '') {
            $newValue = 'NULL';
            $update = "update thesis set " . $colName . " = ? where AccessionNo  = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("si", $newValue, $empId);
            if ($stmt->execute()) {
                $computername = getOperatingSystem();
      
      
                // Get IP address
                $ip = $_SERVER['REMOTE_ADDR'];
                $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
                $loginname = $_SESSION["username"] . ' has  Updated Thesis on '.$colName .' with '.$newValue.' ID-'.$empId;
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
        } else {
            if ($empId != '' && $newValue != '' && $colName != '') {
                $update = "update thesis set " . $colName . " = ? where AccessionNo = ?";
                $stmt = $conn->prepare($update);
                $stmt->bind_param("si", $newValue, $empidh);
                if ($stmt->execute()) {
                    $computername = getOperatingSystem();
      
      
                    // Get IP address
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
                    $loginname = $_SESSION["username"] . ' has  Updated Thesis on '.$colName .' with '.$newValue.' ID-'.$empId;
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
        }
    }
}
$conn->close();
}else{
  echo 'You Dont Have Permission to Edit, Please Contact Library Admin! ';
}
?>
