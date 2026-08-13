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
  <title> Call Number Report </title>
  <meta property="og:title" content="Call No Book Report">
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
      "name": "Looper - Bootstrap 4 Admin Theme",
      "description": "Responsive admin theme build on top of Bootstrap 4",
      "author": {
        "@type": "Person",
        "name": "Beni Arisandi"
      },
      "@type": "WebSite",
      "url": "",
      "headline": "Starter Template",
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
    <main class="">
      <div class="wrapper">
  
        <div class="page">
          <div class="page-inner">
       
            <header class="page-title-bar">
              <!-- page title stuff goes here -->
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
                            <a class="nav-link active show" data-toggle="tab" href="#tab1">Call Number Report from <span id="grl">Volume</span></a>
                          </li>
                        </ul>
                        <a href="#" class="preview btn btn-primary btn-space">Generate</a>
                        <!-- /.nav-tabs -->
                      </div>
                      <!-- /.card-header -->
                      <!-- .card-body -->
                      <div class="card-body text-center">
                        <div class="tab-content">
                          <p class="h5" style="background-color:grey;color:white;font-family:'Times New Roman', Times, serif;">
                            Call # from <span class="startspan">000</span> To <span class="endspan">999.9999</span> and <span class="cattype">Date Received</span> from <span class="bgcurrentdy">1950-01-01</span> to <span class="endcurrentdy"><?php echo date('Y-m-d'); ?></span><span class="locationtext"></span> <span class="subjecttext"> - GENERALITIES</span>
                          </p>

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
                                <p>Print Books For</p>
                                <div class="form-group ">
                                  <label for="exampleFormControlSelect1">Call No1</label>
                                  <select class="form-control" id="callnno1">
                                    <option selected>000</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                    <option value="600">600</option>
                                    <option value="700">700</option>
                                    <option value="800">800</option>
                                    <option value="900">900</option>
                                    <option value="F">F</option>
                                    <option value="B">B</option>
                                  </select>
                                  <label for="exampleFormControlSelect1">Call No2</label>
                                  <select class="form-control" id="callno2">
                                    <option value="099.9999" selected>099.9999</option>
                                    <option value="199.9999">199.9999</option>
                                    <option value="299.9999">299.9999</option>
                                    <option value="399.9999">399.9999</option>
                                    <option value="499.9999">499.9999</option>
                                    <option value="599.9999">599.9999</option>
                                    <option value="699.9999">699.9999</option>
                                    <option value="799.9999">799.9999</option>
                                    <option value="899.9999">899.9999</option>
                                    <option value="999.9999">999.9999</option>
                                    <option value="F">F</option>
                                    <option value="B">B</option>
                                  </select>
                                  <!-- Other radio buttons... -->
                                </div>
                              </div>

                              <div class="col-md-6">
                                <label for="radioGroup2">Date Recive:</label>
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
                          <div class="container mx-auto">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group ">
                                  <label for="exampleFormControlSelect1">Subject</label>
                                  <input id="subject" class="form-control" type="text" name="subject" value="GENERALITIES" placeholder="Subject">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <label for="radioGroup2">Location Circulation:</label>
                                <div class="form-group ">

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox" value="option1">
                                    <select class="form-control" id="locationhandler" disabled style="width:100px;">
                                      <option value="CY">CY</option>
                                      <option value="RB">RB</option>
                                      <option value="REF">REF</option>
                                      <option value="GS">GS</option>
                                      <option value="FR">FR</option>


                                    </select>
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
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#inlineCheckbox").change(function() {
        if(this.checked) {
              $("#locationhandler").prop("disabled", false);
              $(".locationtext").text(",Location Circulation:")
        } else {
          $("#locationhandler").prop("disabled", true);
          $(".locationtext").text("")
        }
      });

      $("#locationhandler").change(function() {
        var selectedValue = $(this).val();
        var Location_Label1 = "";
        if (selectedValue == "CY") {
                Location_Label1 = ",Location - Circulation";
                $(".locationtext").text(Location_Label1);
            } else if (selectedValue == "RB") {
                Location_Label1 = ",Location - Reserved";
                $(".locationtext").text(Location_Label1);
            } else if (selectedValue == "REF") {
                Location_Label1 = ",Location - Reference";
                $(".locationtext").text(Location_Label1);
            } else if (selectedValue == "GS") {
                Location_Label1 = ",Location -Graduate School";
                $(".locationtext").text(Location_Label1);
            } else if (selectedValue== "FR") {
                Location_Label1 = ",Location - Filipianana";
                $(".locationtext").text(Location_Label1);
            }
      });
      let urlhead ="";
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
        let  txtSubject = $("#subject").val();
        var groupings = $('#groupings').val();
        var ca = $('input[name="dater"]').val();
        if(groupings ==""){
          alert("Please select a Groupings");
          return false;
        }
        if(ca ==""){
          alert("Please select Categorize");
          return false;
        }
        if(txtSubject ==undefined){
          alert("Please input Subject");
          return false;
        }
        let  $txtLocation ="";
        groupings = $('#groupings').val();
          if(groupings == "t"){
            groupings = "title";
          }else{
            groupings = "vol";
          }
        ca = $('#categorizeBy').val();
        let  txtCallNo1 = $("#callnno1").val();
        let  txtCallNo2 = $("#callno2").val();

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
        let url ="";
        let cat2 ="";
        var selectedValue = $('#categorizeBy').val();
        console.log(selectedValue);
        if(selectedValue == "da"){
          cat2 = "d";
        }else{
          cat2 = "c";
        }
        if($("#inlineCheckbox").is(':checked')){
          txtLocation = $("#locationhandler").val();
          url = "call_number_prev.php?category="+groupings+"&start="+begind+"&end="+endd+"&subject="+$("#subject").val()+"&callnumst="+txtCallNo1+"&callnumend="+txtCallNo2+"&location="+txtLocation+"&category2="+cat2+"";
          urlhead = url;
        }else{
          url = "call_number_prev.php?category="+groupings+"&start="+begind+"&end="+endd+"&subject="+$("#subject").val()+"&callnumst="+txtCallNo1+"&callnumend="+txtCallNo2+"&category2="+cat2+"";
          urlhead = url;
        }
        $("#portrait").attr("src",url);
    
        $("#portraitModal").modal("toggle");


      });
      $("#callnno1").change(function(){
        let val = $(this).val();
        if (val == "000") {
          $txtSubject = "GENERALITIES";
          $txtCallNo2 = "099.9999";
          $("#callno2").val($txtCallNo2);
          $("#subject").val($txtSubject);
          $(".subjecttext").text($txtSubject);
          $(".startspan").text("000");
          $(".endspan").text($txtCallNo2);


        } else if (val == "100") {
            $txtSubject = "PHILOSOPHY";
            $txtCallNo2 = "199.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("100");
            $(".endspan").text($txtCallNo2);
            
        } else if (val == "200") {
            $txtSubject = "RELIGION";
            $txtCallNo2 = "299.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("200");
            $(".endspan").text($txtCallNo2);
        } else if (val == "300") {
            $txtSubject = "SOCIAL SCIENCES";
            $txtCallNo2 = "399.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("300");
            $(".endspan").text($txtCallNo2);
        } else if (val == "400") {
            $txtSubject = "LANGUAGES";
            $txtCallNo2 = "499.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("400");
            $(".endspan").text($txtCallNo2);
        } else if (val== "500") {
            $txtSubject = "PURE SCIENCES";
            $txtCallNo2 = "599.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("500");
            $(".endspan").text($txtCallNo2);
        } else if (val == "600") {
            $txtSubject = "APPLIED SCIENCES";
            $txtCallNo2 = "699.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("600");
            $(".endspan").text($txtCallNo2);
        } else if (val== "700") {
            $txtSubject = "ARTS AND RECREATION";
            $txtCallNo2 = "799.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("700");
            $(".endspan").text($txtCallNo2);
        } else if (val == "800") {
            $txtSubject = "LITERATURE";
            $txtCallNo2 = "899.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);

            $(".startspan").text("800");
            $(".endspan").text($txtCallNo2);
        } else if (val == "900") {
            $txtSubject = "HISTORY";
            $txtCallNo2 = "999.9999";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("900");
            $(".endspan").text($txtCallNo2);
        }else if (val == "F") {
            $txtSubject = "FICTION";
            $txtCallNo2 = "F";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("F");
            $(".endspan").text($txtCallNo2);
        } else if (val == "B") {
            $txtSubject = "BIOGRAPHY";
            $txtCallNo2 = "B";
            $("#callno2").val($txtCallNo2);
            $("#subject").val($txtSubject);
            $(".subjecttext").text($txtSubject);
            $(".startspan").text("B");
            $(".endspan").text($txtCallNo2);
        } 
      });
      $('#categorizeBy').change(function() {
        var selectedValue = $(this).val();
        if(selectedValue == "da"){
            $('input[name="begindate"]').prop('type', 'date');
            $('input[name="enddate"]').prop('type', 'date');
            $(".cattype").text("Date Received");
        } else {
            $('input[name="begindate"]').prop('type', 'number');
            $('input[name="enddate"]').prop('type', 'number');
            $(".cattype").text("Copyright");
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

    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');
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
</body>

</html>