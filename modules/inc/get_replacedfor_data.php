<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }


// Retrieve data from the database
$sql = "SELECT ID, Title, AccessionNo,AuthorLN,AuthorFN,AuthorMI,CopyrightDate,DateReceived FROM `books lost and replaced` ";
$result = $conn->query($sql);

// Convert the result to a JSON object
$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}
echo json_encode($data);

// Close the database connection
$conn->close();
?>