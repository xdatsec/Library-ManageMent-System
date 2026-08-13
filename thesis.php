<?php
session_start();
$_SESSION['locator'] = 'ms';
$_SESSION['members'] = 'false';
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
  <title> Thesis's | CHMSU LMS </title>
  <meta property="og:title" content="Thesis - All">
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
  <link rel="stylesheet" href="assets/vendor/quill/quill.min.css">
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
    <?php include "assets/header_nav1.php" ?>
    <div class="wrapper">

      <div class="page">
        <!-- .page-inner -->
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
              <h1 class="page-title mr-sm-auto">Thesis</h1>
              <a id="reset" class="btn btn-primary btn-sm"" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Reset</a>
              <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>
            </div>
          </header>
       
          <div class="card container  mt-5" id="fullscreenDiv" style="border-style: solid;border-color:#408080;">
      
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
                    <p>Are you sure, Do you want drop this Thesis?</p>
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
                <a class="nav-link" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Data Entry</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true">Abstract</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">List </a>
              </li>
            </ul>


            <div class="tab-content mt-3" id="myTabContent" style="border-style: solid;border-color:#408080;">
              <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="card-body">
                  <section class="card card-fluid">
                    <!-- #quillEditor -->
                    <div id="quillEditor" style="height: 475px;">

                    </div>
                    <!-- /#quillEditor -->
                  </section>

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
                        <?php
                            if ($_SESSION['isSuperAdmin'] == 1) {
                              ?>
                        <button class="history btn btn-primary mr-1" type="button" data-toggle="modal" data-target="#history">
                          History
                        </button>
                        <button class="btn btn-warning" id="drop" class="drop" type="button">
                          DROP
                        </button>
                        <a class="btn btn-success" id="addts">
                          ADD </a>
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
                  <script>
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
                  </script>
                  <div class="tab-content">

                    <?php
                    $sql = "SELECT * FROM thesis WHERE Deleted = 0 AND Type='Thesis'";
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
                          No Thesis to show!
                        </h1>

                        <div class="container">
                          <div class="row mt-3">


                          </div>


                          <form>
                            <div class="form-group row">
                              <label for="ItemNo" class="col-sm-2 col-form-label">Item No:</label>
                              <div class="col-sm-2">
                                <input type="number" value="" name="ItemNo" class="input form-control" data-id="" id="itemnofield" placeholder="Item No">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="AccessionNo" class="col-sm-2 col-form-label">Acession No:</label>
                              <div class="col-sm-2">
                                <input type="text" value="" name="AccessionNo" class="input form-control" data-id="" id="accessionfield" placeholder="AccessionNo">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Title" class="col-sm-2 col-form-label">Title:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Title" class="input form-control" id="titlefield" placeholder="Title">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Author" class="col-sm-2 col-form-label">Author:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Author" class="input form-control" id="authorfield" placeholder="Author">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Subject" class="col-sm-2 col-form-label">Subject:</label>
                              <div class="col-sm-4">

                                <input type="text" name="Subject" data-id="" class="input form-control" id="subjectfield" placeholder="Subject">
                              </div>
                              <div class="col-sm-1">

                                <label for="Remarks" class="col-sm-13 col-form-label">Remarks:</label>

                              </div>
                              <div class="col">

                                <input type="text" name="Remarks" data-id="" class="input form-control" id="remarksfield" placeholder="Remarks">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="CopyrightYear" class="col-sm-2 col-form-label">Copyright Year:</label>
                              <div class="col-sm-4">

                                <input type="number" name="CopyrightYear" data-id="" class="input form-control" id="cpyfield" placeholder="Source">
                              </div>
                              <div class="col-sm-1">

                                <label for="Source" class="col-sm-13 col-form-label">Source:</label>

                              </div>
                              <div class="col">

                                <input type="text" name="Source" data-id="" class="input form-control" id="sourcefield" placeholder="Source">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="DateReceived" class="col-sm-2 col-form-label">Date Recieve:</label>
                              <div class="col-sm-10">
                                <input type="date" data-id="" name="DateReceived" class="input form-control" id="daterecievefield" placeholder="DateReceived">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Quantity" class="col-sm-2 col-form-label">Quantity:</label>
                              <div class="col-sm-10">
                                <input type="number" data-id="" name="Quantity" class="input form-control" id="quantityfield" placeholder="Quantity">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Encoder" class="col-sm-2 col-form-label">Encoder:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Encoder" class="input form-control" id="encoder" placeholder="Encoder">
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
                            }?>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- BEGIN BASE JS -->
                    <script src="assets/vendor/highlight-js/highlight.pack.js"></script>
                    <script src="assets/vendor/katex/katex.min.js"></script>
                    <script src="assets/vendor/quill/quill.min.js"></script>
                    <script src="assets/javascript/pages/quill-demo.js"></script>
                    <script>
                      $('#addt1').click(function(e) {
                        e.preventDefault();
                        $('#newtab a[href="#add"]').tab('show');
                        localStorage.setItem('currentTab1_T', 'addt')
                      })
                      $('#addts').click(function(e) {
                        e.preventDefault();
                        $('#myTabs a[href="#tab1"]').tab('show');
                        $('#newtab a[href="#add"]').tab('show');
                        localStorage.setItem('mcurrentTab1_T', 'tab1-tab');
                        localStorage.setItem('currentTab1_T', 'addt');
                      })

                      function isValidYear(year) {
                        return !isNaN(year) && Number.isInteger(+year) && year >= 1 && year <= 9999;
                      }






                      var oldValue = null;
                      var memid = null;
                      $(document).on('click', '.input', function() {
                        oldValue = $(this).val();
                        var colName = $(this).attr('name');

                      });



                      var newValue = null;


                      $(document).on('change', '.input', function() {
                        var empId;
                        var elem = $(this);
                        newValue = $(this).val();
                        var newv = newValue;
                        var colName = $(this).attr('name');

                        if (colName == 'ItemNo') {
                          if (newValue == '') {
                            alert("ItemNo cannot be empty");
                            reloadItems();
                          } else {
                            empId = $("#drop").attr("data-id")

                            var news = newValue;
                            if (newValue != oldValue) {
                              $.ajax({
                                url: 'updatethesis',
                                method: 'post',
                                data: {
                                  empId: empId,
                                  colName: colName,
                                  newValue: newValue,
                                },
                                success: function(respone) {
                                  $(elem).parent().val(newv);
                                  reloadItems();

                                  if (respone.trim() != "") {
                                  } else {
                                    if (localStorage.getItem('historystorage_t') == 'Changes Made:\n') {
                                      var currentDate = new Date();

                                      // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                                      var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                                      localStorage.setItem('edittime_t', formattedDate);
                                      localStorage.setItem('saveid_t', empId)
                                    }

                                    var currenhistory = localStorage.getItem('historystorage_t') || '';
                                    var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                                    currenhistory += (currenhistory ? '\n' : '') + newValue;
                                    localStorage.setItem('historystorage_t', currenhistory);
                                  }

                                }
                              });
                            } else {
                              $(this).parent().val(oldValue);
                            }
                          }

                        }
                        if (colName == 'AccessionNo') {
                          if (newValue == '') {
                            alert("AccessionNo cannot be empty");
                            reloadItems();
                          } else {
                            empId = $("#drop").attr("data-id")

                            var news = newValue;
                            if (newValue != oldValue) {
                              $.ajax({
                                url: 'updatethesis',
                                method: 'post',
                                data: {
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
                                    if (localStorage.getItem('historystorage_t') == 'Changes Made:\n') {
                                      var currentDate = new Date();

                                      // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                                      var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                                      localStorage.setItem('edittime_t', formattedDate);
                                      localStorage.setItem('saveid_t', empId)
                                    }

                                    var currenhistory = localStorage.getItem('historystorage_t') || '';
                                    var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                                    currenhistory += (currenhistory ? '\n' : '') + newValue;
                                    localStorage.setItem('historystorage_t', currenhistory);
                                  }

                                }
                              });
                            } else {
                              $(this).parent().val(oldValue);
                            }
                          }

                        } else {
                          empId = $("#drop").attr('data-id');

                          var news = newValue;
                          if (newValue != oldValue) {
                            $.ajax({
                              url: 'updatethesis',
                              method: 'post',
                              data: {
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
                                  if (localStorage.getItem('historystorage_t') == 'Changes Made:\n') {
                                    var currentDate = new Date();

                                    // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                                    var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                                    localStorage.setItem('edittime_t', formattedDate);
                                    localStorage.setItem('saveid_t', empId)
                                  }

                                  var currenhistory = localStorage.getItem('historystorage_t') || '';
                                  var newValue = "\n" + colName + ' =>' + news; // Replace this with the actual new value
                                  currenhistory += (currenhistory ? '\n' : '') + newValue;
                                  localStorage.setItem('historystorage_t', currenhistory);
                                }

                              }
                            });
                          } else {
                            $(this).parent().val(oldValue);
                          }
                        }


                      });

                      var course = <?php echo json_encode($course); ?>;

                      var type = <?php echo json_encode($type); ?>;
                      var items = <?php echo json_encode($items); ?>;

                      var filtered1;

                      var currentIndex = parseInt(localStorage.getItem('currentIndex1_t')) || 0;
                      var item2 = items.slice();

                      function reloadItems() {
                        $.ajax({
                          url: 'RELOAD_T', // Change this to the correct path to your PHP file
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

                        $(document).ready(function() {
                          let currentTab = localStorage.getItem('currentTab1_T');
                          let mastertab = localStorage.getItem('mcurrentTab1_T');

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
                            window.location.href = '/all_thesis_list.php';
                          }

                          $('#viewt').click(function() {
                            localStorage.setItem('currentTab1_T', 'viewt');
                          });
                          $('#tab1-tab').click(function() {
                            localStorage.setItem('mcurrentTab1_T', 'tab1-tab');

                          });
                          $('#tab2-tab').click(function() {
                            localStorage.setItem('mcurrentTab1_T', 'tab2-tab');

                          });
                          $('#tab3-tab').click(function() {
                            localStorage.setItem('mcurrentTab1_T', 'tab3-tab');
                            location.reload();
                          });
                          $('#addt').click(function() {
                            localStorage.setItem('currentTab1_T', 'addt');
                          });
                        });

                      });

                      $(document).on('input', '#encoder', function() {
                        var item = items[currentIndex];
                        $('#encoder').val(item.Encoder);
                      });


                      var quill = new Quill('#quillEditor', {
                        bounds: '#quillEditor',
                        placeholder: 'Type your abstract here...',
                        modules: {
                          clipboard: {
                            matchVisual: false,
                            sanitize: {
                              // Define allowed HTML tags and their attributes
                              tags: {
                                p: true,
                                br: true,
                                strong: true,
                                em: true,
                                a: true,
                                ul: true,
                                li: true,
                                h1: true,
                                h2: true,
                                h3: true,
                                h4: true
                              },
                            }
                          },
                          'formula': true,
                          'syntax': true,
                          'toolbar': [
                            [{
                              'font': []
                            }, {
                              'size': ['small', 'normal', 'large', 'huge'] // Customize size options
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                              'color': []
                            }, {
                              'background': []
                            }],
                            [{
                              'script': 'super'
                            }, {
                              'script': 'sub'
                            }],
                            [{
                              'header': [false, 1, 2, 3, 4, 5, 6]
                            }, 'blockquote', 'code-block'],
                            [{
                              'list': 'ordered'
                            }, {
                              'list': 'bullet'
                            }, {
                              'indent': '-1'
                            }, {
                              'indent': '+1'
                            }],
                            ['direction', {
                              'align': []
                            }],
                            ['formula'],
                            ['clean'],
                            ['save'],
                          ]
                        },
                        theme: 'snow'
                      });

                      // Define a custom save handler when the save button is clicked
                      var customButton = document.querySelector('.ql-save');
                      customButton.innerHTML = '<i class="fas fa-save"></i>'; // Add the save icon
                      customButton.addEventListener('click', function() {
                        const empId = $("#drop").attr("data-id");
                        const colname = "Abstract";
                        const newValue = quill.root.innerHTML;

                        $.ajax({
                          url: 'updatethesis',
                          method: 'post',
                          data: {
                            empId: empId,
                            colName: colname,
                            newValue: newValue,
                          },
                          success: function(respone) {
                            if(newValue ==""){
                              quill.setText('');

                            }else{
                              quill.setContents(newValue);
                              reloadItems();
                            }


                            if (respone != '') {
                              alert(respone);

                            } else {
                              if (localStorage.getItem('historystorage_t') == 'Changes Made:\n') {
                                var currentDate = new Date();

                                // Format the date and time as a string (e.g., "YYYY-MM-DD HH:MM:SS")
                                var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                                localStorage.setItem('edittime_t', formattedDate);
                                localStorage.setItem('saveid_t', empId)
                              }

                              var currenhistory = localStorage.getItem('historystorage_t') || '';
                              var newValue = "\n" + colname + ' =>' + newValue; // Replace this with the actual new value
                              currenhistory += (currenhistory ? '\n' : '') + newValue;
                              localStorage.setItem('historystorage_t', currenhistory);

                            }

                          }
                        });
                      });



                      function dateIsValid(date) {
                        return !Number.isNaN(new Date(date).getTime());
                      }


                      function showItem(index) {
                        var item = items[index];
                        $('#showing').text("Showing Records " + (index + 1) + " of " + items.length);
                        $('#showing1').text("Showing Records " + (index + 1) + " of " + items.length);

                        quill.enable();
                        if(item.Abstract.trim() ==""){
                            


                            }else{
                              quill.clipboard.dangerouslyPasteHTML(item.Abstract);
                            }


                        $('#itemnofield').attr('data-id', item.AccessionNo);
                        $("#accessionfield").val(item.AccessionNo);
                        $('#accessionfield').attr('data-id', item.AccessionNo);
                        $('#itemnofield').val(item.ItemNo);
                        $('#titlefield').val(item.Title);
                        $('#titlefield').prop('disabled', false);
                        $('#authorfield').val(item.Author);
                        $('#subjectfield').val(item.Subject);
                        $('#remarksfield').val(item.Remarks);
                        $('#cpyfield').val(item.CopyrightYear);
                        $('#sourcefield').val(item.Source);
                        const parts = item.DateReceived.split(" "); // Split the date and time
                        const daterecievefield = parts[0]; // Take the date part
                        $('#daterecievefield').val(daterecievefield);
                        $('#quantityfield').val(item.Quantity);
                        $('#encoder').val(item.Encoder);

                        $('#titlefield').attr('data-id', item.AccessionNo);
                        $('#itemnofield').attr('data-id', item.AccessionNo);
                        $('#authorfield').attr('data-id', item.AccessionNo);
                        $('#subjectfield').attr('data-id', item.AccessionNo);
                        $('#remarksfield').attr('data-id', item.AccessionNo);
                        $('#cpyfield').attr('data-id', item.AccessionNo);
                        $('#sourcefield').attr('data-id', item.AccessionNo);
                        $('#daterecievefield').attr('data-id', item.AccessionNo);
                        $('#quantityfield').attr('data-id', item.AccessionNo);
                        $('#encoder').attr('data-id', item.AccessionNo);
                        $('#drop').attr('data-id', item.AccessionNo);
                        $('#drop').prop('disabled', false);
                        $('#drop1').prop('disabled', false);
                        $('#prevBtn').prop('disabled', false);
                        $('#nextBtn').prop('disabled', false);
                        $('#prevBtn1').prop('disabled', false);
                        $('#nextBtn1').prop('disabled', false);
                        $('.history1').prop('disabled', false);
                        $('.history').prop('disabled', false);
                        $('#itemnofield').prop('disabled', false);
                        $('#authorfield').prop('disabled', false);
                        $('#subjectfield').prop('disabled', false);
                        $('#remarksfield').prop('disabled', false);
                        $('#cpyfield').prop('disabled', false);
                        $('#sourcefield').prop('disabled', false);
                        $('#daterecievefield').prop('disabled', false);
                        $('#quantityfield').prop('disabled', false);
                        $('#encoder').prop('disabled', false);
                        $('#accessionfield').prop('disabled', false);



                      }

                      $('#prevBtn').on('click', function() {
                        if (currentIndex > 0) {
                          currentIndex--;
                          localStorage.setItem('currentIndex1_t', currentIndex);
                          if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
                            let id = localStorage.getItem('saveid_t');
                            let edittime_t = localStorage.getItem('edittime_t');

                            $.ajax({
                              url: 'SAVEHISTORY_T',
                              method: 'post',
                              data: {
                                empId: id,
                                edittime_t: edittime_t,
                                history: localStorage.getItem('historystorage_t')
                              },
                              success: function(respone) {
                                localStorage.setItem('historystorage_t', 'Changes Made:\n');
                                showItem(currentIndex);
                              }
                            });

                          } else {
                            showItem(currentIndex);
                          }

                        }



                      });
                      $('#prevBtn1').on('click', function() {

                        if (currentIndex > 0) {
                          currentIndex--;
                          localStorage.setItem('currentIndex1_t', currentIndex);
                          if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
                            let id = localStorage.getItem('saveid_t');
                            let edittime_t = localStorage.getItem('edittime_t');

                            $.ajax({
                              url: 'SAVEHISTORY_T',
                              method: 'post',
                              data: {
                                empId: id,
                                edittime_t: edittime_t,
                                history: localStorage.getItem('historystorage_t')
                              },
                              success: function(respone) {
                                localStorage.setItem('historystorage_t', 'Changes Made:\n');
                                showItem(currentIndex);
                              }
                            });

                          } else {
                            showItem(currentIndex);
                          }

                        }


                      });

                      $('#drop1').click(function() {

                        $('#confirmationModal').modal('show');
                      });

                      document.getElementById("confirmButton").addEventListener("click", function() {
                        var empid = $("#drop").attr('data-id');
                        $.ajax({
                          url: 'dropthesis',
                          method: 'post',
                          data: {
                            empId: empid,
                          },
                          success: function(respone) {
                            reloadItems();

                            localStorage.setItem('currentIndex1_t', 0);

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
                        if (currentIndex < items.length - 1) {

                          currentIndex++;
                          localStorage.setItem('currentIndex1_t', currentIndex);
                          if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
                            let id = localStorage.getItem('saveid_t');
                            let edittime_t = localStorage.getItem('edittime_t');
                            $.ajax({
                              url: 'SAVEHISTORY_T',
                              method: 'post',
                              data: {
                                empId: id,
                                edittime_t: edittime_t,
                                history: localStorage.getItem('historystorage_t')
                              },
                              success: function(respone) {
                                localStorage.setItem('historystorage_t', 'Changes Made:\n');
                                showItem(currentIndex);
                              }
                            });


                          } else {

                            showItem(currentIndex);
                          }

                        }


                      });

                      $('#nextBtn1').on('click', function() {
                        if (currentIndex < items.length - 1) {

                          currentIndex++;
                          localStorage.setItem('currentIndex1_t', currentIndex);
                          if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
                            let id = localStorage.getItem('saveid_t');
                            let edittime_t = localStorage.getItem('edittime_t');
                            $.ajax({
                              url: 'SAVEHISTORY_T',
                              method: 'post',
                              data: {
                                empId: id,
                                edittime_t: edittime_t,
                                history: localStorage.getItem('historystorage_t')
                              },
                              success: function(respone) {
                                localStorage.setItem('historystorage_t', 'Changes Made:\n');
                                showItem(currentIndex);
                              }
                            });


                          } else {

                            showItem(currentIndex);
                          }

                        }


                      });

                      $(document).ready(function() {
                        if (items.length == 0) {
                          $('#nodata').show();
                          $('#titlefield').prop('disabled', true);
                          $('#myTabs li:nth-child(2) a').addClass('disabled');
                          $('#drop1').prop('disabled', true);
                          $('#drop').prop('disabled', true);
                          $('#prevBtn').prop('disabled', true);
                          $('#nextBtn').prop('disabled', true);
                          $('#prevBtn1').prop('disabled', true);
                          $('#nextBtn1').prop('disabled', true);
                          $('.history1').prop('disabled', true);
                          $('.history').prop('disabled', true);
                          $('#itemnofield').prop('disabled', true);
                          $('#authorfield').prop('disabled', true);
                          $('#subjectfield').prop('disabled', true);
                          $('#remarksfield').prop('disabled', true);
                          $('#cpyfield').prop('disabled', true);
                          $('#sourcefield').prop('disabled', true);
                          $('#daterecievefield').prop('disabled', true);
                          $('#quantityfield').prop('disabled', true);
                          $('#encoder').prop('disabled', true);
                          $('#accessionfield').prop('disabled', true);
                          quill.disable();



                        } else {
                          quill.disable();
                          $('#titlefield').prop('disabled', true);
                          $('#drop1').prop('disabled', true);
                          $('#accessionfield').prop('disabled', true);
                          $('#drop').prop('disabled', true);
                          $('#prevBtn').prop('disabled', true);
                          $('#nextBtn').prop('disabled', true);
                          $('#prevBtn1').prop('disabled', true);
                          $('#nextBtn1').prop('disabled', true);
                          $('.history1').prop('disabled', true);
                          $('.history').prop('disabled', true);
                          $('#itemnofield').prop('disabled', true);
                          $('#authorfield').prop('disabled', true);
                          $('#subjectfield').prop('disabled', true);
                          $('#remarksfield').prop('disabled', true);
                          $('#cpyfield').prop('disabled', true);
                          $('#sourcefield').prop('disabled', true);
                          $('#daterecievefield').prop('disabled', true);
                          $('#quantityfield').prop('disabled', true);
                          $('#encoder').prop('disabled', true);
                          $('#nodata').hide();
                          if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {

                            localStorage.setItem('setC', 'ok');
                            let id = localStorage.getItem('saveid_t');
                            let edittime_t = localStorage.getItem('edittime_t');
                            setTimeout(function() {
                              showItem(currentIndex);
                              $.ajax({
                                url: 'SAVEHISTORY_T',
                                method: 'post',
                                data: {
                                  empId: id,
                                  edittime_t: edittime_t,
                                  history: localStorage.getItem('historystorage_t')
                                },
                                success: function(respone) {
                                  localStorage.setItem('historystorage_t', 'Changes Made:\n');


                                  localStorage.setItem('setC', '0');
                                }
                              });
                            }, 1000);

                          } else {
                            showItem(currentIndex);
                          }


                        }

                      });
                    </script>



                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                      <a class="float-left" href="#" id="viewts" style="text-decoration:none; padding:10px;">Go back →</a>
                      <div class="card-body">
                        <div class="container mt-5">
                          <form>
                            <div class="form-group row">
                              <label for="MemberID" class="col-sm-2 col-form-label">Item No:</label>
                              <div class="col-sm-2">
                                <input type="text" value="" name="ItemNo" class=" form-control" data-id="" id="itemnofield_a" placeholder="Item No">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="MemberID" class="col-sm-2 col-form-label">Acession No:</label>
                              <div class="col-sm-2">
                                <input type="text" value="" name="AccessionNo" class=" form-control" data-id="" id="accessionfield_a" placeholder="AccessionNo">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Title:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Title" class=" form-control" id="titlefield_a" placeholder="Title">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Author:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Author" class=" form-control" id="authorfield_a" placeholder="Author">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="fullname" class="col-sm-2 col-form-label">Subject:</label>
                              <div class="col-sm-4">

                                <input type="text" name="Subject" data-id="" class=" form-control" id="subjectfield_a" placeholder="Subject">
                              </div>
                              <div class="col-sm-1">

                                <label for="Remarks" class="col-sm-13 col-form-label">Remarks:</label>

                              </div>
                              <div class="col">

                                <input type="text" name="Remarks" data-id="" class=" form-control" id="remarksfield_a" placeholder="Remarks">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="fullname" class="col-sm-2 col-form-label">Copyright Year:</label>
                              <div class="col-sm-4">

                                <input type="number" name="CopyrightYear" data-id="" class=" form-control" id="cpyfield_a" placeholder="CopyrightYear">
                              </div>
                              <div class="col-sm-1">

                                <label for="Source" class="col-sm-13 col-form-label">Source:</label>

                              </div>
                              <div class="col">

                                <input type="text" name="Source" data-id="" class=" form-control" id="sourcefield_a" placeholder="Source">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Date Recieve:</label>
                              <div class="col-sm-10">
                                <input type="date" data-id="" name="DateReceived" class=" form-control" id="daterecievefield_a" placeholder="DateReceived">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Quantity:</label>
                              <div class="col-sm-10">
                                <input type="number" data-id="" name="Quantity" class=" form-control" id="quantityfield_a" placeholder="Quantity">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Address" class="col-sm-2 col-form-label">Encoder:</label>
                              <div class="col-sm-10">
                                <input type="text" data-id="" name="Encoder" class=" form-control" id="encoderadd" placeholder="Encoder">
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
                //here new
                $('#viewts').click(function(e) {
                  e.preventDefault();
                  $('#newtab a[href="#prev"]').tab('show');
                  localStorage.setItem('currentTab1_T', 'viewt');
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
                  const accession = $("#accessionfield_a").val();
                  const itemno = $('#itemnofield_a').val();
                  const title = $('#titlefield_a').val();
                  const author = $('#authorfield_a').val();
                  const subject = $('#subjectfield_a').val();
                  const remarks = $('#remarksfield_a').val();
                  const copyrightyear = $('#cpyfield_a').val();
                  const source = $('#sourcefield_a').val();
                  const daterecieve = $('#daterecievefield').val();
                  const quantity = $('#quantityfield').val();
                  const encoder = $('#encoderadd').val();

                  var data = {
                    accession: accession,
                    itemno: itemno,
                    title: title,
                    author: author,
                    subject: subject,
                    remarks: remarks,
                    copyrightyear: copyrightyear,
                    source: source,
                    daterecieve: daterecieve,
                    quantity: quantity,
                    encoder: encoder
                  }
                  if (accession == "" || itemno == "" || title == "" || author == "" || subject == "" || remarks == "" || source == "" || daterecieve == "" || quantity == "") {
                    alert("Please fill in all required fields.");
                  } else {


                    $.ajax({
                      url: 'ADDTHESIS',
                      type: 'POST',
                      data: data,
                      success: function(response) {
                        if (response == "ok") {
                          alert("Added Successfully");
                          $('#accessionfield_a').val("");
                          $('#itemnofield_a').val("");
                          $('#titlefield_a').val("");
                          $('#authorfield_a').val("");
                          $('#subjectfield_a').val("");
                          $('#remarksfield_a').val("");
                          $('#cpyfield_a').val("");
                          $('#sourcefield_a').val("");
                          $('#daterecievefield_a').val("");
                          $('#quantityfield_a').val("");


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
              </script>
            </div>

         
          </div>

        </div>
    
      </div>
   
    </div>
  </div>

  <script>
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
          url: 'CHECKHISTORY_T',
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
            if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
              let id = localStorage.getItem('saveid_t');
              let edittime_t = localStorage.getItem('edittime_t');
              $.ajax({
                url: 'SAVEHISTORY_T',
                method: 'post',
                data: {
                  empId: id,
                  search: search,
                  edittime_t: edittime_t,
                  history: localStorage.getItem('historystorage_t')
                },
                success: function(respone) {

                  localStorage.setItem('historystorage_t', 'Changes Made:\n');
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
          url: 'CHECKHISTORY_T2',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(data) {
            history = data; // Use 'history' instead of 'items'
            currentIndex = 0; // Reset currentIndex
            if (localStorage.getItem('historystorage_t') != 'Changes Made:\n') {
              let id = localStorage.getItem('saveid_t');
              let edittime_t = localStorage.getItem('edittime_t');
              $.ajax({
                url: 'SAVEHISTORY_T',
                method: 'post',
                data: {
                  empId: id,
                  edittime_t: edittime_t,
                  history: localStorage.getItem('historystorage_t')
                },
                success: function(respone) {
                  localStorage.setItem('historystorage_t', 'Changes Made:\n');
                  showHistoryItem(currentIndex);
                }
              });


            } else {
              showHistoryItem(currentIndex);
            }



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
      localStorage.setItem('historystorage_t', 'Changes Made:\n');
      localStorage.setItem('edittime_t', '');
      localStorage.setItem('saveid_t', '');
      localStorage.setItem('currentIndex1_t', '0');
      currentIndex = parseInt(localStorage.getItem('currentIndex1_t'));

      showItem(currentIndex);
      alert("Application Reseted");
    });
  </script>

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