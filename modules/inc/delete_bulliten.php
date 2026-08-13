<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $id = $_POST['id'];
  if($_SESSION['isSuperAdmin'] !=1){
    echo "failed";
    exit;
  }else{
  $sql = "UPDATE bulliten SET Deleted = 1 WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  if($stmt->execute()){
    echo "success";
  }else{
    echo "failed";
  }
}

  

}
?>