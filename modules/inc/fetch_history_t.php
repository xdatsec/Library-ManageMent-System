<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
    // Ensure you have a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'].'.thesis'; // ID sent from AJAX request
        $search = $_POST['search']; // ID sent from AJAX request

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM history WHERE IDNo = ? AND Comments LIKE ?");
        $searchParam = '%' . $search . '%'; // Properly format the search string
        $stmt->bind_param("is", $id, $searchParam);
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
    } else {
        echo "Invalid request method.";
    }
} else {
    header('Location: /signin.php');
    exit;
}
?>
