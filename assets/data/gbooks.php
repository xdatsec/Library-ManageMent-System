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

$stmt = $conn->prepare("SELECT * FROM `books sub table` WHERE Deleted = 0 AND BookID = ?");
$stmt->bind_param("i", $ids);
$ids = $_GET['ids'];

$stmt->execute();
$result = $stmt->get_result();
$totalrow = $result->num_rows;

if ($result->num_rows > 0) {
    
    echo '{
        "data": [';
    while ($row = $result->fetch_assoc()) {

        $rowadd++;
        if($rowadd != $totalrow){
            $price = $row['PurchasePrice'];
            $formattedPrice = '₱' . number_format($price, 2);

                echo'
                {
                    "IDNo":"'.htmlspecialchars($row['IDNo'], ENT_QUOTES, 'UTF-8').'",
                    "ItemNo":"'.htmlspecialchars($row['ItemNo'], ENT_QUOTES, 'UTF-8').'",
                    "CourseID":"'.htmlspecialchars($row['CourseID'], ENT_QUOTES, 'UTF-8').'",
                    "CopyRightYear":"'.htmlspecialchars($row['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                    "DateReceived":"'.htmlspecialchars($row['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                    "ISBNNumber":"'.htmlspecialchars($row['ISBNNumber'], ENT_QUOTES, 'UTF-8').'",
                    "EditionNumber":"'.htmlspecialchars($row['EditionNumber'], ENT_QUOTES, 'UTF-8').'",
                    "PurchasePrice":"'.htmlspecialchars($formattedPrice, ENT_QUOTES, 'UTF-8').'",
                    "Supplier":"'.htmlspecialchars($row['Supplier'], ENT_QUOTES, 'UTF-8').'",
                    "Recommendedby":"'.htmlspecialchars($row['Recommendedby'], ENT_QUOTES, 'UTF-8').'",
                    "BPages":"'.htmlspecialchars($row['BPages'], ENT_QUOTES, 'UTF-8').'",
                    "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'"
    
                },
                
               ';
            

           
        }else{
            $price = $row['PurchasePrice'];
            $formattedPrice = '₱' . number_format($price, 2);
            echo'
            {
                "IDNo":"'.htmlspecialchars($row['IDNo'], ENT_QUOTES, 'UTF-8').'",
                "ItemNo":"'.htmlspecialchars($row['ItemNo'], ENT_QUOTES, 'UTF-8').'",
                "CourseID":"'.htmlspecialchars($row['CourseID'], ENT_QUOTES, 'UTF-8').'",
                "CopyRightYear":"'.htmlspecialchars($row['CopyrightYear'], ENT_QUOTES, 'UTF-8').'",
                "DateReceived":"'.htmlspecialchars($row['DateReceived'], ENT_QUOTES, 'UTF-8').'",
                "ISBNNumber":"'.htmlspecialchars($row['ISBNNumber'], ENT_QUOTES, 'UTF-8').'",
                "EditionNumber":"'.htmlspecialchars($row['EditionNumber'], ENT_QUOTES, 'UTF-8').'",
                "PurchasePrice":"'.htmlspecialchars($formattedPrice, ENT_QUOTES, 'UTF-8').'",
                "Supplier":"'.htmlspecialchars($row['Supplier'], ENT_QUOTES, 'UTF-8').'",
                "Recommendedby":"'.htmlspecialchars($row['Recommendedby'], ENT_QUOTES, 'UTF-8').'",
                "BPages":"'.htmlspecialchars($row['BPages'], ENT_QUOTES, 'UTF-8').'",
                "Encoder":"'.htmlspecialchars($row['Encoder'], ENT_QUOTES, 'UTF-8').'"
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
