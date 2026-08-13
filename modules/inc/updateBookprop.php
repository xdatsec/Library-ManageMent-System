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
$empId = $_REQUEST['empId'];
$newValue = $_REQUEST['newValue'];
$colName = $_REQUEST['colName'];
$username = $_SESSION['username'];
$computerName = gethostname();
$changes = '';

if($colName == 'Author1MI' || $colName == 'Author2MI' || $colName =='Author3MI'){
    $newValue = $newValue.'.';
}

if($colName == 'EditionNumber'){
    print($newValue);
    if ($empId != '' && $newValue != '' && $colName != '') {
        if($newValue !='0'){
            $suffix = array('th','st','nd','rd','th','th','th','th','th','th');
            if (($newValue % 100) >= 11 && ($newValue % 100) <= 13) {
                $newValue1 = $newValue . 'th Ed.';
            } else {
                $newValue1 = $newValue . $suffix[$newValue % 10] . ' Ed.';
            }
     
            
            $update = "update `books sub table` set " . $colName . " = '" . $conn->real_escape_string($newValue1) . "' where IDNo  = " . (int)$empId;
            if ($conn->query($update)) {
                
            } else {
                echo 'Error in Updation';
            }
        }else{
            $update = "update `books sub table` set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where IDNo  = " . (int)$empId;
            if ($conn->query($update)) {
                
            } else {
                echo 'Error in Updation';
            }
        }
    
    }
}else{
    if ($empId != '' && $newValue != '' && $colName != '') {
        $update = "update `books sub table` set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where IDNo  = " . (int)$empId;
        if ($conn->query($update)) {
            
        } else {
            echo 'Error in Updation';
        }
    }
}


$conn->close();
}else{
    echo 'You Dont Have Permission to Edit, Please Contact Library Admin! ';
  }
}
?>
