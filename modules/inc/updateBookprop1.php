<?php
include 'connection.php';
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SESSION['isSuperAdmin'] == 1) {
        $empId = $_REQUEST['empId'];
        $newValue = $_REQUEST['newValue'];
        $colName = $_REQUEST['colName'];
        $username = $_SESSION['username'];
        $computerName = gethostname();
        $changes = '';


        if ($colName == 'AccessionNo') {
            $changeval = $_REQUEST['oldval'];
            $bookid = $_REQUEST['bookid'];
            // Prepare and execute a query to fetch all AccessionNo values associated with the specified book ID
            $sql = "SELECT AccessionNo FROM books WHERE BookID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $bookid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            $replacementsMade = false;

            if ($result->num_rows > 0) {
                $updatedValues = [];

                while ($row = $result->fetch_assoc()) {
                    $accessionNo = $row['AccessionNo'];

                    // Check if the AccessionNo contains the specified substring
                    if (strpos($accessionNo, $changeval) !== false) {
                        // Replace the matched substring with the new value
                        $accessionNo = str_replace($changeval, $newValue, $accessionNo);
                        $replacementsMade = true;
                    }

                    $updatedValues[] = $accessionNo;
                }

                $updatedValuesString = implode(", ", $updatedValues);

                // Update the database with the modified values if replacements were made
                if ($replacementsMade) {
                    // Prepare and execute a query to update the AccessionNo values
                    $updateSql = "UPDATE books SET AccessionNo = ? WHERE BookID = ?";
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bind_param("si", $updatedValuesString, $bookid);

                    if ($stmt->execute()) {
                        if ($empId != '' && $newValue != '' && $colName != '') {
                            // Prepare and execute a query to update other values
                            $update = "UPDATE `books accession` SET $colName = ? WHERE AccID = ?";
                            $stmt2 = $conn->prepare($update);
                            $stmt2->bind_param("si", $newValue, $empId);

                            if ($stmt2->execute()) {
                            } else {
                                echo 'Error in Updation';
                            }
                            $stmt2->close();
                        } else {
                            echo "Data inserted successfully!";
                        }
                    } else {
                        echo "Error updating column: " . $conn->error;
                    }

                    $stmt->close();
                } else {
                    echo "No replacements were made.";
                    echo $changeval . ' ' . $newValue;
                }
            } else {
                echo "No data found for the specified book ID.";
            }
        } else if ($colName == 'Status') {
            $encoder = $_SESSION['username'];
            if ($newValue == 'L') {
                $accessionStmt = $conn->prepare("SELECT * FROM `books accession` WHERE AccID = ?");
                $accessionStmt->bind_param("i", $empId);
                $accessionStmt->execute();
                $accessionResult = $accessionStmt->get_result();
                $accessionRow = $accessionResult->fetch_assoc();
                $acessionno = $accessionRow['AccessionNo'];
                $copies = $accessionRow['Copies'];
                $idno = $accessionRow['IDNo'];
                $copies = $accessionRow['Copies'];
                $location = $accessionRow['Location'];
                $source = $accessionRow['Source'];
                $status = "L";

                $bookSubStmt = $conn->prepare("SELECT * FROM  `books sub table` WHERE IDNo  = ?");
                $bookSubStmt->bind_param("i", $idno);
                $bookSubStmt->execute();
                $bookSubResult = $bookSubStmt->get_result();
                $bookSubRow = $bookSubResult->fetch_assoc();
                $bookid = $bookSubRow['BookID'];
                $copyrightdate = $bookSubRow['CopyrightYear'];
                $daterecieve = $bookSubRow['DateReceived'];

                $bookStmt = $conn->prepare("SELECT * FROM `books` WHERE BookID  = ?");
                $bookStmt->bind_param("i", $bookid);
                $bookStmt->execute();
                $bookResult = $bookStmt->get_result();
                $bookRow = $bookResult->fetch_assoc();
                $booktitle = $bookRow['Title'];
                $bookauthor1ln = $bookRow['Author1LN'];
                $bookauthor1fn = $bookRow['Author1FN'];
                $bookauthor1mn = $bookRow['Author1MI'];

                // Insert the lost and replaced book into the `books lost and replaced` table
                $lostAndReplacedStmt = $conn->prepare("INSERT INTO `books lost and replaced` (`AccID`, `AccessionNo`, `Copies`, `Title`, `AuthorLN`, `AuthorFN`, `AuthorMI`, `CopyrightDate`, `DateReceived`, `Location`, `Source`, `Status`, `Encoder`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $lostAndReplacedStmt->bind_param("issssssssssss", $accid, $acessionno, $copies, $booktitle, $bookauthorln, $bookauthorfn, $bookauthormi, $copyrightdate, $datereceived, $location, $source, $status, $encoder);
                $lostAndReplacedStmt->execute();
                if ($empId != '' && $newValue != '' && $colName != '') {
                    $update = "update `books accession` set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where AccID = " . (int)$empId;
                    if ($conn->query($update)) {
                    } else {
                        echo 'Error in Updation';
                    }
                }
            } else {
                if ($empId != '' && $newValue != '' && $colName != '') {
                    $update = "update `books accession` set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where AccID = " . (int)$empId;
                    if ($conn->query($update)) {
                    } else {
                        echo 'Error in Updation';
                    }
                }
            }
        } else {

            if ($empId != '' && $newValue != '' && $colName != '') {
                $update = "update `books accession` set " . $colName . " = '" . $conn->real_escape_string($newValue) . "' where AccID = " . (int)$empId;
                if ($conn->query($update)) {
                } else {
                    echo 'Error in Updation';
                }
            }
        }


        $conn->close();
    } else {
        echo 'You Dont Have Permission to Edit, Please Contact Library Admin! ';
    }
}
