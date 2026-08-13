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

$stmt = $conn->prepare("SELECT * FROM borrowed WHERE `Return` = 0");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {

    
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {
        $memberID = $row['MemberID'];
        $sqlid  = $row['sqlid'];
        $accID = $row['AccID'];
        $porpose = $row['Purpose'];
        $dateborrowed = $row['DateBorrowed'];
        $duedate = $row['DueDate'];
        $tmbr = $row['TimeBorrowed'];

        
        
$tmbrd = new DateTime($tmbr);


$timeborrowed = $tmbrd->format("h:i A");

        
        $dtm = $row['DueTime'];

        
                        
$dtmd = new DateTime($dtm);


$duetime = $dtmd->format("h:i A");
        $remarks = $row['Remarks'];
        $encoder = $row['Encoder'];
        $type = $row['Type'];
    
          
$memberStmt = $conn->prepare("SELECT * FROM members WHERE sqlid = ?");
$memberStmt->bind_param("s", $sqlid);
$memberStmt->execute();
$memberResult = $memberStmt->get_result();


if ($memberResult->num_rows > 0) {
    $memberRow = $memberResult->fetch_assoc();
    $memberName = $memberRow['FirstName'] . " " . $memberRow['MiddleName'] . " " . $memberRow['LastName'];
} else {
    $memberName = "Deleted User"; 
    
}

        $accessionStmt = $conn->prepare("SELECT * FROM `books accession` WHERE AccID = ?");
$accessionStmt->bind_param("i", $accID);
$accessionStmt->execute();
$accessionResult = $accessionStmt->get_result();
$accessionRow = $accessionResult->fetch_assoc();
$acessionno = $accessionRow['AccessionNo'];
$copies = $accessionRow['Copies'];
$idno = $accessionRow['IDNo'];
$location = $accessionRow['Location'];
$bookSubStmt = $conn->prepare("SELECT * FROM  `books sub table` WHERE IDNo  = ?");
$bookSubStmt->bind_param("i", $idno);
$bookSubStmt->execute();
$bookSubResult = $bookSubStmt->get_result();
$bookSubRow = $bookSubResult->fetch_assoc();
$bookid = $bookSubRow['BookID'];


$bookStmt = $conn->prepare("SELECT * FROM `books` WHERE BookID  = ?");
$bookStmt->bind_param("i", $bookid);
$bookStmt->execute();
$bookResult = $bookStmt->get_result();
$bookRow = $bookResult->fetch_assoc();
$booktitle = $bookRow['Title'];
$author = $bookRow['Author1LN'].$bookRow['Author1FN'].$bookRow['Author1MI'];
$callnum1 = $bookRow['CallNum1'];
$callnum2 = $bookRow['CallNum2'];
$subjectid = $bookRow['SubjectID'];


        
        
$rowadd++;
$count = $rowadd;
        if($rowadd != $totalrow){
            $count--;
            echo "
            {
                \"MemberID\":\"" . htmlentities($memberID) . "\",
                \"Name\":\"" . htmlentities($memberName) . "\",
                \"AcessionNo\":\"" . htmlentities($acessionno) . "\",
                \"Copies\":\"" . htmlentities($copies) . "\",
                \"Title\":\"" . htmlentities($booktitle) . "\",
                \"Author\":\"" . htmlentities($author) . "\",
                \"Purpose\":\"" . htmlentities($porpose) . "\",
                \"DateBorrowed\":\"" . htmlentities($dateborrowed) . "\",
                \"DueDate\":\"" . htmlentities($duedate) . "\",
                \"TimeBorrowed\":\"" . htmlentities($timeborrowed) . "\",
                \"DueTime\":\"" . htmlentities($duetime) . "\",
                \"Remarks\":\"" . htmlentities($remarks) . "\",
                \"CallNum1\":\"" . htmlentities($callnum1) . "\",
                \"CallNum2\":\"" . htmlentities($callnum2) . "\",
                \"SubjectID\":\"" . htmlentities($subjectid) . "\",
                \"Location\":\"" . htmlentities($location) . "\",
                \"Encoder\":\"" . htmlentities($encoder) . "\",
                \"Type\":\"" . htmlentities($type) . "\"
            },
            ";
            
        }else{
            $count--;
            echo "
            {
                \"MemberID\":\"" . htmlentities($memberID) . "\",
                \"Name\":\"" . htmlentities($memberName) . "\",
                \"AcessionNo\":\"" . htmlentities($acessionno) . "\",
                \"Copies\":\"" . htmlentities($copies) . "\",
                \"Title\":\"" . htmlentities($booktitle) . "\",
                \"Author\":\"" . htmlentities($author) . "\",
                \"Purpose\":\"" . htmlentities($porpose) . "\",
                \"DateBorrowed\":\"" . htmlentities($dateborrowed) . "\",
                \"DueDate\":\"" . htmlentities($duedate) . "\",
                \"TimeBorrowed\":\"" . htmlentities($timeborrowed) . "\",
                \"DueTime\":\"" . htmlentities($duetime) . "\",
                \"Remarks\":\"" . htmlentities($remarks) . "\",
                \"CallNum1\":\"" . htmlentities($callnum1) . "\",
                \"CallNum2\":\"" . htmlentities($callnum2) . "\",
                \"SubjectID\":\"" . htmlentities($subjectid) . "\",
                \"Location\":\"" . htmlentities($location) . "\",
                \"Encoder\":\"" . htmlentities($encoder) . "\",
                \"Type\":\"" . htmlentities($type) . "\"
            }
            ";
            
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
