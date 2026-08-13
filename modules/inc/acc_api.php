<?php
include 'connection.php';
include 'refferer.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }


function checkAccessionExists($accessionNumber, $conn) {
    $accessionNumber = mysqli_real_escape_string($conn, $accessionNumber);
    $sql = "SELECT COUNT(*) as count FROM `books accession` WHERE AccessionNo = '$accessionNumber'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        return ($count > 0);
    }
    return false;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle a POST request (checking the AccessionNo)
    if (isset($_POST['accessionNumber'])) {
        $accessionNumber = $_POST['accessionNumber'];
        $exists = checkAccessionExists($accessionNumber, $conn);
        echo json_encode(["exists" => $exists]);
    } else {
        echo json_encode(["error" => "AccessionNo not provided"]);
    }
} else {
    // Handle other request methods (e.g., GET)
    echo json_encode(["error" => "Invalid request method"]);
}

// Close the database connection
$conn->close();
?>
