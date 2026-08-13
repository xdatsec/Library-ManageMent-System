<?php

include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // ID sent from AJAX request

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM history WHERE IDNo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the data and store it in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
}
