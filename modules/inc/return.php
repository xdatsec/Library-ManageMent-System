<?php
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $memberID = $_POST['memberID'];
  $dataids = $_POST['dataids']; // Assuming it's an array of dataid values

  if (!empty($dataids)) {
    // Create an index variable
    $i = 0;
    $count = count($dataids);

    // Prepare the SQL statement with placeholders for the parameters
    $stmt = $conn->prepare("UPDATE `borrowed` SET `Return` = 1, DateReturned = NOW() WHERE id = ? AND MemberID = ?");

    // Prepare the SQL statement for returned table
    $updateStmt = $conn->prepare("UPDATE returned SET DateReturned = NOW() WHERE id = ? ");



    $borrowedSql = "SELECT * FROM `borrowed` WHERE id = ?";
    // Prepare the SQL statement for books accession table
    $updateAccessStmt = $conn->prepare("UPDATE `books accession` SET Remarks = 'In' WHERE AccID  = ? ");
   

    // Execute the prepared statements inside the while loop
    while ($i < $count) {
      $dataid = $dataids[$i];
      $dataids_str = implode(',', $dataids[$i]);
      $encoder = $_SESSION['username'];

      $borrowedStmt = $conn->prepare($borrowedSql);
      $borrowedStmt->bind_param('i', $dataids_str);
      $borrowedStmt->execute();
      $borrowedResult = $borrowedStmt->get_result();
      $borrowedRow = $borrowedResult->fetch_assoc();
      $accid = $borrowedRow['AccID'];

      // Bind the parameters to the placeholders for borrowed table
      $stmt->bind_param("ii", $dataids_str, $memberID);

      // Execute the prepared statement for borrowed table
      if ($stmt->execute()) {
        // Bind the parameters to the placeholders for returned table
        $updateStmt->bind_param("i", $dataids_str);

        // Execute the prepared statement for returned table
        if ($updateStmt->execute()) {
         
         
          $updateAccessStmt->bind_param("i", $accid);

          // Execute the prepared statement for books accession table
          if ($updateAccessStmt->execute()) {
            // Handle success for this dataid
          } else {
            echo "Error updating record: " . $updateAccessStmt->error;
          }
        } else {
          echo "Error updating record: " . $updateStmt->error;
        }
      } else {
        echo "Error updating record: " . $stmt->error;
      }

      // Increment the index
      $i++;
    }

    // Close the prepared statements
    $stmt->close();
    $updateStmt->close();
    $updateAccessStmt->close();

    echo "Bulk update completed successfully";
  } else {
    echo "No dataids selected for update.";
  }

  $conn->close();
}
?>
