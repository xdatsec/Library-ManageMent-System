<?php
session_start();
if (isset($_SESSION["loggedin"])) {

}else{
   
        header('Location: /login.php');
        exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/modules/inc/connection.php';

$rowadd = 0;
$totalrow = 0;

$stmt = $conn->prepare("SELECT * FROM thesis WHERE Deleted = 0 AND Type = 'Thesis' AND Status ='L'");;
$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {
       $accession = $row['AccessionNo'].'.thesis';
        $exist = 2;
        if (isset($_SESSION["inv"]) && $_SESSION["inv"] == true) {
            $invstmt = $conn->prepare("SELECT * FROM inventory WHERE AccID  = ? AND Year = ?");
        
            $invstmt->bind_param("ii", $accession, $year);
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
        
            $invstmt->bind_param("ii", $accession, $year);
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
  
                echo'
                {
                    "AccID":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                    "Status":"'.htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8').'",
                    "AccessionNo":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                    "Copies":"'.htmlspecialchars($row['Copies'], ENT_QUOTES, 'UTF-8').'",
                    "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                    "Author":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                    "CopyrightYear":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                    "DateReceived":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                    "MR Page":"'.htmlspecialchars($row['MR Page'], ENT_QUOTES, 'UTF-8').'",
                    "Remarks":"'.htmlspecialchars($row['Remarks'], ENT_QUOTES, 'UTF-8').'",
                    "Existing":"'.htmlspecialchars($exist, ENT_QUOTES, 'UTF-8').'"



                },
                
               ';
            

           
        }else{
    
            echo'
            {
                "AccID":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                "Status":"'.htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8').'",
                "AccessionNo":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                "Copies":"'.htmlspecialchars($row['Copies'], ENT_QUOTES, 'UTF-8').'",
                "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                "Author":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                "CopyrightYear":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                "DateReceived":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                "MR Page":"'.htmlspecialchars($row['MR Page'], ENT_QUOTES, 'UTF-8').'",
                "Remarks":"'.htmlspecialchars($row['Remarks'], ENT_QUOTES, 'UTF-8').'",
                "Existing":"'.htmlspecialchars($exist, ENT_QUOTES, 'UTF-8').'"
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
