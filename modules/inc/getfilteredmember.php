<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$value = $_POST['type'];
    $sql = "SELECT * FROM members WHERE Deleted = 0 AND TypeId = ?"; // Use a placeholder for the value

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Step 2: Bind the parameter to the placeholder
        $stmt->bind_param('s', $value); // 's' indicates a string, adjust if it's another data type

        // Step 3: Execute the query
        $stmt->execute();

        // Step 4: Get the result
        $result = $stmt->get_result();

        // Step 5: Fetch data into an array
        if ($result->num_rows > 0) {
            $items = array();
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

                 // Return the data as a JSON response
        echo json_encode($items);
        }else{
            echo "no";
        }
        
   
    }

}



  ?>