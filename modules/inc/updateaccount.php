<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_SESSION['isSuperAdmin'] == 1){
        $currentpassword = $_REQUEST['currentpassword'];
        $newpassword = $_REQUEST['newpassword'];
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(password_verify($currentpassword, $row['Password'])){

            try {
                if(password_verify($newpassword, $row['Password'])){
                    echo "New Password is the same as the old password";
                    exit;
                }

                $username = $_SESSION['username'];
                $uname = strtolower($username);

                $uname2 = mysqli_real_escape_string($conn, $uname);
                $newpassword2 = mysqli_real_escape_string($conn, $newpassword);
                
                $sql = "ALTER USER '" . $uname2 . "'@'localhost' IDENTIFIED BY '" . $newpassword2 . "'";
                
                if ($conn->query($sql) === TRUE) {
              
                } else {
                    echo "Error updating password: " . $conn->error;
                }


            } catch (mysqli_sql_exception $e) {
                echo "MySQLi Error: " . $e->getMessage();
            }
            $hash = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET Password = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hash, $_SESSION['username']);
            $stmt->execute();
            $result = $stmt->get_result();
        
        }else{
            echo "Current Password is Incorrect Password";
        }
        




    }else{
        $currentpassword = $_REQUEST['currentpassword'];
        $newpassword = $_REQUEST['newpassword'];
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(password_verify($currentpassword, $row['Password'])){
            if(password_verify($newpassword, $row['Password'])){
                echo "New Password is the same as the old password";
                exit;
            }
            
            $hash = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET Password = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hash, $_SESSION['username']);
            $stmt->execute();
            $result = $stmt->get_result();

        }else{
            echo "Current Password is Incorrect Password";
        }

    }

}



?>