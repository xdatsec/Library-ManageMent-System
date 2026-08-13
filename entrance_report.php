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
  <title> Entrance Report </title>
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
  <div class="app">
    <?php include "assets/header_nav1.php" ?>
    <main class="">

      <div class="wrapper">
        <div class="page">
       
          <div class="page-inner">
            <header class="page-title-bar">
            </header>
            <div class="page-section">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-fluid border">
                      <div class="card-header d-flex justify-content-between align-items-center">
                          <ul class="nav nav-tabs card-header-tabs">
                              <li class="nav-item">
                                  <a class="nav-link active show" data-toggle="tab" href="#tab1">Entrance Report</a>
                              </li>
                          </ul>
                          <a href="#" class="preview btn btn-primary btn-space">Generate</a>
                      </div>
                     
                      <div class="card-body text-center">
                        <div class="tab-content">
                          <div class="container mx-auto">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group ">
                                  <div class="form-group row" style="padding: 30px;">
                                      <div class="col-sm-10" style="margin:auto;">
                                          <div class="form-group">
                                              <label for="type">Member type</label>
                                              <select class="form-control" name="type" id="type">
                                                  <option value="Student">Student</option>
                                                  <option value="Faculty">Faculty</option>
                                                  <option value="Staff">Staff</option>
                                                  <option value="Graduate-School">Graduate-School</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="container mx-auto">
                            <div class="row">
                              <div class="col-md-12">
                            
                                <div class="form-group ">
                                  <div class="form-group row" style="padding: 30px; ">

                                    <div class="col-sm-10" style="margin:auto;">
                                      <div class="form-group">
                                        <label for="date">Date</label>
                                        <select class="form-control" name="date" id="date">
                                            <option value="All">All</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                      </div>
                                      <center> 
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;display:none;" class="datehandler">
                                            <p style="margin: 0 10px;">From</p>
                                            <input type="date" class="form-control center" id="datefrom" placeholder="Enter Date" value="<?php echo date('Y'); ?>" style="width:150px; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                                            <p style="margin: 0 10px;">to</p>
                                            <input type="date" class="form-control center" id="dateto" placeholder="Enter Date" style="width:150px; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                                        </div>  
                                      </center> 
                                      <center> 
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;display:none;" id="yearhandler">
                                          <p style="margin: 0 10px;">Date</p>
                                          <input type="date" class="form-control center" id="date&year" placeholder="Enter Year" value="<?php echo date('Y'); ?>" style="width:150px; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                                        </div> 
                                      </center>
                                    </div>
                                  </div>

                                </div>
                              </div>


                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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
  </div>
  <!-- BEGIN BASE JS -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
     
      let urlhead = "";
      $(".openwindow").click(function() {
        var url = urlhead;
        window.open(url, '_blank');
      });
      $('#date').change(function(){
        var type = $('#type').val();
        var date = $('#date').val();

        if($('#date').val() == "Monthly"){
          $("#yearhandler").hide();
          $(".datehandler").show();
        }else{
          $("#yearhandler").hide();
          $(".datehandler").hide();
        }
      });
      $(".preview").click(function() {
        var type = $('#type').val();
        var date = $('#date').val();
      
        if (type == "") {
          alert("Please select Type");
          return false;
        }
        if (date == "") {
          alert("Please select Date");
          return false;
        }



        let url = "";
        if($('#date').val() == "Monthly"){
          var datefrom = $('#datefrom').val();
          var dateto = $('#dateto').val();
          if(datefrom ==""){
            alert("Please select Date");
          return false;
          }
          if(dateto ==""){
            alert("Please select Date");
          return false;
          }
          url = "entrance_report_prev.php?datefrom=" + datefrom + "&dateto=" + dateto + "&type=" + type;
        }else{
          var date = $('#dateyear').val();
          url = "entrance_report_prev.php?date=all&type=" + type;
        }

        urlhead = url;
        console.log(url);
        $("#portrait").attr("src", url);

        $("#portraitModal").modal("toggle");


      });


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