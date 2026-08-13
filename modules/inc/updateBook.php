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
    $empId = $_REQUEST['empId'];
    $newValue = $_REQUEST['newValue'];
    $colName = $_REQUEST['colName'];
    $username = $_SESSION['username'];
    $computerName = gethostname();
    $changes = '';

    if ($colName == 'Author1MI' || $colName == 'Author2MI' || $colName == 'Author3MI') {
        $newValue = $newValue . '.';
    }

    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update books set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where BookID  = " . (int)$empId;
        if ($conn->query($update)) {
            if ($colName == 'Title') {
                $changes = 'Changes Made:' . "\n" . 'Title  => ' . $newValue;
            } else if ($colName == 'Author1FN') {
                $changes = 'Changes Made:' . "\n" . 'Author First => ' . $newValue;
            } else if ($colName == 'Author1LN') {

                $changes = 'Changes Made:' . "\n" . 'Joint Author Last Name  =>' . $newValue;
            } else if ($colName == 'Author1MI') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author Middle Initial  => ' . $newValue;
            } else if ($colName == 'Author2FN') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author First Name  => ' . $newValue;
            } else if ($colName == 'Author2LN') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author Last Name  => ' . $newValue;
            } else if ($colName == 'Author2MI') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author Middle Initial  => ' . $newValue;
            } else if ($colName == 'Author3FN') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author First Name  =>' . $newValue;
            } else if ($colName == 'Author3LN') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author Last Name  =>' . $newValue;
            } else if ($colName == 'Author3MI') {
                $changes = 'Changes Made:' . "\n" . 'Joint Author Middle Initial  => ' . $newValue;
            } else if ($colName == 'SubjectID') {
                $subjects = $_POST['subject'];
                $sql33 = "SELECT * FROM subject WHERE SubjectID = ?";

                // Prepare the statement
                $stmt33 = $conn->prepare($sql33);

                // Bind the parameter to the statement
                $stmt33->bind_param("i", $subjects); // Use $subjects here

                // Execute the statement
                $stmt33->execute();

                // Get the result set
                $result33 = $stmt33->get_result();

                // Initialize the $changes variable
                $changes = 'Changes Made:' . "\n";

                // Loop through the result set and append changes to $changes
                while ($row33 = $result33->fetch_assoc()) {
                    $changes .= 'Subject  => ' . $row33['Subject'] . "\n";
                }
            } else if ($colName == 'PublisherName') {
                $changes = 'Changes Made:' . "\n" . 'Publisher Name  => ' . $newValue;
            } else if ($colName == 'PlaceofPublication') {
                $changes = 'Changes Made:' . "\n" . 'Place of Publication  => ' . $newValue;
            } else if ($colName == 'CallNum1') {
                $changes = 'Changes Made:' . "\n" . 'Book Number  => ' . $newValue;
            } else if ($colName == 'CallNum2') {
                $changes = 'Changes Made:' . "\n" . 'Author Number  => ' . $newValue;
            }


            $sql2 = "INSERT INTO history(IDNo, DateTime, UserName,ComputerName, Comments) VALUES (?, NOW(), ?, ?, ?)";

            // Prepare the statement
            $stmt2 = $conn->prepare($sql2);

            // Bind the parameters to the statement
            $stmt2->bind_param("ssss", $empId, $username, $computerName, $changes);

            // Execute the statement
            if ($stmt2->execute()) {
                echo '';
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
                $loginname = $_SESSION["username"] . ' has  Updated BookS on'.$colName.'with new Value'.$newValue;
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
                echo 'Error: ' . $stmt->error;
            }
        } else {
            echo 'Error in Updation';
        }
    }


    $conn->close();
}else{
    echo 'You Dont Have Permission to Edit, Please Contact Library Admin! ';
  }
}
