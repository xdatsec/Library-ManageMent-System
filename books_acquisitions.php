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
  <title> Books Acquisition's | CHMSU LMS </title>
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


    .fullscreenDiv {
      overflow: auto;
      

    }



    iframe {
      
      width: 100%;
    }


    
    
    ::-webkit-scrollbar {
      width: 0;
    }

    
    ::-webkit-scrollbar {
      height: 0;
    }

    
    
    html {
      scrollbar-width: none;
    }

    
    html {
      scrollbar-width: none;
    }
  </style>
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>

  <div class="app">
    <?php include "assets/header_nav1.php" ?>
    <div class="wrapper">
  
      <div class="page">
  
        <div class="page-inner">
    
          <header class="page-title-bar">
            <!-- .breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">

              </ol>

            </nav>
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto text-white"> Books Acquisition</h1>
              <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>
           </div>
    
          </header>
 
     
          <div id="fullscreenDiv" class="container mt-5" style="border-color:#408080;background-color:#408080;">
            <iframe src="book_acquisition.php" id="" frameborder="0"  onload="resizeIframe(this)"></iframe>
          </div>

  
        </div>

      </div>



    </div>
  </div>
  <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="margin-top:10px;">
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
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
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
          var iframe = document.querySelector('iframe[src="book_acquisition.php"]');
          iframe.addEventListener('load', function() {
          console.log('Iframe has finished loading');
          resizeIframe(this);
          });

          function resizeIframe(obj) {
            try {
              const fullscreendiv = document.getElementById('fullscreenDiv');
                obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
                fullscreendiv.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
                console.log('New height set', obj.style.height);
                if(obj.contentWindow.document.documentElement.scrollHeight < 300){
                  obj.style.height = 1059+'px'; //to avoid small iframe
                  console.log('New height set', obj.style.height);
                  
                }
            } catch (error) {
              console.error('Error resizing iframe', error);
            }
          }   
          var currentIndex = 0;
          var history = []; // Will hold the fetched history data

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
                // Open the modal only if the history array is not empty
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
          // Reload the page
          location.reload();
        });

        if (typeof $('#myTable2').attr('data-id') != 'undefined') {
          var table = $('#myTable2').DataTable({
            dom: '<\'text-muted\'Bi>\n        <\'table-responsive\'tr>\n        <\'mt-4\'p>',
            paging: false, // Disable paging
            scrollY: '200px', // Vertical scroll height
            info: false,
            ordering: false,
            scrollX: true, // Enable horizontal scrolling
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

          // Initialize pickers after adding the row
          pickers.init();

          $('#emptyRow input[name="Encoder"]').on('input', function() {
            // Get the original value from the "encoderCookie" cookie
            var originalEncoderValue = "<?php echo $username ?>";

            if ($(this).val() !== originalEncoderValue) {
              // If the value has changed, reset it to the original value
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

          // Initialize pickers after adding the row
          pickers.init();

          $('#emptyRow input[name="Encoder"]').on('input', function() {
            // Get the original value from the "encoderCookie" cookie
            var originalEncoderValue = "<?php echo $username ?>";

            if ($(this).val() !== originalEncoderValue) {
              // If the value has changed, reset it to the original value
              $(this).val(originalEncoderValue);
            }
          });
          clickCount = 0;

          $.ajax({
            url: 'GPLACE',
            dataType: 'json',
            success: function(data) {

              // Populate the select element with the data
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
              url: 'getapid=' + id, // Pass the ID in the URL
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                if (data.length === 0) {
                  var table = $('#myTable3');
                  table.find('tr').not(':first').remove();
                  $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');


                }

                // Assuming all objects in 'data' have the same structure
                var firstItem = data[0];

                // Create table headers based on object properties
                var tableHeaders = '<tr>';
                for (var key in firstItem) {
                  if (firstItem.hasOwnProperty(key)) {
                    tableHeaders += '<th>' + key + '</th>';
                  }
                }
                tableHeaders += '</tr>';

                $('#myTable thead').html(tableHeaders); // Set table headers

                // Loop through the data and append rows
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
                  // Remove all tr elements from the table except for the first row
                  table.find('tr').not(':first').remove();
                  var span = $(this).find('span');
                  var id = span.attr('id');
                  localStorage.setItem("localid", id);
                  $.ajax({
                    url: 'getapid=' + id, // Pass the ID in the URL
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                      if (data.length === 0) {
                        var table = $('#myTable3');
                        table.find('tr').not(':first').remove();
                        $('#myTable3').find('tbody').append('<tr id="no-data-row"><td colspan="100" class="text-center">To add Fill the form above</td></tr>');


                      }

                      // Assuming all objects in 'data' have the same structure
                      var firstItem = data[0];

                      // Create table headers based on object properties
                      var tableHeaders = '<tr>';
                      for (var key in firstItem) {
                        if (firstItem.hasOwnProperty(key)) {
                          tableHeaders += '<th>' + key + '</th>';
                        }
                      }
                      tableHeaders += '</tr>';

                      $('#myTable thead').html(tableHeaders); // Set table headers

                      // Loop through the data and append rows
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });

                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }


                  });
                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });

                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
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

                      // Add any additional data you want to send
                    },
                    success: function(response) {
                      // Handle the successful response here
                      console.log('Success:', response);
                      table.ajax.reload();
                      location.reload();

                    },
                    error: function(xhr, status, error) {
                      // Handle any errors here
                      console.error('Error:', error);
                    }
                  });


                }



              } else {
                isFirstClick = false;
                showEmptyRowAtEnd();
                latestGeneratedDataId = clickedDataId; // Update the latest generated data-id
              }

            } else {
              // Handle other cases if needed
            }
          });

          function reloads1() {
            const table = $('#myTable2').DataTable();
            var $scrollBody = $(table.table().node()).parent();
     
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



        });
      });
    </script>

    <script src="assets/vendor/sweetalert2.all.min.js"></script>
  
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
              $(elem).parent().addClass('editable_date');
              $(elem).parent().html(newValue);
              topen = false;
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
                        $(elem).parent().addClass('editable1');
                        $(elem).parent().html(newValue);
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
              $(elem).parent().addClass('editable1');
              $(elem).parent().html(newValue);

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
              $(elem).parent().addClass('editable2');
              $(elem).parent().html(selectedOptionText);
              localStorage.setItem("ttopen", "false");
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
    <script>
      $(document).ready(function() {
        const fullscreenDiv = document.getElementById("fullscreenDiv");
        const fullscreenButton = document.getElementById("fullscreenButton");
        let iframe;

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
              iframe = fullscreenDiv.querySelector("iframe");
              if (iframe) {
                iframe.contentDocument.documentElement.style.zoom = 0.75; // Set zoom to 75%
                iframe.addEventListener("load", () => {
                  // Reapply the zoom level after iframe reloads
                  iframe.contentDocument.documentElement.style.zoom = 0.75;
                });
              }
            } else if (fullscreenDiv.mozRequestFullScreen) {
              fullscreenDiv.mozRequestFullScreen();
              localStorage.setItem("fullscreen", "true");
              iframe = fullscreenDiv.querySelector("iframe");
              if (iframe) {
                iframe.contentDocument.documentElement.style.zoom = 0.75; // Set zoom to 75%
                iframe.addEventListener("load", () => {
                  // Reapply the zoom level after iframe reloads
                  iframe.contentDocument.documentElement.style.zoom = 0.75;
                });
              }
            } else if (fullscreenDiv.webkitRequestFullscreen) {
              fullscreenDiv.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
              localStorage.setItem("fullscreen", "true");
              iframe = fullscreenDiv.querySelector("iframe");
              if (iframe) {
                iframe.contentDocument.documentElement.style.zoom = 0.75; // Set zoom to 75%
                iframe.addEventListener("load", () => {
                  // Reapply the zoom level after iframe reloads
                  iframe.contentDocument.documentElement.style.zoom = 0.75;
                });
              }
            }
          }
        }

        function handleFullscreenChange() {
          if (!document.fullscreenElement) {
            localStorage.removeItem("fullscreen");
            if (iframe) {
              iframe.contentDocument.documentElement.style.zoom = 1; // Set zoom to 100%
            }
          }
        }
      });
    </script>



    <!-- END PAGE LEVEL JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    </body>

</html>