<?php
include 'connection.php';
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/vendor/autoload.php';

use DeviceDetector\DeviceDetector;
ini_set('session.gc_maxlifetime', 1296000); // 15 days in seconds

$username = $staffname = $password = "";
$username_err = $password_err = $login_err = "";

// Encryption key (replace with your own secure key)
$encryptionKey = 'X1W2Z3Y4X1W2Z3Y4';
$secretkey ='codecmakergamersx1234@@@123';

// Function to encrypt data and set a cookie
function setEncryptedCookie($name, $value, $username, $expiration) {
    global $encryptionKey;
    $iv = openssl_random_pseudo_bytes(16); // Generate a 16-byte IV
    $encryptedValue = openssl_encrypt($value, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
    $cookieValue = base64_encode($iv . $encryptedValue);
    setcookie($name, $cookieValue, $expiration, '/');
}

$encryptionKey = 'X1W2Z3Y4X1W2Z3Y4';
$secretkey ='codecmakergamersx1234@@@123';

// Function to read and decrypt a cookie
function getDecryptedCookie($name, $username) {
    global $encryptionKey;
    if (isset($_COOKIE[$name])) {
        $cookieValue = base64_decode($_COOKIE[$name]);
        $iv = substr($cookieValue, 0, 16); // Extract the first 16 bytes as IV
        $encryptedValue = substr($cookieValue, 16); // Rest is encrypted data
        try {
            $decryptedValue = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
            if ($decryptedValue === false) {
                throw new Exception("Failed to decrypt cookie.");
            }
            return $decryptedValue;
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error or take appropriate action)
            return null;
        }
    }
    return null;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"])) || empty(trim($_POST["password"]))) {
        $username_err = "Username and Password are required.";
        echo $username_err;
        exit;
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
        echo $password_err;
        exit;
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT Title, isSuperAdmin, UserName, password,deactivated FROM user WHERE UserName = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $staffname, $isSuperAdmin, $username, $hashed_password,$deactivated);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            if($deactivated == 1){
                                echo "Account is deactivated, Please contact the administrator";
                                exit;
                            }else{
                            session_start();
                            // Set session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["staff_name"] = $staffname;
                            $_SESSION["isSuperAdmin"] = $isSuperAdmin;
                            
                            $expiration = time() + 15 * 24 * 3600; 
setEncryptedCookie('loggedin', 'true', $secretkey, $expiration); 
setEncryptedCookie('username', $username, $secretkey, $expiration);  
setEncryptedCookie('staff_name', $staffname, $secretkey, $expiration); 
setEncryptedCookie('isSuperAdmin', $isSuperAdmin, $secretkey, $expiration); 




                            // Update last login time
                            $sql2 = "UPDATE user SET lastlogin = NOW() WHERE UserName = ?";
                            if ($stmt3 = mysqli_prepare($conn, $sql2)) {
                                mysqli_stmt_bind_param($stmt3, "s", $param_userid);
                                $param_userid = $_SESSION["username"];
                                if (mysqli_stmt_execute($stmt3)) {
                                    $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
                                    echo "success";
                                    $computername ="";
                                    $userAgent = $_SERVER['HTTP_USER_AGENT'];

                                    // Initialize DeviceDetector
                                    $dd = new DeviceDetector($userAgent);

                                    // Parse the user agent
                                    $dd->parse();
                                    $osInfo = $dd->getOs();
                                    // Check if 'name' key exists in the operating system array
                                    if (isset($osInfo['name'])) {
                                        // Get operating system name
                                        $osName = $osInfo['name'];

                                        $computername = $osName;
                                    } else {
                                        $computername = "Unknown";
                                    }



                                    // Get IP address
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                    $_SESSION["lastlogin"] = date('Y-m-d H:i:s');
                                    $loginname = $_SESSION["username"] . ' has logged in';
                                    $type = 'login'; // Adjust the type value as needed
                                   

                                    $logentry = "INSERT INTO logs (action, date, type, devicetype, ip) VALUES (?, NOW(), ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $logentry);

                                    if ($stmt) {
                                        mysqli_stmt_bind_param($stmt, 'ssss',  $loginname, $type, $computername, $ip);
                                        mysqli_stmt_execute($stmt);
                                    } else {
                                        // Handle the case where the prepared statement fails
                                        echo "Error preparing statement: " . mysqli_error($conn);
                                    }

                                }
                            }
                            }
                        } else {
                            $login_err = "Invalid username or password.";
                            echo $login_err;
                        }
                    }
                } else {
                    $login_err = "Account does not exist.";
                    echo $login_err;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
