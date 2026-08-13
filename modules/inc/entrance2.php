<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $libraryid = $_POST['libno'];
    $sql = "SELECT * FROM members WHERE student_id  = ? AND Deleted = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $libraryid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
         $libraryname =  $row['LastName']." ".$row['MiddleName']." ".$row['FirstName'];
         $memberid = $row['MemberID'];
         echo "Welcome ".$libraryname;
         $sql2 ="INSERT INTO entrance (MemberID) VALUES (?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("s", $memberid);
            if ($stmt2->execute()) {
  
            } else {
                echo "Error in Updation";
            }
        exit;
    } else {
        echo "Can't Find Library Card No. Please try again";
        exit;
    }


$conn->close();
}
?>