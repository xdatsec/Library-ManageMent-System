<?php
session_start();
$_SESSION['members'] = false;
$_SESSION['locator'] = 'tr';
if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}
include "modules/inc/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- End Required meta tags -->
  <!-- Begin SEO tag -->
  <title> Borrow's Book| CHMSU LMS </title>
  <meta property="og:title" content="Borrow">
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
  <link href="assets/vendor/sweetalert2.min.css" rel="stylesheet">
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
  </style>

  <div class="app">
    <?php include "assets/header_nav1.php" ?>
    <div class="wrapper">

      <div class="page">
 
        <div class="page-inner">
      
          <header class="page-title-bar">
            <!-- .breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                </li>
              </ol>

            </nav>
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto text-white"> Borrow</h1>
              <!---actions-->
              <a href="return.php" class="btn btn-primary btn-sm" style="margin-left:5px;background-color:white;color:black!important;">Return</a>
              <a href="borrowed.php" class="btn btn-primary btn-sm"style="margin-left:5px;background-color:white;color:black!important;">Borrowed and Returned</a>
              <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>

            </div>

          </header>
    
          <div class="page-section">

            <!-- .card -->
            <section class="card card-fluid" id="fullscreenDiv" style="border-style: solid;border-color:#408080;">
              <!-- .card-header -->
              <header class="card-header">
                <!-- .nav-tabs -->
                <ul class="nav nav-tabs card-header-tabs">

                  <li class="nav-item">
                    <a class="nav-link active show" href="borrow.php">Books</a>
                  </li>
                </ul>
                <!-- /.nav-tabs -->
              </header>
              <!-- /.card-header -->
              <!-- .card-body -->
              <div class="card-body" style="border-style: solid;border-color:#408080;">
                <div class="container mt-4">
                  <form class="form-inline">
                    <div class="form-group mr-2">
                      <label for="memberID">Member ID:</label>
                      <input type="text" class="form-control ml-2" id="memberID" placeholder="" style="border-radius: 0;">
                    </div>
                    <div class="form-group flex-grow-1">
                      <input type="text" class="form-control ml-2" id="studentname" placeholder="" style="border-radius: 0;">
                    </div>
                  </form>
                </div>
                <!-- /.input-group -->
                <!--delete modal-->
                <?php include 'modules/inc/bulk_modal.php'; ?>
                <!--end delete modal-->
                <!-- /.form-group -->
                <!-- .table -->
                <div class="table-responsive">
                  <table id="myTable" class="table">
                    <!-- thead -->
                    <thead>
                      <tr>
                        <th>Acession No.</th>
                        <th>Copies</th>
                        <th>Title</th>
                        <th>AuthorID</th>
                        <th>Location</th>
                        <th>SouceID</th>
                        <th>CallNum1</th>
                        <th>CallNum2</th>
                        <th>SubjectID</th>
                        <th>Date Borrowed</th>
                        <th>Time Borrowed</th>
                      </tr>
                    </thead>
                    <!-- /thead -->
                    <tbody>
                      <tr>
                        <td colspan="11">Select book to borrow first</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table -->
                <div class="container mt-4">
                  <div class="row">
                    <div class="col-md-8">
                      <form class="form-inline">
                        <div class="form-group mr-2">
                          <label for="accessionNo">Accession No:</label>
                          <input type="text" class="form-control ml-2" id="accessionNo" placeholder="" style="border-radius: 0;" disabled>
                        </div>
                        <div class="form-group mr-2">
                          <label for="purpose">Purpose:</label>
                          <select class="form-control ml-2" id="purpose" style="border-radius: 0;" disabled>
                            <option value="Overnight">Overnight</option>
                            <option value="PhotoCopy">PhotoCopy</option>
                            <option value="Research">Research</option>
                          </select>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-4 text-right mt-3 mt-md-0">
                      <button class="btn btn-primary" id="borrow">
                        Borrow
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </section>




            <!-- end /.card -->
          </div>
          <!-- /.page-section -->
        </div>

      </div>
   
    </div>
  </div>


  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- END BASE JS -->
  <script>
    let clear = 0;
    $(document).ready(function() {

      const fullscreenDiv = document.getElementById("fullscreenDiv");
      const fullscreenButton = document.getElementById("fullscreenButton");

      fullscreenButton.addEventListener("click", toggleFullscreen);

      // Add an event listener for the fullscreenchange event
      document.addEventListener("fullscreenchange", handleFullscreenChange);
      document.addEventListener("mozfullscreenchange", handleFullscreenChange);
      document.addEventListener("webkitfullscreenchange", handleFullscreenChange);

      function toggleFullscreen() {
        if (!isAlertPresent()) {
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
      }

      function isAlertPresent() {
        // You can implement logic to check if an alert is present here.
        // This can vary depending on how alerts are generated in your application.
        // Return true if an alert is present, and false if not.
        return false; // Replace with your alert-checking logic
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

      let ss = true;

      $('#memberID').on('keydown', function(event) {
        if (event.keyCode === 13) {
          // Enter key was pressed
          var memberID = $(this).val();
          if (memberID === '') {
            // Input field is empty
            alert('Please enter a member ID');
          } else {
            $.ajax({
              url: 'checkusr',
              method: 'POST',
              data: {
                memberID: memberID
              },
              success: function(response) {
                if (response.trim() != '') {
                  // Member ID is valid
                  $('#studentname').val(response);
                  $('#studentname').val(response).prop('readonly', true);
                  $('#studentname').val(response).prop('disabled', true);
                  $('#accessionNo').prop('disabled', false);
                } else {
                  // Member ID is invalid
                  alert('Library Members not found');
                }
              },
              error: function(xhr, status, error) {
                // Handle errors
                console.log(error);
              }
            });
          }
        }
      });


      $('#memberID').on('change', function() {
        // Enter key was pressed
        var memberID = $(this).val();
        if (memberID === '') {
          // Input field is empty
          $('#studentname').val('');
          $('#accessionNo').prop('disabled', true);
        } else {
          $.ajax({
            url: 'checkusr',
            method: 'POST',
            data: {
              memberID: memberID
            },
            success: function(response) {
              if (response.trim() != '') {
                // Member ID is valid
                $('#studentname').val(response);
                $('#studentname').val(response).prop('readonly', true);
                $('#studentname').val(response).prop('disabled', true);
                $('#accessionNo').prop('disabled', false);
              } else {
                $('#studentname').val('');
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.log(error);
            }
          });
        }
      });

      $('#accessionNo').on('keydown', function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          // Enter key was pressed
          var accessionno = $(this).val();
          if (accessionno === '') {
            alert('Please enter accession no')
          } else {
            $.ajax({
              url: 'checkbb',
              method: 'POST',
              data: {
                accessionno: accessionno
              },
              dataType: 'json',
              success: function(response) {
                if (clear == 0) {
                  $('#myTable tbody').empty();
                  clear = 1;
                }
                let error = 0;
                if (response.length > 0) {
                  // APPEND TO TABLE.
                  var table = $('#myTable');
                  var tbody = table.find('tbody');
                  var current_time = new Date().toLocaleTimeString();
                  var current_date = new Date().toLocaleDateString();
                  table.find('tbody tr').each(function() {
                    var id = $(this).find('.accessionNoCell').text();
                    if(accessionno == id){
                      error =1;
                    }

                  });
                  $.each(response, function(index, row) {
                    if (row.Response == 'Book is not available') {
                      alert('Book is not available');
                    }else if (error == 1) {
                      alert('Book is Already Added!');
                    } else {
                      var tr = $('<tr data-id="' + row.BookC + '">');
                      tr.append($('<td  data-id="' + row.AccID + '" class="accessionNoCell">').text(row.AccessionNo));
                      localStorage.setItem("BAccessionNo", row.AccessionNo);
                      tr.append($('<td>').text(row.Copies));
                      localStorage.setItem("BCopies", row.Copies);
                      tr.append($('<td>').text(row.Title));
                      localStorage.setItem("BTitle", row.Title);
                      tr.append($('<td>').text(row.AuthorID));
                      localStorage.setItem("BAuthorID", row.AuthorID);
                      tr.append($('<td>').text(row.Location));
                      localStorage.setItem("BLocation", row.Location);
                      tr.append($('<td>').text(row.Source));
                      localStorage.setItem("BSource", row.Source);
                      tr.append($('<td>').text(row.CallNum1));
                      localStorage.setItem("BCallNum1", row.CallNum1);
                      tr.append($('<td>').text(row.CallNum2));
                      localStorage.setItem("BCallNum2", row.CallNum2);
                      tr.append($('<td>').text(row.SubjectID));
                      localStorage.setItem("BSubjectID", row.SubjectID);
                      tr.append($('<td>').text(current_date));
                      localStorage.setItem("BDate", current_date);
                      tr.append($('<td>').text(current_time));
                      localStorage.setItem("BTime", current_time);
                      localStorage.setItem("AccID", row.AccID);
                      localStorage.setItem("BookC", row.BookC);
                      tr.append("$('<td><a data-id='" + row.BookC + "' class='popbookb  btn-sm' id='remove' style='background-color:transparent;'><i class='fa fa-minus' aria-hidden='true'></i></a></td>')");

                      tr.css('background-color', '#1877f2');
                      tr.css('color', 'white');

                      tbody.append(tr);
                      $("#memberID").prop('disabled', true);
                      $('#purpose').prop('disabled', false);
                      ss = false;
                    }
                  });
                } else {

                  alert("Books not found");
                  ss = true;
                  var table = $('#myTable');
                  var tbody = table.find('tbody');
                  $('#purpose').prop('disabled', true)
                }
              },
              error: function(xhr, status, error) {
                // Handle errors
                console.log(error);
              }
            });
          }
        }
      });


      $(document).on('click', '.popbookb', function() {
        var dataId = $(this).attr('data-id'); // Get the id of the button that was clicked on
        $('tr[data-id="' + dataId + '"]').remove(); // Remove the row from the DOM using the data-id attribute
        // You may want to add additional logic here to remove corresponding local storage items or perform other cleanup tasks

      });

      function borrower_check(mem, numborrow, callback) {
        let isAllow = false;
        $.ajax({
          url: 'borrow_check', // Replace with the correct URL for your server
          method: 'POST',
          data: {
            memberid: mem,
            numborrow: numborrow
          },
          success: function(response) {
            console.log(response);
            if (response == 'true') {
              callback(true);
            } else {
              callback(false);
            }
          },
          error: function(xhr, status, error) {
            // Handle any errors that occur during the request
          }
        });
        return isAllow;
      }
      $('#borrow').on('click', function() {
        var table = $('#myTable');
        var tbody = table.find('tbody');
        var bookdata = [];
        var bookObject = {};
        let numborrow = 0;
        // Iterate through all rows in the table
        table.find('tbody tr').each(function() {
          // Get the data-id attribute value
          var bookid = $(this).attr('data-id');
          var AccID = $(this).find('.accessionNoCell').attr('data-id');
          console.log(AccID);
          console.log(bookid);
          numborrow++;

          bookObject = {
            AccID: AccID,
            BookC: bookid,
            memberID: $('#memberID').val(),
            purpose: $('#purpose').val(),
          };
          bookdata.push(bookObject);
        });

        // Add the book object to the bookdata array
    

        if ($('#memberID').val() == '') {
          alert('Please enter a member ID');
        } else if ($('#purpose').val() == '') {
          alert('Please select a purpose');
        } else if (numborrow == 1 && clear == 0) {
          alert('Please select at least one book');
        } else {
          borrower_check($('#memberID').val(), numborrow, function(canBorrow) {
            console.log(numborrow);
            if (canBorrow == false) {
              alert('Member has reached the maximum number of books to borrow, Please Return some books or Minimize the number of books to borrow');
            } else {
              if (confirm('Are you sure you would like to Borrow these books?')) {
                // Send the array of book data in the AJAX request
                $.ajax({
                  url: 'Actionbulkborrow', // Replace with the correct URL for your server
                  method: 'POST',
                  data: {
                    books: JSON.stringify(bookdata),
                  },
                  success: function(response) {
                    if (response.trim() == '') {
                      alert('Books Borrowed Successfully');
                      // Clear the selectedBooks array or perform any other necessary cleanup
                      selectedBooks = [];
                      window.location.reload();
                    } else {
                      console.log(response);
                    }
                  },
                  error: function(xhr, status, error) {
                    // Handle any errors that occur during the request
                  },
                });
              } else {
                // User clicked "Cancel"
              }
            }
          });
        }

      });

    });

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
      handleFlatpickr: function handleFlatpickr() {
        this._fp1();
      }
    };

    
  </script>
  <!-- BEGIN PLUGINS JS -->
  <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
  <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/extensions/buttons/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables/extensions/buttons/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatables/extensions/buttons/buttons.print.min.js"></script>
  <!-- END PLUGINS JS -->
  <!-- BEGIN THEME JS -->
  <script src="assets/javascript/main.min.js"></script>
  <script src="assets/javascript/main2.js"></script>
  <!-- END THEME JS -->
  <!-- BEGIN PAGE LEVEL JS -->
  <script src="assets/javascript/pages/dataTables.bootstrap.js"></script>
  <script src="assets/vendor/sweetalert2.all.min.js"></script>
  
  <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');
  </script>
  </body>

</html>