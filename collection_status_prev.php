<?php
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
date_default_timezone_set('Asia/Manila');
include "modules/inc/connection.php";

$start = htmlentities($_GET['start']);
$end = htmlentities($_GET['end']);
$status = htmlentities($_GET['status']);

if (empty($start) || empty($end) || empty($status)) {
    // One or more variables are empty
    // Handle the error here
    header('Location: /collection_status.php');
} else {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/fontawesome-all.min.css">
    <style>
        body::-webkit-scrollbar {
            display: none;
            
        }


        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
            }

            .print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            font-size: 12px;
            
        }

        header {
            background-color: white;
            text-align: left;
            padding: 10px;
            margin-right: 30px;
        }

        table {
            font-size: 12px;
            
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 6px;
            
            text-align: left;
        }

        th {
            background-color: white;
        }

        tr {
            background-color: white;
        }

        thead {
            background-color: white;
            border-bottom: black 2px solid;
            
            position: relative;
            z-index: 2;
        }

        h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            
        }

        
        @media only screen and (max-width: 600px) {
            table {
                margin: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="school-header" style="width:100%;display:inline-block;">
            <img style="margin-left:30px;width:90px;" src="data:image/png;base64,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">        <a class="print" href="javascript:window.print()" style="font-size:20px;float:right;">Print<i class="fa fa-print"></i></a>
        <h5 style="display:inline-block;font-size:30px;position:relative;bottom:30px;left:10px;" class="school-name">Carlos Hilado Memorial State University</h5>
        </div>
        <?php

            if ($status == "E") {
                echo '<h1 style="position: relative;top: 20px;left: 20px;font-weight:bold;">Books - Existing</h1>';
            } else if ($status == "L") {
                echo '<h1 style="position: relative;top: 20px;left: 20px;font-weight:bold;">Books - Lost</h1>';
            } else if ($status == "RE") {
                echo '<h1 style="position: relative;top: 20px;left: 20px;font-weight:bold;">Books - Replaced</h1>';
            } else if ($status == "D") {
                echo '<h1 style="position: relative;top: 20px;left: 20px;font-weight:bold;">Books - Deleted</h1>';
            } else {
                header('Location: /collection_status.php');
            }
            echo "<p style='position: relative;top: 20px;left: 20px;font-weight:bold;'> Date Recieve from" . $start . " To " . $end . "</p>";
        ?>
        <p class="date" style="float:right;">Date: <?php echo date("F d, Y"); ?></p>
    </header>
    <table>
        <thead>
            <tr>
                <th>Acc No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                // Convert the start and end dates to the format used in the database
                $start_date_formatted = date('Y-m-d', strtotime($start));
                $end_date_formatted = date('Y-m-d', strtotime($end));

                if (htmlentities($_GET['status']) != "D") {
                    $sql3 = "SELECT * FROM `books` WHERE   Deleted = 0";
                } else {
                    $sql3 = "SELECT * FROM `books` WHERE  Deleted = 1";
                }
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();

                // Check if there are results before fetching
                while ($row3 = $result3->fetch_assoc()) {

                    $subtablerow = "SELECT * FROM `books sub table` WHERE BookID  = ? AND DATE(DateReceived) BETWEEN ? AND ?";
                    $stmt2 = $conn->prepare($subtablerow);
                    $stmt2->bind_param("sss", $row3['BookID'], $start_date_formatted, $end_date_formatted);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    // Check if there are results before fetching
                    while ($row2 = $result2->fetch_assoc()) {
                        $sql = "";
                        if (!empty($_GET['status'])) {
                            $status = htmlentities($_GET['status']);
                            if ($status == "E") {
                                $sql = "SELECT * FROM `books accession` WHERE Status ='E' AND IDNo = ?";
                            } else if ($status == "L") {
                                $sql = "SELECT * FROM `books accession` WHERE Status ='L' AND IDNo = ?";
                            } else if ($status == "RE") {
                                $sql = "SELECT * FROM `books accession` WHERE Status ='RE' AND IDNo = ?";
                            } else if ($status == "D") {
                                $sql = "SELECT * FROM `books accession` WHERE IDNo = ?";
                            }
                        } else {
                            header('Location: /collection_status.php');
                        }
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $row2['IDNo']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlentities($row['AccessionNo']) . "</td>";
                            echo "<td>" . htmlentities($row3['Title']) . "</td>";
                            echo "<td>" . htmlentities($row3['Author1LN']) . ',' . htmlentities($row3['Author1FN']) . "</td>";
                            $getsubject = "SELECT * FROM `subject` WHERE SubjectID  = ?";
                            $stmt666 = $conn->prepare($getsubject);
                            $stmt666->bind_param("s", $row3['SubjectID']);
                            $stmt666->execute();
                            $result666 = $stmt666->get_result();
                            while ($iam666 = $result666->fetch_assoc()) {
                                echo "<td>" . htmlentities($iam666['Subject']) . "</td>";
                            }
                            $stmt666->close();
                            echo "</tr>";
                        }
                    }
                }



                ?>

            </tr>
        </tbody>
    </table>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>