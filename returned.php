
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
    <title> Books Borrowed and Returned | CHMSU LMS </title>
    <meta property="og:title" content="All Books">
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
        "author":
        {
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
        color:white;
      }
      body{
        background-color:#408080;
        color:black;
      }
      html{  
        background-color:#408080;
        color:black;
      }
      .nav-item.active a {
        color: #ff5733; 
      }
      .has-active a{
        color:#408080 !important;
      }
      .has-child span{
        color:#408080 !important;
      }
      .btn-primary{
        background-color:#408080;
        color:white !important;
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
                <h1 class="page-title mr-sm-auto text-white"> Borrowed and Returned</h1>
                <a href="return.php" class="btn btn-primary btn-sm"  style="margin-left:5px;background-color:white;color:black!important;">Return</a>

                <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;"">Maximize Window</a>
              </div>


              <!-- /title and toolbar -->
            </header>
        
    
            <div class="page-section" >
              <section id="fullscreenDiv" class="card card-fluid" style="border-style: solid;border-color:#408080;">
    
                <header class="card-header">
                  <!-- .nav-tabs -->
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link active show"  href="returned.php">Returned</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="borrowed.php" id="tab2">Borrowed</a>
                    </li>
                  </ul>
                    <!-- /.nav-tabs -->
                </header>
              
                <div class="card-body">
                  
                  <!-- .form-group -->
                  <div class="form-group">
                    <!-- .input-group -->
                    <div class="input-group input-group-alt">
                    
                      <div class="input-group-prepend">
                        <select id="filterBy" class="custom-select">

                          <option value="0" selected>MemberID</option>
                          <option value="1">Name</option>
                          <option value="2">Acession No</option>
                          <option value="3">Copies</option>
                          <option value="4">Title</option>
                          <option value="5">CallNum1</option>
                          <option value="6">CallNum2</option>
                          <option value="7">Author</option>
                          <option value="8">Subject</option>
                          <option value="9">Location</option>
                          <option value="10">Date Borrowed</option>
                          <option value="11">Due Date</option>
                          <option value="12">Date Returned</option>
                          <option value="13">Time Borrowed</option>
                          <option value="14">Due Time</option>
                          <option value="15">Time Returned</option>
                          <option value="16">Porpose</option>
                          <option value="17">Books Fine</option>
                          <option value="18">Paid</option>
                
          
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
                        <input id="table-search" type="text" class="form-control" placeholder="Search Returned"> </div>
                    
                      </div>
                  
                    </div>
                      <?php
                        include 'modules/inc/bulk_modal.php';
                      ?>
                    <table id="myTable" class="table">
                      <!-- thead -->
                      <thead>
                      <tr>
                          <th> MemberID </th>
                          <th> Name </th>
                          <th> Acession No</th>
                          <th> Copies</th>
                          <th>Title </th>
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
                          <th>Porpose</th>
                          <th>Books Fine</th>
                          <th>Paid</th>
                        </tr>
                      </thead>
                      <!-- /thead -->
                    </table>
          
                </div>
              
              </section>
            
            </div>
  
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
$(document).on('click', '.paid', function() {
  event.preventDefault();
    return false;
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
    <script src="assets/javascript/pages/all_returned.js"></script>

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


		
    


			



      $(document).ready(function() {



    
    $('#viewt').click(function() {
        localStorage.setItem('currentTab', 'viewt');
    });
    $('#tab1').click(function() {
        localStorage.setItem('mcurrentTab', 'tab1-tab');
        location.reload();
        window.location.href = '/book_acquisition.php';
    });
    $('#tab2').click(function() {
        localStorage.setItem('mcurrentTab', 'tab2-tab');
        location.reload();
        window.location.href = '/book_acquisition.php';
    });
    $('#tab3-tab').click(function() {
        localStorage.setItem('mcurrentTab', 'tab3-tab');
        window.location.href = '/all_books.php';
    });
    $('#addt').click(function() {
        localStorage.setItem('currentTab', 'addt');
    });
});

		</script>




    <script>
  jQuery(window).on("load", function () {
    localStorage.setItem("topen", false);

  });


</script>

<script>
$(document).ready(function () {
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
    
    <!-- END PAGE LEVEL JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-116692175-1');
    </script>
  </body>
</html>