<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    header('Location: /signin.php');
    exit;
}

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memberID = $_POST['memberID'];
    $accessionno = '';
    $returns = '';
    $copies = '';
    $location = '';
    $bookTitle = '';
    $bookAuthor = '';
    $bookCallNum1 = '';
    $bookCallNum2 = '';
    $bookSubject = '';
    $dateborrowed = '';
    $duedate = '';
    $duetime = '';
    $datereturned = '';
    $timeborrowed = '';
    $timereturned = '';
    $fineAmount = 0;
    $porpose = '';
    $accid = '';
    $id = '';
    $paid = '';

    $borrowedSql = "SELECT * FROM returned WHERE MemberID = ? AND `Fine` > 0";
    $borrowedStmt = $conn->prepare($borrowedSql);
    $borrowedStmt->bind_param('i', $memberID);
    $borrowedStmt->execute();
    $borrowedResult = $borrowedStmt->get_result();

    // Check if there are any borrowed books
    if ($borrowedResult->num_rows > 0) {
        // Initialize an empty array to store the book data
        $books = array();

        // Loop through each borrowed book
        while ($borrowedRow = $borrowedResult->fetch_assoc()) {
            $fineAmount = 0;
            $currentDate = new DateTime();
            $dueDateStr = $borrowedRow['DueDate']; // Due date in string format

            // Create a DateTime object for the due date
            $dueDate = new DateTime($dueDateStr);

            $fineAmount = $borrowedRow['Fine'];
            $accid = $borrowedRow['AccID'];
            $id = $borrowedRow['id'];

            $dateborrowed = $borrowedRow['DateBorrowed'];
            $duedate = $borrowedRow['DueDate'];
            $duetime = $borrowedRow['DueTime'];
            $datereturned = $borrowedRow['DateReturned'];
            $timeborrowed = $borrowedRow['TimeBorrowed'];
            $timereturned = $borrowedRow['TimeReturned'];
            $porpose = $borrowedRow['Purpose'];
            $paid = $borrowedRow['Paid'];

            $accessionSql = "SELECT * FROM `books accession` WHERE AccID = ?";
            $accessionStmt = $conn->prepare($accessionSql);
            $accessionStmt->bind_param('i', $borrowedRow['AccID']);
            $accessionStmt->execute();
            $accessionResult = $accessionStmt->get_result();

            // Check if there's a result and fetch the book data
            if ($accessionResult) {
                $accessionRow = $accessionResult->fetch_assoc();
                $accessionno = $accessionRow['AccessionNo'];
                $copies = $accessionRow['Copies'];
                $location = $accessionRow['Location'];

                $subTableSql = "SELECT BookID FROM `books sub table` WHERE IDNo = ?";
                $subTableStmt = $conn->prepare($subTableSql);
                $subTableStmt->bind_param('i', $accessionRow['IDNo']);
                $subTableStmt->execute();
                $subTableResult = $subTableStmt->get_result();
                $subTableRow = $subTableResult->fetch_assoc();
                $bookID = $subTableRow['BookID'];

                // Select the book data from the `books` table
                $bookSql = "SELECT * FROM `books` WHERE BookID = ?";
                $bookStmt = $conn->prepare($bookSql);
                $bookStmt->bind_param('i', $bookID);
                $bookStmt->execute();
                $bookResult = $bookStmt->get_result();
                $bookRow = $bookResult->fetch_assoc();

                $bookTitle = $bookRow['Title'];
                $bookAuthor = $bookRow['Author1FN'] . ' ' . $bookRow['Author1LN'];
                $bookCallNum1 = $bookRow['CallNum1'];
                $bookCallNum2 = $bookRow['CallNum2'];
                $bookSubjectID = $bookRow['SubjectID'];

                // Select the subject data from the `subject` table
                $subjectSql = "SELECT * FROM `subject` WHERE SubjectID = ?";
                $subjectStmt = $conn->prepare($subjectSql);
                $subjectStmt->bind_param('i', $bookSubjectID);
                $subjectStmt->execute();
                $subjectResult = $subjectStmt->get_result();

                // Add the book data to the array
                $books[] = array(
                    'Fine' => $fineAmount,
                    'Paid' => $paid,
                    'Acc_No' => $accessionno . '' . $copies,
                    'Location' => $location,
                    'Purpose' => $porpose,
                    'Due_Date' => $duedate,
                    'Due_Time' => $duetime,
                    'Date_Returned' => $datereturned,
                    'Time_Returned' => $timereturned,
                    'Time_Borrowed' => $timeborrowed,
                    'Accid' => $accid,
                    'id' => $id,
                    
                );
            }
        }

        // Encode the book data as JSON
        $json = json_encode($books);
        header('Content-Type: application/json');
        // Do something with the JSON data
        echo $json;
        
    } else {
        $data = array();
        $json = json_encode($data);

        // Send the JSON response
        header('Content-Type: application/json');
        echo $json;
    }
    $conn->close();
}
?>
