<?php
session_start();
$_SESSION['members'] = false;
$_SESSION['locator'] = 'rp';
if (isset($_SESSION["loggedin"])) {
  if ($_SESSION['isSuperAdmin'] == 0) {
    header('Location: /index.php');
  }
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
  <title> Accession Book Report </title>
  <meta property="og:title" content="Accession Book Report">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta name="author" content="CodecMaker">

  <meta property="og:locale" content="en_US">
  <meta name="description" content="A Library Management System">
  <meta property="og:description" content="A Library Management System">

  <meta property="og:site_name" content="CHMSU LMS ">

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
  <!-- BEGIN THEME STYLES -->
  <link rel="stylesheet" href="assets/stylesheets/main.min.css">
  <link rel="stylesheet" href="assets/stylesheets/custom.css">
  <!-- END THEME STYLES -->
</head>
<style>
#iframe-container iframe::-webkit-scrollbar {
    display: none; 
}
#portraitModal::iframe::-webkit-scrollbar {

    display: none; 
}
.modal-xl {
        max-width: 90%; 
    }

</style>
<body>
  <!-- .app -->
  <div class="app">

    <?php include "assets/header_nav1.php" ?>
    <!-- /.app-aside -->
    <!-- .app-main -->
    <main class="">
      <!-- .wrapper -->
      <div class="wrapper">
        <!-- .page -->
        <div class="page">
          <!-- .page-inner -->
          <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
              <!-- page title stuff goes here -->
            </header>
            <!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-fluid">
                      <!-- .card-header -->
                      <div class="card-header  d-flex justify-content-between align-items-center"">
                        <!-- .nav-tabs -->
                        <ul class="nav nav-tabs card-header-tabs">
                          <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#tab1">Accession Book Report</a>
                          </li>
                        </ul>
                        <a href="#" class="preview btn btn-primary btn-space">Generate</a>
                        <!-- /.nav-tabs -->
                      </div>
                      <!-- /.card-header -->
                      <!-- .card-body -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="form-group row" style="padding: 30px;">
                            <label for="inputText" class="col-sm-3 col-form-label">Start no of accession to be printed on</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="accessionstart" placeholder="">
                            </div>
                          </div>
                          <div class="form-group row" style="padding: 30px; ">
                            <label for="combo2" class="col-sm-3 col-form-label">Categorize By:</label>
                            
                            <div class="col-sm-9">
    <select class="form-control" name="radioGroup" id="category">
        <option value="gc">General Collection</option>
        <option value="gf">General Fund</option>
        <option value="dd">Donation</option>
    </select>
</div>
                          </div>
                       



                        </div>
                      </div>
                      <!-- /.page-section -->
                    </div>
                    <!-- /.page-inner -->
                  </div>
                  <!-- /.page -->
                </div>
                <div class="modal fade" id="portraitModal" tabindex="-1" role="dialog" aria-labelledby="portraitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="portraitModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="iframe-container">
          <iframe id="portrait" src="" width="100%" height="600" frameborder="0"></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="openwindow btn btn-primary">Open New Window</button>
      </div>
    </div>
  </div>
</div>


    </main>
    <!-- /.app-main -->
  </div>
  <!-- /.app -->
  <!-- BEGIN BASE JS -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
    let urlhead ="";
    $(".openwindow").click(function() {
      var url = urlhead;
      window.open(url, '_blank');
    });
    $(".close").click(function() {
    $("#portraitModal").hide();
    });
    $(".preview").click(function() {
      if(isNaN($("#accessionstart").val())){
        alert("Please input a number");
        return false;
      }
      var selectedValue = $('#category').val();

      $("#accessionstart").val();
      if($("#accessionstart").val() == ""){
        alert("Please input the start number of accession to be preview on");
        return false;
      }else if(selectedValue == ""){
        alert("Please select the category");
        return false;
      }else{
        
        $("#portraitModal").modal("toggle");
        urlhead = "/accession_preview.php?accessionstart="+$("#accessionstart").val()+"&category="+selectedValue;
        $("#portrait").attr("src","/accession_preview.php?accessionstart="+$("#accessionstart").val()+"&category="+selectedValue);
      }

      });
    </script>
  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- END BASE JS -->
  <!-- BEGIN PLUGINS JS -->
  <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
  <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <!-- END PLUGINS JS -->
  <!-- BEGIN THEME JS -->
  <script src="assets/javascript/main.min.js"></script>
  <!-- END THEME JS -->
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