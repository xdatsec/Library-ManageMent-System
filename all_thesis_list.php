
<?php 
session_start();
if (isset($_SESSION["loggedin"])) {

} else {
    header('Location: /signin.php');
    exit;
}
$_SESSION['members'] =='false';
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
    <title> Books Acquisition's | CHMSU LMS </title>
    <meta property="og:title" content="Thesis">
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
    <link rel="stylesheet" href="assets/vendor/fontaw/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/fontaw/css/solid.css">
<link rel="stylesheet" href="assets/vendor/fontaw/css/regular.css">
<link rel="stylesheet" href="assets/vendor/fontaw/css/brands.css">
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
#fullscreenDiv {
   
   overflow: auto; 
}
    </style>

    <div class="app">
      <!-- .app-header -->

              <!-- .nav -->
             <?php include "assets/header_nav1.php" ?>
              <!-- /.nav -->
              <!-- .btn-account -->
             
              <!-- /.btn-account -->


</a>
        <!-- .wrapper -->
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
                  <h1 class="page-title mr-sm-auto">Thesis</h1>
                  <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);" style="margin-left:5px;background-color:white;color:black!important;">Maximize Window</a>
  

        

</div>


                <!-- /title and toolbar -->
              </header>
              <!-- /.page-title-bar -->
              <!-- .page-section -->
              
              <div class="page-section">
             
                <!-- .card -->
                <section class="card card-fluid" id="fullscreenDiv"  style="border-style: solid;border-color:#408080;">
                  <!-- .card-header -->
                  <header class="card-header">
                    <!-- .nav-tabs -->
                    <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link"  id="tab1">Data Entry</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link"  id="tab2">Abstract</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active show"  href="all_thesis_list.php">List</a>
                      </li>
                  

  
                      
                    </ul>
                      <!-- /.nav-tabs -->
                  </header>
                  <!-- /.card-header -->
                  <!-- .card-body -->
                  <div class="card-body" style="border-style: solid;border-color:#408080;">
                    
                    <!-- .form-group -->
                    <div class="form-group">
                      <!-- .input-group -->
                      <div class="input-group input-group-alt">
                        <!-- .input-group-prepend -->
                        <div class="input-group-prepend">

                  


                          <select id="filterBy" class="custom-select">
                            <option value='' selected>All</option>
                            <option value='0'>AccessionNo</option>
                            <option value="1">Title</option>
                            <option value="2">Author</option>
                            <option value="3">CopyrightYear</option>
                            <option value="4">DateReceived</option>
                            <option value="5">Quantity</option>
                            <option value="6">Type</option>
                            <option value="7">DateEncoded</option>
                            <option value="8">Encoder</option>
     
          
                          </select>
                        </div>
                        <!-- /.input-group-prepend -->
                        <!-- .input-group -->
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
                          <input id="table-search" type="text" class="form-control" placeholder="Search Thesis"> </div>
                        <!-- /.input-group -->
                      </div>
                      <!-- /.input-group -->
                    </div>

                   <!--delete modal-->
     <?php
     include 'modules/inc/bulk_modal.php';
      ?>
    <!--end delete modal-->
                     
                    <!-- /.form-group -->
                    <!-- .table -->
                    <table id="myTable" class="table">
                      <!-- thead -->
                      <thead>
                        <tr>
              
                
                          <th> AccessionNo </th>
                          <th> Title </th>
                          <th> Author </th>
                          <th> CopyrightYear</th>
                          <th>DateReceived </th>
                          <th> Quantity</th>
                          <th> Type</th>
                          <th>DateEncoded</th>
                          <th>Encoder</th>
                          <th>Index</th>
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
        <!-- /.wrapper -->
      </main>
      <!-- /.app-main -->
    </div>
    <!-- /.app -->
    <!-- BEGIN BASE JS -->

    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- END BASE JS -->
    <script>
$(document).ready(function(){


});


      </script>

<script>
$(document).ready(function () {
   const fullscreenDiv = document.getElementById("fullscreenDiv");
   const fullscreenButton = document.getElementById("fullscreenButton");

   fullscreenButton.addEventListener("click", toggleFullscreen);

   
   document.addEventListener("fullscreenchange", handleFullscreenChange);
   document.addEventListener("mozfullscreenchange", handleFullscreenChange);
   document.addEventListener("webkitfullscreenchange", handleFullscreenChange);

   function toggleFullscreen() {
       if (fullscreenDiv) {
           if (fullscreenDiv.requestFullscreen) {
               fullscreenDiv.requestFullscreen();
               localStorage.setItem("fullscreen", "true");
               setZoomLevel(fullscreenDiv, 0.75); 
           } else if (fullscreenDiv.mozRequestFullScreen) {
               fullscreenDiv.mozRequestFullScreen();
               localStorage.setItem("fullscreen", "true");
               setZoomLevel(fullscreenDiv, 0.75); 
           } else if (fullscreenDiv.webkitRequestFullscreen) {
               fullscreenDiv.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
               localStorage.setItem("fullscreen", "true");
               setZoomLevel(fullscreenDiv, 0.75); 
           }
       }
   }

   function handleFullscreenChange() {
       if (!document.fullscreenElement) {
           
           setZoomLevel(fullscreenDiv, 1); 
           localStorage.removeItem("fullscreen");
       }
   }

   function setZoomLevel(element, zoomLevel) {
       element.style.zoom = zoomLevel;
   }
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
    <script src="assets/javascript/pages/all_thesis.js"></script>

    <script src="assets/vendor/sweetalert2.all.min.js
"></script>
<link href="assets/vendor/sweetalert2.min.css
" rel="stylesheet">
<script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>

window.addEventListener('load', function() {
    

});
</script>
<script type="text/javascript" language="javascript" class="init">
		var pickers = {
  init: function init() {

    this.bindUIActions();
  },
  bindUIActions: function bindUIActions() {

    
    this.handleFlatpickr();
  },
  _fp1: function _fp1() {
    
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
        localStorage.setItem('currentTab1_T', 'viewt');
    });
    $('#tab1').click(function() {
        localStorage.setItem('mcurrentTab1_T', 'tab1-tab');
        location.reload();
        window.location.href = '/thesis.php';
    });
    $('#tab2').click(function() {
        localStorage.setItem('mcurrentTab1_T', 'tab2-tab');
        location.reload();
        window.location.href = '/thesis.php';
    });
    $('#tab3-tab').click(function() {
        localStorage.setItem('mcurrentTab1_T', 'tab3-tab');
        window.location.href = 'all_members_list.php';
    });

});


		</script>




    <script>
  jQuery(window).on("load", function () {
    localStorage.setItem("topen", false);
    history.pushState(null, null, '/thesis.php');

  });

  $('#myTable').on('click', 'tr', function() {
  
  if ($(this).closest('thead, th').length === 0) {
    var span = $(this).find('span');
    
    var id = span.attr('id');
    localStorage.setItem('currentIndex1_t', id);
    alert("Selected!");
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