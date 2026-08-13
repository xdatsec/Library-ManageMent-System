<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['AccID'];
    $year = $_POST['year'];
    $existing = $_POST['exist'];
    $_SESSION['inv'] = true;
    $_SESSION['invyears'] = $year;
    $types = $_POST['type'];
    $user = $_SESSION['username'];
    $existnum = 0;
    if($existing =="yes"){
        $existnum = 1;
    }else if($existing =="no"){
        $existnum = 0;
    }else{
        $existnum = 2;
    }

    // Prepare a SQL statement
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE AccID  = ? AND Year = ?");
    
    // Bind the id to the statement
    $stmt->bind_param("ii", $id,$year);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if any rows were returned
    if ($result->num_rows > 0) {
        $updateSql = "UPDATE inventory SET Existing = ? WHERE AccID=?";
         // Prepare the statement
         $updateSqlStmt = $conn->prepare($updateSql);
        $updateSqlStmt->bind_param("ss", $existnum, $id);
        if ($updateSqlStmt->execute()) {
            echo 'ok';
        } else {
            echo 'Error: ' . $stmt->error;
        }
    } else {
        $sql2 = "INSERT INTO inventory(AccID, Year, Existing,Type, User) VALUES (?, ?, ?, ?, ?)";
        // Prepare the statement
        $stmt2 = $conn->prepare($sql2);
        
        // Bind the parameters to the statement
        $stmt2->bind_param("sssss", $id,$year,$existnum,$types,$user);

        // Execute the statement
        if ($stmt2->execute()) {
            echo 'ok';
        } else {
            echo 'Error: ' . $stmt->error;
        }
    }
   
    $stmt->close();





}




















?>