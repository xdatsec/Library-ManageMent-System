<?php
session_start();
include 'connection.php';
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if ($_SERVER["REQUEST_METHOD"]) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userroles = $_POST["userroles"];
    $password = $_POST["password"];
    if($_SESSION['isSuperAdmin'] ==1){
        if($userroles == 1){
            $sqlselectemail = "SELECT * FROM user WHERE email = ?";
            $stmtselectemail = $conn->prepare($sqlselectemail);
            $stmtselectemail->bind_param("s", $email);
            $stmtselectemail->execute();
            $resultselectemail = $stmtselectemail->get_result();
            $rowselectemail = $resultselectemail->fetch_assoc();
            if($resultselectemail->num_rows > 0){
                echo "Email already exist";
                exit;
            }
            $sqlselectusername = "SELECT * FROM user WHERE UserName = ?";
            $stmtselectusername = $conn->prepare($sqlselectusername);
            $stmtselectusername->bind_param("s", $username);
            $stmtselectusername->execute();
            $resultselectusername = $stmtselectusername->get_result();
            $rowselectusername = $resultselectusername->fetch_assoc();
            if($resultselectusername->num_rows > 0){
                echo "Username already exist";
                exit;
            }
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (UserName, Email, Password, isSuperAdmin, Title) VALUES (?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssis", $username, $email, $passwordhash, $superadmin, $title);
            $superadmin = 0;
            $title ="Staff";
            if ($stmt->execute()) {
              
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
                $loginname = $_SESSION["username"] . ' has created a new user with username -'.$username;
                $type = 'INSERT'; // Adjust the type value as needed
              
              
                $logentry = "INSERT INTO logs (action, date, type, devicetype, ip) VALUES (?, NOW(), ?, ?, ?)";
                $lognstmt = mysqli_prepare($conn, $logentry);
              
                if ($lognstmt) {
                  mysqli_stmt_bind_param($lognstmt, 'ssss',  $loginname, $type, $computername, $ip);
              
                  if (mysqli_stmt_execute($lognstmt)) {
                    // Redirect to login page
                  
                  } else {
                    echo "Something went wrong. Please try again later.";
                  }
                }
              
                // Close statement
                mysqli_stmt_close($lognstmt);
              
                // Close connection
                mysqli_close($conn);
              
                exit;
              } else {
                echo "Something went wrong. Please try again later.";
              }
              
              // Close statement
              mysqli_stmt_close($stmt);
              
              // Close connection
              mysqli_close($conn);
              
              exit;







        }else{

            $sqlselectemail = "SELECT * FROM user WHERE email = ?";
            $stmtselectemail = $conn->prepare($sqlselectemail);
            $stmtselectemail->bind_param("s", $email);
            $stmtselectemail->execute();
            $resultselectemail = $stmtselectemail->get_result();
            $rowselectemail = $resultselectemail->fetch_assoc();
            if($resultselectemail->num_rows > 0){
                echo "Email already exist";
                exit;
            }
            $sqlselectusername = "SELECT * FROM user WHERE UserName = ?";
            $stmtselectusername = $conn->prepare($sqlselectusername);
            $stmtselectusername->bind_param("s", $username);
            $stmtselectusername->execute();
            $resultselectusername = $stmtselectusername->get_result();
            $rowselectusername = $resultselectusername->fetch_assoc();
            if($resultselectusername->num_rows > 0){
                echo "Username already exist";
                exit;
            }
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (UserName, Email, Password, isSuperAdmin, Title) VALUES (?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssis", $username, $email, $passwordhash, $superadmin, $title);
            $superadmin = 1;
            $title ="Librarian";

            
            if ($stmt->execute()) {

                // MySQL query to create a new user
$newUsername = mysqli_real_escape_string($conn, $username);
$newUserPassword =mysqli_real_escape_string($conn, $password);

$sqlCreateUser = "CREATE USER '$newUsername'@'localhost' IDENTIFIED BY '$newUserPassword'";
if ($conn->query($sqlCreateUser) === TRUE) {
 

    // Grant privileges to the user on the 'lib_sis' database
    $sqlGrantPrivileges = "GRANT ALTER, SELECT, INSERT, UPDATE, DELETE ON mrrptech_lib_sis.* TO '$newUsername'@'localhost'";
    if ($conn->query($sqlGrantPrivileges) === TRUE) {
      
    } else {
        echo "Error granting privileges: " . $conn->error;
    }
} else {
    echo "Error creating user: " . $conn->error;
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
                $loginname = $_SESSION["username"] . ' has created a new Librarian with username -'.$username;
                $type = 'INSERT'; // Adjust the type value as needed
              
              
                $logentry = "INSERT INTO logs (action, date, type, devicetype, ip) VALUES (?, NOW(), ?, ?, ?)";
                $lognstmt = mysqli_prepare($conn, $logentry);
              
                if ($lognstmt) {
                  mysqli_stmt_bind_param($lognstmt, 'ssss',  $loginname, $type, $computername, $ip);
              
                  if (mysqli_stmt_execute($lognstmt)) {
                    // Redirect to login page
                  
                  } else {
                    echo "Something went wrong. Please try again later.";
                  }
                }
              
                // Close statement
                mysqli_stmt_close($lognstmt);
              
                // Close connection
                mysqli_close($conn);
              
                exit;
              } else {
                echo "Something went wrong. Please try again later.";
              }
              
              // Close statement
              mysqli_stmt_close($stmt);
              
              // Close connection
              mysqli_close($conn);
              
              exit;

        }
    }


}



?>