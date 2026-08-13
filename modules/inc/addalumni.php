<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $memberid = $_POST['memberid'];
    //insert to alumni table
    $sql ="SELECT * FROM members WHERE MemberID = '$memberid' AND Deleted = 0";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $firstname = $row['FirstName'];
            $lastname = $row['LastName'];
            $middlename = $row['MiddleName'];

            $sql_alumni = "SELECT * FROM alumni WHERE Firstname = '$firstname' AND Lastname = '$lastname'";
            $result_alumni = mysqli_query($conn, $sql_alumni);

            if(mysqli_num_rows($result_alumni) > 0) {
                echo "User already exists in the alumni table";
            } else {
                $sql_alumni_insert = "INSERT INTO alumni (Firstname, Lastname, TypeId) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql_alumni_insert);
                mysqli_stmt_bind_param($stmt, "ssi", $firstname, $lastname, $typeid);
                $typeid = $row['TypeId'];

                if (mysqli_stmt_execute($stmt)) {
                    echo "Alumni record added successfully";
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

                    $os = getOperatingSystem();
                    $browser = $_SERVER['HTTP_USER_AGENT'];
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $memberid = $row['MemberID'];
                    $typeid = $row['TypeId'];
                    $sql_log = "INSERT INTO logs (action,devicetype,type) VALUES (?, ?, ?)";
                    $stmt_log = mysqli_prepare($conn, $sql_log);
                    mysqli_stmt_bind_param($stmt_log, "sss", $logm, $os, $typelog);
                    $logm =$_SESSION['staff_name']." Added alumni record for $firstname $lastname";
                    $typelog = "insert";
                    $action = "Added alumni record";
                    if (mysqli_stmt_execute($stmt_log)) {
           
                    } else {
                        echo "Error: " . $sql_log . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Error: " . $sql_alumni_insert . "<br>" . mysqli_error($conn);
                }

            }
        }
    } else {
        echo "Memberid not found";
    }
}






?>