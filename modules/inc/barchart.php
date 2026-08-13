<?php
date_default_timezone_set('Asia/Manila');

session_start();

if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}

include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jan = 0;
    $feb = 0;
    $mar = 0;
    $apr = 0;
    $may = 0;
    $jun = 0;
    $jul = 0;
    $aug = 0;
    $sep = 0;
    $oct = 0;
    $nov = 0;
    $dec = 0;
$year = date('Y');
$query = "SELECT * 
FROM entrance e 
INNER JOIN members m ON e.MemberID = m.MemberID 
WHERE m.Deleted = 0";
$result = mysqli_query($conn, $query);

// Fetch the data and format it as a JSON array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    if(date('Y-m', strtotime($row['DateAdded']))  ==$year."-01"){
        $jan++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-02"){
        $feb++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-03"){
        $mar++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-04"){
        $apr++;
    }else if(date('Y-m', strtotime($row['DateAdded']))==$year."-05"){
        $may++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-06"){
        $jun++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-07"){
        $jul++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-08"){
        $aug++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-09"){
        $sep++;
    }else if(date('Y-m', strtotime($row['DateAdded']))==$year."-10"){
        $oct++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-11"){
        $nov++;
    }else if(date('Y-m', strtotime($row['DateAdded'])) ==$year."-12"){
        $dec++;
    }
}

$data = array(
    array('January', $jan),
    array('February', $feb),
    array('March', $mar),
    array('April', $apr),
    array('May', $may),
    array('June', $jun),
    array('July', $jul),
    array('August', $aug),
    array('September', $sep),
    array('October', $oct),
    array('November', $nov),
    array('December', $dec)
);

echo json_encode($data);


mysqli_close($conn);
}

