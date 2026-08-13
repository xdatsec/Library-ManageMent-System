<?php
// delete_items.php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["items"])) {
    $selectedItems = $_POST["items"];
    // Here you can perform the deletion logic based on the selected items
    // For this example, let's just print the item IDs that would be deleted
    $deletedItemIDs = implode(", ", $selectedItems);
    $sql = "UPDATE members SET Deleted = 1 WHERE id IN ($deletedItemIDs)";
      if ($conn->query($sql) === TRUE) {
        echo "Items dropped!";
      } else {
        echo "ERROR";
      }
}

?>