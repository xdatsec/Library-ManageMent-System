<?php
session_start();

if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}

$_SESSION['locator'] = 'tr';
$_SESSION['members'] = 'false';
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
  <title> Inventory | CHMSU LMS </title>
  <meta property="og:title" content="Inventory">
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
      <!-- .page -->
      <div class="page">
        <!-- .page-inner -->
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

            <!-- title and toolbar -->
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto text-white"> Books Inventory</h1>

              <!-- .btn-toolbar -->
              <!---actions-->

                      <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>

            </div>

          </header>
       

          <div class="page-section">
            <header class="card-header" style="background-color: white;border-radius: 0px;border: none;">
                    
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link active show" href="inventory.php" >Books</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="inventory_t.php">Thesis</a>
                </li>


                
              </ul>
              
            </header>
       
            <section class="card card-fluid" id="fullscreenDiv">
           
              <div class="card-body">
                <div class="form-group">
         
                  <div class="input-group input-group-alt">
       
                    <div class="input-group-prepend">
                      <select id="filterBy" class="custom-select">
                        <option value="">Acession No</option>

                      </select>
                    </div>
                 
                    <div class="input-group has-clearable">
                      <button id="clear-search" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">
                          <i class="fa fa-times-circle"></i>
                        </span>
                      </button>
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <span class="oi oi-magnifying-glass"></span>
                        </span>
                      </div>
                      <input id="table-search" type="text" class="form-control" placeholder="Search Inventory">
                    </div>
                    <!-- /.input-group -->
                  </div>
                  <!-- /.input-group -->
                </div>
                <div class="row mt-3">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="selectOption" class="form-label">Filter:</label>
                      <select class="form-control small-select" id="filtertype" style="width:124px;">
                        <option value="0" selected>All</option>
                        <option value="1">Existing</option>
                        <option value="2">Non-Existing</option>
                        <option value="3">Lost</option>
                      </select>
                    </div>
                    <hr>
                  </div>

                </div>
                <!--delete modal-->
                <?php
                include 'modules/inc/bulk_modal.php';
                ?>
                <!--end delete modal-->
                <div class="container mt-4">
                  <form class="form-inline">
                    <div class="form-group mr-2">
                      <label for="year">Year:</label>
                      <?php
                      $currentYear = date('Y');
                      ?>
                      <input type="text" class="form-control ml-2" id="year" placeholder="" value="<?php if (!isset($_SESSION['invyears'])) {
                                                                                                      echo $currentYear;
                                                                                                    } else {
                                                                                                      echo $_SESSION['invyears'];
                                                                                                    } ?>" style="border-radius: 0;">
                    </div>
                    <div class="form-group flex-grow-1">
                      <button type="buttton" class="btn btn-primary" id="invstart" style="border-radius: 0;">Begin new Inventory</button>
                    </div>
                  </form>
                </div>
                <!-- /.form-group -->
                <!-- .table -->
                <table id="myTable" class="table">
                  <!-- thead -->
                  <thead>
                    <tr>
                      <th>Existing</th>
                      <th>Status</th>
                      <th>AccessionNo</th>
                      <th>Copies</th>
                      <th>Title</th>
                      <th>Author1LN</th>
                      <th>Author1FN</th>
                      <th>Author1MI</th>
                      <th>PublisherName</th>
                      <th>PlaceofPublication</th>
                      <th>Subject</th>
                      <th>CallNum1</th>
                      <th>CallNum2</th>
                      <th>CopyrightYear</th>
                      <th>DateReceived</th>
                      <th>ISBNNumber</th>
                      <th>EditionNumber</th>
                      <th>Location</th>
                      <th>BPages</th>
                      <th>MR Page</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <!-- /thead -->
                </table>
                <!-- /.table -->
              </div>
              <!-- /.card-body -->
            </section>
            <!-- /.card -->
          </div>
          <!-- /.page-section -->
        </div>
        <!-- /.page-inner -->
      </div>
      <!-- /.page -->
    </div>

    </main>

  </div>
  <script>
    $(document).ready(function() {
      $('#table-search').on('keyup change focus', function(e) {
        var table = $('#myTable').DataTable();

        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
      });

      function datatables(types) {
        var table = $('#myTable').DataTable();
        table.destroy();

        $('#myTable').DataTable({
          dom: '<\'text-muted\'Bi>\n        <\'table-responsive\'tr>\n        <\'mt-4\'p>',
          buttons: [],
          language: {
            zeroRecords: "No records found.",
            paginate: {
              previous: '<i class="fa fa-lg fa-angle-left"></i>',
              next: '<i class="fa fa-lg fa-angle-right"></i>'
            }

          },

          autoWidth: false,
          ajax: types,
          deferRender: true,
          order: [
            [7, 'asc']
          ],
          columns: [{
              data: 'AccID',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Status',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'AccessionNo',
              className: 'align-middle'
            },
            {
              data: 'Copies',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Title',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Author1LN',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Author1FN',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Author1MI',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'PublisherName',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'PlaceofPublication',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Subject',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'CallNum1',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'CallNum2',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'CopyrightYear',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'DateReceived',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'ISBNNumber',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'EditionNumber',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Location',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'BPages',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'MR Page',
              className: 'align-middle',
              searchable: false
            },
            {
              data: 'Remarks',
              className: 'align-middle',
              searchable: false
            }

          ],
          columnDefs: [{
            targets: 0,
            render: function render(data, type, row, meta) {
              if (row.Existing == 1) {

                return '<select class="form-control inventoryhandler"  data-id="' + row.AccID + '"  style="width:100px;"><option value=""></option> <option value="yes" selected>Yes</option><option value="no">No</option></select>';
              } else if (row.Existing == 0) {

                return '<select class="form-control inventoryhandler"  data-id="' + row.AccID + '"  style="width:100px;"><option value=""></option> <option value="yes">Yes</option><option value="no" selected>No</option></select>';
              } else if (row.Existing == 2) {

                return '<select class="form-control inventoryhandler"  data-id="' + row.AccID + '"  style="width:100px;"><option value="" selected></option> <option value="yes">Yes</option><option value="no" >No</option></select>';
              } else {
                return '<select class="form-control inventoryhandler"  data-id="' + row.AccID + '"  style="width:100px;display:none;"><option value="" selected></option> <option value="yes">Yes</option><option value="no" >No</option></select>';
              }
            }
          }]


        });
      }
      $(document).on('change', '#filtertype', function() {
        let type = $(this).val();
        if (type == '0') {
          let inventory = "inventory";
          datatables(inventory);
        } else if (type == '1') {
          let inventory = "inventory_e";
          datatables(inventory);
        } else if (type == '2') {
          let inventory = "inventory_ne";
          datatables(inventory);
        } else {
          let inventory = "inventory_l";
          datatables(inventory);
        }


      });
      $(document).on('change', '.inventoryhandler', function() {
        let yesno = $(this).val();
        let id = $(this).attr("data-id");
        let year = $("#year").val();
        const type ="Books";
        $.ajax({
          url: 'saveinventory', // Replace with the correct URL for your server
          method: 'POST',
          data: {
            type: type,
            AccID: id,
            exist: yesno,
            year: year
          },
          success: function(response) {
            localStorage.setItem('inv', 'true');
            localStorage.setItem('invyear', year);
          },
          error: function(xhr, status, error) {
            // Handle any errors that occur during the request
          }
        });
      });

      $("#invstart").click(function(e) {
        e.preventDefault();
        let year = $("#year").val();
        var confirmed = confirm('Are you sure, Do you want to Start new inventory?');
        if (confirmed) {
          $.ajax({
            url: 'destroyinv', // Replace with the correct URL for your server
            method: 'POST',
            data: {
              year: year
            },
            success: function(response) {
              location.reload();
            },
            error: function(xhr, status, error) {
              // Handle any errors that occur during the request
            }
          });
        }
      });
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
  </script>

  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- END BASE JS -->

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
  <script src="assets/javascript/pages/inventory.js"></script>

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




  <script>
    jQuery(window).on("load", function() {
      localStorage.setItem("topen", false);

    });
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