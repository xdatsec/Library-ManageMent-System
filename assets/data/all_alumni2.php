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

$stmt = $conn->prepare("SELECT * FROM alumni");


$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {


$rowadd++;

        if($rowadd != $totalrow){
            echo'
            {
              "id":'.htmlentities($row['AlumniID']).',
              "id2":'.htmlentities($row['AlumniID']).',
              "img":7,
              "name":"'.htmlentities($row['FirstName']).' '.htmlentities($row['LastName']).' '.htmlentities($row['MiddleName']).'",
              "LastName":"'.htmlentities($row['LastName']).'",
              "FirstName":"'.htmlentities($row['FirstName']).'",
              "MiddleName":"'.htmlentities($row['MiddleName']).'"
            },
            
           ';
        }else{
            echo'
            {
              "id":'.htmlentities($row['AlumniID']).',
              "id2":'.htmlentities($row['AlumniID']).',
              "img":7,
              "name":"'.htmlentities($row['FirstName']).' '.htmlentities($row['LastName']).' '.htmlentities($row['MiddleName']).'",
              "LastName":"'.htmlentities($row['LastName']).'",
              "FirstName":"'.htmlentities($row['FirstName']).'",
              "MiddleName":"'.htmlentities($row['MiddleName']).'"
            }
            
           ';
        }
       
    
      
    }
    echo ']
}';

} else {
    echo'[{"data":[]}]

    ';
    exit;
}


$stmt->close();
$conn->close();
?>
