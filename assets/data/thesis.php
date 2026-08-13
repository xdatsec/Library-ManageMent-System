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

$stmt = $conn->prepare("SELECT * FROM thesis WHERE Deleted = 0 AND Type = 'Thesis' ");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {
        $rowadd++;
        $count = $rowadd;
        if($rowadd != $totalrow){
            $count--;
            echo'
            {
                
                "AccessionNo":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                "Author":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                "CopyrightYear":"'.htmlspecialchars($row['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                "DateReceived":"'.htmlspecialchars($row['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                "Quantity":"'.htmlspecialchars($row['Quantity'], ENT_QUOTES, 'UTF-8').'",
                "Type":"'.htmlspecialchars($row['Type'], ENT_QUOTES, 'UTF-8').'",
                "DateEncoded":"'.htmlspecialchars($row['DateEncoded'], ENT_QUOTES, 'UTF-8').'",
                "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'",
                "Count":"'.htmlspecialchars($count, ENT_QUOTES, 'UTF-8').'"
            },
            
           ';
        }else{
            $count--;
            echo'
            {
                "AccessionNo":"'.htmlspecialchars($row['AccessionNo'], ENT_QUOTES, 'UTF-8').'",
                "Title":"'.htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8').'",
                "Author":"'.htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8').'",
                "CopyrightYear":"'.htmlspecialchars($row['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                "DateReceived":"'.htmlspecialchars($row['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                "Quantity":"'.htmlspecialchars($row['Quantity'], ENT_QUOTES, 'UTF-8').'",
                "Type":"'.htmlspecialchars($row['Type'], ENT_QUOTES, 'UTF-8').'",
                "DateEncoded":"'.htmlspecialchars($row['DateEncoded'], ENT_QUOTES, 'UTF-8').'",
                "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'",
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
