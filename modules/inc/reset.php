<?php
include 'connection.php';
include 'refferer.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newpassword = $_POST['newpassword'];
    $email = $_POST['email'];
    $code = $_POST['code'];
    $hashpassword = password_hash($newpassword, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmtSelect = $conn->prepare("SELECT resetcode FROM user WHERE email = ?");
    $stmtSelect->bind_param("s", $email);

    // Execute the query
    $stmtSelect->execute();

    // Get the result
    $result = $stmtSelect->get_result();

    // Check if any rows were returned (user exists)
    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        $hashed_password = $row['resetcode'];
        if (password_verify($code,$hashed_password)) {

        } else {
            echo "Expire reset code! or Already used!";
            exit;
        }
    }


    $stmt = $conn->prepare("UPDATE user SET Password = ?, `resetcode` = ? WHERE email = ?");

    // Bind the parameters
    $stmt->bind_param("sss", $hashpassword, $resetcode, $email);
    $resetcode = "";
    // Execute the query
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Password change!";
    } else {
    }

    // Close the statement
    $stmt->close();
    $stmtSelect->close();
}
