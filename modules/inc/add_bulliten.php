<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $note = $_POST['note']."\n -".$_SESSION['username'];

  $username = $_SESSION['username'];
  $sql = "INSERT INTO bulliten (message) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $note);
  if($stmt->execute()){
    echo "success";
  }else{
    echo "failed";
  }


  

}
?>