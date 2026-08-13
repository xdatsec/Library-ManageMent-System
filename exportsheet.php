<?php
  session_start();
  $_SESSION['members'] = false;
  $_SESSION['locator'] = 'rp';
  if (isset($_SESSION["loggedin"])) {
    if ($_SESSION['isSuperAdmin'] == 0) {
      header('Location: /index.php');
    }
  } else {
    header('Location: /signin.php');
    exit;
  }

  require 'vendor/autoload.php';
  
  use PhpOffice\PhpSpreadsheet\IOFactory;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  // Load the template file
  $templatePath = 'assets/sheet.xlsx';
  $spreadsheet = IOFactory::load($templatePath);
  $coursename ='';
  $yearname='';
  $typename='';
  $sectionname='';

  $worksheet = $spreadsheet->getActiveSheet();
  include 'modules/inc/connection.php';
  $start = 2;
  $sql = "SELECT *
  FROM entrance e
  INNER JOIN members m ON e.MemberID = m.MemberID
  WHERE m.Deleted = 0";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $start++;
        $inputDate = $row['DateAdded'];
        $date = $inputDate;
        $formattedDate = $inputDate;


        $firstname = $row['FirstName'];
        $lastname = $row['LastName'];

        $sqlcourse = "SELECT * FROM course Where CourseID = ?";
        $coursestmt = $conn->prepare($sqlcourse);
        $coursestmt->bind_param("i", $row['CourseID']);
        $coursestmt->execute();
        $courseresult = $coursestmt->get_result();
        $courserow = $courseresult->fetch_assoc();
        $course = $courserow['Course'];

        $sqltype = "SELECT * FROM type Where TypeId = ?";
        $typestmt = $conn->prepare($sqltype);
        $typestmt->bind_param("i", $row['TypeId']);
        $typestmt->execute();
        $resulttype = $typestmt->get_result();
        $rowtype = $resulttype->fetch_assoc();
        $types =$rowtype['Type'];

        $worksheet->setCellValue('A'.$start, ''.$row['MemberID']);
        $worksheet->setCellValue('B'.$start, ''.$firstname . " " . $lastname);
        $worksheet->setCellValue('C'.$start, ''.$course);
        $worksheet->setCellValue('D'.$start, ''.$formattedDate);
        $worksheet->setCellValue('E'.$start, ''.$types);
        $worksheet->getStyle('A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('C'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('D'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('E'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


    }
  



    $filename = 'exported_fullreport.xlsx';

    // Save file on the server
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($filename);
    
    // Set the headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Length: ' . filesize($filename));
    
    // Output file contents
    readfile($filename);
    // Remove file from the server after download
    if (file_exists($filename)) {
        unlink($filename);
    }

  
    exit;
  }

 
?>



