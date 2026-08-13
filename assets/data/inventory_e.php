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

$stmt = $conn->prepare("SELECT * FROM `books` WHERE Deleted = 0");;
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo']}';
    exit;
}
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {
        $bookid = $row['BookID'];
        $subtablestmt = $conn->prepare("SELECT * FROM `books sub table` WHERE BookID  = ?");
        $subtablestmt->bind_param("i", $bookid); 
        $subtablestmt->execute();
        $subtableresult = $subtablestmt->get_result();
        $subtablerow = $subtableresult->fetch_assoc();
        if ($subtableresult->num_rows == 0) {
            echo']}';
            exit;
        }
        $idno = $subtablerow['IDNo'];
        $accessionstmt = $conn->prepare("SELECT * FROM `books accession` WHERE IDNo = ?");
        $accessionstmt->bind_param("i", $idno); 
        $accessionstmt->execute();
        $accessionresult = $accessionstmt->get_result();
        $accessionrow = $accessionresult->fetch_assoc();
        if ($accessionresult->num_rows == 0) {
            echo']}';
            exit;
        }

        $subject_stmt = $conn->prepare("SELECT Subject FROM subject WHERE SubjectID = ?");
        $subject_stmt->bind_param("i", $row['SubjectID']);
        $subject_stmt->execute();
        $subject_result = $subject_stmt->get_result();
        $subject_row = $subject_result->fetch_assoc();
        $subject ="none";
        if (isset($subject_row['Subject'])) {
            
            $subject = $subject_row['Subject'];
        } else {
            
            $subject ="";
        }
        if (isset($_SESSION["inv"]) && $_SESSION["inv"] == true) {
            $invstmt = $conn->prepare("SELECT * FROM inventory WHERE AccID  = ? AND Year = ?");
        
            $invstmt->bind_param("ii", $accid2, $year);
            $accid2 = $accessionrow['AccID'];
            if(isset($_SESSION['invyears']) && $_SESSION['invyears'] != ""){
                $year =  $_SESSION['invyears'];
            }else{
                $year = date('Y');
            }
            $invstmt->execute();


            
            $invresult = $invstmt->get_result();

            
            if ($invresult->num_rows > 0) {
                $invrow = $invresult->fetch_assoc();
                if($invrow['Existing'] == 1){
                    $exist = 1;
                }else if($invrow['Existing'] == 0){
                    $exist = 0;
                }else{
                    $exist = 2;
                }
            }else{
                $exist = 2;
            }

        }else{
            $invstmt = $conn->prepare("SELECT * FROM inventory WHERE AccID  = ? AND Year = ?");
        
            $invstmt->bind_param("ii", $accid2, $year);
            $accid2 = $accessionrow['AccID'];
            if(isset($_SESSION['invyears']) && $_SESSION['invyears'] != ""){
                $year =  $_SESSION['invyears'];
            }else{
                $year = date('Y');
            }
            $invstmt->execute();


            
            $invresult = $invstmt->get_result();

            
            if ($invresult->num_rows > 0) {
                $invrow = $invresult->fetch_assoc();
                if($invrow['Existing'] == 1){
                    $exist = 1;
                }else if($invrow['Existing'] == 0){
                    $exist = 0;
                }else{
                    $exist = 2;
                }
            }else{
                $exist = 2;
            }
        }

        $rowadd++;
        if($rowadd != $totalrow){
            if($exist == 1){
                echo'
                {
                    "AccID":"'.htmlspecialchars($accessionrow['AccID'], ENT_QUOTES, 'UTF-8').'",
                    "Status":"'.htmlspecialchars($accessionrow['Status'], ENT_QUOTES, 'UTF-8').'",
                    "AccessionNo":"'.htmlspecialchars($accessionrow['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                    "Copies":"'.htmlspecialchars($accessionrow['Copies'], ENT_QUOTES, 'UTF-8').'",
                    "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                    "Author1LN":"'.htmlspecialchars($row['Author1LN'], ENT_QUOTES, 'UTF-8').'",
                    "Author1FN":"'.htmlspecialchars($row['Author1FN'], ENT_QUOTES, 'UTF-8').'",
                    "Author1MI":"'.htmlspecialchars($row['Author2LN'], ENT_QUOTES, 'UTF-8').'",
                    "PublisherName":"'.htmlspecialchars($row['PublisherName'], ENT_QUOTES, 'UTF-8').'",
                    "PlaceofPublication":"'.htmlspecialchars($row['PlaceofPublication'], ENT_QUOTES, 'UTF-8').'",
                    "Subject":"'.htmlspecialchars($subject, ENT_QUOTES, 'UTF-8').'",
                    "CallNum1":"'.htmlspecialchars($row['CallNum1'], ENT_QUOTES, 'UTF-8').'",
                    "CallNum2":"'.htmlspecialchars($row['CallNum2'], ENT_QUOTES, 'UTF-8').'",
                    "CopyrightYear":"'.htmlspecialchars($subtablerow['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                    "DateReceived":"'.htmlspecialchars($subtablerow['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                    "ISBNNumber":"'.htmlspecialchars($subtablerow['ISBNNumber'], ENT_QUOTES, 'UTF-8').'",
                    "EditionNumber":"'.htmlspecialchars($subtablerow['EditionNumber'], ENT_QUOTES, 'UTF-8').'",
                    "Location":"'.htmlspecialchars($accessionrow['Location'], ENT_QUOTES, 'UTF-8').'",
                    "BPages":"'.htmlspecialchars($subtablerow['BPages'], ENT_QUOTES, 'UTF-8').'",
                    "MR Page":"'.htmlspecialchars($accessionrow['MR Page'], ENT_QUOTES, 'UTF-8').'",
                    "Remarks":"'.htmlspecialchars($accessionrow['Remarks'], ENT_QUOTES, 'UTF-8').'",
                    "Existing":"'.htmlspecialchars($exist, ENT_QUOTES, 'UTF-8').'"




                },
                
               ';
            }

           
        }else{
            if($exist == 1){
            echo'
            {
                "AccID":"'.htmlspecialchars($accessionrow['AccID'], ENT_QUOTES, 'UTF-8').'",
                "Status":"'.htmlspecialchars($accessionrow['Status'], ENT_QUOTES, 'UTF-8').'",
                "AccessionNo":"'.htmlspecialchars($accessionrow['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                "Copies":"'.htmlspecialchars($accessionrow['Copies'], ENT_QUOTES, 'UTF-8').'",
                "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                "Author1LN":"'.htmlspecialchars($row['Author1LN'], ENT_QUOTES, 'UTF-8').'",
                "Author1FN":"'.htmlspecialchars($row['Author1FN'], ENT_QUOTES, 'UTF-8').'",
                "Author1MI":"'.htmlspecialchars($row['Author2LN'], ENT_QUOTES, 'UTF-8').'",
                "PublisherName":"'.htmlspecialchars($row['PublisherName'], ENT_QUOTES, 'UTF-8').'",
                "PlaceofPublication":"'.htmlspecialchars($row['PlaceofPublication'], ENT_QUOTES, 'UTF-8').'",
                "Subject":"'.htmlspecialchars($subject, ENT_QUOTES, 'UTF-8').'",
                "CallNum1":"'.htmlspecialchars($row['CallNum1'], ENT_QUOTES, 'UTF-8').'",
                "CallNum2":"'.htmlspecialchars($row['CallNum2'], ENT_QUOTES, 'UTF-8').'",
                "CopyrightYear":"'.htmlspecialchars($subtablerow['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                "DateReceived":"'.htmlspecialchars($subtablerow['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                "ISBNNumber":"'.htmlspecialchars($subtablerow['ISBNNumber'], ENT_QUOTES, 'UTF-8').'",
                "EditionNumber":"'.htmlspecialchars($subtablerow['EditionNumber'], ENT_QUOTES, 'UTF-8').'",
                "Location":"'.htmlspecialchars($accessionrow['Location'], ENT_QUOTES, 'UTF-8').'",
                "BPages":"'.htmlspecialchars($subtablerow['BPages'], ENT_QUOTES, 'UTF-8').'",
                "MR Page":"'.htmlspecialchars($accessionrow['MR Page'], ENT_QUOTES, 'UTF-8').'",
                "Remarks":"'.htmlspecialchars($accessionrow['Remarks'], ENT_QUOTES, 'UTF-8').'",
                "Existing":"'.htmlspecialchars($exist, ENT_QUOTES, 'UTF-8').'"
           }
            
           ';
        }else{
            echo'
            {
                "AccID":"",
                "Status":"",
                "AccessionNo":"",
                "Copies":"",
                "Title":"",
                "Author1LN":"",
                "Author1FN":"",
                "Author1MI":"",
                "PublisherName":"",
                "PlaceofPublication":"",
                "Subject":"",
                "CallNum1":"",
                "CallNum2":"",
                "CopyrightYear":"",
                "DateReceived":"",
                "ISBNNumber":"",
                "EditionNumber":"",
                "Location":"",
                "BPages":"",
                "MR Page":"",
                "Remarks":"",
                "Existing":"3"
           }
            
           ';
        }
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
