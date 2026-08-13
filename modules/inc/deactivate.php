<?php
session_start();
include 'connection.php';
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if ($_SERVER["REQUEST_METHOD"]) {
    $selectedItems = $_POST["username"];
    $sqlcheck = "SELECT deactivated, isSuperAdmin FROM user WHERE UserName = ?";
    $stmtcheck = $conn->prepare($sqlcheck);
    $stmtcheck->bind_param("s", $selectedItems);
    $stmtcheck->execute();
    $resultcheck = $stmtcheck->get_result();
    $rowcheck = $resultcheck->fetch_assoc();
    if($rowcheck['deactivated'] == 1){

      if($rowcheck['isSuperAdmin'] =="0"){

      
      $sql = "UPDATE user SET deactivated = 0 WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selectedItems);
     
        if ($stmt->execute()) {
          echo "Account has been Reactivate!";
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
          $loginname = $_SESSION["username"] . ' has  Reactivated The Account with username -'.$selectedItems;
          $type = 'DROP'; // Adjust the type value as needed
        
        
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
          echo "ERROR";
        }
      }else{
        
      $sql = "UPDATE user SET deactivated = 0 WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selectedItems);
     
        if ($stmt->execute()) {
          echo "Account has been Reactivate!";
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
          $uname = strtolower($selectedItems);
          $newUsername = mysqli_real_escape_string($conn, $uname);
          $sqlGrantPrivileges = "GRANT ALTER, SELECT, INSERT, UPDATE, DELETE ON mrrptech_lib_sis.* TO '$newUsername'@'localhost'";
          if ($conn->query($sqlGrantPrivileges) === TRUE) {
            
          } else {
              echo "Error granting privileges: " . $conn->error;
          }
        
          // Get and print the OS
          $computername = getOperatingSystem();
        
        
          // Get IP address
          $ip = $_SERVER['REMOTE_ADDR'];
          $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
          $loginname = $_SESSION["username"] . ' has  Reactivated The Account with username -'.$selectedItems;
          $type = 'DROP'; // Adjust the type value as needed
        
        
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
          echo "ERROR";
        }
      }
    }else{
      if($rowcheck['isSuperAdmin'] =="0"){  
      $sql = "UPDATE user SET deactivated = 1 WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selectedItems);
     
        if ($stmt->execute()) {
          echo "Account has been Deactivated!";
         

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
          $loginname = $_SESSION["username"] . ' has  Deactivated The Account with username -'.$selectedItems;
          $type = 'DROP'; // Adjust the type value as needed
        
        
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
          echo "ERROR";
        }
      
    }else{
      $sql = "UPDATE user SET deactivated = 1 WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selectedItems);
     
        if ($stmt->execute()) {
          echo "Account has been Deactivated!";
          $uname = strtolower($selectedItems);
          $newUsername = mysqli_real_escape_string($conn, $uname);
          $sqlGrantPrivileges = "REVOKE ALL PRIVILEGES ON mrrptech_lib_sis.* FROM '$newUsername'@'localhost';";
          if ($conn->query($sqlGrantPrivileges) === TRUE) {
            
          } else {
              echo "Error granting privileges: " . $conn->error;
          }

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
          $loginname = $_SESSION["username"] . ' has  Deactivated The Account with username -'.$selectedItems;
          $type = 'DROP'; // Adjust the type value as needed
        
        
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
          echo "ERROR";
        }
      }
    }
   
}

?>