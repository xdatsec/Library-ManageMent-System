<?php

session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Manila');
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function BooksFine($type,$MemberID, $DueDate, $DateReturned, $DueTime, $TimeReturned, $Location, $Purpose) {
        $blnMemberType = (substr($type, 0, 1) === "F" || substr($type, 0, 1) === "S") ? true : false;
        echo $blnMemberType;
        if ($type === true || $Purpose === "Research") {
            return 0;
        }
    
        if ($DueDate > $DateReturned || ($DueDate == $DateReturned && $TimeReturned < strtotime("10:00:00 AM"))) {
            return 0;
        }
    
        $intHour = 0;
        $intDays = 0;
    
        if ($DueDate < $DateReturned) {
            // Assuming Work_Days and Holidays functions are defined elsewhere
            $intDays = Work_Days($DueDate, $DateReturned) - Holidays("Return", strval($DueDate), $DateReturned);
        }
    
        if ($Purpose === "PhotoCopy") {
            $dueTimeTimestamp = strtotime($DueTime);
            if ($DueDate == $DateReturned) {
                if ($TimeReturned <= $dueTimeTimestamp) {
                    return 0;
                }
    
                $intHour = round(($TimeReturned - $dueTimeTimestamp) / 3600);
    
                if ($intHour >= 60 || $DueDate < $DateReturned) {
                    $BooksFine = intval($intHour / 60) * 5;
                    if ($intHour % 60 > 0) {
                        $BooksFine += 5;
                    }
                    $BooksFine -= ($dueTimeTimestamp < strtotime("11:59:00 AM") && $TimeReturned > strtotime("1:00:00 PM")) ? 5 : 0;
                } else {
                    $BooksFine = 5;
                }
            } else {
                $intHour = round((strtotime("5:00:00 PM") - $dueTimeTimestamp) / 3600);
                if ($intHour >= 60) {
                    $BooksFine = intval($intHour / 60) * 5;
                    if ($intHour % 60 > 0) {
                        $BooksFine = ($BooksFine + 5) + (35 * $intDays);
                    }
                    $BooksFine -= ($dueTimeTimestamp < strtotime("11:59:00 AM")) ? 5 : 0;
                } else {
                    $BooksFine = 5 + (35 * $intDays);
                }
    
                switch (true) {
                    case $TimeReturned > strtotime("4:00:00 PM"): $BooksFine -= 0; break;
                    case $TimeReturned > strtotime("3:00:00 PM"): $BooksFine -= 5; break;
                    case $TimeReturned > strtotime("3:00:00 PM"): $BooksFine -= 10; break;
                    case $TimeReturned > strtotime("1:00:00 PM"): $BooksFine -= 15; break;
                    case $TimeReturned > strtotime("11:00:00 AM"): $BooksFine -= 20; break;
                    case $TimeReturned > strtotime("10:00:00 AM"): $BooksFine -= 25; break;
                    case $TimeReturned > strtotime("9:00:00 AM"): $BooksFine -= 30; break;
                    case $TimeReturned > strtotime("8:00:00 AM"): $BooksFine -= 35; break;
                }
            }
        } elseif ($Purpose === "Overnight") {
            if ($Location === "RB") {
                switch (true) {
                    case $TimeReturned > strtotime("4:00:00 PM"): $intHour = 6; break;
                    case $TimeReturned > strtotime("3:00:00 PM"): $intHour = 5; break;
                    case $TimeReturned > strtotime("2:00:00 PM"): $intHour = 4; break;
                    case $TimeReturned > strtotime("1:00:00 PM"): $intHour = 3; break;
                    case $TimeReturned > strtotime("11:00:00 AM"): $intHour = 2; break;
                    case $TimeReturned > strtotime("10:00:00 AM"): $intHour = 1; break;
                    case $TimeReturned < strtotime("10:00:00 AM"): $intHour = 0; break;
                }
    
                $BooksFine = ($intDays * 6) + $intHour;
            } else {
                if ($TimeReturned > strtotime("10:00:00 AM")) {
                    $intHour = 1;
                }
                $BooksFine = $intDays + $intHour;
            }
        }
        return $BooksFine;
    }

    function getHolidaysFromDatabase() {
        include 'connection.php';
    
        $holidays = [];
    
        // Fetch holidays from the database
        $sql = "SELECT Holiday FROM holidays"; // Change 'holidays_table' to your actual table name
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $holidays[] = date('m/d', strtotime($row['Holiday']));
            }
        }
    
        $conn->close();
    
        return $holidays;
    }
    
    function Holidays($strBorRet, $DueDate, $DateReturned = null) {
        try {
            $holidays = getHolidaysFromDatabase(); // Call the function to get holidays from the database
    
            $DueDate = date('m/d', strtotime($DueDate));
    
            $holidayCount = 0;
    
            if ($strBorRet == "Borrow") {
                foreach ($holidays as $holiday) {
                    while (date('m/d', strtotime($DueDate . '/' . date('Y'))) == $holiday) {
                        $DueDate = date('m/d', strtotime($DueDate . '/' . date('Y') . ' + 1 day'));
                        $holidayCount++;
                    }
                }
            } else { // Return
                while (strtotime($DueDate) < strtotime($DateReturned)) {
                    $DueDateFormatted = date('m/d', strtotime($DueDate));
    
                    if (in_array($DueDateFormatted, $holidays) && date('D', strtotime($DueDate . '/' . date('Y'))) != 'Sat' && date('D', strtotime($DueDate . '/' . date('Y'))) != 'Sun') {
                        $holidayCount++;
                    }
    
                    $DueDate = date('m/d', strtotime($DueDate . '/' . date('Y') . ' + 1 day'));
                }
            }
    
            return $holidayCount;
        } catch (Exception $e) {
            // Handle exceptions here if needed
            return 0;
        }
    }

    

    function Work_Days($BegDate, $EndDate) {
        try {
            // Note that this function does not account for holidays.
            $BegDate = date('Y-m-d', strtotime($BegDate));
            $EndDate = date('Y-m-d', strtotime($EndDate));
            $WholeWeeks = floor((strtotime($EndDate) - strtotime($BegDate)) / (60 * 60 * 24 * 7));
            $DateCnt = date('Y-m-d', strtotime($BegDate . " + " . $WholeWeeks . " weeks"));
            $EndDays = 0;
    
            while (strtotime($DateCnt) < strtotime($EndDate)) {
                if (date('D', strtotime($DateCnt)) != 'Sun' && date('D', strtotime($DateCnt)) != 'Sat') {
                    $EndDays++;
                }
                $DateCnt = date('Y-m-d', strtotime($DateCnt . " + 1 day"));
            }
    
            return $WholeWeeks * 5 + $EndDays;
        } catch (Exception $e) {
            // Handle exceptions here if needed
            return 0;
        }
    }


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
    $paid = '';
    $overdueDays = 0;
    $overdueDayss;
    $overdueHours =0;
    $chargePerDay = 0;
    $chargePerHour = 0;
    $borrowedSql = "SELECT * FROM borrowed WHERE MemberID = ?   AND `Return` = 0";
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
            $returns = $borrowedRow['Return'];
            $currentDate = new DateTime();
            $dueDateStr = $borrowedRow['DueDate']; // Due date in string format

            // Create a DateTime object for the due date
            $dueDate = new DateTime($dueDateStr);
            $daysOverdue = $currentDate->diff($dueDate)->format('%a');

            $accid = $borrowedRow['AccID'];

            $dateborrowed = date("Y-m-d", strtotime($borrowedRow['DateBorrowed']));
            $duedate = date("Y-m-d", strtotime($borrowedRow['DueDate']));
            date_default_timezone_set('Asia/Manila');

            $duetime = date("g:ia", strtotime($borrowedRow['DueDate']));
            if (!empty($borrowedRow['DateReturned'])) {
                $datereturned = date("Y-m-d", strtotime($borrowedRow['DateReturned']));
            } else {
                $datereturned = "";
            }

            if (!empty($borrowedRow['TimeReturned'])) {
                $timereturned = date("g:ia", strtotime($borrowedRow['TimeReturned']));
            } else {
                $timereturned = "";
            }
            $timeborrowed =  date("g:ia", strtotime($borrowedRow['TimeBorrowed']));

            $porpose = $borrowedRow['Purpose'];
            $id = $borrowedRow['ID'];

            $selectmember = $conn->prepare("SELECT * FROM `members` WHERE MemberID = ?");
            $selectmember->bind_param("i", $memberID);
            $selectmember->execute();
            $selectmemberresult = $selectmember->get_result();
            $selectmemberrow = $selectmemberresult->fetch_assoc();

            $accessionSql = "SELECT * FROM `books accession` WHERE AccID = ?";
            $accessionStmt = $conn->prepare($accessionSql);
            $accessionStmt->bind_param('i', $borrowedRow['AccID']);
            $accessionStmt->execute();
            $accessionResult = $accessionStmt->get_result();
            if ($accessionResult) {
                $accessionRow = $accessionResult->fetch_assoc();
                $currentDate->setTime(0, 0);
                $dueDate->setTime(0, 0);
                $currentDateStr = $currentDate->format('Y-m-d');
                $dueDateStr = $dueDate->format('Y-m-d');
                $location = $accessionRow['Location'];
                $selectsection = $conn->prepare("SELECT * FROM `Section` WHERE section = ?");
                $selectsection->bind_param("s", $location);
                $selectsection->execute();
                $selectsectionresult = $selectsection->get_result();
                $selectsectionrow = $selectsectionresult->fetch_assoc();

                $selectsection1 = $conn->prepare("SELECT * FROM `Section` WHERE section = 'Photocopy'");
                $selectsection1->execute();
                $selectsectionresult1 = $selectsection1->get_result();
                $selectsectionrow1 = $selectsectionresult1->fetch_assoc();

                $dueDateStrS = $borrowedRow['DueDate']; // Due date in string format
                $currentDate2 = new DateTime();
                // Create a DateTime object for the due date
                $dueDate1 = new DateTime($dueDateStrS);
                $dueDate1->setTime(0, 0);
                $overduetime = 0;
                $overdueday = 0;
         


            



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

                // Check if there are any rows returned
                if ($subjectResult->num_rows > 0) {
                    $subjectRow = $subjectResult->fetch_assoc();
                    $bookSubject = $subjectRow['Subject'];
                } else {
                    $bookSubject = 'N/A';
                }

                $returnedSql = "SELECT * FROM returned WHERE id  = ?";
                $returnedStmt = $conn->prepare($returnedSql);
                $returnedStmt->bind_param('i', $id);
                $returnedStmt->execute();
                $returnedResult = $returnedStmt->get_result();

                // Check if there are any returned books
                if ($returnedResult->num_rows > 0) {
                    $returnrow = $returnedResult->fetch_assoc();
                    $paid = $returnrow['Paid'];
                }
                $type = $selectmemberrow['TypeId'];
                $currentDateTime = date("Y-m-d H:i:s");

                $fineAmount = BooksFine($type,$memberID, $borrowedRow['DueDate'], $currentDateTime, $borrowedRow['DueTime'], $currentDateTime, $location, $porpose);



                // Add the book data to the array
                $books[] = array(
                    'Return' => $returns,
                    'Fine' => $fineAmount,
                    'AccessionNo' => $accessionno,
                    'Copies' => $copies,
                    'Title' => $bookTitle,
                    'CallNum1' => $bookCallNum1,
                    'CallNum2' => $bookCallNum2,
                    'Author' => $bookAuthor,
                    'Subject' => $bookSubject,
                    'Location' => $location,
                    'DateBorrowed' => $dateborrowed,
                    'DueDate' => $duedate,
                    'DateReturned' => $datereturned,
                    'TimeBorrowed' => $timeborrowed,
                    'DueTime' => $duetime,
                    'TimeReturned' => $timereturned,
                    'Purpose' => $porpose,
                    'AccID' => $accid,
                    'id' => $id,
                    'Paid' => $paid,

                );

                // Prepare the SQL statement
                $updateStmt = $conn->prepare("UPDATE returned SET Fine = ? WHERE AccID = ? AND id = ?");

                // Bind the parameters to the placeholders
                $updateStmt->bind_param("iii", $fineAmount, $accid, $id);

                // Execute the prepared statement
                if ($updateStmt->execute()) {
                } else {
                    echo "Error updating record: " . $updateStmt->error;
                }

                $updateStmt->close();
            }
        }

        // Encode the book data as JSON
        $json = json_encode($books);

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
