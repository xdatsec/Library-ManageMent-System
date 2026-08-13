<?php
session_start();
$_SESSION['locator'] = 'tr';
$_SESSION['members'] = 'false';
$username = '';
if (isset($_SESSION["loggedin"])) {
  include "modules/inc/connection.php";
  $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
} else {
  header('Location: /signin.php');
  exit;
}

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
  <meta property="og:title" content="Books Acquisition">
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

      padding: 0px;

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
  </style>
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>

  <div class="" style="margin:0px;padding:0px;">


    <!-- .wrapper -->
    <div class="" style="margin:0px;padding:0px;">
      <!-- .page -->
      <div class="" style="margin:0px;padding:0px;background-color:#408080;">
        <!-- .page-inner -->
        <div class="" style="margin:0px;padding:0px;">
          <!-- .page-title-bar -->

          <!-- /.page-title-bar -->
          <!-- .page-section -->
          <div class="card  mt-12" style="border-style: solid;border-color:#408080;background-color:white;">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Book Information</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Books Accessiom & Sub Table</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">List </a>
              </li>
            </ul>

            <div class="tab-content mt-3" id="myTabContent">
              <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <section class="card card-fluid" style="border-style: solid;border-color:#408080;">
                  <header class="card-header" style="display:none;">
                    <!-- .nav-tabs -->
                    <ul class="nav nav-tabs" id="newtab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" id="viewt" data-toggle="tab" href="#prev" role="tab" aria-controls="prev" aria-selected="true">View</a>
                      </li>
                      <li class="nav-item" style="display:none;">
                        <a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add</a>
                      </li>
                    </ul>
                    <!-- /.nav-tabs -->
                  </header>

                  <div class="tab-content">

                    <?php
                    $sql = "SELECT * FROM books WHERE Deleted = 0";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                      
                      
                      $stmt->execute();

                      
                      $result = $stmt->get_result();

                      
                      if ($result->num_rows > 0) {
                        $items = array();
                        while ($row = $result->fetch_assoc()) {
                          $items[] = $row;
                        }
                      } else {
                        echo "";
                        $items = array();
                      }
                    }

                    ?>

                    <div class="tab-pane fade show active" id="prev" role="tabpanel" aria-labelledby="prev-tab">
                      <div class="card-body">
                        <h1 id="nodata" style="display:none;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: black; z-index: 1; padding: 20px; color: green; font-family: 'Courier New', monospace; font-size: 20px; line-height: 1.2em; letter-spacing: 2px;">
                          No Books to show
                        </h1>
                        <div class="container mt-5">

                          <form>
                            <div class="form-group row">
                              <label for="title" class="col-sm-2 col-form-label">Title:</label>
                              <div class="col-sm-10">
                                <input type="text" value="" name="Title" class="input form-control" data-id="" id="title" placeholder="Book Title">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="author" class="col-sm-2 col-form-label">Author:</label>
                              <div class="col-sm-4">
                                <label for="author" class="col-sm-10 col-form-label">Last Name</label>
                                <input type="text" name="Author1LN" data-id="" class="input form-control" id="lastname" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <label for="author" class="col-sm-10 col-form-label">First Name</label>
                                <input type="text" name="Author1FN" data-id="" class="input form-control" id="firstname" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <label for="author" class="col-sm-10 col-form-label">Middle Name</label>
                                <input type="text" name="Author1MI" data-id="" class="input form-control" id="middlename" placeholder="Middle Name" maxlength="2">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="joint_author" class="col-sm-2 col-form-label">Joint Author:</label>
                              <div class="col-sm-4">
                                <input type="text" name="Author2LN" data-id="" class="input form-control" id="joint_lastname" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" name="Author2FN" name="Author2LN" data-id="" class="input form-control" id="joint_firstname" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="Author2MI" data-id="" class="input form-control" id="joint_middlename" placeholder="Middle Name" maxlength="2">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="joint_author" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-4">
                                <input type="text" name="Author3LN" data-id="" class="input form-control" id="joint_lastname1" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" name="Author3FN" data-id="" class="input form-control" id="joint_firstname1" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="Author3MI" data-id="" class="input form-control" id="joint_middlename1" placeholder="Middle Name" maxlength="2">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                              <div class="col-sm-10">
                                <select class="form-control" data-id="" name="SubjectID" id="subject">
                                  <?php
                                  $stmt1 = $conn->prepare('SELECT * FROM subject WHERE Type = "Books" AND  Deleted = 0');

                                  
                                  $stmt1->execute();

                                  
                                  $result1 = $stmt1->get_result();
                                  while ($row1 = $result1->fetch_assoc()) {
                                    echo '<option value="' . $row1['SubjectID'] . '">' . $row1['Subject'] . '</option>';
                                    $subjects[] = $row1;
                                  }


                                  ?>


                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="publisher" class="col-sm-2 col-form-label">Publisher:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="PublisherName" class="input form-control" id="publisher" placeholder="Publisher Name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="place_of_publication" class="col-sm-2 col-form-label">Place of Publication:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="PlaceofPublication" class="input form-control" id="place_of_publication" placeholder="Place of Publication">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="call_number" class="col-sm-2 col-form-label" style="padding-top:31px;">Call Number:</label>
                              <div class="col-sm-3">
                                <label for="booknumber" class="col-sm-6 col-form-label">Book No.</label>
                                <input type="text" data-id="" name="CallNum1" class="input form-control" id="booknumber" placeholder="Book Number">
                              </div>
                              <div class="col-sm-3">
                                <label for="authornumber" class="col-sm-6 col-form-label">Author No.</label>
                                <input type="text" data-id="" name="CallNum2" class="input form-control" id="authornumber" placeholder="Author Number">
                              </div>
                              <div class="col-sm-4">
                                <label for="encoder" class="col-sm-6 col-form-label">Encoder.</label>
                                <input type="text" data-id="" name="Encoder" class="form-control" id="encoder" placeholder="Encoder">
                              </div>
                            </div>

                          </form>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="card-footer-content">
                          <a class="text-right" id="showing">Showing items 0-0</a>
                          <div class="btn-group float-right" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mr-1" type="button" id="nextBtn">
                              Next
                            </button>
                            <button class="btn btn-primary mr-1" id="prevBtn" type="button">
                              Prev
                            </button>
                            <button class="btn btn-primary mr-1" type="button" data-toggle="modal" data-target="#history">
                              History
                            </button>
                            <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                            <button class="btn btn-warning" id="drop" class="drop" type="button">
                              DROP
                            </button>
                            <a class="btn btn-success" id="addt">
                              ADD </a>
                            <?php
                            }
                            ?>

                          
                          </div>
                        </div>

                      </div>

                    </div>


                    <script>
                      $('#addt').click(function(e) {
                        e.preventDefault();
                        $('#newtab a[href="#add"]').tab('show');
                        localStorage.setItem('currentTab', 'addt');
                      })
                      $(document).ready(function() {
                        $('#addts').click(function(e) {
                          e.preventDefault();
                          $('#myTabs a[href="#tab1"]').tab('show');
                          $('#newtab a[href="#add"]').tab('show');
                          localStorage.setItem('mcurrentTab', 'tab1-tab');
                          localStorage.setItem('currentTab', 'addt');
                        })
                        $('#viewts').click(function(e) {
                          e.preventDefault();
                          $('#newtab a[href="#prev"]').tab('show');
                          localStorage.setItem('currentTab', 'viewt');
                        });
                         $('#drops').click(function() {
                        var empId = $('#drop').attr('data-id');
                        var confirmed = confirm('Are you sure, Do you want drop this book?');

                        
                        if (confirmed) {
                          $.ajax({
                            url: 'dropbook',
                            method: 'post',
                            data: {
                              empId: empId,
                            },
                            success: function(respone) {

                              reloadItems();
                              localStorage.setItem('currentIndex', 0);
                              location.reload();

                            }
                          });
                        }
                      });
                      });
                      $('#subject').change(function() {
                        var elem = $(this);
                        newValue = $(this).val();
                        var empId = $(this).attr('data-id');
                        var colName = $(this).attr('name');
                        let subject = $(this).val();
                        $.ajax({
                          url: 'updatebook',
                          method: 'post',
                          data: {
                            empId: empId,
                            colName: colName,
                            newValue: newValue,
                            subject: subject,
                          },
                          success: function(respone) {
                            $(elem).parent().val(newValue);
                            reloadItems();
                            if (respone != '') {
                              alert(respone);
                            }

                          }
                        });
                      });

                      var oldValue = null;
                      $(document).on('click', '.input', function() {
                        oldValue = $(this).val();
                      });
                      var newValue = null;
                      $(document).on('blur', '.input', function() {
                        var elem = $(this);
                        newValue = $(this).val();
                        var empId = $(this).attr('data-id');
                        var colName = $(this).attr('name');

                      });

                      $(document).on('input', '.input', function() {
                        var elem = $(this);
                        newValue = $(this).val();
                        var empId = $(this).attr('data-id');
                        var colName = $(this).attr('name');

                        if (newValue != oldValue) {
                          $.ajax({
                            url: 'updatebook',
                            method: 'post',
                            data: {
                              empId: empId,
                              colName: colName,
                              newValue: newValue,
                            },
                            success: function(respone) {
                              $(elem).parent().val(newValue);
                              reloadItems();
                              if (respone != '') {
                                alert(respone);
                              }
                            }
                          });
                        } else {
                          $(this).parent().val(oldValue);
                        }
                      });


                      var subjects = <?php echo json_encode($subjects); ?>;
                      var items = <?php echo json_encode($items); ?>;
                      var currentIndex = parseInt(localStorage.getItem('currentIndex')) || 0;
                      var item2 = items.slice();

                      function reloadItems() {
                        $.ajax({
                          url: 'RELOAD', 
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
                      $(document).ready(function() {
                        $(document).ready(function() {
                          let currentTab = localStorage.getItem('currentTab');
                          let mastertab = localStorage.getItem('mcurrentTab');

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

                              if (typeof $('#myTable2').attr('data-id') != 'undefined') {
                                $('#tab2-tab').addClass('active show');
                              } else {
                                $('#tab1-tab').addClass('active');
                                $('#tab1').addClass('active show');
                              }
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
                            window.location.href = '/all_books.php';
                          }

                          $('#viewt').click(function() {
                            localStorage.setItem('currentTab', 'viewt');
                          });
                          $('#tab1-tab').click(function() {
                            localStorage.setItem('mcurrentTab', 'tab1-tab');
                            location.reload();
                          });
                          $('#tab2-tab').click(function() {


                            if (typeof $('#myTable2').attr('data-id') != 'undefined') {
                              localStorage.setItem('mcurrentTab', 'tab2-tab');
                              location.reload();
                            } else {
                              localStorage.setItem('mcurrentTab', 'tab1-tab');
                            }


                          });
                          $('#tab3-tab').click(function() {
                            localStorage.setItem('mcurrentTab', 'tab3-tab');
                            location.reload();
                          });
                          $('#addt').click(function() {
                            localStorage.setItem('currentTab', 'addt');
                          });
                        });

                      });

                      $(document).on('input', '#encoder', function() {
                        var item = items[currentIndex];
                        $('#encoder').val(item.Encoder);
                      });

                      function showItem(index) {
                        var item = items[index];

                        $('#showing5').text("Showing Records " + (index + 1) + " of " + items.length);
                        $('#showing').text("Showing Records " + (index + 1) + " of " + items.length);
                        $('#title').val(item.Title);
                        $('#drop').attr('data-id', item.BookID);
                        $('#title').attr('data-id', item.BookID);
                        $('#lastname').val(item.Author1LN);
                        $('#lastname').attr('data-id', item.BookID);
                        $('#firstname').val(item.Author1FN);
                        $('#firstname').attr('data-id', item.BookID);
                        $('#middlename').val(item.Author1MI);
                        $('#middlename').attr('data-id', item.BookID);
                        $('#joint_lastname').val(item.Author2LN);
                        $('#joint_lastname').attr('data-id', item.BookID);
                        $('#joint_firstname').val(item.Author2FN);
                        $('#joint_firstname').attr('data-id', item.BookID);
                        $('#joint_middlename').val(item.Author2MI);
                        $('#joint_middlename').attr('data-id', item.BookID);
                        $('#joint_lastname1').val(item.Author3LN);
                        $('#joint_lastname1').attr('data-id', item.BookID);
                        $('#joint_firstname1').val(item.Author3FN);
                        $('#joint_firstname1').attr('data-id', item.BookID);
                        $('#joint_middlename1').val(item.Author3MI);
                        $('#joint_middlename1').attr('data-id', item.BookID);

                        $('#subject').val(item.SubjectID);
                        if (item.SubjectID == subjects[0].SubjectID) {
                          $('#subject').append("<option value=" + subjects[0].SubjectID + " selected>" + subjects[0].Subject + "</option>")
                        }
                        $('#subject').attr('data-id', item.BookID);
                        $('#publisher').val(item.PublisherName);
                        $('#publisher').attr('data-id', item.BookID);
                        $('#place_of_publication').val(item.PlaceofPublication);
                        $('#place_of_publication').attr('data-id', item.BookID);
                        $('#booknumber').val(item.CallNum1);
                        $('#booknumber').attr('data-id', item.BookID);
                        $('#authornumber').val(item.CallNum2);
                        $('#authornumber').attr('data-id', item.BookID);
                        $('#encoder').val(item.Encoder);
                        $('#myTable2').attr('data-id', item.BookID);
                      }

                      $('#prevBtn').on('click', function() {
                        if (currentIndex > 0) {
                          currentIndex--;
                          localStorage.setItem('currentIndex', currentIndex);
                          showItem(currentIndex);
                          localStorage.setItem('localid', '')
                        }
                      });
                      $('#drop').click(function() {
                        var empId = $(this).attr('data-id');
                        var confirmed = confirm('Are you sure, Do you want drop this book?');

                        
                        if (confirmed) {
                          $.ajax({
                            url: 'dropbook',
                            method: 'post',
                            data: {
                              empId: empId,
                            },
                            success: function(respone) {

                              reloadItems();
                              localStorage.setItem('currentIndex', 0);
                              location.reload();

                            }
                          });
                        }
                      });
                     


                      $('#nextBtn').on('click', function() {
                        if (currentIndex < items.length - 1) {
                          currentIndex++;
                          localStorage.setItem('currentIndex', currentIndex);
                          localStorage.setItem('localid', '')
                          showItem(currentIndex);
                        }

                      });

                      $(document).ready(function() {

                        if (items.length == 0) {
                          $('#nodata').show();
                          $('#myTabs li:nth-child(2) a').addClass('disabled');

                        } else {
                          $('#nextBtn5').on('click', function() {
                            if (currentIndex < items.length - 1) {
                              currentIndex++;
                              localStorage.setItem('currentIndex', currentIndex);
                              localStorage.setItem('localid', '')
                              showItem(currentIndex);
                              window.location.reload()
                            }

                          });

                          $('#prevBtn5').on('click', function() {
                            if (currentIndex > 0) {
                              currentIndex--;
                              localStorage.setItem('currentIndex', currentIndex);
                              showItem(currentIndex);
                              localStorage.setItem('localid', '')
                              window.location.reload()
                            }
                          });
                          showItem(currentIndex);
                        }

                      });
                    </script>



                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">

                      <a class="float-left" href="#" id="viewts" style="text-decoration:none; padding:10px;">Go back →</a>
                      <div class="card-body">
                        <div class="container mt-5">

                          <form action="">
                            <div class="form-group row">
                              <label for="title" class="col-sm-2 col-form-label">Title:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="title2" placeholder="Book Title">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="author" class="col-sm-2 col-form-label">Author:</label>
                              <div class="col-sm-4">

                                <input type="text" class="form-control" id="lastname2" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="firstname2" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="middlename2" placeholder="Middle Name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="joint_author" class="col-sm-2 col-form-label">Joint Author:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="joint_lastname2" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="joint_firstname2" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="joint_middlename2" placeholder="Middle Name">
                              </div>

                            </div>
                            <div class="form-group row">
                              <label for="joint_author" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="joint_lastname22" placeholder="Last Name">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="joint_firstname22" placeholder="First Name">
                              </div>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="joint_middlename22" placeholder="Middle Name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="subject2" class="col-sm-2 col-form-label">Subject:</label>
                              <div class="col-sm-10">
                                <select class="form-control" id="subject2">
                                  <?php
                                  $stmt11 = $conn->prepare('SELECT * FROM subject WHERE Type = "Books" AND  Deleted = 0');

                                  
                                  $stmt11->execute();

                                  
                                  $result11 = $stmt11->get_result();
                                  while ($row11 = $result11->fetch_assoc()) {
                                    echo '<option value="' . $row11['SubjectID'] . '">' . $row11['Subject'] . '</option>';
                                  }


                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="publisher" class="col-sm-2 col-form-label">Publisher:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="publisher2" placeholder="Publisher Name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="place_of_publication" class="col-sm-2 col-form-label">Place of Publication:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="place_of_publication2" placeholder="Place of Publication">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="call_number" class="col-sm-2 col-form-label">Call Number:</label>
                              <div class="col-sm-3">
                                <input type="text" class="form-control" id="booknumber2" placeholder="Book Number">
                              </div>
                              <div class="col-sm-3">
                                <input type="text" class="form-control" id="authornumber2" placeholder="Author Number">
                              </div>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="encoder2" placeholder="Encoder">
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
              <script>
                let name = "<?php echo $username ?>";
                $('document').ready(function() {
                  $('#encoder2').val(name);
                });

                $(document).on('input', '#encoder2', function() {
                  $('#encoder2').val(name);
                });
                $('form').submit(function(event) {
                  event.preventDefault();
                  var data = {
                    title2: $('#title2').val(),
                    lastname2: $('#lastname2').val(),
                    firstname2: $('#firstname2').val(),
                    middlename2: $('#middlename2').val(),
                    joint_lastname2: $('#joint_lastname2').val(),
                    joint_firstname2: $('#joint_firstname2').val(),
                    joint_middlename2: $('#joint_middlename2').val(),
                    joint_lastname22: $('#joint_lastname22').val(),
                    joint_firstname22: $('#joint_firstname22').val(),
                    joint_middlename22: $('#joint_middlename22').val(),
                    subject2: $('#subject2').val(),
                    publisher2: $('#publisher2').val(),
                    place_of_publication2: $('#place_of_publication2').val(),
                    booknumber2: $('#booknumber2').val(),
                    authornumber2: $('#authornumber2').val(),
                    encoder2: $('#encoder2').val()
                  };
                  if (data.title2 == "" || data.lastname2 == "" || data.firstname2 == "" || data.middlename2 == "" || data.joint_lastname2 == "" || data.joint_firstname2 == "" || data.joint_middlename2 == "" || data.joint_lastname22 == "" || data.joint_firstname22 == "" || data.joint_middlename22 == "" || data.subject2 == "" || data.publisher2 == "" || data.place_of_publication2 == "" || data.booknumber2 == "" || data.authornumber2 == "" || data.encoder2 == "") {
                    alert("Please fill up all fields");
                  } else {

                    $.ajax({
                      url: 'ADD_BOOK',
                      type: 'POST',
                      data: data,
                      success: function(response) {
                        alert(response);

                        $('#title2').val("");
                        $('#lastname2').val("");
                        $('#firstname2').val("");
                        $('#middlename2').val("");
                        $('#joint_lastname2').val("");
                        $('#joint_firstname2').val("");
                        $('#joint_middlename2').val("");
                        $('#joint_lastname22').val("");
                        $('#joint_firstname22').val("");
                        $('#joint_middlename22').val("");
                        $('#publisher2').val("");
                        $('#place_of_publication2').val("");
                        $('#booknumber2').val("");
                        $('#authornumber2').val("");
                        reloadItems();
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error: ' + textStatus + ' - ' + errorThrown);
                      }
                    });
                  }
                });
              </script>

              <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="page-section">

                  <!-- .card -->
                  <section class="card card-fluid" style="border-style: solid;border-color:#408080;">
                    <!-- .card-header -->

                    <!-- /.card-header -->
                    <!-- .card-body -->
                    <div class="card-body">

                      <!-- .form-group -->


                      <!--delete modal-->

                      <!--end delete modal-->

                      <!-- /.form-group -->
                      <!-- .table -->
                      <table id="myTable2" class="table" style="font-size:12px;">
                        <!-- thead -->
                        <thead>
                          <tr>

                            <th></th>
                            <th>ItemNo</th>
                            <th>CourseID</th>
                            <th>CopyRightYear</th>
                            <th>DateReceived</th>
                            <th>ISBNNumber</th>
                            <th>EditionNumber</th>
                            <th>PurchasePrice</th>
                            <th>Supplier</th>
                            <th>Recommendedby</th>
                            <th>BPages</th>
                            <th>Encoder</th>
                          </tr>
                        </thead>
                        <!-- /thead -->
                      </table>
                      <!-- /.table -->
                    </div>
                    <div class="card-body">

                      <!-- .form-group -->


                      <!--delete modal-->

                      <!--end delete modal-->

                      <!-- /.form-group -->
                      <!-- .table -->
                      <div class="container">
                        <p id="noofdata"></p>
                        <div class="table-responsive" style="font-size:12px;height: 250px;overflow-x:auto;">
                          <table class="table " id="myTable3">
                            <thead>
                              <tr>
                                <th></th>
                                <th style="position: sticky; top: 0; background: white;">Item No</th>
                                <th style="position: sticky; top: 0; background: white;">Accesion No</th>
                                <th style="position: sticky; top: 0; background: white;">Copies</th>
                                <th style="position: sticky; top: 0; background: white;">Location</th>
                                <th style="position: sticky; top: 0; background: white;">Book Location</th>
                                <th style="position: sticky; top: 0; background: white;">Source</th>
                                <th style="position: sticky; top: 0; background: white;">Donor</th>
                                <th style="position: sticky; top: 0; background: white;">SubClass1</th>
                                <th style="position: sticky; top: 0; background: white;">SubClass2</th>
                                <th style="position: sticky; top: 0; background: white;">SubClass3</th>
                                <th style="position: sticky; top: 0; background: white;">SubClass4</th>
                                <th style="position: sticky; top: 0; background: white;">Replace For</th>
                                <th style="position: sticky; top: 0; background: white;">Remarks</th>
                                <th style="position: sticky; top: 0; background: white;">Mr Page</th>
                                <th style="position: sticky; top: 0; background: white;">Status</th>
                                <th style="position: sticky; top: 0; background: white;">Encoder</th>


                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- /.table -->
                    </div>
                    <!-- /.card-body -->
                  </section>
                  <!-- /.card -->
                </div>
                <div class="card-footer">
                  <div class="card-footer-content">
                    <a class="text-right" id="showing5">Showing items 0-0</a>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                      <button class="btn btn-primary mr-1" type="button" id="nextBtn5">
                        Next
                      </button>
                      <button class="btn btn-primary mr-1" id="prevBtn5" type="button">
                        Prev
                      </button>
                      <button class="btn btn-primary mr-1" type="button" data-toggle="modal" data-target="#history">
                        History
                      </button>
                      <?php
                      if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                      <button class="btn btn-warning" id="drops" class="drop" type="button">
                        DROP
                      </button>
                      <a class="btn btn-success" id="addts">
                        ADD </a>
                      <?php
                      }?>
                      
                    </div>
                  </div>

                </div>
                <!-- /.page-section -->
                <!-- /.page-section -->
              </div>
              <!-- /.page-inner -->
            </div>
            <!-- /.page -->
          </div>
          <!-- /.wrapper -->
          </main>
          <!-- /.app-main -->

        </div>
      </div>

    </div>
  </div>
  </div>

  <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="
">
      <div class="modal-content rounded-0">
        <div class="modal-header rounded-0" id="head" style="color:black;">
          <h5 class="modal-title" id="myModalLabel">History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:black;">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="
    height: 318px;
">
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
                  <div class="col-sm-10">
                    <textarea class="form-control" value="No Data" id="comments" rows="3" disabled></textarea>
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

            <button id="prevBtn1" class="btn btn-primary mt-4" style="float:left;">Previous</button>

            <button id="nextBtn1" class="btn btn-primary mt-4 ml-2" style="float:left;">Next</button>


          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        var currentIndex = 0;
        var history = []; 

        function fetchHistoryData(id) {
          $.ajax({
            type: 'POST',
            url: 'CHECKHISTORY',
            data: {
              id: id
            },
            dataType: 'json',
            success: function(data) {
              history = data; 
              currentIndex = 0; 
              
              showHistoryItem(currentIndex);

            }
          });
        }

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

        let id = $('#drop').attr('data-id');
        fetchHistoryData(id);


        $('#prevBtn1').on('click', function() {
          currentIndex--;
          if (currentIndex < 0) {
            currentIndex = 0;
          }
          showHistoryItem(currentIndex);
        });

        $('#nextBtn1').on('click', function() {
          currentIndex++;
          if (currentIndex >= history.length) {
            currentIndex = history.length - 1;
          }
          showHistoryItem(currentIndex);
        });

        $('#history').on('shown.bs.modal', function() {
          let id = $('#drop').attr('data-id');
          fetchHistoryData(id);
        });

        $('#history').on('hidden.bs.modal', function() {
          
          location.reload();
        });
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
      $(document).ready(function() {
        if (typeof $('#myTable2').attr('data-id') != 'undefined') {
          var table = $('#myTable2').DataTable({
            dom: '<\'text-muted\'Bi>\n        <\'table-responsive\'tr>\n        <\'mt-4\'p>',
            paging: false, 
            scrollY: '200px', 
            info: false,
            ordering: false,
            scrollX: true, 
            scrollCollapse: true,
            autoWidth: false,
            ajax: 'www/get/GETALLBOOKSD=' + $('#myTable2').attr('data-id'),
            deferRender: true,
            order: [1, 'asc'],
            language: {
              zeroRecords: "Please fill the input fields below to add a new row",
            },

            columns: [{
                data: 'IDNo',
                className: 'col-checker align-middle',
                orderable: false,
                searchable: false
              },
              {
                data: 'ItemNo',
                className: 'align-middle'
              },
              {
                data: 'CourseID',
                className: 'align-middle'
              },
              {
                data: 'CopyRightYear',
                className: 'align-middle'
              },
              {
                data: 'DateReceived',
                className: 'align-middle'
              },
              {
                data: 'ISBNNumber',
                className: 'align-middle'
              },
              {
                data: 'EditionNumber',
                className: 'align-middle'
              },
              {
                data: 'PurchasePrice',
                className: 'align-middle'
              },
              {
                data: 'Supplier',
                className: 'align-middle'
              },
              {
                data: 'Recommendedby',
                className: 'align-middle'
              },
              {
                data: 'BPages',
                className: 'align-middle'
              },
              {
                data: 'Encoder',
                className: 'align-middle'
              }
            ],
            columnDefs: [{
              targets: 0,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="" name="IDNo" class=""></span>';
              }
            }, {
              targets: 1,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="ItemNo" class="">' + row.ItemNo + '</span>';
              }
            }, {
              targets: 2,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="CourseID" class="">' + row.CourseID + '</span>';
              }
            }, {
              targets: 3,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '"  class="editable" name="CopyRightYear" class="">' + row.CopyRightYear + '</span>';
              }
            }, {
              targets: 4,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable_date" name="DateReceived" class="">' + row.DateReceived + '</span>';
              }
            }, {
              targets: 5,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="ISBNNumber" class="">' + row.ISBNNumber + '</span>';
              }
            }, {
              targets: 6,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="EditionNumber" class="">' + row.EditionNumber + '</span>';
              }
            }, {
              targets: 7,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="PurchasePrice" class="">' + row.PurchasePrice + '</span>';
              }
            }, {
              targets: 8,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="Supplier" class="">' + row.Supplier + '</span>';
              }
            }, {
              targets: 9,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="Recommendedby" class="">' + row.Recommendedby + '</span>';
              }
            }, {
              targets: 10,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" class="editable" name="BPages" class="">' + row.BPages + '</span>';
              }
            }, {
              targets: 11,
              render: function render(data, type, row, meta) {
                return ' <span id="' + row.IDNo + '" name="Encoder" class="">' + row.Encoder + '</span>';
              }
            }]
          });

          table.on('draw', function() {
            showEmptyRowAtEnd();
            emptyRowAdded = true;
          });
          $('#tab2-tab').on('click', function() {
            $('#myTable2').DataTable().ajax.reload();
          });
        } else {

        }

        









        function getCookie(name) {
          var cookies = document.cookie.split(';');
          for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
              return decodeURIComponent(cookie.substring(name.length + 1));
            }
          }
          return null;
        }

        var addcount = 0;
        showEmptyRowAtEnd();

        function showEmptyRowAtEnd() {
          var cookieValue = getCookie("username");
          addcount++;

          const emptyRowHtml = `
  <tr id="emptyRow">
    <td><i class="fas fa-star"></i></td>
    <td><input data-id='${addcount}' value="0" type="text" name="ItemNo" class="itemno form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="CourseID" class="courseid form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="CopyRightYear" class="cpyear form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" id="burecieve" name="DateReceived" class="daterecive form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="ISBNNumber" class="isbn form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="EditionNumber" class="editionnumber form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="PurchasePrice" class="pprice form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="Supplier" class="supplier form-control" style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="Recommendedby" class="recomend form-control"  style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="BPages" class="bpages form-control"  style="width: 84px;border-radius: 0" ></td>
    <td><input data-id='${addcount}' type="text" name="Encoder" class="ed form-control"  style="width: 84px;border-radius: 0"  value='<?php echo $username ?>'></td>
  </tr>
  `;

          $('#myTable2 tbody').append(emptyRowHtml);

          
          pickers.init();

          $('#emptyRow input[name="Encoder"]').on('input', function() {
            
            var originalEncoderValue = "<?php echo $username ?>";

            if ($(this).val() !== originalEncoderValue) {
              
              $(this).val(originalEncoderValue);
            }
          });

        }
        var clickCount = 0;
        var addcount2 = 0;

        function showEmptyRowAtEnd2() {
          var cookieValue = getCookie("username");
          addcount2++;

          const emptyRowHtml = `
  <tr id="emptyRow">
    <td><i class="fas fa-star"></i></td>

  
    <td><input data-id='${addcount2}' value="0" type="text" name="ItemNo" style="width: 84px;border-radius: 0" class="itemno1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="AccessionNo"  style="width: 84px;border-radius: 0" class="accessionno1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Copies"  style="width: 84px;border-radius: 0" class="copies1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Location"  style="width: 84px;border-radius: 0" class="location1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="BookLocation"  style="width: 84px;border-radius: 0" class="booklocation1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Source"  style="width: 84px;border-radius: 0" class="source1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Donor"  style="width: 84px;border-radius: 0" class="donor1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass1"  style="width: 84px;border-radius: 0" class="subclass11 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass2"  style="width: 84px;border-radius: 0" class="subclass21 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass3"  style="width: 84px;border-radius: 0" class="subclass31 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="SubClass4"  style="width: 84px;border-radius: 0" class="subclass41 form-control "></td>
      <td> <select data-id='${addcount2}' name="Replacedfor"  style="width: 200px;border-radius: 0" class="replacefor1 form-control"></select></td>
    <td><input data-id='${addcount2}' value ="In" type="text" name="Remarks"  style="width: 84px;border-radius: 0" class="remarks1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="MR Page	"  style="width: 84px;border-radius: 0" class="mrpage1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Status"  style="width: 84px;border-radius: 0" value='E' class="status1 form-control "></td>
    <td><input data-id='${addcount2}' type="text" name="Encoder"  style="width: 84px;border-radius: 0" class="encoder1 form-control " style="width:120px;border-radius: 0" value='<?php echo $username ?>' ></td>
  </tr>
  `;

          $('#myTable3 tbody').append(emptyRowHtml);

          
          pickers.init();

          $('#emptyRow input[name="Encoder"]').on('input', function() {
            
            var originalEncoderValue = "<?php echo $username ?>";

            if ($(this).val() !== originalEncoderValue) {
              
              $(this).val(originalEncoderValue);
            }
          });
          clickCount = 0;

          $.ajax({
            url: 'GPLACE',
            dataType: 'json',
            success: function(data) {

              
              var select = $(`.replacefor1[data-id="${addcount2}"]`);


              select.append("$('<option value='null' class='formgroup' selected >Select</option>");

              $.each(data, function(index, item) {
                select.append($('<option>', {
                  value: item.ID,
                  text: item.Title + ", Accession No - " + item.AccessionNo
                }));
              });

              select.css({
                width: "100px",
                padding: "10px",
                "max-height": "200px",
                "overflow-y": "auto"
              });


            }
          });

          setTimeout(showempty, 1000);

          function showempty() {


            $(".editable1").each(function() {
              var value = $(this).text().trim();
              if (value === "") {
                $(this).text("Not Set");
                value = "Not Set";
              }

            });

          }

        }
        jQuery(window).on("load", function() {
          localStorage.setItem("clickon", false);
          localStorage.setItem("ttopen", "false");
          if (localStorage.localid != '') {
            var id = localStorage.getItem("localid");
            $.ajax({
              url: 'getapid=' + id, 
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                if (data.length === 0) {
                  var table = $('#myTable3');
                  table.find('tr').not(':first').remove();
                  $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');


                }

                
                var firstItem = data[0];

                
                var tableHeaders = '<tr>';
                for (var key in firstItem) {
                  if (firstItem.hasOwnProperty(key)) {
                    tableHeaders += '<th>' + key + '</th>';
                  }
                }
                tableHeaders += '</tr>';

                $('#myTable thead').html(tableHeaders); 

                
                $.each(data, function(index, item) {
                  var newRow = '<tr>';

                  for (var key in item) {
                    if (item.hasOwnProperty(key)) {
                      if (key === 'AccID') {
                        newRow += '<td ><span id="' + item.AccID + '"  style="display:none;" class="editable" name="' + key + '">' + item[key] + '</span></td>';
                      } else if (key === 'Replacedfor') {
                        newRow += '<td> <span id="' + item.AccID + '" class="editable2" name="' + key + '">' + item.Title + '</span></td>';
                      } else if (key == 'Title') {
                        newRow += '<td style="display:none;" > <span id="' + item.AccID + '" class="editable1" name="' + key + '">' + item[key] + '</span></td>';

                      } else {
                        newRow += '<td> <span id="' + item.AccID + '" class="editable1" name="' + key + '">' + item[key] + '</span></td>';
                      }
                    }
                  }
                  newRow += '</spa></tr>';

                  $('#myTable3 tbody').append(newRow);
                  var tbodyLength = $('#myTable3 tbody tr').length;
                        $("#noofdata").text("Showing " + tbodyLength + " entries")

                });

                var addertm = setTimeout(showEmptyRowAtEnd2, 1000);

              },
              error: function(err) {
                console.error('Error fetching data:', err);
              }
            });

          }

          $(document).ready(function() {



            $('#myTable2').on('click', 'tr', function() {

              var id = $(this).attr('id');
              if (clickCount > 0) {

              } else {
                clickCount++;
                if (id === 'emptyRow') {

                } else {
                  var table = $('#myTable3');
                  
                  table.find('tr').not(':first').remove();
                  var span = $(this).find('span');
                  var id = span.attr('id');
                  localStorage.setItem("localid", id);
                  $.ajax({
                    url: 'getapid=' + id, 
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                      if (data.length === 0) {
                        var table = $('#myTable3');
                        table.find('tr').not(':first').remove();
                        $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');


                      }

                      
                      var firstItem = data[0];

                      
                      var tableHeaders = '<tr>';
                      for (var key in firstItem) {
                        if (firstItem.hasOwnProperty(key)) {
                          tableHeaders += '<th>' + key + '</th>';
                        }
                      }
                      tableHeaders += '</tr>';

                      $('#myTable thead').html(tableHeaders); 

                      
                      $.each(data, function(index, item) {
                        var newRow = '<tr>';

                        for (var key in item) {
                          if (item.hasOwnProperty(key)) {
                            if (key === 'AccID') {
                              newRow += '<td ><span id="' + item.AccID + '"  style="display:none;" class="editable" name="' + key + '">' + item[key] + '</span></td>';
                            } else if (key === 'Replacedfor') {
                              newRow += '<td> <span id="' + item.AccID + '" class="editable2" name="' + key + '">' + item[key] + '</span></td>';
                            } else {
                              newRow += '<td> <span id="' + item.AccID + '" class="editable1" name="' + key + '">' + item[key] + '</span></td>';
                            }
                          }
                        }
                        newRow += '</tr>';
                       
                        $('#myTable3 tbody').append(newRow);
                        var tbodyLength = $('#myTable3 tbody tr').length;
                        $("#noofdata").text("Showing " + tbodyLength + " entries")
                        

                      });

                      var addertm = setTimeout(showEmptyRowAtEnd2, 1000);

                    },
                    error: function(err) {
                      console.error('Error fetching data:', err);
                    }
                  });

                }
              }

            });



          });

          setTimeout(reloads1, 1000);
          let add = 0;

          const inputValue = $('.itemno[data-id="' + addcount + '"]').val();
          let latestGeneratedDataId = 0;
          let isFirstClick = true;

          $(document).on('click', '.itemno', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });


          $(document).on('click', '.courseid', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });

          $(document).on('click', '.cpyear', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });

                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });


          $(document).on('click', '.daterecive', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });

          $(document).on('click', '.isbn', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }


                  });
                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });

          $(document).on('click', '.editionnumber', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });

                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });


          $(document).on('click', '.pprice', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });


          $(document).on('click', '.supplier', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });

          $(document).on('click', '.recomend', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id="' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              
            }
          });


          $(document).on('click', '.bpages', function() {
            const clickedDataId = $(this).data('id');

            if (clickedDataId > latestGeneratedDataId || latestGeneratedDataId === 0) {
              const itemno = $('.itemno[data-id="' + (clickedDataId - 1) + '"]');
              const courseid = $('.courseid[data-id="' + (clickedDataId - 1) + '"]');
              const cpyear = $('.cpyear[data-id="' + (clickedDataId - 1) + '"]');
              const daterecive = $('.daterecive[data-id="' + (clickedDataId - 1) + '"]');
              const isbn = $('.isbn[data-id="' + (clickedDataId - 1) + '"]');
              const editionnumber = $('.editionnumber[data-id="' + (clickedDataId - 1) + '"]');
              const pprice = $('.pprice[data-id=wedValues "' + (clickedDataId - 1) + '"]');
              const supplier = $('.supplier[data-id="' + (clickedDataId - 1) + '"]');
              const recomend = $('.recomend[data-id="' + (clickedDataId - 1) + '"]');
              const bpages = $('.bpages[data-id="' + (clickedDataId - 1) + '"]');
              const ed = $('.ed[data-id="' + (clickedDataId - 1) + '"]');
              let itemval = 0;
              let courseval = 0;
              let cpyearval = 0;
              let datereciveval = 0;
              let isbnval = 0;
              let editionnumberval = 0;
              let ppriceval = 0;
              let supplierval = 0;
              let recomendval = 0;
              let bpagesval = 0;
              let edval = 0;
              if (itemno.length === 0 || itemno.val().trim() !== "") {
                itemval = itemno.val();
              } else {
                itemval = null;
              }

              if (courseid.length === 0 || courseid.val().trim() !== "") {
                courseval = courseid.val();
              } else {
                courseval = null;
              }

              if (cpyear.length === 0 || cpyear.val().trim() !== "") {
                cpyearval = cpyear.val();
              } else {
                cpyearval = null;
              }

              if (daterecive.length === 0 || daterecive.val().trim() !== "") {
                datereciveval = daterecive.val();
              } else {
                datereciveval = null;
              }

              if (isbn.length === 0 || isbn.val().trim() !== "") {
                isbnval = isbn.val();
              } else {
                isbnval = null;
              }

              if (editionnumber.length === 0 || editionnumber.val().trim() !== "") {
                editionnumberval = editionnumber.val();
              } else {
                editionnumberval = null;
              }

              if (pprice.length === 0 || pprice.val().trim() !== "") {
                ppriceval = pprice.val();
              } else {
                ppriceval = null;

              }

              if (supplier.length === 0 || supplier.val().trim() !== "") {
                supplierval = supplier.val();
              } else {
                supplierval = null;

              }

              if (recomend.length === 0 || recomend.val().trim() !== "") {
                recomendval = recomend.val();
              } else {
                recomendval = null;

              }

              if (bpages.length === 0 || bpages.val().trim() !== "") {
                bpagesval = bpages.val();
              } else {
                bpagesval = null;

              }

              if (ed.length === 0 || ed.val().trim() !== "") {
                edval = ed.val();
              } else {
                edval = null;

              }



              if (!isFirstClick) {
                if (cpyearval == null) {
                  alert("Please dont leave Copyright Field blanks");
                } else if (datereciveval == null) {
                  alert("Please dont leave Date Recieve Field blanks");
                } else {
                  const table = $('#myTable2').DataTable();

                  isFirstClick = true;
                  setTimeout(showEmptyRowAtEnd, 1000);
                  setTimeout(reloads1, 1000);

                  $.ajax({
                    url: 'insertbookprop',
                    type: 'POST',
                    data: {
                      itemno: itemval,
                      courseid: courseval,
                      cpyear: cpyearval,
                      daterecives: datereciveval,
                      isbn: isbnval,
                      editionnumber: editionnumberval,
                      pprice: ppriceval,
                      supplier: supplierval,
                      recomend: recomendval,
                      bpages: bpagesval,
                      encoder: edval,
                      bookid: $('#drop').attr('data-id')

                      
                    },
                    success: function(response) {
                      
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; 
              }

            } else {
              // Handle other cases if needed
            }
          });

          function reloads1() {
            const table = $('#myTable2').DataTable();
            var $scrollBody = $(table.table().node()).parent();
            $scrollBody.scrollTop($scrollBody.get(0).scrollHeight);
          }











          let add1 = 0;

          const inputValue1 = $('.itemno1[data-id="' + addcount2 + '"]').val();
          let latestGeneratedDataId1 = 0;
          let isFirstClick1 = true;

          $(document).on('click', '.itemno1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });

          $(document).on('click', '.accessionno1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });

          $(document).on('click', '.copies1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });

          $(document).on('click', '.location1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.booklocation1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.source1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.donor1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.subclass11', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.subclass21', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.subclass31', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.subclass41', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.replacefor1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.remarks1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.mrpage1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });


          $(document).on('click', '.status1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else if (isNaN(copies1val)) {
                  alert("Copies must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });

          $(document).on('click', '.encoder1', function() {
            const clickedDataId1 = $(this).data('id');


            if (clickedDataId1 > latestGeneratedDataId1 || latestGeneratedDataId1 === 0) {
              const itemno1 = $('.itemno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const accessionno1 = $('.accessionno1[data-id="' + (clickedDataId1 - 1) + '"]');
              const copies1 = $('.copies1[data-id="' + (clickedDataId1 - 1) + '"]');
              const location1 = $('.location1[data-id="' + (clickedDataId1 - 1) + '"]');
              const booklocation1 = $('.booklocation1[data-id="' + (clickedDataId1 - 1) + '"]');
              const source1 = $('.source1[data-id="' + (clickedDataId1 - 1) + '"]');
              const donor1 = $('.donor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass11 = $('.subclass11[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass21 = $('.subclass21[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass31 = $('.subclass31[data-id="' + (clickedDataId1 - 1) + '"]');
              const subclass41 = $('.subclass41[data-id="' + (clickedDataId1 - 1) + '"]');
              const replacefor1 = $('.replacefor1[data-id="' + (clickedDataId1 - 1) + '"]');
              const remarks1 = $('.remarks1[data-id="' + (clickedDataId1 - 1) + '"]');
              const mrpage1 = $('.mrpage1[data-id="' + (clickedDataId1 - 1) + '"]');
              const status1 = $('.status1[data-id="' + (clickedDataId1 - 1) + '"]');
              const encoder1 = $('.encoder1[data-id="' + (clickedDataId1 - 1) + '"]');
              let item1val = 0;
              let accessionno1val = 0;
              let copies1val = 0;
              let location1val = 0;
              let booklocation1val = 0;
              let source1val = 0;
              let donor1val = 0;
              let subclass11val = 0;
              let subclass21val = 0;
              let subclass31val = 0;
              let subclass41val = 0;
              let replacefor1val = 0;
              let remarks1val = 0;
              let mrpage1val = 0;
              let status1val = 0;
              let encoder1val = 0;

              if (itemno1.length === 0 || itemno1.val().trim() !== "") {
                item1val = itemno1.val();
              } else {
                item1val = null;
              }
              if (accessionno1.length === 0 || accessionno1.val().trim() !== "") {
                accessionno1val = accessionno1.val();
              } else {
                accessionno1val = null;
              }
              if (copies1.length === 0 || copies1.val().trim() !== "") {
                copies1val = copies1.val();
              } else {
                copies1val = null;
              }
              if (location1.length === 0 || location1.val().trim() !== "") {
                location1val = location1.val();
              } else {
                location1val = null;
              }
              if (booklocation1.length === 0 || booklocation1.val().trim() !== "") {
                booklocation1val = booklocation1.val();
              } else {
                booklocation1val = null;
              }
              if (source1.length === 0 || source1.val().trim() !== "") {
                source1val = source1.val();
              } else {
                source1val = null;
              }

              if (donor1.length === 0 || donor1.val().trim() !== "") {
                donor1val = donor1.val();
              } else {
                donor1val = null;
              }
              if (subclass11.length === 0 || subclass11.val().trim() !== "") {
                subclass11val = subclass11.val();
              } else {
                subclass11val = null;
              }
              if (subclass21.length === 0 || subclass21.val().trim() !== "") {
                subclass21val = subclass21.val();
              } else {
                subclass21val = null;
              }
              if (subclass31.length === 0 || subclass31.val().trim() !== "") {
                subclass31val = subclass31.val();
              } else {
                subclass31val = null;
              }
              if (subclass41.length === 0 || subclass41.val().trim() !== "") {
                subclass41val = subclass41.val();
              } else {
                subclass41val = null;
              }
              if (replacefor1.length === 0) {
                replacefor1val = replacefor1.val();
              } else {
                replacefor1val = null;
              }
              if (remarks1.length === 0 || remarks1.val().trim() !== "") {
                remarks1val = remarks1.val();
              } else {
                remarks1val = null;
              }

              if (mrpage1.length === 0 || mrpage1.val().trim() !== "") {
                mrpage1val = mrpage1.val();
              } else {
                mrpage1val = null;
              }
              if (status1.length === 0 || status1.val().trim() !== "") {
                status1val = status1.val();
              } else {
                status1val = null;
              }

              if (encoder1.length === 0 || encoder1.val().trim() !== "") {
                encoder1val = encoder1.val();
              } else {
                encoder1val = null;
              }





              if (!isFirstClick1) {

                var statusvalues = ["E", "L", "RE"];

                var isValuesallowed = statusvalues.includes(status1val);

                var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];

                var isSourceallowed = sourcevalues.includes(source1val);

                var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];

                var isLocationallowed = locationvalues.includes(location1val);


                if (accessionno1val == null) {
                  alert("Please dont leave Accession No blanks");
                } else if (location1val == null) {
                  alert("Please dont leave Location Field blanks");
                } else if (source1val == null) {
                  alert("Please dont leave Source Field blanks");
                } else if (!isValuesallowed) {
                  alert("Values Allowed on Status are E, L, RE");
                } else if (!isSourceallowed) {
                  alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                } else if (!isLocationallowed) {
                  alert("Value Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR")
                } else if (isNaN(accessionno1val)) {
                  alert("Accession Number must be a number")
                } else {
                  $.ajax({
                    url: 'APICC',
                    type: 'POST',
                    data: {
                      accessionNumber: accessionno1val
                    },
                    dataType: 'json',
                    success: function(response) {
                      if (response.exists) {
                        alert("Accession Number already exist");

                      } else {
                        isFirstClick1 = true;
                        const table = $('#myTable3');


                        $.ajax({
                          url: 'insertbookprop1',
                          type: 'POST',
                          data: {
                            bookid: $('#drop').attr('data-id'),
                            itemno: itemno1.val(),
                            accessionno: accessionno1.val(),
                            copies: copies1.val(),
                            location: location1.val(),
                            booklocation: booklocation1.val(),
                            source: source1.val(),
                            donor: donor1.val(),
                            subclass1: subclass11.val(),
                            subclass2: subclass21.val(),
                            subclass3: subclass31.val(),
                            subclass4: subclass41.val(),
                            replacefor: replacefor1.val(),
                            remarks: remarks1.val(),
                            mrpage: mrpage1.val(),
                            status: status1.val(),
                            encoder: encoder1.val(),
                            idno: localStorage.getItem('localid')

                            // Add any additional data you want to send
                          },
                          success: function(response) {
                            localStorage.setItem("clickon", false);
                            location.reload();

                          },
                          error: function(xhr, status, error) {
                            // Handle any errors here
                            console.error('Error:', error);
                          }
                        });
                      }
                    },
                    error: function() {
                      $('#result').text('Error checking AccessionNo.');
                    }
                  });


                  /*
                                  
                                    */

                }



              } else {
                localStorage.setItem("clickon", true);
                isFirstClick1 = false;
                showEmptyRowAtEnd2();
                latestGeneratedDataId1 = clickedDataId1; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });



        });








      });
    </script>

    <script src="assets/vendor/sweetalert2.all.min.js
"></script>
    <link href="assets/vendor/sweetalert2.min.css
" rel="stylesheet">
    <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>

    <script type="text/javascript" language="javascript" class="init">
      var pickers = {
        init: function init() {

          this.bindUIActions();
        },
        bindUIActions: function bindUIActions() {

          // event handlers
          this.handleFlatpickr();
        },
        _fp1: function _fp1() {
          // Human-friendly Dates
          return flatpickr('#birthdate', {
            disableMobile: true,
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: 'Y-m-d'
          });
        },
        _fp2: function _fp2() {
          // Human-friendly Dates
          return flatpickr('#burecieve', {
            disableMobile: true,
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: 'Y-m-d'
          });
        },
        handleFlatpickr: function handleFlatpickr() {
          this._fp1();
          this._fp2();
        }
      };
    </script>
    <script>
      var oldValue = null;
      $(document).on('dblclick', '.editable', function() {

        if ($(this).attr('name') == 'EditionNumber') {
          oldValue = $(this).text();
          if (typeof oldValue === 'string') {
            var numericStr = oldValue.replace(/\D/g, '');
            $(this).removeClass('editable');
            $(this).html('<input type="text" style="width:150px;" class="update" value="' + numericStr + '" />');
            $(this).find('.update').focus();
          }
        } else if ($(this).attr('name') == 'PurchasePrice') {
          oldValue = $(this).text();
          if (typeof oldValue === 'string') {
            var numericStr = oldValue.replace(/\D/g, '');
            var numericValue = parseFloat(numericStr) / 100; // Convert to decimal

            $(this).removeClass('editable');
            $(this).html('<input type="text" style="width:150px;" class="update" value="' + numericValue + '" />');
            $(this).find('.update').focus();
          }



        } else {



          oldValue = $(this).html();

          $(this).removeClass('editable'); // to stop from making repeated request

          $(this).html('<input type="text" style="width:150px;" class="update" value="' + oldValue + '" />');
          $(this).find('.update').focus();
        }
      });

      var newValue = null;
      $(document).on('blur', '.update', function() {
        var elem = $(this);
        newValue = $(this).val();
        var empId = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if (newValue != oldValue) {
          if (newValue == '') {
            newValue = oldValue;
          }
          $.ajax({
            url: 'updatebookprop',
            method: 'post',
            data: {
              empId: empId,
              colName: colName,
              newValue: newValue,
            },
            success: function(respone) {
              if(respone!=""){
                alert(respone);
                $(elem).parent().addClass('editable');
                $(elem).parent().html(oldValue);
              }else{
              if (colName == 'EditionNumber') {
                var suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

                if ((newValue % 100) >= 11 && (newValue % 100) <= 13) {
                  var newValue1 = newValue + 'th Ed.';


                  $(elem).parent().addClass('editable');
                  $(elem).parent().html(newValue1);
                } else {
                  var newValue1 = newValue + suffix[newValue % 10] + ' Ed.';

                  $(elem).parent().addClass('editable');
                  $(elem).parent().html(newValue1);
                }


              } else if (colName == "PurchasePrice") {
                var formattedPrice = '';
                if (typeof newValue === 'number') {
                  formattedPrice = '₱' + newValue.toFixed(2);
                } else {
                  formattedPrice = '₱' + parseFloat(newValue).toFixed(2);
                }
                $(elem).parent().addClass('editable');
                $(elem).parent().html(formattedPrice);
              } else {

                $(elem).parent().addClass('editable');
                $(elem).parent().html(newValue);
              }

              }
            }
          });



        } else {
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });


      //date


      var oldValue = null;
      let topen = false;

      $(document).on('dblclick', '.editable_date', function() {
        if (topen == false) {


          oldValue = $(this).html();

          $(this).removeClass('editable_date'); // to stop from making repeated request

          $(this).html('<input id="birthdate" value="' + oldValue + '" class="update_date" type="text" placeholder="Click to Select" class="form-control"> </div>');
          pickers.init();
          $(this).find('.update_date').focus();
          topen = true;
        } else {
          alert("Please save the changes on open input first");
        }
      });

      var newValue = null;
      $(document).on('change', '.update_date', function() {
        $(this).find('.update_date').focus();
        var elem = $(this);
        newValue = $(this).val();
        var empId = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if (newValue != "") {
          $.ajax({
            url: 'updatebookprop',
            method: 'post',
            data: {
              empId: empId,
              colName: colName,
              newValue: newValue,
            },
            success: function(respone) {
              if(respone!=""){
                alert(respone);
                $(elem).parent().addClass('editable_date');
                $(elem).parent().html(oldValue);
                topen = false;
              }else{
              $(elem).parent().addClass('editable_date');
              $(elem).parent().html(newValue);
              topen = false;
              }
            }
          });
        } else {
          $(elem).parent().addClass('editable_date');
          $(this).parent().html(oldValue);
          topen = false;
        }
      });


      //second


      var oldValue = null;
      $(document).on('dblclick', '.editable1', function() {
        if (localStorage.getItem("ttopen") === "true") {
          // Value in local storage is "true" (as a string)
          alert("Please save the changes on open input first");
        } else {


          oldValue = $(this).html();

          $(this).removeClass('editable1'); // to stop from making repeated request

          $(this).html('<input type="text" style="width:150px;" class="update1" value="' + oldValue + '" />');
          $(this).find('.update1').focus();
        }
      });

      var newValue = null;
      $(document).on('blur', '.update1', function() {
        var elem = $(this);
        var newValue = $(this).val();
        var empId = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if (newValue != oldValue) {
          if (newValue == '') {
            newValue = oldValue;
          }

          if (colName == "AccessionNo") {
            if (newValue.length == 0) {
              alert("Please don't leave Accession number blank");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              $.ajax({
                url: 'APICC',
                type: 'POST',
                data: {
                  accessionNumber: newValue
                },
                dataType: 'json',
                success: function(response) {
                  if (response.exists) {
                    alert("Accession Number already exists");
                    $(elem).parent().addClass('editable1');
                    $('.update1').parent().html(oldValue);
                  } else {
                    $.ajax({
                      url: 'updatebookprop1',
                      method: 'post',
                      data: {
                        oldval: oldValue,
                        bookid: $('#drop').attr('data-id'),
                        empId: empId,
                        colName: colName,
                        newValue: newValue,
                      },
                      success: function(response) {
                       if(response !=""){
                        alert(response);
                        $(elem).parent().addClass('editable1');
                        $(elem).parent().html(oldValue);
                       }else{
                        $(elem).parent().addClass('editable1');
                        $(elem).parent().html(newValue);
                       }
                      }
                    });
                  }
                },
                error: function() {
                  alert('Error checking AccessionNo.');
                  $(elem).parent().addClass('editable1');
                  $('.update1').parent().html(oldValue);
                }
              });
            }
          } else if (colName == "Location") {
            if (newValue.length == 0) {
              alert("Please don't leave Location blank");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              var locationvalues = ["CY", "REF", "GS", "Fiction", "RB", "FR", "E-CY", "E-FR"];
              var isLocationallowed = locationvalues.includes(newValue);

              if (!isLocationallowed) {
                alert("Values Allowed on Location are CY or REF or GS or Fiction or RB or FR or E-CY or E-FR");
                $(elem).parent().addClass('editable1');
                $('.update1').parent().html(oldValue);
              } else {
                updateValue();
              }
            }
          } else if (colName == "Source") {
            if (newValue.length == 0) {
              alert("Please don't leave Source blank");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              var sourcevalues = ["GF", "GF W/O MR", "D W MR", "D W/O MR"];
              var isSourceallowed = sourcevalues.includes(newValue);

              if (!isSourceallowed) {
                alert("Values Allowed on Source are GF or GF W/O MR or D W MR or D W/O MR");
                $(elem).parent().addClass('editable1');
                $('.update1').parent().html(oldValue);
              } else {
                updateValue();
              }
            }
          } else if (colName == "Status") {
            if (newValue.length == 0) {
              alert("Please don't leave Status blank");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              var statusvalues = ["E", "L", "RE"];
              var isValuesallowed = statusvalues.includes(newValue);

              if (!isValuesallowed) {
                alert("Values Allowed on Status are E, L, RE");
                $(elem).parent().addClass('editable1');
                $('.update1').parent().html(oldValue);
              } else {
                if (newValue === "L") {
                  if (confirm("Are you sure you want to change the Status")) {
                    if (confirm("Are you sure this book is lost?")) {
                      updateValue();
                    } else {
                      // User canceled the second confirmation, handle accordingly
                      $(elem).parent().addClass('editable1');
                      $('.update1').parent().html(oldValue);
                    }
                  } else {
                    $(elem).parent().addClass('editable1');
                    $('.update1').parent().html(oldValue);
                  }
                } else {
                  confirm("Are you sure you want to change the Status")
                  if (confirm) {
                    updateValue();

                  } else {
                    $(elem).parent().addClass('editable1');
                    $('.update1').parent().html(oldValue);
                  }
                }
              }
            }
          } else if (colName == "Copies") {
            if (newValue.length == 0) {
              alert("Please don't leave Copies blank");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else if (isNaN(newValue)) {
              alert("Copies Number must be a number");
              $(elem).parent().addClass('editable1');
              $('.update1').parent().html(oldValue);
            } else {
              updateValue();
            }
          } else {
            updateValue();
          }
        } else {
          $(elem).parent().addClass('editable1');
          $(this).parent().html(newValue);
        }



        function updateValue() {
          $.ajax({
            url: 'updatebookprop1',
            method: 'post',
            data: {
              empId: empId,
              colName: colName,
              newValue: newValue,
            },
            success: function(response) {
              if(response !=""){
                alert(response);
                        $(elem).parent().addClass('editable1');
                        $(elem).parent().html(oldValue);
                       }else{
                        $(elem).parent().addClass('editable1');
                        $(elem).parent().html(newValue);
                       }

            }
          });
        }
      });

      var oldValue = null;
      $(document).on('dblclick', '.editable2', function() {
        localStorage.setItem("ttopen", "true");




        oldValue = $(this).html();

        $(this).removeClass('editable1'); // to stop from making repeated request

        $(this).html('<select name="Replacedfor"  style="width: 200px;" class="update2 replacefor2 form-control"></select>');

        $.ajax({
          url: 'GPLACE',
          dataType: 'json',
          success: function(data) {

            // Populate the select element with the data
            var select = $(`.replacefor2`);


            select.append("$('<option value='null' class='formgroup' selected >Select</option>");
            select.append("$('<option value='' class='formgroup' >Cancel</option>");
            $.each(data, function(index, item) {
              select.append($('<option>', {
                value: item.ID,
                text: item.Title + ", Accession No - " + item.AccessionNo
              }));
            });

            select.css({
              width: "100px",
              padding: "10px",
              "max-height": "200px",
              "overflow-y": "auto"
            });


          }
        });

      });

      var newValue = null;

      $(document).on('change', '.update2', function() {
        $('selector').attr('title');
        var elem = $(this);
        var selectedOptionText = $(this).find('option:selected').text();
        var newValue = $(this).val();
        var empId = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if (newValue != oldValue) {
          if (newValue == '') {
            $(elem).parent().addClass('editable2');
            $(this).parent().html(oldValue);
            localStorage.setItem("ttopen", "false");
          } else {
            updateValue2();
            localStorage.setItem("ttopen", "false");
          }




        } else {
          $(elem).parent().addClass('editable2');
          $(this).parent().html(newValue);
        }



        function updateValue2() {
          $.ajax({
            url: 'updatebookprop1',
            method: 'post',
            data: {
              empId: empId,
              colName: colName,
              newValue: newValue,
            },
            success: function(response) {
              if(response !=""){
                alert(response);
                $(elem).parent().addClass('editable2');
                $(elem).parent().html(selectedOptionText);
                        localStorage.setItem("ttopen", "false");
                       }else{
                        $(elem).parent().addClass('editable2');
              $(elem).parent().html(selectedOptionText);
              localStorage.setItem("ttopen", "false");
                       }
           
            }
          });
        }
      });
    </script>

    <script>
      // Define the check function before using it
      function check() {
        var editableSpans = $(".editable");
        var editableSpans2 = $(".editable1");
        var editableSpans3 = $(".editable_date");

        editableSpans.each(function() {
          var value = $(this).text().trim();
          if (value === "") {
            $(this).text("Not Set");
            value = "Not Set";
          }
        });

        editableSpans2.each(function() {
          var value = $(this).text().trim();
          if (value === "") {
            $(this).text("Not Set");
            value = "Not Set";
          }
        });


        editableSpans3.each(function() {
          var value = $(this).text().trim();
          if (value === "") {
            $(this).text("0000-00-00");
            value = "0000-00-00";
          }
        });
      }

      // Use the window.load event to ensure all resources are loaded
      $(window).on("load", function() {
        pickers.init();
        setTimeout(check, 1000);





        // Initialize DataTable


      });
      jQuery(window).on("load", function() {
        localStorage.setItem("topen", false);

      });
    </script>



    <!-- END PAGE LEVEL JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    </body>

</html>