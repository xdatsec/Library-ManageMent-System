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
  <meta property="og:title" content="Return">
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
  </style>
  <div class="app">
    <?php include "assets/header_nav1.php" ?>
    <div class="wrapper">
      <div class="page">
    
        <div class="page-inner">
          <!-- .page-title-bar -->
          <header class="page-title-bar">
            <!-- .breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                </li>
              </ol>

            </nav>
         
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto text-white"> Return</h1>
           
              <a href="borrow.php" class="btn btn-primary btn-sm" style="margin-left:5px;background-color:white;color:black!important;">Borrow</a>
              <a href="returned.php" class="btn btn-primary btn-sm" style="margin-left:5px;background-color:white;color:black!important;">Borrowed and Returned</a>
              <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>

            </div>


         
          </header>
          <div class="page-section">
            <section id="fullscreenDiv" class="card card-fluid" style="border-style: solid;border-color:#408080;">
              <!-- .card-header -->
              <div class="modal fade" id="fines">
                <div class="modal-dialog modal-lg"> <!-- Add 'modal-lg' class to make it larger -->
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 id="memname"></h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                      <div class="table-responsive">
                        <table id="myTable2" class="table table-striped">
                          <!-- thead -->
                          <thead>
                            <tr>
                              <th>Fine</th>
                              <th>Paid</th>
                              <th>Acc No</th>
                              <th>Location</th>
                              <th>Porpose</th>
                              <th>Due Date</th>
                              <th>Due Time</th>
                              <th>Date Return</th>
                              <th>Time Return</th>
                            </tr>
                          </thead>
                          <!-- /thead -->
                          <tbody>
                            <tr></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="container mt-4" id="amountfines">
                      <span id="amountfines"></span>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>

                  </div>
                </div>
              </div>
              <header class="card-header">
                <ul class="nav nav-tabs card-header-tabs">

                  <li class="nav-item">
                    <a class="nav-link active show" href="book_acquisition.php">Books</a>
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
                        <th>Return</th>
                        <th>Fine</th>
                        <th>Acession No.</th>
                        <th>Copies</th>
                        <th>Title</th>
                        <th>CallNum1</th>
                        <th>CallNum2</th>
                        <th>Author</th>
                        <th>Subject</th>
                        <th>Location</th>
                        <th>Date Borrowed</th>
                        <th>Due Date</th>
                        <th>Date Returned</th>
                        <th>Time Borrowed</th>
                        <th>Due Time</th>
                        <th>Time Returned</th>
                        <th>Purpose</th>


                        
                      </tr>
                    </thead>
                    <!-- /thead -->
                    <tbody>
                      <tr>
                        <td colspan="11">Enter Member id first</td>
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
                        </div>
                        <div class="form-group mr-2">

                        </div>
                      </form>
                    </div>
                    <div class="col-md-4 text-right mt-3 mt-md-0">
                      <button class="btn btn-primary" id="fine" data-toggle="modal" data-target="#fines">
                        Fine
                      </button>
                      <button class="btn btn-primary" id="return">
                       Return
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <!-- /.page-section -->
        </div>
  
      </div>

    </div>
  </div>

  <!-- /.app -->
  <!-- BEGIN BASE JS -->

  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- END BASE JS -->
  <script>
    
    $(document).on('change', '.return_handler1', function() {
      const id = $(this).attr('data-id'); // Get the value of the 'data-id' attribute
      const val = $(this).val(); // Get the value of the input
      if (this.checked) {
        $.ajax({
          url: 'pfine',
          method: 'POST',
          data: {
            dataid: id,
            paid: '1'
          },
          success: function(response) {
            const str = $('#amountfines').text();
            const numericPart = str.replace(/\D/g, ''); // Replace all non-digit characters with an empty string
            const fines = parseInt(numericPart, 10);
            const newval = parseInt(val, 10); // Convert the string to an integer
            const newfine = fines - newval;
            const newfines = parseInt(newfine, 10);
            $('#amountfines').text('Fine:₱' + newfines);
          },
          error: function(xhr, status, error) {
            console.log('Request failed:', error);
          }
        });
      } else {
        $.ajax({
          url: 'pfine',
          method: 'POST',
          data: {
            dataid: id,
            paid: '0'
          },
          success: function(response) {
            const str = $('#amountfines').text();
            const numericPart = str.replace(/\D/g, ''); // Replace all non-digit characters with an empty string
            const fines = parseInt(numericPart, 10);
            const newval = parseInt(val, 10); // Convert the string to an integer
            const newfine = fines + newval;
            const newfines = parseInt(newfine, 10);
            $('#amountfines').text('Fine:₱' + newfines);
          },
          error: function(xhr, status, error) {
            console.log('Request failed:', error);
          }
        });
      }
    });

    $(document).ready(function() {


      if (localStorage.getItem('memberID') != null) {
        let memberID = localStorage.getItem('memberID');
        $.ajax({
          url: 'checkusr',
          method: 'POST',
          data: {
            memberID: memberID
          },
          success: function(response) {
            if (response.trim() != '') {
              // Member ID is valid
              $('#studentname').val(response).prop({
                'readonly': true,
                'disabled': true
              });

              $("#memberID").val(memberID);
              $('#memname').text(response);
              // Send an AJAX request to check the returned books
              $.ajax({
                type: 'POST',
                url: 'checkrb',
                data: {
                  memberID: memberID
                },
                dataType: 'json',
                success: function(data) {
                  // Get the table body element
                  var tbody = $('#myTable tbody');

                  // Clear any existing rows from the table
                  tbody.empty();

                  if (data.length == 0) {
                    tbody.append('<td colspan="11">Member has no Borrowed Books</td>');
                  } else {
                    let fines = 0;
                    // Loop through each book in the data array
                    $.each(data, function(index, book) {
                      // Create a new row for the book
                      var row = $('<tr>');
                      var row2 = $('<tr>');

                      if (book.Return == 1) {

                        row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="">'));
                      } else {

                        if (book.Paid == 1) {
                          row.append($('<td>').html('<input type="checkbox" id="' + 0 + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="' + book.Fine + '">'));
                          row.append($('<td>').text('₱' + 0));
                          fines += 0;

                        } else {
                          row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="' + book.Fine + '">'));
                          row.append($('<td>').html('<strong>₱' + book.Fine+'</strong>'));
                          fines += parseInt(book.Fine);
                        }

                      }
                      $('#amountfines').text('Fine:₱' + fines);
                      row.append($('<td>').text(book.AccessionNo));
                      row.append($('<td>').text(book.Copies));
                      row.append($('<td>').text(book.Title));
                      row.append($('<td>').text(book.CallNum1));
                      row.append($('<td>').text(book.CallNum2));
                      row.append($('<td>').text(book.Author));
                      row.append($('<td>').text(book.Subject));
                      row.append($('<td>').html('<strong>'+book.Location+'</strong>'));
                      row.append($('<td>').text(book.DateBorrowed));
                      row.append($('<td>').text(book.DueDate));
                      row.append($('<td>').text(book.DateReturned));
                      row.append($('<td>').text(book.TimeBorrowed));
                      row.append($('<td>').text(book.DueTime));
                      row.append($('<td>').text(book.TimeReturned));
                      row.append($('<td>').html('<strong>'+book.Purpose+'</strong>'));
                   
                      // Append the row to the table body
                      tbody.append(row);
                    });
                    $.ajax({
                      type: 'POST',
                      url: 'checkrb2',
                      data: {
                        memberID: memberID
                      },
                      dataType: 'json',
                      success: function(data) {
                        // Get the table body element
                        var tbody = $('#myTable2 tbody');

                        // Clear any existing rows from the table
                        tbody.empty();

                        if (data.length == 0) {
                          tbody.append('<td colspan="11">No Available fines</td>');
                        } else {
                          let fines = 0;
                          $.each(data, function(index, book) {
                            // Create a new row for the book
                            var row = $('<tr>');
                            row.append($('<td>').text('₱' + parseInt(book.Fine, 10)));
                            if (book.Paid == 1) {

                              row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]" name="group" value="' + book.Fine + '" checked>'));
                              fines += 0;
                            } else {

                              row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]"  name="group" value="' + book.Fine + '">'));
                              fines += parseInt(book.Fine);


                            }
                            $('#amountfines').text('Fine:₱' + fines);
                            row.append($('<td>').text(book.Acc_No));
                            row.append($('<td>').text(book.Location));
                            row.append($('<td>').text(book.Purpose));
                            row.append($('<td>').text(book.Due_Date));
                            const tdate = new Date(book.Due_Time);

                            // Get the hours, minutes, and seconds from the Date object
                            const hours1 = tdate.getHours();
                            const minutes1 = tdate.getMinutes();
                            const seconds1 = tdate.getSeconds();

                            // Determine if it's AM or PM
                            const period1 = hours1 >= 12 ? "PM" : "AM";

                            // Convert hours to 12-hour format
                            const hours121 = hours1 % 12 || 12;

                            // Create a formatted time string in 12-hour format
                            const dueTime = `${hours121}:${String(minutes1).padStart(2, '0')}${period1}`;

                            row.append($('<td>').text(dueTime));
                            const treturn = new Date(book.Time_Returned);

                            // Get the hours, minutes, and seconds from the Date object
                            const hours = treturn.getHours();
                            const minutes = treturn.getMinutes();
                            const seconds = treturn.getSeconds();

                            // Determine if it's AM or PM
                            const period = hours >= 12 ? "PM" : "AM";

                            // Convert hours to 12-hour format
                            const hours12 = hours % 12 || 12;

                            // Create a formatted time string in 12-hour format
                            const datereturned = `${hours12}:${String(minutes).padStart(2, '0')}${period}`;
                            row.append($('<td>').text(book.Date_Returned));
                            row.append($('<td>').text(datereturned));



                            // Append the row to the table body
                            tbody.append(row);

                          });

                        }
                      },
                      error: function(xhr, status, error) {
                        // Handle any errors
                        console.log('Error: ' + error);
                      }
                    });





                  }
                },
                error: function(xhr, status, error) {
                  // Handle any errors
                  console.log('Error: ' + error);
                }
              });
            } else {
              $('#studentname').val('');
              alert("Library Members not found");
              $('#memname').text("Select a member first");
              var tbody = $('#myTable2 tbody');

              // Clear any existing rows from the table
              tbody.empty();
            }
          },
          error: function(xhr, status, error) {
            // Handle errors
            console.log(error);
          }
        });
      }

    });
    $(document).ready(function() {


      let ss = true;
      $('#memberID').on('keydown', function(event) {
        if (event.keyCode === 13) {
          // Enter key was pressed
          var memberID = $('#memberID').val();
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
                  $('#studentname').val(response).prop({
                    'readonly': true,
                    'disabled': true
                  });
                  localStorage.setItem("memberID", memberID);
                  $('#memname').text(response);

                  // Send an AJAX request to check the returned books
                  $.ajax({
                type: 'POST',
                url: 'checkrb',
                data: {
                  memberID: memberID
                },
                dataType: 'json',
                success: function(data) {
                  // Get the table body element
                  var tbody = $('#myTable tbody');

                  // Clear any existing rows from the table
                  tbody.empty();

                  if (data.length == 0) {
                    tbody.append('<td colspan="11">Member has no Borrowed Books</td>');
                  } else {
                    let fines = 0;
                    // Loop through each book in the data array
                    $.each(data, function(index, book) {
                      // Create a new row for the book
                      var row = $('<tr>');
                      var row2 = $('<tr>');

                      if (book.Return == 1) {

                        row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="">'));
                      } else {

                        if (book.Paid == 1) {
                          row.append($('<td>').html('<input type="checkbox" id="' + 0 + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="' + book.Fine + '">'));
                          row.append($('<td>').text('₱' + 0));
                          fines += 0;

                        } else {
                          row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="' + book.Fine + '">'));
                          row.append($('<td>').html('<strong>₱' + book.Fine+'</strong>'));
                          fines += parseInt(book.Fine);
                        }

                      }
                      $('#amountfines').text('Fine:₱' + fines);
                      row.append($('<td>').text(book.AccessionNo));
                      row.append($('<td>').text(book.Copies));
                      row.append($('<td>').text(book.Title));
                      row.append($('<td>').text(book.CallNum1));
                      row.append($('<td>').text(book.CallNum2));
                      row.append($('<td>').text(book.Author));
                      row.append($('<td>').text(book.Subject));
                      row.append($('<td>').html('<strong>'+book.Location+'</strong>'));
                      row.append($('<td>').text(book.DateBorrowed));
                      row.append($('<td>').text(book.DueDate));
                      row.append($('<td>').text(book.DateReturned));
                      row.append($('<td>').text(book.TimeBorrowed));
                      row.append($('<td>').text(book.DueTime));
                      row.append($('<td>').text(book.TimeReturned));
                      row.append($('<td>').html('<strong>'+book.Purpose+'</strong>'));
                   
                      // Append the row to the table body
                      tbody.append(row);
                    });
                    $.ajax({
                      type: 'POST',
                      url: 'checkrb2',
                      data: {
                        memberID: memberID
                      },
                      dataType: 'json',
                      success: function(data) {
                        // Get the table body element
                        var tbody = $('#myTable2 tbody');

                        // Clear any existing rows from the table
                        tbody.empty();

                        if (data.length == 0) {
                          tbody.append('<td colspan="11">No Available fines</td>');
                        } else {
                          let fines = 0;
                          $.each(data, function(index, book) {
                            // Create a new row for the book
                            var row = $('<tr>');
                            row.append($('<td>').text('₱' + parseInt(book.Fine, 10)));
                            if (book.Paid == 1) {

                              row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]" name="group" value="' + book.Fine + '" checked>'));
                              fines += 0;
                            } else {

                              row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]"  name="group" value="' + book.Fine + '">'));
                              fines += parseInt(book.Fine);


                            }
                            $('#amountfines').text('Fine:₱' + fines);
                            row.append($('<td>').text(book.Acc_No));
                            row.append($('<td>').text(book.Location));
                            row.append($('<td>').text(book.Purpose));
                            row.append($('<td>').text(book.Due_Date));
                            const tdate = new Date(book.Due_Time);

                            // Get the hours, minutes, and seconds from the Date object
                            const hours1 = tdate.getHours();
                            const minutes1 = tdate.getMinutes();
                            const seconds1 = tdate.getSeconds();

                            // Determine if it's AM or PM
                            const period1 = hours1 >= 12 ? "PM" : "AM";

                            // Convert hours to 12-hour format
                            const hours121 = hours1 % 12 || 12;

                            // Create a formatted time string in 12-hour format
                            const dueTime = `${hours121}:${String(minutes1).padStart(2, '0')}${period1}`;

                            row.append($('<td>').text(dueTime));
                            const treturn = new Date(book.Time_Returned);

                            // Get the hours, minutes, and seconds from the Date object
                            const hours = treturn.getHours();
                            const minutes = treturn.getMinutes();
                            const seconds = treturn.getSeconds();

                            // Determine if it's AM or PM
                            const period = hours >= 12 ? "PM" : "AM";

                            // Convert hours to 12-hour format
                            const hours12 = hours % 12 || 12;

                            // Create a formatted time string in 12-hour format
                            const datereturned = `${hours12}:${String(minutes).padStart(2, '0')}${period}`;
                            row.append($('<td>').text(book.Date_Returned));
                            row.append($('<td>').text(datereturned));



                            // Append the row to the table body
                            tbody.append(row);

                          });

                        }
                      },
                      error: function(xhr, status, error) {
                        // Handle any errors
                        console.log('Error: ' + error);
                      }
                    });





                  }
                },
                error: function(xhr, status, error) {
                  // Handle any errors
                  console.log('Error: ' + error);
                }
              });
                } else {
                  $('#studentname').val('');
                  alert("Library Members not found");
                  $('#memname').text("Select a member first");
                  var tbody = $('#myTable2 tbody');

                  // Clear any existing rows from the table
                  tbody.empty();
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
      $('#memberID').on('change', function(event) {

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
                $('#studentname').val(response).prop({
                  'readonly': true,
                  'disabled': true
                });
                $('#memname').text(response);
                localStorage.setItem("memberID", memberID);
                // Send an AJAX request to check the returned books
                $.ajax({
                  type: 'POST',
                  url: 'checkrb',
                  data: {
                    memberID: memberID
                  },
                  dataType: 'json',
                  success: function(data) {
                    // Get the table body element
                    var tbody = $('#myTable tbody');

                    // Clear any existing rows from the table
                    tbody.empty();

                    if (data.length == 0) {
                      tbody.append('<td colspan="11">Member has no Borrowed Books</td>');
                    } else {
                      // Loop through each book in the data array
                      $.each(data, function(index, book) {
                        // Create a new row for the book
                        var row = $('<tr>');
                        if (book.Return == 1) {

                          row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="Option 1">'));
                        } else {
                          if (book.Paid == 1) {
                            row.append($('<td>').html('<input type="checkbox" id="' + 0 + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="Option 1">'));
                            row.append($('<td>').text('₱' + 0));
                          } else {
                            row.append($('<td>').html('<input type="checkbox" id="' + book.Fine + '" data-id="' + book.id + '" class="return_handler" type="checkbox" name="bookID[]" value="' + book.Return + '" name="group" value="Option 1">'));
                            row.append($('<td>').text('₱' + book.Fine));
                          }
                        }

                        row.append($('<td>').text(book.AccessionNo));
                      row.append($('<td>').text(book.Copies));
                      row.append($('<td>').text(book.Title));
                      row.append($('<td>').text(book.CallNum1));
                      row.append($('<td>').text(book.CallNum2));
                      row.append($('<td>').text(book.Author));
                      row.append($('<td>').text(book.Subject));
                      row.append($('<td>').html('<strong>'+book.Location+'</strong>'));
                      row.append($('<td>').text(book.DateBorrowed));
                      row.append($('<td>').text(book.DueDate));
                      row.append($('<td>').text(book.DateReturned));
                      row.append($('<td>').text(book.TimeBorrowed));
                      row.append($('<td>').text(book.DueTime));
                      row.append($('<td>').text(book.TimeReturned));
                      row.append($('<td>').html('<strong>'+book.Porpose+'</strong>'));

                        tbody.append(row);
                      });
                      localStorage.setItem("memberID", memberID);

                      $.ajax({
                        type: 'POST',
                        url: 'checkrb2',
                        data: {
                          memberID: memberID
                        },
                        dataType: 'json',
                        success: function(data) {
                          // Get the table body element
                          var tbody = $('#myTable2 tbody');

                          // Clear any existing rows from the table
                          tbody.empty();

                          if (data.length == 0) {
                            tbody.append('<td colspan="11">No Available fines</td>');
                          } else {
                            let fines = 0;
                            $.each(data, function(index, book) {
                              // Create a new row for the book
                              var row = $('<tr>');
                              row.append($('<td>').text('₱' + parseInt(book.Fine, 10)));
                              if (book.Paid == 1) {

                                row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]"  name="group" value="' + book.Fine + '" checked>'));
                                fines += 0;
                              } else {

                                row.append($('<td>').html('<input type="checkbox"  data-id="' + book.id + '" class="return_handler1" type="checkbox" name="bookID[]" name="group" value="' + book.Fine + '">'));
                                fines += parseInt(book.Fine);

                              }

                              $('#amountfines').text('Fine:₱' + fines);
                              row.append($('<td>').text(book.Acc_No));
                              row.append($('<td>').text(book.Location));
                              row.append($('<td>').text(book.Purpose));
                              row.append($('<td>').text(book.Due_Date));
                              const tdate = new Date(book.Due_Time);

                              // Get the hours, minutes, and seconds from the Date object
                              const hours1 = tdate.getHours();
                              const minutes1 = tdate.getMinutes();
                              const seconds1 = tdate.getSeconds();

                              // Determine if it's AM or PM
                              const period1 = hours1 >= 12 ? "PM" : "AM";

                              // Convert hours to 12-hour format
                              const hours121 = hours1 % 12 || 12;

                              // Create a formatted time string in 12-hour format
                              const dueTime = `${hours121}:${String(minutes1).padStart(2, '0')}${period1}`;

                              row.append($('<td>').text(dueTime));
                              const treturn = new Date(book.Time_Returned);

                              // Get the hours, minutes, and seconds from the Date object
                              const hours = treturn.getHours();
                              const minutes = treturn.getMinutes();
                              const seconds = treturn.getSeconds();

                              // Determine if it's AM or PM
                              const period = hours >= 12 ? "PM" : "AM";

                              // Convert hours to 12-hour format
                              const hours12 = hours % 12 || 12;

                              // Create a formatted time string in 12-hour format
                              const datereturned = `${hours12}:${String(minutes).padStart(2, '0')}${period}`;
                              row.append($('<td>').text(book.Date_Returned));
                              row.append($('<td>').text(datereturned));



                              // Append the row to the table body
                              tbody.append(row);

                            });

                          }
                        },
                        error: function(xhr, status, error) {
                          // Handle any errors
                          console.log('Error: ' + error);
                        }
                      });

                    }
                  },
                  error: function(xhr, status, error) {
                    // Handle any errors
                    console.log('Error: ' + error);
                  }
                });
              } else {
                $('#studentname').val('');
                $('#memname').text("Select a member first");
                var tbody = $('#myTable2 tbody');

                // Clear any existing rows from the table
                tbody.empty();
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.log(error);
            }
          });
        }

      });
    });

    $('#return').on('click', function() {
      var checkedCheckboxes = $('.return_handler:checked');

      if ($('#memberID').val() == '') {
        alert('Please enter a member ID');
      } else if (checkedCheckboxes.length === 0) {
        alert('Select at least one book to return');
      } else {
        var allValid = true;
        var selectedBooks = [];

        checkedCheckboxes.each(function() {
          var dataId = $(this).attr('data-id');
          var id = $(this).attr('id');
          if (id > 0) {
            alert('Can\'t be returned while it has a fine, Please pay the fine first');
            allValid = false;
            return false; // Exit the loop
          }

          // Collect data for selected books
          selectedBooks.push({
            dataId: dataId
          });
        });

        if (allValid) {
          if (confirm("Are you sure you would like to Return these books?")) {
            var memberID1 = $('#memberID').val();

            // Send selectedBooks array to the server for bulk update
            $.ajax({
              type: 'POST',
              url: 'Actionreturn',
              data: {
                memberID: memberID1,
                dataids: selectedBooks
              }, // Removed JSON.stringify
              success: function(data) {

                localStorage.setItem("memberID", memberID1);
                window.location.reload();
              },
              error: function(xhr, status, error) {
                // Handle any errors
                console.log('Error: ' + error);
              }
            });
          } else {
            // User clicked "Cancel" in the confirmation dialog
          }
        }
      }
    });



    $('#fines').on('hidden.bs.modal', function() {
      window.location.reload();
    });
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
      handleFlatpickr: function handleFlatpickr() {
        this._fp1();
      }
    };
  </script>






  <!-- END PAGE LEVEL JS -->
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