<?php


session_start();

if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}

include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $postData = $_POST['books'];
  $books = json_decode($postData, true);
  // Loop through each book and process the borrowing
  foreach ($books as $book) {
    date_default_timezone_set('Asia/Manila');
    $accID = $book['AccID'];
    $bookC = $book['BookC'];
    $memberID = $book['memberID'];
    $purpose = $book['purpose'];

    $selectStmt = $conn->prepare("SELECT sqlid  FROM members WHERE MemberID = ? AND Deleted = 0");

    // Bind the MemberID parameter to the prepared statement
    $selectStmt->bind_param("s", $memberID);

    // Execute the prepared statement
    $selectStmt->execute();

    // Get the result set from the executed statement
    $selectResult = $selectStmt->get_result();

    // Fetch the first row of the result set as an associative array
    $selectRow = $selectResult->fetch_assoc();

    // Get the id value from the fetched row
    $id = $selectRow['sqlid'];


    $selectfromaccession = $conn->prepare("SELECT * FROM `books accession` WHERE AccID = ? AND Remarks = 'In' AND Deleted = 0");
    $selectfromaccession->bind_param("i", $accID);
    $selectfromaccession->execute();
    $selectfromaccessionresult = $selectfromaccession->get_result();
    $selectfromaccessionrow = $selectfromaccessionresult->fetch_assoc();
    $location = $selectfromaccessionrow['Location'];
    $selectsection = $conn->prepare("SELECT * FROM `Section` WHERE section = ?");
    $selectsection->bind_param("s", $location);
    $selectsection->execute();
    $selectsectionresult = $selectsection->get_result();
    $selectsectionrow = $selectsectionresult->fetch_assoc();

    $selectsection1 = $conn->prepare("SELECT * FROM `Section` WHERE section = 'Photocopy'");
    $selectsection1->execute();
    $selectsectionresult1 = $selectsection1->get_result();
    $selectsectionrow1 = $selectsectionresult1->fetch_assoc();
    $daysToAdd = 0;
    $porpose = $purpose;
    $dateBorrowed = $dateBorrowed = date('Y-m-d g:ia'); // This will set $dateBorrowed to the current date and time in the format 'Y-m-d g:ia'.
    $timeBorrowed = date('Y-m-d H:ia'); // This will set $dateBorrowed to the current date and time in the format 'Y-m-d g:ia'.
    if ($porpose == "PhotoCopy") {
      $daysToAdd = $selectsectionrow1['DueDays'];
      $timetoadd = $daysToAdd * 100;
      $dateborrowtime = new DateTime($dateBorrowed);
      $dateborrowtime->modify("+" . $timetoadd . " minutes");
      $dueDate = $dateborrowtime->format('Y-m-d H:ia');
      $dueTime = $dateborrowtime->format('Y-m-d H:ia');
    } else {
      $daysToAdd = $selectsectionrow['DueDays'];
      $dateborrowtime = new DateTime($dateBorrowed);
      $dateborrowtime->modify("+" . $daysToAdd . " days");
      $dueDate = $dateborrowtime->format('Y-m-d H:ia');
      $dueTime = $dateborrowtime->format('Y-m-d H:ia');
    }

    // Prepare the SELECT statement
    $stmt = $conn->prepare("INSERT INTO borrowed (AccID, `Return`, MemberID, Purpose, DateBorrowed, TimeBorrowed,DueDate, DueTime, Remarks, `Type`, Encoder, sqlid ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $accID, $return, $memberID, $purpose, $dateBorrowed, $timeBorrowed, $dueDate,  $dueTime, $remarks, $type, $encoder, $id);

    // Set the values of the bind parameters
    $accID = $accID;
    $return = 0;
    $memberID = $memberID;
    $remarks = "In";
    $type = "Books";
    $encoder = $_SESSION['username'];

    if ($stmt->execute()) {
      $insertid = $conn->insert_id;
      // Prepare the SQL statement for the first update
      $sql1 = "UPDATE members SET CurBooksBorrowed = ?, Borrowed = 1, BooksBorrowed = BooksBorrowed + 1 WHERE MemberID = ?";

      // Prepare the statement for the first update
      $stmt1 = $conn->prepare($sql1);

      // Bind the parameters for the first update
      $stmt1->bind_param("is", $booked, $memberID);

      if ($stmt1->execute()) {
        // Prepare the SQL statement for the second update
        $sql2 = "UPDATE `books accession` SET Remarks = 'Out' WHERE AccID = ?";

        // Prepare the statement for the second update
        $stmt2 = $conn->prepare($sql2);

        // Bind the parameter for the second update
        $stmt2->bind_param("i", $accID);

        if ($stmt2->execute()) {
          // Now, select all the relevant data from the "borrowed" table
          $selectStmt = $conn->prepare("SELECT * FROM borrowed WHERE AccID = ? AND MemberID = ? AND ID = ?");
          $selectStmt->bind_param("sss", $accID, $memberID, $insertid);
          $selectStmt->execute();
          $result = $selectStmt->get_result();

          // Free the memory associated with the previous result set
          $selectStmt->free_result();

          // Insert selected data into the "returned" table
          while ($row = $result->fetch_assoc()) {
            // Insert selected data into the "returned" table with constant values
            $insertStmt = $conn->prepare("INSERT INTO returned (AccID, MemberID, Purpose, DateBorrowed, DueDate, DateReturned, TimeBorrowed, DueTime, TimeReturned, Paid, Type, Encoder,id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, 0, ?, ?)");

            // Bind the parameters for the insert statement
            $insertStmt->bind_param("issssssssss", $row['AccID'], $row['MemberID'], $row['Purpose'], $row['DateBorrowed'], $row['DueDate'], $row['DateReturned'], $row['TimeBorrowed'], $row['DueTime'], $row['Type'], $encoder, $row['ID']);

            if ($insertStmt->execute()) {
            } else {
              echo "Error inserting data into 'returned' table: " . $insertStmt->error;
            }

            // Close the insert statement
            $insertStmt->close();
          }
        } else {
          // The second update operation failed
          echo "Error in the second update: " . $stmt2->error;
        }
      } else {
        // The first update operation failed
        echo "Error in the first update: " . $stmt1->error;
      }
    } else {
      // The initial execute operation failed
      echo "Error: " . $stmt->error;
    }
}

}
