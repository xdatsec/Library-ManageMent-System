
<?php 
session_start();
$_SESSION['locator'] = 'tr';
$_SESSION['members'] = 'false';
if (isset($_SESSION["loggedin"])) {
    
} else {
    header('Location: /signin.php');
    exit;
}
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Alumni | CHMSU LMS </title>
    <meta property="og:title" content="Alumni">
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
    <!-- END THEME STYLES -->
  </head>
  <body>
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
              <?php include 'assets/header_nav1.php'; ?>
     
        <!-- .wrapper -->
        <div class="wrapper">
          <!-- .page -->
          <div class="page">
            <!-- .page-inner -->
            <div class="page-inner">
              <!-- .page-title-bar -->
              <header class="page-title-bar">
                <!-- .breadcrumb -->
                
                <div class="d-md-flex align-items-md-start"><h1 class="page-title mr-sm-auto text-white">Alumni</h1>
                  <!-- .btn-toolbar -->
                  <a id="fullscreenButton" class="btn btn-primary btn-sm" href="javascript:void(0);"style="background-color:white;color:black!important;">Maximize Window</a>
                  <a class="btn btn-primary btn-sm" href="javascript:void(0);" style="background-color:white;color:black!important;"  data-toggle="modal" data-target="#memberModal">ADD</a>
                </div>
                <!-- /MODAL -->

                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="memberModalLabel">Enter Member ID</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="member-id" class="col-form-label">Member ID:</label>
            <input type="text" class="form-control" id="member-id">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="savealumni btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

                <!-- /.breadcrumb -->
              </header>
              <!-- /.page-title-bar -->
              <!-- .page-section -->
              <div class="page-section">
                <!-- .card -->
                <section class="card card-fluid" id="fullscreenDiv" style="border-style: solid;border-color:#408080;">
                  <!-- .card-header -->
          
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
                          <option value='' selected> All </option>
                            <option value="1">Full Name</option>
                            <option value="3">LastName</option>
                            <option value="4">FirstName</option>
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
                          <input id="table-search" type="text" class="form-control" placeholder="Search Members"> </div>
                        <!-- /.input-group -->
                      </div>
                      <!-- /.input-group -->
                    </div>
                    <!-- /.form-group -->
                      <!--delete modal-->
     <?php
     include 'modules/inc/bulk_modal.php';
      ?>
    <!--end delete modal-->
                    <!-- .table -->
                    <table id="myTable" class="table">
                      <!-- thead -->
                      <thead>
                        <tr>
                  
                        <th colspan="2" style="min-width: 20px;text-align: center;" rowspan="1">
                          Full Name
                            </th>
                          <th> LastName </th>
                          <th> FirstName </th>
                          <th> MiddleName </th>
     
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
    <script>
$(document).ready(function () {
   const fullscreenDiv = document.getElementById("fullscreenDiv");
   const fullscreenButton = document.getElementById("fullscreenButton");

   fullscreenButton.addEventListener("click", toggleFullscreen);

   
   document.addEventListener("fullscreenchange", handleFullscreenChange);
   document.addEventListener("mozfullscreenchange", handleFullscreenChange);
   document.addEventListener("webkitfullscreenchange", handleFullscreenChange);

   function toggleFullscreen() {
    if (!isAlertPresent()) {
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
}

function isAlertPresent() {
  
    return false; 
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
    <!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script>
$(document).ready(function(){
$('.savealumni').click(function(){
  var memberid = $('#member-id').val();
  $.ajax({
    url: 'addalumni',
    method: 'POST',
    data:{
      memberid:memberid
    },
    success:function(data){
      alert(data);
      location.reload();
    }
  });
})
$(document).on('click','#remove',function(){
  let delpop = confirm('Are you sure you want to delete this alumni?');
  if(delpop == true){
  var id = $(this).attr('data-id');
  $.ajax({
    url: 'deletealumni',
    method: 'POST',
    data:{
      id:id
    },
    success:function(data){
      alert(data);
      location.reload();
    }
  });
}else{
  return false;
}
});

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
    <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/javascript/pages/dataTables.bootstrap.js"></script>
    <script src="assets/javascript/pages/all_alumni2.js"></script>
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