<?php
 include 'connection.php';

 session_start();
 if (isset($_SESSION["loggedin"])) {
 } else {
     header('Location: /signin.php');
     exit;
 }
 
 $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 
 if ($id === false || $id === null) {
     die("Invalid or missing ID parameter.");
 }
 
 // Define a query to retrieve data from your database table based on the ID using a prepared statement
 $query = "SELECT ba.AccID, ba.ItemNo, ba.AccessionNo, ba.Copies, ba.Location, ba.BookLocation, ba.Source, ba.Donor, ba.SubClass1, ba.SubClass2, ba.SubClass3, ba.SubClass4, ba.Replacedfor, ba.Remarks, ba.`MR Page`, ba.Status, ba.Encoder FROM `books accession` ba LEFT JOIN `books lost and replaced` blr ON ba.Replacedfor = blr.ID WHERE ba.IDNo = ?"; // Replace with your table name and columns
 
 // Prepare the SQL statement
 $stmt = $conn->prepare($query);
 
 // Bind the parameter with type "i" for integer
 $stmt->bind_param('i', $id);
 
 // Execute the prepared statement
 $stmt->execute();
 
 // Get the result set
 $result = $stmt->get_result();
 
 // Initialize an empty array to store the data
 $data = array();
 
 // Fetch data and store it in the array
 while ($row = $result->fetch_assoc()) {
     $data[] = $row;
 }
 
 // Close the prepared statement
 $stmt->close();
 
 // Close the database connection
 $conn->close();
 
 // Encode the data as JSON and send it as the response
 header('Content-Type: application/json');
 echo json_encode($data);
?>
