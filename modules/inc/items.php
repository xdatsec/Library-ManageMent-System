

<?php
session_start();
if (isset($_SESSION["loggedin"])) {
    include "connection.php";
  } else {
      header('Location: /signin.php');
      exit;
  }


$sql = "SELECT * FROM books WHERE Deleted = 0";
$stmt = $conn->prepare($sql);

if ($stmt) {
  $stmt->execute();
  $result = $stmt->get_result();
  $items = array();
  while ($row = $result->fetch_assoc()) {
    $items[] = $row;
  }
  echo json_encode($items);
}

?>