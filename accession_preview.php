<?php
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
    header('Location: /signin.php');
    exit;
}
date_default_timezone_set('Asia/Manila');
include "modules/inc/connection.php";
$accessionstart = htmlentities($_GET['accessionstart']);
$cat = htmlentities($_GET['category']);
if (empty($accessionstart) || empty($cat)) {
    header('Location: /accession_reports.php');
    exit;
} else {
    $catarray = array(); 
    
    $catarray[] = 'gc';
    $catarray[] = 'gf';
    $catarray[] = 'dd';


    if (!in_array($cat, $catarray)) {
        header('Location: /accession_reports.php');
    }
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
        <img style="margin-left:30px;width:90px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAACQ1BMVEX
       <h5 style="display:inline-block;font-size:30px;position:relative;bottom:30px;left:10px;" class="school-name">Carlos Hilado Memorial State University</h5>
        </div>
        <?php

        if ($cat == "gc") {
            echo '<h1 style="position: relative;top: 20px;left: 20px;">Accession Book - General Collection</h1>';
        } else if ($cat == "gf") {
            echo '<h1 style="position: relative;top: 20px;left: 20px;">Accession Book - General Fund</h1>';
        } else {
            echo '<h1 style="position: relative;top: 20px;left: 20px;">Accession Book - Donation</h1>';
        }
        ?>

        <p class="date" style="float:right;">Date: <?php echo date("F d, Y"); ?></p>
    </header>

    <table>
        <thead>
            <tr>
                <th>Acc. No.</th>
                <th>D. Rec</th>
                <th>Call #</th>
                <th>Author</th>
                <th>Title</th>
                <th>Place of Pub</th>
                <th>Publisher</th>
                <th>Copyright</th>
                <th>Source</th>
                <th>Mr Page</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <!-- Your data rows go here -->
            <tr>
                <?php


                if ($cat == "gc") {
                    $booksr = "SELECT * FROM `books` WHERE Deleted = 0";
                    $booksr_st = $conn->prepare($booksr);
                    $booksr_st->execute();
                    $booksr_r = $booksr_st->get_result();

                    
                    while ($row3 = $booksr_r->fetch_assoc()) {

                        $subtablerow = "SELECT * FROM `books sub table` WHERE BookID = ?";
                        $stmt2 = $conn->prepare($subtablerow);
                        $stmt2->bind_param("s", $row3['BookID']);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        while ($row2 = $result2->fetch_assoc()) {
                            $sql = "SELECT * FROM `books accession` WHERE `AccessionNo` > ? AND IDNo = ? ORDER BY `AccessionNo` ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $accessionstart,$row2['IDNo']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {

                                echo "<td>" . htmlentities($row['AccessionNo']) . "</td>";
                                echo "<td>" . htmlentities($row['DateEncoded']) . "</td>";
                                echo "<td>" . htmlentities($row3['CallNum1']) . '' . htmlentities($row3['CallNum2']) . "</td>";
                                echo "<td>" . htmlentities($row3['Author1LN']) . ',' . htmlentities($row3['Author1FN']) . "</td>";
                                echo "<td>" . htmlentities($row3['Title']) . "</td>";
                                echo "<td>" . htmlentities($row3['PlaceofPublication']) . "</td>";
                                echo "<td>" . htmlentities($row3['PublisherName']) . "</td>";
                                echo "<td>" . htmlentities($row2['CopyrightYear']) . "</td>";
                                echo "<td>" . htmlentities($row['Source']) . "</td>";
                                echo "<td>" . htmlentities($row['MR Page']) . "</td>";
                                echo "<td>" . htmlentities($row['Status']) . "</td>";
                                echo "<td>" . htmlentities($row2['PurchasePrice']) . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                } else if ($cat == "gf") {
                  $booksr = "SELECT * FROM `books` WHERE Deleted = 0";
                    $booksr_st = $conn->prepare($booksr);
                    $booksr_st->execute();
                    $booksr_r = $booksr_st->get_result();

                    
                    while ($row3 = $booksr_r->fetch_assoc()) {

                        $subtablerow = "SELECT * FROM `books sub table` WHERE BookID = ?";
                        $stmt2 = $conn->prepare($subtablerow);
                        $stmt2->bind_param("s", $row3['BookID']);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        while ($row2 = $result2->fetch_assoc()) {
                            $sql = "SELECT * FROM `books accession` WHERE `AccessionNo` > ? AND IDNo = ? AND `Source` Like '%GF%'  ORDER BY `AccessionNo` ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $accessionstart,$row2['IDNo']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {

                                echo "<td>" . htmlentities($row['AccessionNo']) . "</td>";
                                echo "<td>" . htmlentities($row['DateEncoded']) . "</td>";
                                echo "<td>" . htmlentities($row3['CallNum1']) . '' . htmlentities($row3['CallNum2']) . "</td>";
                                echo "<td>" . htmlentities($row3['Author1LN']) . ',' . htmlentities($row3['Author1FN']) . "</td>";
                                echo "<td>" . htmlentities($row3['Title']) . "</td>";
                                echo "<td>" . htmlentities($row3['PlaceofPublication']) . "</td>";
                                echo "<td>" . htmlentities($row3['PublisherName']) . "</td>";
                                echo "<td>" . htmlentities($row2['CopyrightYear']) . "</td>";
                                echo "<td>" . htmlentities($row['Source']) . "</td>";
                                echo "<td>" . htmlentities($row['MR Page']) . "</td>";
                                echo "<td>" . htmlentities($row['Status']) . "</td>";
                                echo "<td>" . htmlentities($row2['PurchasePrice']) . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                } else {
                    $booksr = "SELECT * FROM `books` WHERE Deleted = 0";
                    $booksr_st = $conn->prepare($booksr);
                    $booksr_st->execute();
                    $booksr_r = $booksr_st->get_result();

                    
                    while ($row3 = $booksr_r->fetch_assoc()) {

                        $subtablerow = "SELECT * FROM `books sub table` WHERE BookID = ?";
                        $stmt2 = $conn->prepare($subtablerow);
                        $stmt2->bind_param("s", $row3['BookID']);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        while ($row2 = $result2->fetch_assoc()) {
                            $sql = "SELECT * FROM `books accession` WHERE `AccessionNo` > ? AND IDNo = ? AND `Source` Like '%D%'  ORDER BY `AccessionNo` ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $accessionstart,$row2['IDNo']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {

                                echo "<td>" . htmlentities($row['AccessionNo']) . "</td>";
                                echo "<td>" . htmlentities($row['DateEncoded']) . "</td>";
                                echo "<td>" . htmlentities($row3['CallNum1']) . '' . htmlentities($row3['CallNum2']) . "</td>";
                                echo "<td>" . htmlentities($row3['Author1LN']) . ',' . htmlentities($row3['Author1FN']) . "</td>";
                                echo "<td>" . htmlentities($row3['Title']) . "</td>";
                                echo "<td>" . htmlentities($row3['PlaceofPublication']) . "</td>";
                                echo "<td>" . htmlentities($row3['PublisherName']) . "</td>";
                                echo "<td>" . htmlentities($row2['CopyrightYear']) . "</td>";
                                echo "<td>" . htmlentities($row['Source']) . "</td>";
                                echo "<td>" . htmlentities($row['MR Page']) . "</td>";
                                echo "<td>" . htmlentities($row['Status']) . "</td>";
                                echo "<td>" . htmlentities($row2['PurchasePrice']) . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }


                ?>

            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $(".preview").click(function() {
            var selectedValue = $('input[name="radioGroup"]:checked').attr('id');
            $("#accessionstart").val();

        });
    </script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>