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

$stmt = $conn->prepare("SELECT * FROM books WHERE Deleted = 0");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {

    
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {

        $subject_stmt = $conn->prepare("SELECT Subject FROM subject WHERE SubjectID = ?");
        $subject_stmt->bind_param("i", $row['SubjectID']);
        $subject_stmt->execute();
        $subject_result = $subject_stmt->get_result();
        $subject_row = $subject_result->fetch_assoc();
        $subject = $subject_row['Subject'];
$count1 = 0;
        $subtablestmt = $conn->prepare("SELECT IDNo FROM `books sub table` WHERE BookID = ?");
$subtablestmt->bind_param("i", $row['BookID']);
$subtablestmt->execute();
$subtableresult = $subtablestmt->get_result();

$idnos = array();
while ($subtablerow = $subtableresult->fetch_assoc()) {
    $idno = $subtablerow['IDNo'];

    $countacession = $conn->prepare("SELECT COUNT(*) AS total FROM `books accession` WHERE IDNo = ?");
    $countacession->bind_param("i", $idno);
    $countacession->execute();
    $countacessionresult = $countacession->get_result();
    $countacessionrow = $countacessionresult->fetch_assoc();
    $countacession = $countacessionrow['total'];
    $count1 = $count1 + $countacession;
}

   
        

        
$rowadd++;
$count = $rowadd;
        if($rowadd != $totalrow){
            $count--;
            echo'
            {
                "Count":"'.$count.'",
              "BookID":'.$row['BookID'].',
              "Title":"'.$row['Title'].'",
              "SubjectID":"'.$subject.'",
              "PublisherName":"'.$row['PublisherName'].'",
              "PlaceofPublication":"'.$row['PlaceofPublication'].'",
              "CallNum1":"'.$row['CallNum1'].'",
              "CallNum2":"'.$row['CallNum2'].'",
                "Quantity":"'.$count1.'"
            },
            
           ';
        }else{
            $count--;
            echo'
            {
                "Count":"'.$count.'",
                "BookID":'.$row['BookID'].',
                "Title":"'.$row['Title'].'",
                "SubjectID":"'.$subject.'",
                "PublisherName":"'.$row['PublisherName'].'",
                "PlaceofPublication":"'.$row['PlaceofPublication'].'",
                "CallNum1":"'.$row['CallNum1'].'",
                "CallNum2":"'.$row['CallNum2'].'",
                "Quantity":"'.$countacession.'"
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
