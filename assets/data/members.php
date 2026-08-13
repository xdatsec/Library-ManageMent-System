<?php
session_start();
if (isset($_SESSION["loggedin"])) {

}else{
   
        header('Location: /login.php');
        exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/modules/inc/connection.php';

$coursename ='';
$yearname='';
$typename='';
$sectionname='';
$rowadd = 0;
$totalrow = 0;

$stmt = $conn->prepare("SELECT * FROM members WHERE Deleted = 0");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {

if($row['CourseID'] == 0){
    $coursename = 'N/A';
}else{
$getcourse = $conn->prepare("SELECT * FROM course WHERE CourseID = ?");


$getcourse->bind_param("i", $row['CourseID']);


$getcourse->execute();
$courseresult = $getcourse->get_result();


if ($courseresult->num_rows > 0) {
    
    while ($courserow = $courseresult->fetch_assoc()) {
        $coursename = $courserow['Course'];
    }
} else {
    $coursename = 'N/A';
}
$getcourse->close();
}

if($row['YearID'] == 0){
    $yearname = 'N/A';
}else{
$getsyear = $conn->prepare("SELECT * FROM year WHERE YearID = ?");


$getsyear->bind_param("i", $row['YearID']);


$getsyear->execute();
$yearresult = $getsyear->get_result();


if ($yearresult->num_rows > 0) {
    
    while ($yearrow = $yearresult->fetch_assoc()) {
        $yearname = $yearrow['Year'];
    }
} else {
    $yearname = 'N/A';
}
$getsyear->close();
}

if($row['SectionID'] == 0){
    $sectionname = 'N/A';
}else{
$getsection = $conn->prepare("SELECT * FROM section2 WHERE SectionID = ?");


$getsection->bind_param("i", $row['SectionID']);


$getsection->execute();
$sectionresult = $getsection->get_result();


if ($sectionresult->num_rows > 0) {
    
    
    while ($sectionrow = $sectionresult->fetch_assoc()) {
        $sectionname = $sectionrow['Section'];
    }
} else {
    $sectionname = 'N/A';
}
$getsection->close();
}

if($row['TypeId'] == 0){
    $typename = 'N/A';
}else{
$gettype = $conn->prepare("SELECT * FROM type WHERE TypeId = ?");


$gettype->bind_param("i", $row['TypeId']);


$gettype->execute();
$typeresult = $gettype->get_result();


if ($typeresult->num_rows > 0) {
    
    while ($typerow = $typeresult->fetch_assoc()) {
        $typename = $typerow['Type'];
    }
} else {
    $typename = 'N/A';
}
$gettype->close();
}
$rowadd++;
$count = $rowadd;
$text = preg_replace('/\s+/', '', $row['Remarks']);
$remarks = "";
$maxLength = 10;
if (mb_strlen($text) > $maxLength) {
    $remarks =  mb_substr($text, 0, $maxLength) . '...';
}else{
    $remarks = $text;
}

        if($rowadd != $totalrow){
            $count--;
            echo'
            {
                
              "MemberID":"'.htmlspecialchars($row['MemberID'], ENT_QUOTES, 'UTF-8').'",
              "LastName":"'.htmlspecialchars($row['LastName'], ENT_QUOTES, 'UTF-8').'",
              "FirstName":"'.htmlspecialchars($row['FirstName'], ENT_QUOTES, 'UTF-8').'",
              "MiddleName":"'.htmlspecialchars($row['MiddleName'], ENT_QUOTES, 'UTF-8').'",
              "Course":"'.htmlspecialchars($coursename, ENT_QUOTES, 'UTF-8').'",
              "Type":"'.htmlspecialchars($typename, ENT_QUOTES, 'UTF-8').'",
              "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'",
              "DateEncoded":"'.htmlspecialchars($row['DateEncoded'], ENT_QUOTES, 'UTF-8').'",
              "Count":"'.htmlspecialchars($count, ENT_QUOTES, 'UTF-8').'"
            },
            
           ';
        }else{
            $count--;
            echo'
            {
                "MemberID":"'.htmlspecialchars($row['MemberID'], ENT_QUOTES, 'UTF-8').'",
                "LastName":"'.htmlspecialchars($row['LastName'], ENT_QUOTES, 'UTF-8').'",
                "FirstName":"'.htmlspecialchars($row['FirstName'], ENT_QUOTES, 'UTF-8').'",
                "MiddleName":"'.htmlspecialchars($row['MiddleName'], ENT_QUOTES, 'UTF-8').'",
                "Course":"'.htmlspecialchars($coursename, ENT_QUOTES, 'UTF-8').'",
                "Type":"'.htmlspecialchars($typename, ENT_QUOTES, 'UTF-8').'",
                "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'",
                "DateEncoded":"'.htmlspecialchars($row['DateEncoded'], ENT_QUOTES, 'UTF-8').'",
                "Count":"'.htmlspecialchars($count, ENT_QUOTES, 'UTF-8').'"
            }
            
           ';
        }
       
    
      
    }
    echo ']
}';

} else {
    echo'[{"data":[]}]

    ';

}


$stmt->close();
$conn->close();
?>
