<?php

session_start();
if (isset($_SESSION["loggedin"])) {
  } else {
      header('Location: /signin.php');
      exit;
  }

include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accid = '';
    $bookc = '';
    $accessionno = $_POST['accessionno'];
    $sql = "SELECT * FROM `books accession` WHERE AccessionNo = ? AND  Deleted = '0'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $accessionno);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        echo 'Error executing query: ' . $conn->error;
        exit();
    }


    $rows = array();
    while ($row = $result->fetch_assoc()) {
        if($row['Remarks'] == 'Out'){
            $row['Response'] = 'Book is not available';
            $rows[] = $row;
            echo json_encode($rows);
            exit();
        }
        $accid = $row['AccID'];
        $bookid = null;
        // Assuming you have a valid connection to your database, create a new SQL query
        $subTableSql = "SELECT BookID FROM `books sub table` WHERE IDNo = ?";
        $subTableStmt = $conn->prepare($subTableSql);
        $subTableStmt->bind_param('i', $row['IDNo']); // Bind the IDNo from the current row
        $subTableStmt->execute();
        $subTableResult = $subTableStmt->get_result();

        // Check if there's a result and fetch the bookid
        if ($subTableResult) {
            $subTableRow = $subTableResult->fetch_assoc();
            $bookid = $subTableRow['BookID'];
            $bookc = $subTableRow['BookID'];
         
        }

        // Use the bookid to fetch the Title from the 'book' table
        $title = null;
        $subject = null;
        if ($bookid) {
            $bookSql = "SELECT Title, Author1FN, Author1LN,CallNum1,CallNum2,SubjectID  FROM `books` WHERE BookID  = ?";
            $bookStmt = $conn->prepare($bookSql);
            $bookStmt->bind_param('i', $bookid);
            $bookStmt->execute();
            $bookResult = $bookStmt->get_result();

            // Check if there's a result and fetch the Title
            if ($bookResult) {
                $bookRow = $bookResult->fetch_assoc();
                $title = $bookRow['Title'];
                $authorid = $bookRow['Author1FN'] . ", " . $bookRow['Author1LN'];
                $callnum1 = $bookRow['CallNum1'];
                $callnum2 = $bookRow['CallNum2'];
                
                if($bookRow['SubjectID'] == 0){
                    $subject = 'N/A';
                }else{
                $subject_stmt = $conn->prepare("SELECT Subject FROM subject WHERE SubjectID = ?");
                $subject_stmt->bind_param("i", $bookRow['SubjectID']);
                $subject_stmt->execute();
                $subject_result = $subject_stmt->get_result();
                $subject_row = $subject_result->fetch_assoc();
                $subject = $subject_row['Subject'];
                }

            }
        }

        // Add the Title to the current row
        $row['Title'] = $title;
        $row['AuthorID'] = $authorid;

        $row['SubjectID'] = $subject;
        $row['CallNum1'] = $callnum1;
        $row['CallNum2'] = $callnum2;
        $row['AccID'] = $accid;
        $row['BookC'] = $bookc;
        // Append the modified row to the $rows array
        $rows[] = $row;

        // Close the subTableStmt and bookStmt
        $subTableStmt->close();
        if (isset($bookStmt)) {
            $bookStmt->close();
        }

        
    }

    echo json_encode($rows);

    $result->free();
    $stmt->close();
    $conn->close();
}






?>