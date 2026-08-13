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
  <title> Subject Report </title>
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
                        <!-- .card-header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <!-- .nav-tabs -->
                          <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                              <a class="nav-link active show" data-toggle="tab" href="#tab1">Subject Report by <span id="grl">Volume</span></a>
                            </li>
                          </ul>
                          <a href="#" class="preview btn btn-primary btn-space">Generate</a>
        
                        </div>
                
                        <div class="card-body text-center">
                          <div class="tab-content">
                            <div class="container mx-auto">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group ">
                                    <label for="groupings">Groupings:</label>
                                    <select class="form-control" name="gr" id="groupings">
                                        <option value="v">Volume</option>
                                        <option value="t">Title</option>
                                        <!-- Other options... -->
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group ">
                                    <label for="categorizeBy">Categorize By:</label>
                                    <select class="form-control" name="dater" id="categorizeBy">
                                        <option value="da">Date Receive</option>
                                        <option value="c">Copyright</option>
                                        <!-- Other options... -->
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="container mx-auto">
                              <div class="row">
                                <div class="col-md-6">
                                  <p>Print Subject For</p>
                                  <div class="form-group ">
                                    <label for="subjectSelect">Subject</label><br>
                                    <select class="form-control" name="sj_h" id="subjectSelect">
                                        <option value="all">All</option>
                                        <option value="sc">Specific</option>
                                    </select>
                                    <select class="form-control" id="subject_handler" name="sj" disabled>
                                      <?php 
                                        $sql = "SELECT * FROM `subject` WHERE Deleted = 0 AND Type = 'Books'";
                                        $result = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['SubjectID'].'">'.$row['Subject'].'</option>';
                                        }

                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <label for="radioGroup2">Date Recieve:</label>
                                  <div class="form-group ">
                                    <label for="radioGroup2">Beginning  <span class="cattype">Date Received</span></label>

                                    <input class="form-control" type="date" name="begindate" value="1950-01-01">
                                    <!-- Other radio buttons... -->
                                  </div>
                                  <div class="form-group ">
                                    <label for="radioGroup2">Ending  <span class="cattype">Date Received</span>:</label>

                                    <input class="form-control" type="date" name="enddate" value="<?php echo date('Y-m-d'); ?>">
                                    <!-- Other radio buttons... -->
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
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
          
      urlhead ="";
      $(".openwindow").click(function() {
        var url = urlhead;
        window.open(url, '_blank');
      });
      $('#groupings').change(function(){
        if($(this).val() == 't'){
            $("#grl").text("Title");
        }else{
            $("#grl").text("Volume");
        }
      });
      $(".preview").click(function(){
        let  txtSubject = "";
        if($('#subjectSelect').val() == 'sc'){
          txtSubject = $("#subject_handler").val();
        }else{
          txtSubject = $('#subjectSelect').val();
        }
        var groupings = $('#groupings').val();
        var ca = $('#categorizeBy').val();
        if(groupings ==undefined){
          alert("Please select a Groupings");
          return false;
        }
        if(ca ==undefined){
          alert("Please select Categorize");
          return false;
        }
        if(txtSubject ==undefined){
          alert("Please input Subject");
          return false;
        }
        groupings = $('#groupings').val();
        if(groupings == "t"){
          groupings = "title";
        }else{
          groupings = "vol";
        }
      ca = $('#categorizeBy').val();

        let  begind =  $('input[name="begindate"]').val();
        let  endd =  $('input[name="enddate"]').val();
        if(begind ==""){
          alert("Please input Begin Date");
          return false;
        }
        if(endd ==""){
          alert("Please input End Date");
          return false;
        }
        var selectedValue = $('#categorizeBy').val();
        console.log(selectedValue);
        if(selectedValue == "da"){
          cat2 = "d";
        }else{
          cat2 = "c";
        }
        var url = "/subject_reports_prev.php?subject=" + txtSubject + "&groupings=" + groupings + "&cat=" + cat2 + "&begind=" + begind + "&endd=" + endd + "";
        urlhead = url;
      
        $("#portrait").attr("src",url);
    
        $("#portraitModal").modal("toggle");


      });
      $('#subjectSelect').change(function(){
        if($(this).val() == 'all'){
          $("#subject_handler").prop("disabled", true);
        }else{
          $("#subject_handler").prop("disabled", false);
        }
      });

      $('#categorizeBy').change(function() {
        var selectedValue = $('#categorizeBy').val();
        if(selectedValue == "da"){
          var bg = $('input[name="begindate"]').prop('type', 'date');
          var end = $('input[name="enddate"]').prop('type', 'date');
          $(".cattype").text("Date Received")
                      
        }else{
          var bg = $('input[name="begindate"]').prop('type', 'number');
          var end = $('input[name="enddate"]').prop('type', 'number');
          $(".cattype").text("Copyright")
        }
      });
      $('input[name="begindate"]').change(function(){
        let val = $(this).val();
        $(".bgcurrentdy").text(val);
      });

      $('input[name="enddate"]').change(function(){
        let val = $(this).val();
        $(".endcurrentdy").text(val);
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