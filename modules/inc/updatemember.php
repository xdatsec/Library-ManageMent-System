<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];

if($colName == 'MiddleName'){
    
    $newValue = $newValue.'.';

    $stmt3 = $conn->prepare("SELECT MemberID FROM members WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Deleted = 0");
    $stmt3->bind_param("sss", $lastname, $firstname, $newValue);

    // Execute the statement
    $stmt3->execute();

    // Get the result
    $result45 = $stmt3->get_result();

    // Check if any rows are returned
    if ($result45->num_rows > 0) {
        $getname = $result45->fetch_assoc();
        if($getname['MemberID'] != $empId){
            echo "This Member Already Exists(Enter other name)";
            exit;
        }

    } else {
        if ($empId != '' && $newValue != '' && $colName != '') {
            $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
}else if($colName == 'LastName'){
    
    $newValue = $newValue;

    $stmt3 = $conn->prepare("SELECT MemberID FROM members WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Deleted = 0");
    $stmt3->bind_param("sss", $newValue, $firstname, $middlename);

    // Execute the statement
    $stmt3->execute();

    // Get the result
    $result45 = $stmt3->get_result();

    // Check if any rows are returned
    if ($result45->num_rows > 0) {
        $getname = $result45->fetch_assoc();
        if($getname['MemberID'] != $empId){
            echo "This Member Already Exists(Enter other name)";
            exit;
        }

    } else {
        if ($empId != '' && $newValue != '' && $colName != '') {
            $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
}else if($colName == 'FirstName'){
    
    $newValue = $newValue;

    $stmt3 = $conn->prepare("SELECT MemberID FROM members WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Deleted = 0");
    $stmt3->bind_param("sss", $lastname, $newValue, $middlename);

    // Execute the statement
    $stmt3->execute();

    // Get the result
    $result45 = $stmt3->get_result();

    // Check if any rows are returned
    if ($result45->num_rows > 0) {
        $getname = $result45->fetch_assoc();
        if($getname['MemberID'] != $empId){
            echo "This Member Already Exists(Enter other name)";
            exit;
        }

    } else {
        if ($empId != '' && $newValue != '' && $colName != '') {
            $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
}else if($colName == 'email'){
    
  $newValue = $newValue;

  $stmt3 = $conn->prepare("SELECT MemberID FROM members WHERE email = ? AND Deleted = 0");
  $stmt3->bind_param("s", $newValue);

  // Execute the statement
  $stmt3->execute();

  // Get the result
  $result45 = $stmt3->get_result();

  // Check if any rows are returned
  if ($result45->num_rows > 0) {
      $getname = $result45->fetch_assoc();
     echo "This Email Already Exists(Enter other Email)";
      exit;

  } else {
    if (!filter_var($newValue, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
      exit;
  }
      if ($empId != '' && $newValue != '' && $colName != '') {
          $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
          if ($conn->query($update)) {
       // Get and print the OS
       $computername = getOperatingSystem();
    
    
       // Get IP address
       $ip = $_SERVER['REMOTE_ADDR'];
       $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
       $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
}else if($colName =='DateEnlist'){
    $nextDay = date('Y-m-d', strtotime($newValue . ' +1 day'));

    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update members set " . $colName . " = '" . $conn->real_escape_string($nextDay) . "' where MemberID  = " . (int)$empId;
        if ($conn->query($update)) {
     // Get and print the OS
     $computername = getOperatingSystem();
      
      
     // Get IP address
     $ip = $_SERVER['REMOTE_ADDR'];
     $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
     $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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


}else if($colName =='DatetoGrad'){
    $nextDay = date('Y-m-d', strtotime($newValue . ' +1 day'));

    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update members set " . $colName . " = '" . $conn->real_escape_string($nextDay) . "' where MemberID  = " . (int)$empId;
        if ($conn->query($update)) {
     // Get and print the OS
     $computername = getOperatingSystem();
      
      
     // Get IP address
     $ip = $_SERVER['REMOTE_ADDR'];
     $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
     $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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


}else if($colName =='DatetoGrad'){
    $nextDay = date('Y-m-d', strtotime($newValue . ' +1 day'));

    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update members set " . $colName . " = '" . $conn->real_escape_string($nextDay) . "' where MemberID  = " . (int)$empId;
        if ($conn->query($update)) {
     // Get and print the OS
     $computername = getOperatingSystem();
      
      
     // Get IP address
     $ip = $_SERVER['REMOTE_ADDR'];
     $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
     $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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


}else if($colName =='MemberID'){
// Prepare the SELECT statement
$stmt2 = $conn->prepare("SELECT LastName, FirstName, MiddleName FROM members WHERE MemberID = ? AND Deleted = 0");
$stmt2->bind_param("s", $newValue);

// Execute the statement
$stmt2->execute();

// Get the result
$result = $stmt2->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
   if($row['LastName'] != $lastname || $row['FirstName'] != $firstname || $row['MiddleName'] != $middlename){
    echo "This Member Already Exists";
    exit;
   }

    
}else{
    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
        if ($conn->query($update)) {
            $rowsec ="IDNo";
            $update = "update history set " . $rowsec . " = '" . $conn->real_escape_string($newValue) . "' where IDNo  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
}else{
    if($newValue == ''){
        $update = "update members set " . $colName . " = '" . $conn->real_escape_string('NULL') . "' where MemberID  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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
    }else{
        if ($empId != '' && $newValue != '' && $colName != '') {
            $update = "update members set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where MemberID  = " . (int)$empId;
            if ($conn->query($update)) {
         // Get and print the OS
         $computername = getOperatingSystem();
      
      
         // Get IP address
         $ip = $_SERVER['REMOTE_ADDR'];
         $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
         $loginname = $_SESSION["username"] . ' has  Updated Member on '.$colName .' with '.$newValue.' ID-'.$empId;
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

}else{

}

}else{
  echo 'You Dont Have Permission to Edit, Please Contact Library Admin! ';
}
$conn->close();
?>
