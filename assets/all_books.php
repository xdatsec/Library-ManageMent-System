
<?php 
session_start();
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
    <title> Books Acquisition's | CHMSU LMS </title>
    <meta property="og:title" content="All Books">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="author" content="CodecMaker">
    
    <meta property="og:locale" content="en_US">
    <meta name="description" content="A Library Management System">
    <meta property="og:description" content="A Library Management System">
    <link rel="canonical" href="//chmsulms.com">
    <meta property="og:url" content="//chmsulms.com">
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
      <!-- .app-header -->

              <!-- .nav -->
             <?php include "assets/header_nav1.php" ?>
              <!-- /.nav -->
              <!-- .btn-account -->
             
              <!-- /.btn-account -->
            

        <!-- .html{ -->
        <div class="wrapper" >
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
                  <h1 class="page-title mr-sm-auto"> Books Acquisition</h1>
                  <!-- .btn-toolbar -->
        

</div>


                <!-- /title and toolbar -->
              </header>
              <!-- /.page-title-bar -->
              <!-- .page-section -->
              
              <div class="page-section">
                
                <!-- .card -->
                <section class="card card-fluid" style="border-style: solid;border-color:#408080;">
                  <!-- .card-header -->
                  <header class="card-header">
                    <!-- .nav-tabs -->
                    <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link"  id="tab1">Page1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link"  id="tab2">Page2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active show"  href="book_acquisition.php">Page3</a>
                      </li>

  
                      
                    </ul>
                      <!-- /.nav-tabs -->
                  </header>
                  <!-- /.card-header -->
                  <!-- .card-body -->
                  <div class="card-body">
                    
                    <!-- .form-group -->
                    <div class="form-group">
                      <!-- .input-group -->
                      <div class="input-group input-group-alt">
                        <!-- .input-group-prepend -->
                        <div class="input-group-prepend">

                  


                          <select id="filterBy" class="custom-select">
                            <option value='' selected>Title</option>
                            <option value="1">Subjects</option>
                            <option value="2">PublisherName</option>
                            <option value="3">PlaceofPublication</option>
                            <option value="4">Book No.</option>
                            <option value="5">Author No</option>
                            <option value="6">BookID</option>
                
          
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
                          <input id="table-search" type="text" class="form-control" placeholder="Search Books"> </div>
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
                
                          <th> Title </th>
                          <th> Subject </th>
                          <th> Publishing Name </th>
                          <th> Place of Publication</th>
                          <th> Book No. </th>
                          <th> Author No</th>
                          <th> Book ID</th>
                          <th>index NO</th>
                          
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
        <!-- /.html{ -->
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
    <script src="assets/javascript/pages/all_books.js"></script>

    <script src="assets/vendor/sweetalert2.all.min.js
"></script>
<link href="assets/vendor/sweetalert2.min.css
" rel="stylesheet">
<script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>
// Wait for the page to completely load
window.addEventListener('load', function() {
    // Set the URL history to "/booksquisition"
    history.pushState({}, '', '/book_acquisition.php');
});
</script>
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

  $('#myTable').on('click', 'tr', function() {
  // Check if the clicked element has a 'thead' or 'th' ancestor element
  if ($(this).closest('thead, th').length === 0) {
    var span = $(this).find('span');
    // Get the ID of the <span> element
    var id = span.attr('id');
    localStorage.setItem('currentIndex', id);
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