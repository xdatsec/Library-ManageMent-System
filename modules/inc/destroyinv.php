<?php
include 'connection.php';
session_start();

if (!isset($_SESSION["loggedin"])) {
    header('Location: /signin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted year and sanitize it to prevent SQL injection
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);

    // Check if the year is valid (e.g., within a specific range)
    if ($year >= 2000 && $year <= 2100) {
        // The year is valid; you can store it in the session
        $_SESSION['inv'] = false;
        $_SESSION['invyears'] = $year;
    } else {
        // The year is not valid; you can handle this as needed (e.g., show an error message)
        echo "Invalid year. Please enter a year between 2000 and 2100.";
    }
}
?>
