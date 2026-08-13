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

$stmt = $conn->prepare("SELECT * FROM borrowed WHERE `Return` = 1");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {

    
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {
        $memberID = $row['MemberID'];
        $accID = $row['AccID'];
        $sqlid = $row['sqlid'];
        $id = $row['ID'];
        $porpose = $row['Purpose'];
        $dateborrowed = $row['DateBorrowed'];
        $duedate = $row['DueDate'];
        $timebrt = $row['TimeBorrowed'];
                
$timebrtd = new DateTime($timebrt);


$timeborrowed = $timebrtd->format("h:i A");
        $dtm = $row['DueTime'];

                        
$dtmd = new DateTime($dtm);


$duetime = $dtmd->format("h:i A");
        $remarks = $row['Remarks'];
        $encoder = $row['Encoder'];
        $timert = $row['TimeReturned'];
        
$dateTime = new DateTime($timert);


$timereturned = $dateTime->format("h:i A");

        $datereturned = $row['DateReturned'];


        $returnedStmt = $conn->prepare("SELECT * FROM `returned` WHERE id = ?");
$returnedStmt->bind_param("i", $id);
$returnedStmt->execute();
$returnedResult = $returnedStmt->get_result();
$returnedRow = $returnedResult->fetch_assoc();
if(!isset($returnedRow['Fine'])){
    $fine =0;
}else{
    $fine = $returnedRow['Fine'];
}
if(!isset($returnedRow['Paid'])){
    $paid =0;
}else{
    $paid = $returnedRow['Paid'];
}





    
$memberStmt = $conn->prepare("SELECT * FROM members WHERE sqlid = ? ");
$memberStmt->bind_param("i", $sqlid);
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


        
        /*

             <th> MemberID </th>
                          <th> Name </th>
                          <th> Acession No</th>
                          <th> Copies</th>
                          <th>Title </th>
                          <th>CallNum1</th>
                          <th>CallNum2</th>
                          <th>Author</th>
                          <th>Subject</th>
                          <th>Location</th>
                          <th>Date Borrowed</th>
                          <th>Due Date</th>
                          <th>Date Returned</th>
                          <th>Time Borrowed</th>
                          <th>Due Time</th>
                          <th>Time Returned</th>
                          <th>Porpose</th>
                          <th>Books Fine</th>
                          <th>Paid</th>
follow tis
                          */
$rowadd++;
$count = $rowadd;
        if($rowadd != $totalrow){
            $count--;
            echo "
            {
                \"MemberID\":\"".htmlentities($memberID)."\",
                \"Name\":\"".htmlentities($memberName)."\",
                \"AcessionNo\":\"".htmlentities($acessionno)."\",
                \"Copies\":\"".htmlentities($copies)."\",
                \"Title\":\"".htmlentities($booktitle)."\",
                \"CallNum1\":\"".htmlentities($callnum1)."\",
                \"CallNum2\":\"".htmlentities($callnum2)."\",
                \"Author\":\"".htmlentities($author)."\",
                \"SubjectID\":\"".htmlentities($subjectid)."\",
                \"Location\":\"".htmlentities($location)."\",
                \"DateBorrowed\":\"".htmlentities($dateborrowed)."\",
                \"DueDate\":\"".htmlentities($duedate)."\",
                \"DateReturned\":\"".htmlentities($datereturned)."\",
                \"TimeBorrowed\":\"".htmlentities($timeborrowed)."\",
                \"DueTime\":\"".htmlentities($duetime)."\",
                \"TimeReturned\":\"".htmlentities($timereturned)."\",
                \"Purpose\":\"".htmlentities($porpose)."\",
                \"Fine\":\"".htmlentities($fine)."\",
                \"Paid\":\"".htmlentities($paid)."\"
            },
            ";
            
        }else{
            $count--;
            echo "
            {
                \"MemberID\":\"".htmlentities($memberID)."\",
                \"Name\":\"".htmlentities($memberName)."\",
                \"AcessionNo\":\"".htmlentities($acessionno)."\",
                \"Copies\":\"".htmlentities($copies)."\",
                \"Title\":\"".htmlentities($booktitle)."\",
                \"CallNum1\":\"".htmlentities($callnum1)."\",
                \"CallNum2\":\"".htmlentities($callnum2)."\",
                \"Author\":\"".htmlentities($author)."\",
                \"SubjectID\":\"".htmlentities($subjectid)."\",
                \"Location\":\"".htmlentities($location)."\",
                \"DateBorrowed\":\"".htmlentities($dateborrowed)."\",
                \"DueDate\":\"".htmlentities($duedate)."\",
                \"DateReturned\":\"".htmlentities($datereturned)."\",
                \"TimeBorrowed\":\"".htmlentities($timeborrowed)."\",
                \"DueTime\":\"".htmlentities($duetime)."\",
                \"TimeReturned\":\"".htmlentities($timereturned)."\",
                \"Purpose\":\"".htmlentities($porpose)."\",
                \"Fine\":\"".htmlentities($fine)."\",
                \"Paid\":\"".htmlentities($paid)."\"
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
