<?php
session_start();
$_SESSION['locator'] = 'tr';
$_SESSION['members'] = 'true';
$username = '';
if (isset($_SESSION["loggedin"])) {
  include "modules/inc/connection.php";
  $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
} else {
  header('Location: /signin.php');
  exit;
}
$course = "";
$type = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- End Required meta tags -->
  <!-- Begin SEO tag -->
  <title> All Member's | CHMSU LMS </title>
  <meta property="og:title" content="Library Members - All">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta name="author" content="CodecMaker">

  <meta property="og:locale" content="en_US">
  <meta name="description" content="A Library Management System">
  <meta property="og:description" content="A Library Management System">

  <meta property="og:site_name" content="CHMSU LMS ">
  <script type="application/ld+json">
    {
      "name": "CHMSU LMS ",
      "description": "A Library Management System",
      "author": {
        "@type": "Company",
        "name": "CodecMaker"
      },
      "@type": "WebSite",
      "url": "",
      "headline": "DashBoard",
      "@context": "http://schema.org"
    }
  </script>
  <!-- End SEO tag -->
  <!-- FAVICONS -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/favicon.ico">
  <meta name="theme-color" content="#3063A0">
  <!-- End FAVICONS -->
  <script src="assets/vendor/pace/pace.min.js"></script>
  <!-- BEGIN BASE STYLES -->
  <link rel="stylesheet" href="assets/vendor/flatpickr/flatpickr.min.css">
  <link rel="stylesheet" href="assets/vendor/pace/pace.min.css">
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/fontawesome-all.min.css">
  <!-- END BASE STYLES -->
  <!-- BEGIN PLUGINS STYLES -->
  <link rel="stylesheet" href="assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.css">
  <!-- END PLUGINS STYLES -->
  <!-- BEGIN THEME STYLES -->
  <link rel="stylesheet" href="assets/stylesheets/main.min.css">
  <link rel="stylesheet" href="assets/stylesheets/custom.css">
  <!-- .app -->
  <style>
    tr:not(thead tr):hover {
      background-color: #1877F2;
      color: white;
    }

    body {
      background-color: #408080;
      color: black;
    }

    html {
      background-color: #408080;
      color: black;

    }

    .nav-item.active a {
      color: #ff5733;
      
    }

    .has-active a {
      color: #408080 !important;
    }

    .has-child span {
      color: #408080 !important;
    }

    .btn-primary {
      background-color: #408080;
      color: white !important;
    }

    #fullscreenDiv {

      overflow: auto;
      
    }
  </style>
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>

  <div class="app">

    <!-- .nav -->
    <?php include "assets/header_nav1.php" ?>
    <div class="wrapper">

      <div class="page">

        <div class="page-inner">
          <!-- .page-title-bar -->
          <header class="page-title-bar">
            <!-- .breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">

              </ol>

            </nav>

            <!-- title and toolbar -->
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto text-white"> Library Members</h1>
              <a id="reset" class="btn btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Reset</a>
              <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>
            </div>




            <!-- /title and toolbar -->
          </header>
   
          <div class="card container  mt-5" id="fullscreenDiv" style="border-style: solid;border-color:#408080;">
            <!-- Bootstrap Modal -->
            <div class="modal" id="confirmationModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure, Do you want drop this Student?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Yes, I'm sure</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal" id="respondmodal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p id="respondtextmodal"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-0">
                  <div class="modal-header rounded-0" id="head" style="color:black;">
                    <h5 class="modal-title" id="myModalLabel">History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="color:black;">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" style="height: 318px;">
                    <div class="container">
                      <div class="tab-content mt-4" id="myTabContent" style="z-index:0;height: 245px;">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="form-group row">
                            <label for="inputField" class="col-sm-2 col-form-label">Date Time:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" value="No Data" id="datetime" placeholder="Input Field" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputField" class="col-sm-2 col-form-label">UserName:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" value="No Data" id="inputField" placeholder="Input Field" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputField" class="col-sm-2 col-form-label">ComputerName:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" value="No Data" id="cpname" placeholder="Input Field" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputField" class="col-sm-2 col-form-label">Comments:</label>
                            <div class="col-lg-12">
                              <textarea class="form-control" value="No Data" id="comments" rows="3" disabled="" style="height: 106px;"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer" style="z-index:1;">
                    <div class="container">
                      <div class="row">
                        <div class="col-sm">
                          <!--- showing 1-10 of 100 -->
                          <a class="" id="showing2" style="text-decoration:none;"></a>
                        </div>
                      </div>
                      <!--- showing 1-10 of 100 -->
                      <button id="prevBtn2" class="btn btn-primary mt-4" style="float:left;">Previous</button>
                      <button id="nextBtn2" class="btn btn-primary mt-4 ml-2" style="float:left;">Next</button>
                      <input class="searchs" class="form-control" placeholder="Search" style="float:right;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Library Members</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true">Information</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">List </a>
              </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent" style="border-style: solid;border-color:#408080;">
              <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="card-body">
                  <form>
                    <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Name:</label>
                      <div class="col-sm-3">
                        <input type="text" value="" name="name" class="input form-control" data-id="" id="namefield" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Student ID" class="col-sm-2 col-form-label">Student ID:</label>
                      <div class="col-sm-10">
                        <input type="text" data-id="" name="student_id" class="input form-control" id="studentid" placeholder="Student ID"><span class="text-info">Make sure to Bind to Student ID for Entrance</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-2 col-form-label">Email:</label>
                      <div class="col-sm-10">
                        <input type="email" data-id="" name="email" class="input form-control" id="email" placeholder="Enter Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="SchoolYearFrom" class="col-sm-2 col-form-label">School Year From:</label>
                      <div class="col-sm-3">
                        <input type="text" data-id="" name="SchoolYearFrom" class="input form-control" id="schoolyearfrom" placeholder="School Year from">

                      </div>

                      <div class="col-sm-3">
                        <input type="text" data-id="" name="SchoolYearTo" class="input form-control" id="schoolyearto" placeholder="School Year to">
                      </div>

                    </div>
                    <div class="form-group row">
                      <label for="BooksBorrowed" class="col-sm-2 col-form-label">Book Borrowed:</label>
                      <div class="col-sm-10">
                        <input type="number" data-id="" name="BooksBorrowed" class="input form-control" id="booksborrowed" placeholder="Book Borrowed">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="DateEnlist" class="col-sm-2 col-form-label">Date Enlist:</label>
                      <div class="col-sm-10">
                        <input type="date" data-id="" name="DateEnlist" class="input form-control" id="dateenlist" placeholder="DateEnlist">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="DatetoGrad" class="col-sm-2 col-form-label">Date to Graduate:</label>
                      <div class="col-sm-10">
                        <input type="date" data-id="" name="DatetoGrad" class="input form-control" id="datetograd" placeholder="Date to Graduate">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ParentGuardian" class="col-sm-2 col-form-label">Parent Guardian:</label>
                      <div class="col-sm-10">
                        <input type="text" data-id="" name="ParentGuardian" class="input form-control" id="parentguardian" placeholder="Parent/Guardian">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ParentGuardian" class="col-sm-2 col-form-label">School /Office Where employed:</label>
                      <div class="col-sm-10">
                        <input type="text" data-id="" name="Employment" class="input form-control" id="employment" placeholder="School /Office Where employed">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="HeadOfSchool" class="col-sm-2 col-form-label">HeadOfSchool:</label>
                      <div class="col-sm-10">
                        <input type="text" data-id="" name="HeadOfSchool" class="input form-control" id="headofschool" placeholder="Head Of School">
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="card-footer-content">
                        <a class="text-right" id="showing1">Showing items 0-0</a>
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                          <button class="btn btn-primary mr-1" type="button" id="nextBtn">
                            Next
                          </button>
                          <button class="btn btn-primary mr-1" id="prevBtn" type="button">
                            Prev
                          </button>
                          <button class="history btn btn-primary mr-1" type="button" data-toggle="modal" data-target="#history">
                            History
                          </button>
                          <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                          ?>
                          <button class="btn btn-warning" id="drop" class="drop" type="button">
                            DROP
                          </button>
                          <a class="btn btn-success" id="addts">ADD</a>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>



                </div>
              </div>
              <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <section class="card card-fluid">
                  <header class="card-header" style="display:none;">

                    <!-- .nav-tabs -->
                    <ul class="nav nav-tabs" id="newtab" role="tablist">




                      <li class="nav-item">
                        <a class="nav-link nav-active" id="viewt" data-toggle="tab" href="#prev" role="tab" aria-controls="prev" aria-selected="true">View</a>
                      </li>


                      <li class="nav-item">
                        <a class="nav-link" id="addt" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add</a>
                      </li>


                    </ul>
                    <!-- /.nav-tabs -->
                  </header>
  
                  <div class="tab-content">

                    <?php
                      $sql = "SELECT * FROM members WHERE Deleted = 0";
                      $stmt = $conn->prepare($sql);

                      if ($stmt) {
                        // Step 2: Bind the parameter to the placeholder
                        // Step 3: Execute the query
                        $stmt->execute();

                        // Step 4: Get the result
                        $result = $stmt->get_result();

                        // Step 5: Fetch data into an array
                        if ($result->num_rows > 0) {
                          $items = array();
                          while ($row = $result->fetch_assoc()) {
                            $items[] = $row;
                          }
                        } else {
                          $items = array();
                        }
                      }

                    ?>
                    <div class="tab-pane fade show active" id="prev" role="tabpanel" aria-labelledby="prev-tab">
                      <div class="card-body" style="position: relative;bottom: 15px;">
                        <h1 id="nodata" style="display:none;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: black; z-index: 1; padding: 20px; color: green; font-family: 'Courier New', monospace; font-size: 20px; line-height: 1.2em; letter-spacing: 2px;">
                          No Members to show
                        </h1>

                        <div class="container">
                          <div class="row mt-3">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="selectOption" class="form-label">Filter:</label>
                                <select class="form-control small-select" id="filtertype" style="width:124px;">
                                  <option value="0" selected>All</option>
                                  <?php
                                  $stmttype = $conn->prepare('SELECT * FROM type WHERE Deleted = 0');

                                  // Execute the query
                                  $stmttype->execute();

                                  // Get the result
                                  $typeresult = $stmttype->get_result();
                                  while ($typerow = $typeresult->fetch_assoc()) {
                                    echo '<option value="' . $typerow['TypeId'] . '">' . $typerow['Type'] . '</option>';
                                  }


                                  ?>
                                </select>
                              </div>
                              <hr>
                            </div>

                          </div>


                          <form>
                            <div class="form-group row">
                              <label for="MemberID" class="col-sm-2 col-form-label">MemberID:</label>
                              <div class="col-sm-2">
                                <input type="text" value="" name="MemberID" class="input form-control" data-id="" id="memberfield" placeholder="">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="fullname" class="col-sm-2 col-form-label">Name:</label>
                              <div class="col-sm-4">
                                <label for="LastName" class="col-sm-10 col-form-label">Last Name</label>
                                <input type="text" name="LastName" data-id="" class="input form-control" id="lastnamefield" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">

                                <label for="FirstName" class="col-sm-10 col-form-label">First Name</label>
                                <input type="text" name="FirstName" data-id="" class="input form-control" id="firstnamefield" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <label for="MiddleName" class="col-sm-10 col-form-label">Middle Name</label>
                                <input type="text" name="MiddleName" data-id="" class="input form-control" id="middlenamefield" placeholder="Middle Name" maxlength="2">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Address:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Address" class="input form-control" id="addressfield" placeholder="Address">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="PhoneNo" class="col-sm-2 col-form-label">Phone no:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="PhoneNo" class="input form-control" id="phone" placeholder="Phone No.">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="TypeId" class="col-sm-2 col-form-label">Type:</label>
                              <div class="col-sm-10">
                                <select class="form-control" data-id="" name="TypeId " id="typefield">
                                  <?php
                                  $stmttype = $conn->prepare('SELECT * FROM type WHERE Deleted = 0');

                                  // Execute the query
                                  $stmttype->execute();

                                  // Get the result
                                  $typeresult = $stmttype->get_result();

                                  // Check if there are rows to fetch
                                  if ($typeresult->num_rows > 0) {
                                    $type = array();
                                    while ($typerow = $typeresult->fetch_assoc()) {
                                      echo '<option value="' . $typerow['TypeId'] . '">' . $typerow['Type'] . '</option>';
                                      $type[] = $typerow;
                                    }
                                  } else {
                                    $type = "1";
                                  }
                                  ?>


                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="CourseID" class="col-sm-2 col-form-label">Course:</label>
                              <div class="col-sm-10">
                                <select class="form-control" data-id="" name="CourseID " id="coursefield">
                                  <?php
                                  $coursestmt = $conn->prepare('SELECT * FROM course WHERE Deleted = 0');

                                  // Execute the query
                                  $coursestmt->execute();

                                  // Get the result
                                  $courseresult = $coursestmt->get_result();
                                  if ($courseresult->num_rows > 0) {
                                    $course = array();
                                    while ($courserow = $courseresult->fetch_assoc()) {
                                      echo '<option value="' . $courserow['CourseID'] . '">' . $courserow['Course'] . '</option>';
                                      $course[] = $courserow;
                                    }
                                  } else {
                                    $course = "1";
                                  }


                                  ?>


                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Banned" class="col-sm-2 col-form-label">Banned:</label>
                              <div class="col-sm-10">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="Banned" data-id="" class="custom-control-input" id="banned">
                                  <label class="custom-control-label" for="banned"></label>
                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Remarks" class="col-sm-2 col-form-label">Remarks:</label>
                              <div class="col-sm-10">
                                <textarea type="text" data-id="" name="Remarks" class="input form-control" id="remarksfield" placeholder=""></textarea>
                              </div>
                            </div>


                            <div class="form-group row">
                              <label for="Encoder" class="col-sm-2 col-form-label">Encoder:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Encoder" class="input form-control" id="encoder" placeholder="">
                              </div>
                            </div>




                          </form>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="card-footer-content">
                          <a class="text-right" id="showing">Showing items 0-0</a>
                          <div class="btn-group float-right" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mr-1" type="button" id="nextBtn1">
                              Next
                            </button>
                            <button class="btn btn-primary mr-1" id="prevBtn1" type="button">
                              Prev
                            </button>
                            <button class="history btn btn-primary mr-1" type="button" data-toggle="modal" data-target="#history">
                              History
                            </button>
                            <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                            <button class="btn btn-warning" id="drop1" class="drop" type="button">
                              DROP
                            </button>
                            <a class="btn btn-success" id="addt1">
                              ADD </a>
                              <?php
                            }
                            ?>
                          </div>
                        </div>

                      </div>
                    </div>
                   
                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                      <a class="float-left" href="#" id="viewts" style="text-decoration:none; padding:10px;">Go back →</a>
                      <div class="card-body">
                        <div class="container mt-5">
                          <form action="">
                            <div class="form-group row">
                              <label for="MemberID" class="col-sm-2 col-form-label">MemberID:</label>
                              <div class="col-sm-2">
                                <input type="text" value="" name="MemberID" class="form-control" data-id="" id="memberid" placeholder="Memberid">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="fullname" class="col-sm-2 col-form-label">Name:</label>
                              <div class="col-sm-4">
                                <label for="LastName" class="col-sm-10 col-form-label">Last Name</label>
                                <input type="text" name="LastName" data-id="" class=" form-control" id="lastname" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">

                                <label for="FirstName" class="col-sm-10 col-form-label">First Name</label>
                                <input type="text" name="FirstName" data-id="" class=" form-control" id="firstname" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <label for="MiddleName" class="col-sm-10 col-form-label">Middle Name</label>
                                <input type="text" name="MiddleName" data-id="" class=" form-control" id="mname" placeholder="Middle Name" maxlength="2">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Address:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Address" class=" form-control" id="address" placeholder="Address">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="PhoneNo" class="col-sm-2 col-form-label">Phone no:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Phone no" class=" form-control" id="phoneno" placeholder="Phone no.">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="TypeId" class="col-sm-2 col-form-label">Type:</label>
                              <div class="col-sm-10">
                                <select class="form-control" data-id="" name="TypeId " id="typeid">
                                  <?php
                                  $stmttype = $conn->prepare('SELECT * FROM type WHERE Deleted = 0');

                                  // Execute the query
                                  $stmttype->execute();

                                  // Get the result
                                  $typeresult = $stmttype->get_result();

                                  // Check if there are rows to fetch
                                  if ($typeresult->num_rows > 0) {
                                    $type = array();
                                    while ($typerow = $typeresult->fetch_assoc()) {
                                      echo '<option value="' . $typerow['TypeId'] . '">' . $typerow['Type'] . '</option>';
                                      $type[] = $typerow;
                                    }
                                  } else {
                                    $type = "";
                                  }
                                  ?>


                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="CourseID" class="col-sm-2 col-form-label">Course:</label>
                              <div class="col-sm-10">
                                <select class="form-control" data-id="" name="CourseID " id="courseid">
                                  <?php
                                  $coursestmt = $conn->prepare('SELECT * FROM course WHERE Deleted = 0');

                                  // Execute the query
                                  $coursestmt->execute();

                                  // Get the result
                                  $courseresult = $coursestmt->get_result();
                                  if ($courseresult->num_rows > 0) {
                                    $course = array();
                                    while ($courserow = $courseresult->fetch_assoc()) {
                                      echo '<option value="' . $courserow['CourseID'] . '">' . $courserow['Course'] . '</option>';
                                      $course[] = $courserow;
                                    }
                                  } else {
                                    $course = "1";
                                  }


                                  ?>


                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Banned" class="col-sm-2 col-form-label">Banned:</label>
                              <div class="col-sm-10">
                                <div class="custom-control custom-checkbox">

                                  <input type="checkbox" name="Banned" data-id="" class="" id="banned" style="position: relative;right: 24px;">

                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Remarks" class="col-sm-2 col-form-label">Remarks:</label>
                              <div class="col-sm-10">
                                <textarea type="text" data-id="" name="Remarks" class=" form-control" id="remarks" placeholder="Remarks"></textarea>
                              </div>
                            </div>


                            <div class="form-group row">
                              <label for="Encoder" class="col-sm-2 col-form-label">Encoder:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Encoder" class=" form-control" id="encoderadd" placeholder="">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12 text-right">
                                <button class="btn btn-primary">Submit</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="card-footer">

                      </div>
                    </div>
                  </div>

                </section>
              </div>
            </div>
          </div>
  
        </div>

      </div>

    </div>

  </div>
  
  <script>
    $('#viewts').click(function(e) {
      e.preventDefault();
      $('#newtab a[href="#prev"]').tab('show');
      localStorage.setItem('currentTab1', 'viewt');
    });
    let name = "<?php echo $username ?>";
    $('document').ready(function() {
      $('#encoderadd').val(name);
    });

    $(document).on('input', '#encoderadd', function() {
      $('#encoderadd').val(name);
    });
    $('form').submit(function(event) {
        event.preventDefault();
        var memberid = $('#memberid').val();
        var lastname = $('#lastname').val();
        var firstname = $('#firstname').val();
        var mname = $('#mname').val();
        var address = $('#address').val();
        var phoneno = $('#phoneno').val();
        var typeid = $('#typeid').val();
        var courseid = $('#courseid').val();
        var remarks = $('#remarks').val();
        var encoderadd = $('#encoderadd').val();
        var data = {
          memberid: $('#memberid').val(),
          lastname: $('#lastname').val(),
          firstname: $('#firstname').val(),
          mname: $('#mname').val(),
          address: $('#address').val(),
          phoneno: $('#phoneno').val(),
          typeid: $('#typeid').val(),
          courseid: $('#courseid').val(),
          banned: $('#banned').is(':checked') ? 1 : 0,
          remarks: $('#remarks').val(),
          encoderadd: $('#encoderadd').val()
        }
      if (memberid === "" || lastname === "" || firstname === "" || mname === "" || address === "" || phoneno === "" || typeid === "" || courseid === "" || encoderadd === "") {
      alert("Please fill in all required fields.");
      } else {


        $.ajax({
          url: 'ADDMEMBER',
          type: 'POST',
          data: data,
          success: function(response) {
            if (response == "ok") {
              alert("Added Successfully");
              $('#memberid').val("");
              $('#lastname').val("");
              $('#firstname').val("");
              $('#mname').val("");
              $('#address').val("");
              $('#phoneno').val("");
              $('#banned').prop('checked', false);
              $('#remarks').val("");
            } else {
              alert(response);
            }


            reloadItems();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
          }
        });
      }
    });

    $(document).ready(function() {
      const fullscreenDiv = document.getElementById("fullscreenDiv");
      const fullscreenButton = document.getElementById("fullscreenButton");

      fullscreenButton.addEventListener("click", toggleFullscreen);

      // Add an event listener for the fullscreenchange event
      document.addEventListener("fullscreenchange", handleFullscreenChange);
      document.addEventListener("mozfullscreenchange", handleFullscreenChange);
      document.addEventListener("webkitfullscreenchange", handleFullscreenChange);

      function toggleFullscreen() {
        if (fullscreenDiv) {
          if (fullscreenDiv.requestFullscreen) {
            fullscreenDiv.requestFullscreen();
            localStorage.setItem("fullscreen", "true");
            setZoomLevel(fullscreenDiv, 0.75); // Set zoom to 75%
          } else if (fullscreenDiv.mozRequestFullScreen) {
            fullscreenDiv.mozRequestFullScreen();
            localStorage.setItem("fullscreen", "true");
            setZoomLevel(fullscreenDiv, 0.75); // Set zoom to 75%
          } else if (fullscreenDiv.webkitRequestFullscreen) {
            fullscreenDiv.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            localStorage.setItem("fullscreen", "true");
            setZoomLevel(fullscreenDiv, 0.75); // Set zoom to 75%
          }
        }
      }

      function handleFullscreenChange() {
        if (!document.fullscreenElement) {
          // Exit fullscreen, revert to normal zoom (100%)
          setZoomLevel(fullscreenDiv, 1); // Set zoom to 100%
          localStorage.removeItem("fullscreen");
        }
      }

      function setZoomLevel(element, zoomLevel) {
        element.style.zoom = zoomLevel;
      }
    });
    $('#addt1').click(function(e) {
      e.preventDefault();
      $('#newtab a[href="#add"]').tab('show');
      localStorage.setItem('currentTab1', 'addt')
    })
    $('#addts').click(function(e) {
      e.preventDefault();
      $('#myTabs a[href="#tab1"]').tab('show');
      $('#newtab a[href="#add"]').tab('show');
      localStorage.setItem('mcurrentTab1', 'tab1-tab');
      localStorage.setItem('currentTab1', 'addt');
    })

    function isValidYear(year) {
      return !isNaN(year) && Number.isInteger(+year) && year >= 1 && year <= 9999;
    }
    $('#coursefield').change(function() {

      var elem = $(this);
      newValue = $(this).val();
      var news = newValue;
      var colName = $(this).attr('name');

      var empId = $("#drop").attr('data-id');

      let lastname = $('#lastnamefield').val();
      let firstname = $('#firstnamefield').val();
      let middlename = $('#middlenamefield').val();
      $.ajax({
        url: 'updatemember',
        method: 'post',
        data: {
          firstname: firstname,
          lastname: lastname,
          middlename: middlename,
          empId: empId,
          colName: colName,
          newValue: newValue,
        },
        success: function(respone) {
          $(elem).parent().val(newValue);
          reloadItems();
          if (respone != '') {
            alert(respone);
          } else {
            if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
              var currentDate = new Date();

              // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
              var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
              localStorage.setItem('edittime', formattedDate);
              localStorage.setItem('saveid', empId)
            }

            var currenhistory = localStorage.getItem('historystorage') || '';
            var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
            currenhistory += (currenhistory ? '\n' : '') + newValue;
            localStorage.setItem('historystorage', currenhistory);
          }

        }
      });
    })



    $('#typefield').change(function() {

      var elem = $(this);
      var newValue = $(this).val();
      var news = newValue;
      var colName = $(this).attr('name');

      var empId = $("#drop").attr('data-id');

      let lastname = $('#lastnamefield').val();
      let firstname = $('#firstnamefield').val();
      let middlename = $('#middlenamefield').val();
      $.ajax({
        url: 'updatemember',
        method: 'post',
        data: {
          firstname: firstname,
          lastname: lastname,
          middlename: middlename,
          empId: empId,
          colName: colName,
          newValue: newValue,
        },
        success: function(respone) {
          $(elem).parent().val(newValue);
          reloadItems();
          if (respone != '') {
            alert(respone);
          } else {
            if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
              var currentDate = new Date();

              // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
              var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
              localStorage.setItem('edittime', formattedDate);
              localStorage.setItem('saveid', empId)
            }

            var currenhistory = localStorage.getItem('historystorage') || '';
            var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
            currenhistory += (currenhistory ? '\n' : '') + newValue;
            localStorage.setItem('historystorage', currenhistory);
          }

        }
      });
    });

    var oldValue = null;
    var memid = null;
    $(document).on('click', '.input', function() {
      oldValue = $(this).val();
      var colName = $(this).attr('name');
      if (colName == 'MemberID') {
        memid = $(this).val();
      }
    });



    var newValue = null;


    $(document).on('change', '.input', function() {
      var empId;
      var elem = $(this);
      newValue = $(this).val();
      var newv = newValue;
      var colName = $(this).attr('name');
      if (colName == 'PhoneNo') {
        var phone = $(this).val(); // get the value from the current element

        var phoneRegex = /^(09|\+639)\d{9}$/;
        if (!phoneRegex.test(phone)) {
          alert("Invalid phone number");
          reloadItems();
        } else {
          empId = $("#drop").attr('data-id');
          let lastname = $('#lastnamefield').val();
          let firstname = $('#firstnamefield').val();
          let middlename = $('#middlenamefield').val();

          var news = newValue;
          if (newValue != oldValue) {
            $.ajax({
              url: 'updatemember',
              method: 'post',
              data: {
                firstname: firstname,
                lastname: lastname,
                middlename: middlename,
                empId: empId,
                colName: colName,
                newValue: newValue,
              },
              success: function(respone) {
                $(elem).parent().val(newv);
                reloadItems();

                if (respone != '') {
                  alert(respone);

                } else {
                  if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                    var currentDate = new Date();

                    // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                    var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                    localStorage.setItem('edittime', formattedDate);
                    localStorage.setItem('saveid', empId)
                  }

                  var currenhistory = localStorage.getItem('historystorage') || '';
                  var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                  currenhistory += (currenhistory ? '\n' : '') + newValue;
                  localStorage.setItem('historystorage', currenhistory);
                }

              }
            });
          } else {
            $(this).parent().val(oldValue);
          }
        }

      } else if (colName == 'SchoolYearFrom' || colName == 'SchoolYearTo') {
        var schoolyearfrom = $('input[name="SchoolYearFrom"]').val();
        var schoolyearto = $('input[name="SchoolYearTo"]').val();

        if (isValidYear(newValue) == false) {
          alert("Invalid year");
          reloadItems();
        } else if (colName == "SchoolYearTo" && schoolyearfrom > newValue) {
          // Code to execute when "schoolyear to" is greater than "schoolyear from"
          alert("Not Valid school year range");
          reloadItems();


        } else if (colName == "SchoolYearFrom" && schoolyearto < newValue) {
          // Code to execute when "schoolyear to" is greater than "schoolyear from"
          alert("Not Valid school year range");
          reloadItems();


        } else {
          empId = $("#drop").attr('data-id');
          let lastname = $('#lastnamefield').val();
          let firstname = $('#firstnamefield').val();
          let middlename = $('#middlenamefield').val();

          var news = newValue;
          if (newValue != oldValue) {
            $.ajax({
              url: 'updatemember',
              method: 'post',
              data: {
                firstname: firstname,
                lastname: lastname,
                middlename: middlename,
                empId: empId,
                colName: colName,
                newValue: newValue,
              },
              success: function(respone) {
                $(elem).parent().val(newv);
                reloadItems();

                if (respone != '') {
                  alert(respone);

                } else {
                  if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                    var currentDate = new Date();

                    // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                    var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                    localStorage.setItem('edittime', formattedDate);
                    localStorage.setItem('saveid', empId)
                  }

                  var currenhistory = localStorage.getItem('historystorage') || '';
                  var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                  currenhistory += (currenhistory ? '\n' : '') + newValue;
                  localStorage.setItem('historystorage', currenhistory);
                }

              }
            });
          } else {
            $(this).parent().val(oldValue);
          }
        }





      } else {

        if (colName == 'MemberID') {
          if (newValue == '') {
            alert("Member ID cannot be empty");
            reloadItems();
          } else {
            empId = memid;
            let lastname = $('#lastnamefield').val();
            let firstname = $('#firstnamefield').val();
            let middlename = $('#middlenamefield').val();

            var news = newValue;
            if (newValue != oldValue) {
              $.ajax({
                url: 'updatemember',
                method: 'post',
                data: {
                  firstname: firstname,
                  lastname: lastname,
                  middlename: middlename,
                  empId: empId,
                  colName: colName,
                  newValue: newValue,
                },
                success: function(respone) {
                  $(elem).parent().val(newv);
                  reloadItems();

                  if (respone != '') {
                    alert(respone);

                  } else {
                    if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                      var currentDate = new Date();

                      // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                      var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                      localStorage.setItem('edittime', formattedDate);
                      localStorage.setItem('saveid', empId)
                    }

                    var currenhistory = localStorage.getItem('historystorage') || '';
                    var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                    currenhistory += (currenhistory ? '\n' : '') + newValue;
                    localStorage.setItem('historystorage', currenhistory);
                  }

                }
              });
            } else {
              $(this).parent().val(oldValue);
            }
          }

        } else {
          empId = $("#drop").attr('data-id');

          let lastname = $('#lastnamefield').val();
          let firstname = $('#firstnamefield').val();
          let middlename = $('#middlenamefield').val();

          var news = newValue;
          if (newValue != oldValue) {
            $.ajax({
              url: 'updatemember',
              method: 'post',
              data: {
                firstname: firstname,
                lastname: lastname,
                middlename: middlename,
                empId: empId,
                colName: colName,
                newValue: newValue,
              },
              success: function(respone) {
                $(elem).parent().val(newv);
                reloadItems();

                if (respone != '') {
                  alert(respone);

                } else {
                  if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                    var currentDate = new Date();

                    // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                    var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                    localStorage.setItem('edittime', formattedDate);
                    localStorage.setItem('saveid', empId)
                  }

                  var currenhistory = localStorage.getItem('historystorage') || '';
                  var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                  currenhistory += (currenhistory ? '\n' : '') + newValue;
                  localStorage.setItem('historystorage', currenhistory);
                }

              }
            });
          } else {
            $(this).parent().val(oldValue);
          }
        }
      }

    });

    var course = <?php echo json_encode($course); ?>;

    var type = <?php echo json_encode($type); ?>;
    var items = <?php echo json_encode($items); ?>;

    var filtered1;

    var currentIndex = parseInt(localStorage.getItem('currentIndex1')) || 0;
    var item2 = items.slice();

    function reloadItems() {
      $.ajax({
        url: 'RELOAD_A', // Change this to the correct path to your PHP file
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          items = data;
          showItem(currentIndex);
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }
    var formChanged = false;

    $(document).on('input', '.input', function() {
      formChanged = true;
    });




    $(document).ready(function() {
      let currentTab = localStorage.getItem('currentTab1');
      let mastertab = localStorage.getItem('mcurrentTab1');

      if (mastertab == null) {
        $('#tab1-tab').addClass('active');
        $('#tab1').addClass('active show');
      } else if (mastertab == 'tab1-tab') {
        $('#tab1-tab').addClass('active');
        $('#tab1').addClass('active show');

        if (currentTab == null) {
          $('#addt').removeClass('active');
          $('#viewt').addClass('active');
          $('#add').removeClass('show active');
          $('#prev').addClass('show active');
          localStorage.setItem('currentTab', 'viewt');
        } else if (currentTab === 'viewt') {
          $('#addt').removeClass('active');
          $('#viewt').addClass('active');
          $('#add').removeClass('show active');
          $('#prev').addClass('show active');
        } else if (currentTab === 'tab2-tab') {
          $('#tab2-tab').addClass('active show');
        } else {
          $('#addt').addClass('active');
          $('#viewt').removeClass('active');
          $('#add').addClass('show active');
          $('#prev').removeClass('show active');
        }
      } else if (mastertab == 'tab2-tab') {
        $('#tab2-tab').addClass('active');
        $('#tab2').addClass('show active');
      } else if (mastertab == 'tab3-tab') {
        $('#tab3-tab').addClass('active');
        $('#tab3').addClass('show active');
        window.location.href = '/all_members_list.php';
      }

      $('#viewt').click(function() {
        localStorage.setItem('currentTab1', 'viewt');
      });
      $('#tab1-tab').click(function() {
        localStorage.setItem('mcurrentTab1', 'tab1-tab');

      });
      $('#tab2-tab').click(function() {
        localStorage.setItem('mcurrentTab1', 'tab2-tab');

      });
      $('#tab3-tab').click(function() {
        localStorage.setItem('mcurrentTab1', 'tab3-tab');
        location.reload();
      });
      $('#addt').click(function() {
        localStorage.setItem('currentTab1', 'addt');
      });
    });



    $(document).on('input', '#encoder', function() {
      var item = items[currentIndex];
      $('#encoder').val(item.Encoder);
    });

    $(document).on('change', '#filtertype', function() {
      let value = $(this).val();
      if ($(this).val() == '0') {

        if (typeof type == 'undefined') {
          $('#nodata').show();
        } else {
          $('#nodata').hide();
          items = item2;
          currentIndex = 0;
          showItem(currentIndex);
        }
      } else {

        $.ajax({
          type: 'POST', // Change the request method to POST
          url: 'GETFILTERED', // Replace with the actual path to your PHP script
          dataType: 'json',
          data: {
            type: value,

          },
          success: function(data) {
            $("#nodata").hide();
            filtered1 = data;
            showfiltered(0);
            currentIndex = 0;


          },
          error: function(xhr, status, error) {
            $("#nodata").show();
          }
        });


      }
    });

    function dateIsValid(date) {
      return !Number.isNaN(new Date(date).getTime());
    }

    function showfiltered(index) {

      var item = filtered1[index];
      $('#showing').text("Showing Records " + (index + 1) + " of " + filtered1.length);
      $('#showing1').text("Showing Records " + (index + 1) + " of " + items.length);
      $('#memberfield').val(item.MemberID);
      $('#lastnamefield').val(item.LastName);
      $('#firstnamefield').val(item.FirstName);
      $('#middlenamefield').val(item.MiddleName);
      $('#namefield').val(item.LastName + ", " + item.FirstName);
      $('#drop').attr('data-id', item.MemberID);
      $('#schoolyearto').val(item.SchoolYearTo);
      $('#schoolyearfrom').val(item.SchoolYearFrom);
      $('#studentid').val(item.student_id);
      $('#email').val(item.email);
      $('#booksborrowed').val(item.BooksBorrowed);
      var dateenlist = new Date(item.DateEnlist || '2024-05-28 00:00:00'); // Corrected variable name

      var dategrad = new Date(item.DatetoGrad || '2024-05-28 00:00:00'); // Corrected variable name

      if (!dateIsValid(item.DatetoGrad)) {
        $('#datetograd').val('1990-01-01');
      } else {
        var dategradformat = dategrad.toISOString().split('T')[0];
        $('#datetograd').val(dategradformat);
      }

      if (!dateIsValid(item.DateEnlist)) {
        $('#dateenlist').val('1990-01-01');
      } else {
        var dateenlistformat = dateenlist.toISOString().split('T')[0];
        $('#dateenlist').val(dateenlistformat);
      }





      $('#parentguardian').val(item.ParentGuardian);
      $('#employment').val(item.Employment);
      $('#headofschool').val(item.HeadOfSchool);
      $('#schoolyearto').attr('data-id', item.MemberID);
      $('#schoolyearfrom').attr('data-id', item.MemberID);
      $('#booksborrowed').attr('data-id', item.MemberID);
      $('#dateenlist').attr('data-id', item.MemberID);
      $('#datetograd').attr('data-id', item.MemberID);
      $('#parentguardian').attr('data-id', item.MemberID);
      $('#employment').attr('data-id', item.MemberID);
      $('#headofschool').attr('data-id', item.MemberID);
      $('#addressfield').val(item.Address);
      $('#phone').val(item.PhoneNo);
      $('#coursefield').val(item.CourseID);
      $('#banned').prop('checked', item.Banned == 1);
      $('#remarksfield').val(item.Remarks);
      $('#memberfield').attr('data-id', item.MemberID);
      $('#lastnamefield').attr('data-id', item.MemberID);
      $('#firstnamefield').attr('data-id', item.MemberID);
      $('#middlenamefield').attr('data-id', item.MemberID);
      $('#addressfield').attr('data-id', item.MemberID);
      $('#phone').attr('data-id', item.MemberID);
      $('#coursefield').attr('data-id', item.MemberID);
      $('#banned').attr('data-id', item.MemberID);
      $('#remarksfield').attr('data-id', item.MemberID);
      $('#typefield').val(item.TypeId);

      if (type && type[0] && type[0].TypeId !== undefined) {

        if (item.TypeId == type[0].TypeId) {
          $('#typefield').append("<option value=" + type[0].TypeId + " selected>" + type[0].Type + "</option>");
        }
      } else {

      }
      if (course && course[0] && course[0].CourseID !== undefined) {
        if (item.CourseID == course[0].CourseID) {
          $('#coursefield').append("<option value=" + course[0].CourseID + " selected>" + course[0].Course + "</option>");

        }
      } else {

      }




      $('#typefield').attr('data-id', item.MemberID);
      $('#encoder').val(item.Encoder);
    }

    function showItem(index) {
      var item = items[index];
      $('#drop').attr('data-id', item.MemberID);
      $('#showing').text("Showing Records " + (index + 1) + " of " + items.length);
      $('#showing1').text("Showing Records " + (index + 1) + " of " + items.length);
      $('#namefield').val(item.LastName + ", " + item.FirstName);

      $("#namefield").attr("readonly", true);

      $('#schoolyearto').val(item.SchoolYearTo);
      $('#schoolyearfrom').val(item.SchoolYearFrom);
      $('#studentid').val(item.student_id);
      $('#email').val(item.email);
      $('#booksborrowed').val(item.BooksBorrowed);
      var dateenlist = new Date(item.DateEnlist || '2024-05-28 00:00:00'); // Corrected variable name

      var dategrad = new Date(item.DatetoGrad || '2024-05-28 00:00:00'); // Corrected variable name

      if (!dateIsValid(item.DatetoGrad)) {
        $('#datetograd').val('1990-01-01');
      } else {
        var dategradformat = dategrad.toISOString().split('T')[0];
        $('#datetograd').val(dategradformat);
      }

      if (!dateIsValid(item.DateEnlist)) {
        $('#dateenlist').val('1990-01-01');
      } else {
        var dateenlistformat = dateenlist.toISOString().split('T')[0];
        $('#dateenlist').val(dateenlistformat);
      }


      $('#parentguardian').val(item.ParentGuardian);
      $('#parentguardian').val(item.ParentGuardian);
      $('#employment').val(item.Employment);
      $('#headofschool').val(item.HeadOfSchool);
      $('#memberfield').val(item.MemberID);
      $('#lastnamefield').val(item.LastName);
      $('#firstnamefield').val(item.FirstName);
      $('#middlenamefield').val(item.MiddleName);
      $('#addressfield').val(item.Address);
      $('#phone').val(item.PhoneNo);
      $('#coursefield').val(item.CourseID);
      $('#banned').prop('checked', item.Banned == 1);
      $('#remarksfield').val(item.Remarks);
      $('#memberfield').attr('data-id', item.MemberID);
      $('#lastnamefield').attr('data-id', item.MemberID);
      $('#firstnamefield').attr('data-id', item.MemberID);
      $('#middlenamefield').attr('data-id', item.MemberID);
      $('#addressfield').attr('data-id', item.MemberID);
      $('#phone').attr('data-id', item.MemberID);
      $('#coursefield').attr('data-id', item.MemberID);
      $('#banned').attr('data-id', item.MemberID);
      $('#remarksfield').attr('data-id', item.MemberID);
      $('#typefield').val(item.TypeId);
      $('#schoolyearto').attr('data-id', item.MemberID);
      $('#schoolyearfrom').attr('data-id', item.MemberID);
      $('#booksborrowed').attr('data-id', item.MemberID);
      $('#dateenlist').attr('data-id', item.MemberID);
      $('#datetograd').attr('data-id', item.MemberID);
      $('#parentguardian').attr('data-id', item.MemberID);
      $('#employment').attr('data-id', item.MemberID);
      $('#headofschool').attr('data-id', item.MemberID);


      if (type && type[0] && type[0].TypeId !== undefined) {

        if (item.TypeId == type[0].TypeId) {
          $('#typefield').append("<option value=" + type[0].TypeId + " selected>" + type[0].Type + "</option>");
        }
      } else {

      }
      if (course && course[0] && course[0].CourseID !== undefined) {
        if (item.CourseID == course[0].CourseID) {
          $('#coursefield').append("<option value=" + course[0].CourseID + " selected>" + course[0].Course + "</option>");


        }
        $('#memberfield').prop('disabled', false);
        $('#lastnamefield').prop('disabled', false);
        $('#firstnamefield').prop('disabled', false);
        $('#middlenamefield').prop('disabled', false); // corrected typo
        $('#addressfield').prop('disabled', false);
        $('#phone').prop('disabled', false);
        $('#coursefield').prop('disabled', false);
        $('#banned').prop('disabled', false);
        $('#remarksfield').prop('disabled', false);
        $('#typefield').prop('disabled', false);
        $('#encoder').prop('disabled', false);
        $('#prevBtn').prop('disabled', false);
        $('#nextBtn').prop('disabled', false);
        $('#drop').prop('disabled', false);
        $('.history').prop('disabled', false);
        $('#filtertype').prop('disabled', false);
      } else {

      }


      $('#typefield').attr('data-id', item.MemberID);
      $('#encoder').val(item.Encoder);


    }

    $('#prevBtn').on('click', function() {
      if ($('#filtertype').val() == '0') {
        if (currentIndex > 0) {
          currentIndex--;
          localStorage.setItem('currentIndex1', currentIndex);
          if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
            let id = localStorage.getItem('saveid');
            let edittime = localStorage.getItem('edittime');

            $.ajax({
              url: 'SAVEHISTORY',
              method: 'post',
              data: {
                empId: id,
                edittime: edittime,
                history: localStorage.getItem('historystorage')
              },
              success: function(respone) {
                localStorage.setItem('historystorage', 'Changes Made:\n');
                showItem(currentIndex);
              }
            });

          } else {
            showItem(currentIndex);
          }

        }
      } else {
        if (currentIndex > 0) {
          currentIndex--;
          localStorage.setItem('currentIndex1', currentIndex);
          showfiltered(currentIndex);

        }
      }

    });
    $('#prevBtn1').on('click', function() {
      if ($('#filtertype').val() == '0') {
        if (currentIndex > 0) {
          currentIndex--;
          localStorage.setItem('currentIndex1', currentIndex);
          if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
            let id = localStorage.getItem('saveid');
            let edittime = localStorage.getItem('edittime');

            $.ajax({
              url: 'SAVEHISTORY',
              method: 'post',
              data: {
                empId: id,
                edittime: edittime,
                history: localStorage.getItem('historystorage')
              },
              success: function(respone) {
                localStorage.setItem('historystorage', 'Changes Made:\n');
                showItem(currentIndex);
              }
            });

          } else {
            showItem(currentIndex);
          }

        }
      } else {
        if (currentIndex > 0) {
          currentIndex--;
          localStorage.setItem('currentIndex1', currentIndex);
          showfiltered(currentIndex);

        }
      }

    });

    $('#drop1').click(function() {

      $('#confirmationModal').modal('show');
    });

    document.getElementById("confirmButton").addEventListener("click", function() {
      var empid = $("#drop").attr('data-id');
      $.ajax({
        url: 'dropmember',
        method: 'post',
        data: {
          empId: empid,
        },
        success: function(respone) {
          reloadItems();

          localStorage.setItem('currentIndex1', 0);

          $('#confirmationModal').modal('hide'); // Close the modal
          $('#respondtextmodal').text(respone);
          $('#respondmodal').modal('show');

        }
      });

    });


    $('#drop').click(function() {

      $('#confirmationModal').modal('show');
    });
    $('#nextBtn').on('click', function() {
      if ($('#filtertype').val() == '0') {
        if (currentIndex < items.length - 1) {
          currentIndex++;
          localStorage.setItem('currentIndex1', currentIndex);
          if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
            let id = localStorage.getItem('saveid');
            let edittime = localStorage.getItem('edittime');
            $.ajax({
              url: 'SAVEHISTORY',
              method: 'post',
              data: {
                empId: id,
                edittime: edittime,
                history: localStorage.getItem('historystorage')
              },
              success: function(respone) {
                localStorage.setItem('historystorage', 'Changes Made:\n');
                showItem(currentIndex);
              }
            });


          } else {
            showItem(currentIndex);
          }

        }
      } else {
        if (currentIndex < filtered1.length - 1) {
          currentIndex++;
          localStorage.setItem('currentIndex1', currentIndex);

          showfiltered(currentIndex);
        }
      }

    });

    $('#nextBtn1').on('click', function() {
      if ($('#filtertype').val() == '0') {
        if (currentIndex < items.length - 1) {
          currentIndex++;
          localStorage.setItem('currentIndex1', currentIndex);
          if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
            let id = localStorage.getItem('saveid');
            let edittime = localStorage.getItem('edittime');
            $.ajax({
              url: 'SAVEHISTORY',
              method: 'post',
              data: {
                empId: id,
                edittime: edittime,
                history: localStorage.getItem('historystorage')
              },
              success: function(respone) {
                localStorage.setItem('historystorage', 'Changes Made:\n');
                showItem(currentIndex);
              }
            });


          } else {
            showItem(currentIndex);
          }

        }
      } else {
        if (currentIndex < filtered1.length - 1) {
          currentIndex++;
          localStorage.setItem('currentIndex1', currentIndex);

          showfiltered(currentIndex);
        }
      }

    });

    $(document).ready(function() {
      if (items.length == 0) {
        $('#nodata').show();
        $('#myTabs li:nth-child(2) a').addClass('disabled');

        $('#memberfield').prop('disabled', true);
        $('#lastnamefield').prop('disabled', true);
        $('#firstnamefield').prop('disabled', true);
        $('#middlenamefield').prop('disabled', true); // corrected typo
        $('#addressfield').prop('disabled', true);
        $('#phone').prop('disabled', true);
        $('#coursefield').prop('disabled', true);
        $('#banned').prop('disabled', true);
        $('#remarksfield').prop('disabled', true);
        $('#typefield').prop('disabled', true);
        $('#encoder').prop('disabled', true);
        $('#prevBtn').prop('disabled', true);
        $('#nextBtn').prop('disabled', true);
        $('#drop').prop('disabled', true);
        $('.history').prop('disabled', true);
        $('#filtertype').prop('disabled', true);



      } else {
        $('#memberfield').prop('disabled', true);
        $('#lastnamefield').prop('disabled', true);
        $('#firstnamefield').prop('disabled', true);
        $('#middlenamefield').prop('disabled', true); // corrected typo
        $('#addressfield').prop('disabled', true);
        $('#phone').prop('disabled', true);
        $('#coursefield').prop('disabled', true);
        $('#banned').prop('disabled', true);
        $('#remarksfield').prop('disabled', true);
        $('#typefield').prop('disabled', true);
        $('#encoder').prop('disabled', true);
        $('#prevBtn').prop('disabled', true);
        $('#nextBtn').prop('disabled', true);
        $('#drop').prop('disabled', true);
        $('.history').prop('disabled', true);
        $('#filtertype').prop('disabled', true);
        $('#nodata').hide();
        if (localStorage.getItem('historystorage') != 'Changes Made:\n') {

          localStorage.setItem('setC', 'ok');
          let id = localStorage.getItem('saveid');
          let edittime = localStorage.getItem('edittime');
          setTimeout(function() {
            showItem(currentIndex);
            $.ajax({
              url: 'SAVEHISTORY',
              method: 'post',
              data: {
                empId: id,
                edittime: edittime,
                history: localStorage.getItem('historystorage')
              },
              success: function(respone) {
                localStorage.setItem('historystorage', 'Changes Made:\n');


                localStorage.setItem('setC', '0');
              }
            });
          }, 1000);

        } else {
          showItem(currentIndex);
        }


      }

    });
    $(document).ready(function() {
      $(".searchs").on("keydown", function(event) {
        if (event.key === "Enter") {
          currentIndex++;
          if (currentIndex >= history.length) {
            currentIndex = history.length - 1;
          }
          showHistoryItem(currentIndex);
        }
      });
      $(document).on('input', '.searchs', function() {
        var searchTerm = $(".searchs").val();
        let id = $('#drop').attr('data-id');
        fetchHistoryData1(id, searchTerm);
        if (searchTerm == "") {
          fetchHistoryData(id);
        }
      });
      $("#history").on("show.bs.modal", function() {
        let id = $('#drop').attr('data-id');
        fetchHistoryData(id);
      });
      var currentIndex = 0;
      var history = []; // Will hold the fetched history data
      function fetchHistoryData1(id, search) {
        $.ajax({
          type: 'POST',
          url: 'CHECKHISTORY_s',
          data: {
            id: id,
            search: search
          },
          dataType: 'json',
          success: function(data) {
            if (data.length == 0) {
              $('#datetime').val("No Data");
              $('#inputField').val("No Data");
              $('#cpname').val("No Data");
              $('#comments').val('No Data');
            }
            history = data; // Use 'history' instead of 'items'
            currentIndex = 0; // Reset currentIndex
            if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
              let id = localStorage.getItem('saveid');
              let edittime = localStorage.getItem('edittime');
              $.ajax({
                url: 'SAVEHISTORY',
                method: 'post',
                data: {
                  empId: id,
                  search: search,
                  edittime: edittime,
                  history: localStorage.getItem('historystorage')
                },
                success: function(respone) {

                  localStorage.setItem('historystorage', 'Changes Made:\n');
                  showHistoryItem(currentIndex);
                }
              });


            } else {
              showHistoryItem(currentIndex);
            }



          }
        });
      }

      function fetchHistoryData(id) {
        $.ajax({
          type: 'POST',
          url: 'CHECKHISTORY',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(data) {
            history = data; // Use 'history' instead of 'items'
            currentIndex = 0; // Reset currentIndex
            if (localStorage.getItem('historystorage') != 'Changes Made:\n') {
              let id = localStorage.getItem('saveid');
              let edittime = localStorage.getItem('edittime');
              $.ajax({
                url: 'SAVEHISTORY',
                method: 'post',
                data: {
                  empId: id,
                  edittime: edittime,
                  history: localStorage.getItem('historystorage')
                },
                success: function(respone) {
                  localStorage.setItem('historystorage', 'Changes Made:\n');
                  showHistoryItem(currentIndex);
                }
              });


            } else {
              showHistoryItem(currentIndex);
            }



          }
        });
      }
      $("#banned").on("change", function() {
        var elem = $(this);
        newValue = $(this).val();
        var news = newValue;
        var colName = $(this).attr('name');

        var empId = $("#drop").attr('data-id');

        let lastname = $('#lastnamefield').val();
        let firstname = $('#firstnamefield').val();
        let middlename = $('#middlenamefield').val();
        if (this.checked) {

          $.ajax({
            url: 'updatemember',
            method: 'post',
            data: {
              firstname: firstname,
              lastname: lastname,
              middlename: middlename,
              empId: empId,
              colName: colName,
              newValue: 1,
            },
            success: function(respone) {
              $(elem).parent().val(newValue);
              reloadItems();
              if (respone != '') {
                alert(respone);
              } else {
                if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                  var currentDate = new Date();

                  // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                  var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                  localStorage.setItem('edittime', formattedDate);
                  localStorage.setItem('saveid', empId)
                }

                var currenhistory = localStorage.getItem('historystorage') || '';
                var newValue = "\n" + colName + ' =>True' // Replace this with the actual new value
                currenhistory += (currenhistory ? '\n' : '') + newValue;
                localStorage.setItem('historystorage', currenhistory);
              }

            }
          });
        } else {

          $.ajax({
            url: 'updatemember',
            method: 'post',
            data: {
              firstname: firstname,
              lastname: lastname,
              middlename: middlename,
              empId: empId,
              colName: colName,
              newValue: 0,
            },
            success: function(respone) {
              $(elem).parent().val(newValue);
              reloadItems();
              if (respone != '') {
                alert(respone);
              } else {
                if (localStorage.getItem('historystorage') == 'Changes Made:\n') {
                  var currentDate = new Date();

                  // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                  var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                  localStorage.setItem('edittime', formattedDate);
                  localStorage.setItem('saveid', empId)
                }

                var currenhistory = localStorage.getItem('historystorage') || '';
                var newValue = "\n" + colName + ' =>false' // Replace this with the actual new value
                currenhistory += (currenhistory ? '\n' : '') + newValue;
                localStorage.setItem('historystorage', currenhistory);
              }

            }
          });
        }
      });

      function showHistoryItem(index) {

        var item = history[index];
        if (history.length == 0) {
          $('#showing2').text("Showing Records " + (index) + " of " + history.length);

        } else {
          $('#showing2').text("Showing Records " + (index + 1) + " of " + history.length);
          $('#datetime').val(item.DateTime);
          $('#inputField').val(item.UserName);
          $('#cpname').val(item.ComputerName);
          $('#comments').val(item.Comments);
        }


      }




      $('#prevBtn2').on('click', function() {
        currentIndex--;
        if (currentIndex < 0) {
          currentIndex = 0;
        }
        showHistoryItem(currentIndex);
      });

      $('#nextBtn2').on('click', function() {
        currentIndex++;
        if (currentIndex >= history.length) {
          currentIndex = history.length - 1;
        }
        showHistoryItem(currentIndex);
      });

      $('#history').on('shown.bs.modal', function() {
        let id = $('#drop').attr('data-id');
        fetchHistoryData(id);

        function exitFullscreen() {
          if (document.fullscreenElement) {
            document.exitFullscreen();
            localStorage.removeItem("fullscreen");
            setZoomLevel(fullscreenDiv, 1); // Set zoom to 100%
          } else if (document.mozFullScreenElement) {
            document.mozCancelFullScreen();
            localStorage.removeItem("fullscreen");
            setZoomLevel(fullscreenDiv, 1); // Set zoom to 100%
          } else if (document.webkitFullscreenElement) {
            document.webkitExitFullscreen();
            localStorage.removeItem("fullscreen");
            setZoomLevel(fullscreenDiv, 1); // Set zoom to 100%
          }
        }


      });

      $('#history').on('hidden.bs.modal', function() {
        // Reload the page

      });
    });
    $("#reset").click(function() {
      localStorage.setItem('historystorage', 'Changes Made:\n');
      localStorage.setItem('edittime', '');
      localStorage.setItem('saveid', '');
      localStorage.setItem('currentIndex1', '0');
      currentIndex = parseInt(localStorage.getItem('currentIndex1'));

      showItem(currentIndex);
      alert("Application Reseted");
    });
  </script>
  <!-- /.app -->
  <!-- BEGIN BASE JS -->

  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- END BASE JS -->

  </script>
  <!-- BEGIN PLUGINS JS -->
  <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
  <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>


  <!-- END PLUGINS JS -->
  <!-- BEGIN THEME JS -->
  <script src="assets/javascript/main.min.js"></script>
  <script src="assets/javascript/main2.js"></script>
  <!-- END THEME JS -->
  <!-- BEGIN PAGE LEVEL JS -->
  <script src="assets/javascript/pages/dataTables.bootstrap.js"></script>


  <script>
    jQuery(window).on("load", function() {
      localStorage.setItem("topen", false);

    });
  </script>



  <!-- END PAGE LEVEL JS -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
  </body>

</html>