<?php
include 'connection.php';
session_start();
if (!isset($_SESSION["loggedin"])) {
    header('Location: /signin.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$memberid = $_POST['memberid'];
$borrow = $_POST['numborrow'];

$sql = "SELECT count(*) as total FROM `borrowed` WHERE `MemberID` = ? AND `Return` = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$checktype = "SELECT TypeId FROM `members` WHERE `MemberID` = ?";
$stmt2 = $conn->prepare($checktype);
$stmt2->bind_param("s", $memberid);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();
$checklimit = "SELECT * FROM `type` WHERE `TypeId` = ?";
$stmt3 = $conn->prepare($checklimit);
$stmt3->bind_param("s", $row2['TypeId']);
$stmt3->execute();
$result3 = $stmt3->get_result();
$row3 = $result3->fetch_assoc();
$total = $row['total'] + $borrow;
//if they exceed the borrow_limit
if($total > $row3['borrow_limit']){
    echo "false";
    exit;
}else{
    echo "true";
    exit;
}


}








?>