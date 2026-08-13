<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $computerName = gethostname();
        $empId = $_POST['empId'].'.thesis';
        $history = $_POST['history'];
        $edittimw = $_POST['edittime_t'];
        $username = $_SESSION['username'];


        $sql2 = "INSERT INTO history(IDNo, DateTime, UserName,ComputerName, Comments) VALUES (?, NOW(), ?, ?, ?)";
    
        // Prepare the statement
        $stmt2 = $conn->prepare($sql2);
        
        // Bind the parameters to the statement
        $stmt2->bind_param("ssss", $empId, $username, $computerName, $history);
        
        // Execute the statement
        if ($stmt2->execute()) {
            echo 'Hello';
        } else {
            echo 'Error: ' . $stmt->error;
        }



$conn->close();
}
?>
