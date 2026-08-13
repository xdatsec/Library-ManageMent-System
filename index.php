<?php
session_start();
$_SESSION['locator'] = 'index';
$_SESSION['members'] = 'false';
if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}
function showdata($month, $conn)
{
  $currentYear = date('Y') . '-' . $month;
  $query = "SELECT COUNT(DISTINCT MemberID) as count FROM entrance WHERE `DateAdded` LIKE '$currentYear%' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo $row['count'];
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
include 'modules/inc/connection.php';
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- End Required meta tags -->
  <!-- Begin SEO tag -->
  <title> DashBoard| CHMSU LMS </title>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta property="og:title" content="Dashboard">
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
  <link rel="stylesheet" href="assets/vendor/pace/pace.min.css">
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/fontawesome-all.min.css">
  <!-- END BASE STYLES -->
  <!-- BEGIN PLUGINS STYLES -->
  <link rel="stylesheet" href="assets/vendor/flatpickr/flatpickr.min.css">
  <!-- END PLUGINS STYLES -->
  <!-- BEGIN THEME STYLES -->
  <link rel="stylesheet" href="assets/stylesheets/main.min.css">
  <link rel="stylesheet" href="assets/stylesheets/custom.css">
  <!-- END THEME STYLES -->
</head>
<style>
.data-g:hover {
  background-color: white;
  cursor: pointer;
  color: black;
}
</style>

<body>

  <div class="app">

    <?php include "assets/header_nav1.php" ?>




    <!-- /.nav -->
    <!-- .btn-account -->


    <!-- /.app-aside -->


    <?php
    // Define the $texts array
    $texts = [
      "Here’s what’s happening with our Library today.",
      "Discover the latest updates from our Library.",
      "Stay informed about the current Library events.",
      "Get the scoop on what's going on in our Library now.",
      "Find out what's new in our Library.",
      "Learn about the latest news from our Library.",
      "Get the latest news from our Library.",
      "Find out what's happening in our Library.",
      "Discover the latest updates from our Library.",
      "Stay informed about the current Library events.",
      "Get the scoop on what's going on in our Library now.",
    ];


    // Get a random index for the $texts array
    $index = array_rand($texts);

    // Retrieve the random text from the $texts array
    $text = $texts[$index];
    ?>


    <!-- .wrapper -->
    <div class="wrapper">
      <!-- .page -->
      <div class="page" style=" overflow-y: scroll;
  overflow-x: hidden;">
        <!-- .page-inner -->
        <div class="page-inner">
          <!-- .page-title-bar -->
          <header class="page-title-bar">
            <p class="lead">
              <span class="font-weight-bold">Hi, <?php echo $_SESSION['username']; ?>.</span>

              <span class="d-block text-muted"><span class="d-block text-muted"><?php echo $text; ?></span></span>


            </p>
          </header>
          <!-- /.page-title-bar -->
          <!-- .page-section -->
          <div class="page-section">
            <!-- .section-block -->
            <div class="section-block">
              <!-- metric row -->
              <div class="metric-row">
                <div class="col-lg-12">
                  
                 <?php
                      if($_SESSION['isSuperAdmin'] == 1){
                        echo '<div class="metric-row metric-flush">
                        <!-- metric column -->
                        <div class="col data-g">';
                        echo '<a href="userlist.php" class="metric metric-bordered align-items-center">';
                    ?>
                        <h2 class="metric-label">No of Library System Users</h2>
                        <p class="metric-value h3">
                          <sub>
                            <i class="oi oi-people"></i>
                          </sub>
                          <?php
                          // Query to count users
                          $sql = "SELECT COUNT(*) as user_count FROM user";
                          $result = $conn->query($sql);
                          $count_u = 0;
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $count_u = $row['user_count'];
                            }
                            echo '<span class="value">' . $count_u . '</span>';
                          } else {
                            echo '<span class="value">0</span>';
                          }
                          ?>

                        </p>
                      </a>
                      <?php
                      }
                      ?>
                      <!-- /.metric -->
                    </div>
                 
                    <!-- /metric column -->
                    <!-- metric column -->
                    <div class="col data-g">
                      <!-- .metric -->
                      <a href="borrowed.php" class="metric metric-bordered align-items-center">
                        <h2 class="metric-label"> No of Borrowed Books </h2>
                        <p class="metric-value h3">
                          <sub>
                            <i class="oi oi-book"></i>
                          </sub>
                          <?php
                          // Query to count users
                          $sql1 = "SELECT COUNT(*) as book_borrow FROM `borrowed` WHERE `Return` = '0'";
                          $result1 = $conn->query($sql1);
                          $count_us = 0;
                          if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                              $count_us = $row1['book_borrow'];
                            }
                            echo '<span class="value">' . $count_us . '</span>';
                          } else {
                            echo '<span class="value">0</span>';
                          }
                          ?>
                        </p>
                      </a>
                      <!-- /.metric -->
                    </div>
                    <div class="col data-g">
                      <!-- .metric -->
                      <a href="books_acquisitions.php" class="metric metric-bordered align-items-center">
                        <h2 class="metric-label"> No of Books </h2>
                        <p class="metric-value h3">
                          <sub>
                            <i class="oi oi-book"></i>
                          </sub>
                          <?php
                          $count_book = 0;
                          $sqlbook = "SELECT * FROM `books` WHERE Deleted = 0";
                          $resultbook = $conn->query($sqlbook);

                          if ($resultbook->num_rows > 0) {
                            while ($rowbook = $resultbook->fetch_assoc()) {
                              $sql_sub = "SELECT * FROM `books sub table` WHERE BookID  = ?";
                              $stmt_sub = $conn->prepare($sql_sub);
                              $stmt_sub->bind_param('s', $rowbook['BookID']);
                              $stmt_sub->execute();
                              $result_sub = $stmt_sub->get_result();
                              $row_sub = $result_sub->fetch_assoc();
                              $sqlaccession = "SELECT * FROM `books accession` WHERE IDNo = ?";
                              $stmtaccession = $conn->prepare($sqlaccession);
                              $stmtaccession->bind_param('s', $row_sub['IDNo']);
                              $stmtaccession->execute();
                              $resultaccession = $stmtaccession->get_result();
                              while ($rowaccession = $resultaccession->fetch_assoc()) {
                                $count_book++;
                              }
                            }
                          }
                          echo '<span class="value">' . $count_book . '</span>';
                          ?>
                        </p>
                      </a>
                      <!-- /.metric -->
                    </div>
                    <!-- /metric column -->
                    <!-- metric column -->
                    <div class="col data-g">
                      <!-- .metric -->
                      <a href="library_members.php" class="metric metric-bordered align-items-center">
                        <h2 class="metric-label">No of Registered Students</h2>
                        <p class="metric-value h3">
                          <sub>
                            <i class="fa fa-user"></i>
                          </sub>
                          <?php
                          // Query to count users
                          $sql1 = "SELECT COUNT(*) as studentcount FROM `members` WHERE TypeId  = '1' AND Deleted = 0";
                          $result1 = $conn->query($sql1);
                          $count_us = 0;
                          if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                              $count_us = $row1['studentcount'];
                            }
                            echo '<span class="value">' . $count_us . '</span>';
                          } else {
                            echo '<span class="value">0</span>';
                          }
                          ?>
                        </p>
                      </a>
                      <!-- /.metric -->
                    </div>
                    <div class="col data-g">
                      <!-- .metric -->
                      <?php
                      $current_date = date('Y-m-d');
                      ?>
                      <a href="entrance_report_prev.php?datefrom=<?php echo $current_date; ?>&dateto=<?php echo $current_date; ?>&type=All" class="metric metric-bordered align-items-center">
                        <h2 class="metric-label">No. of Visitors Today </h2>
                        <p class="metric-value h3">
                          <sub>
                            <i class="oi oi-people"></i>
                          </sub>
                          <?php
                          // Query to count users
                          $sql1 = "SELECT COUNT(DISTINCT MemberID ) as distinct_book_count FROM `entrance` WHERE DateAdded LIKE '" . date('Y-m-d') . "%'";
                          $result1 = $conn->query($sql1);
                          $count_us = 0;
                          if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                              $count_us = $row1['distinct_book_count'];
                            }
                            echo '<span class="value">' . $count_us . '</span>';
                          } else {
                            echo '<span class="value">0</span>';
                          }
                          ?>
                        </p>
                      </a>
                      <!-- /.metric -->
                    </div>
                    <!-- /metric column -->
                  </div>
                </div>
                <!-- metric column -->
                <?php    /*<div class="col-lg-3">
             
                  <!-- .metric -->
                  <a href="user-tasks.html" class="metric metric-bordered">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success">
                        <span class="oi oi-media-record pulse mr-1"></span> ONGOING TASKS</span>
                    </div>
                    <p class="metric-value h3">
                      <sub>
                        <i class="oi oi-timer"></i>
                      </sub>
                      <span class="value">8</span>
                    </p>
                  </a>
                  <!-- /.metric -->
                </div>
                <!-- /metric column -->
              </div>
              <!-- /metric row -->
            </div>
            */
                ?>
                <!-- /.section-block -->
                <!-- grid row -->
                <!-- grid column -->
                <div class="col-lg-12">

                  <!-- .card -->
                  <section class="card card-fluid">
                    <div class="card-header"> Entrance
                      
                    <a href="entrance_report_prev.php?date=All&type=all" class="btn btn-primary float-right ml-2" style="text-decoration:none;">View full report &rarr;</a>
                      <a class="btn btn-secondary entranceai float-right" style="text-decoration:none;">See Explanation </a>
                    </div>
                    <!-- .card-body -->
                    <div class="card-body">
                      <h3 class="card-title text-left">Year  <?php echo date('Y'); ?> Data for Entrance</h3>
                     
                      <div id="flot-bar" class="flot"></div>
                    </div>
                    <!-- /.card-body -->

                  </section>
                  <!-- /.card -->
                </div>
                <hr>
                <div class="col-lg-12">

<!-- .card -->
<section class="card card-fluid">
  <div class="card-header"> Borrowed


    <a href="returned.php" class="btn btn-primary float-right ml-2" style="text-decoration:none;">View</a>
    <a class="btn btn-secondary borrowai float-right" style="text-decoration:none;">See Explanation </a>
  </div>
  <!-- .card-body -->
  <div class="card-body">
    <h3 class="card-title text-left">Year  <?php echo date('Y'); ?> Data for Borrowed Books</h3>
    <div id="flot-bar2" class="flot"></div>
  </div>
  <!-- /.card-body -->

</section>
<!-- /.card -->
</div>
                <!-- /grid column -->
                <!-- grid column -->
                <!-- /grid row -->
                <!-- section-deck -->

                <!-- /section-deck -->
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

    <div class="modal fade" id="aimodal" tabindex="-1" role="dialog" aria-labelledby="aimodalLabel" aria-hidden="true" style="z-index: 1030 !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aimodalLabel">Explanation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This Library Management System is Property of CHMSU Binalbagan
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      <!-- /.app -->
      <!-- BEGIN BASE JS -->
      <script src="assets/vendor/jquery/jquery.min.js"></script>
      <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
      <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <!-- END BASE JS -->
      <!-- BEGIN PLUGINS JS -->
      <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
      <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
      <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
      <script src="assets/vendor/chart.js/Chart.min.js"></script>
      <!-- END PLUGINS JS -->
      <!-- BEGIN THEME JS -->
      <script src="assets/javascript/main.min.js"></script>

      <!-- END THEME JS -->
      <!-- BEGIN PAGE LEVEL JS -->
      <script src="assets/javascript/pages/easypiechart-demo.js"></script>
      
      <!-- END PAGE LEVEL JS -->
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script src="assets/vendor/flot/jquery.flot.min.js"></script>
      <script src="assets/vendor/flot/jquery.flot.resize.min.js"></script>
      <script src="assets/vendor/flot/jquery.flot.categories.min.js"></script>
      <script src="assets/javascript/pages/jquery.flot.axislabels.min.js"></script>
      <script src="assets/javascript/pages/flot-demo.js"></script>
      <script src="assets/vendor/flot/jquery.flot.time.min.js"></script>
      <script type='text/javascript'>
        $(".borrowai").click(function(){
          showai();
          setTimeout(function() {

            $.post('barchart2', function(serverData) {
              let data = JSON.parse(serverData);
              for (let i = 0; i < data.length; i++) {
              if (data[i][1] != 0 && data[i][1] != null && data[i][1] != "" && data[i][1] != "0") {
                mayValue = data[i][1];
                naempty = 1;
                break;
              }
            }
            if(naempty == 0){
              $('#aimodal .modal-body').html(`There is no data for this month or is on way!`);
            }else{
              
              let datas = data.map(item => [item[0], item[1]]);
              aidata = data.map(item => [item[0], item[1]]);
              let jan = aidata.find(item => item[0] === "January");
              let feb = aidata.find(item => item[0] === "February");
              let mar = aidata.find(item => item[0] === "March");
              let apr = aidata.find(item => item[0] === "April");
              let may = aidata.find(item => item[0] === "May");
              let jun = aidata.find(item => item[0] === "June");
              let jul = aidata.find(item => item[0] === "July");
              let aug = aidata.find(item => item[0] === "August");
              let sep = aidata.find(item => item[0] === "September");
              let oct = aidata.find(item => item[0] === "October");
              let nov = aidata.find(item => item[0] === "November");
              let dec = aidata.find(item => item[0] === "December");
              explaindata = "data for entrance"+"<br>"+"January: "+jan[1]+"<br>"+"February: "+feb[1]+"<br>"+"March: "+mar[1]+"<br>"+"April: "+apr[1]+"<br>"+"May: "+may[1]+"<br>"+"June: "+jun[1]+"<br>"+"July: "+jul[1]+"<br>"+"August: "+aug[1]+"<br>"+"September: "+sep[1]+"<br>"+"October: "+oct[1]+"<br>"+"November: "+nov[1]+"<br>"+"December: "+dec[1]+"<br>";



              let response = explaindata;

              let instruction = "explain for entrance these are people who borrowed the library in the month of january february march april may june july august september october november and december based on the data provided above. just explain dont be paranoid or give conclusions just explain the data for entrance for the months of january february march april may june july august september october november and december based on the data provided above.";

              let google_api_key = "AIzaSyAkoVOkYoY8DRO_TgaSIb8Zex2h_Zcue6k"; // replace with your actual Google API key
              let gemini_url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=${google_api_key}`;

              let data2 = {
                  system_instruction: {
                      parts: [
                          {
                              text: instruction
                          }
                      ]
                  },
                  contents: [
                      {
                          role: "user",
                          parts: [
                              {
                                  text: response
                              }
                          ]
                      }
                  ]
              };

              // Show loading message
            

            $.ajax({
                url: gemini_url,
                type: 'POST',
                data: JSON.stringify(data2),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                async: false,
                success: function(res) {
                    let text = res.candidates[0].content.parts[0].text;

                    // Remove emojis from the text
                    let text_without_emojis = text.replace(/[\u{10000}-\u{10FFFF}]/gu, '');

                    // Replace loading message with actual content
                    $('#aimodal .modal-body').html(text_without_emojis);
                },
                error: function() {
                    // Replace loading message with error message
                    $('#aimodal .modal-body').html('An error occurred. Please try again, check your internet connection, or contact the system administrator.');
                }
            });
            


            }


              
            });
        }, 2000);
       
        });
        $(".entranceai").click(function(){
          showai();
          setTimeout(function() {

            $.post('barchart', function(serverData) {
              let data = JSON.parse(serverData);
              for (let i = 0; i < data.length; i++) {
              if (data[i][1] != 0 && data[i][1] != null && data[i][1] != "" && data[i][1] != "0") {
                mayValue = data[i][1];
                naempty = 1;
                break;
              }
            }
            if(naempty == 0){
              $('#aimodal .modal-body').html(`There is no data for this month or is on way!`);
            }else{
              
              let datas = data.map(item => [item[0], item[1]]);
              aidata = data.map(item => [item[0], item[1]]);
              let jan = aidata.find(item => item[0] === "January");
              let feb = aidata.find(item => item[0] === "February");
              let mar = aidata.find(item => item[0] === "March");
              let apr = aidata.find(item => item[0] === "April");
              let may = aidata.find(item => item[0] === "May");
              let jun = aidata.find(item => item[0] === "June");
              let jul = aidata.find(item => item[0] === "July");
              let aug = aidata.find(item => item[0] === "August");
              let sep = aidata.find(item => item[0] === "September");
              let oct = aidata.find(item => item[0] === "October");
              let nov = aidata.find(item => item[0] === "November");
              let dec = aidata.find(item => item[0] === "December");
              explaindata = "data for entrance"+"<br>"+"January: "+jan[1]+"<br>"+"February: "+feb[1]+"<br>"+"March: "+mar[1]+"<br>"+"April: "+apr[1]+"<br>"+"May: "+may[1]+"<br>"+"June: "+jun[1]+"<br>"+"July: "+jul[1]+"<br>"+"August: "+aug[1]+"<br>"+"September: "+sep[1]+"<br>"+"October: "+oct[1]+"<br>"+"November: "+nov[1]+"<br>"+"December: "+dec[1]+"<br>";



              let response = explaindata;

              let instruction = "explain for entrance these are people who entered the library in the month of january february march april may june july august september october november and december based on the data provided above. just explain dont be paranoid or give conclusions just explain the data for entrance for the months of january february march april may june july august september october november and december based on the data provided above.";

              let google_api_key = "AIzaSyAkoVOkYoY8DRO_TgaSIb8Zex2h_Zcue6k"; // replace with your actual Google API key
              let gemini_url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=${google_api_key}`;

              let data2 = {
                  system_instruction: {
                      parts: [
                          {
                              text: instruction
                          }
                      ]
                  },
                  contents: [
                      {
                          role: "user",
                          parts: [
                              {
                                  text: response
                              }
                          ]
                      }
                  ]
              };

              // Show loading message
            

            $.ajax({
                url: gemini_url,
                type: 'POST',
                data: JSON.stringify(data2),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                async: false,
                success: function(res) {
                    let text = res.candidates[0].content.parts[0].text;

                    // Remove emojis from the text
                    let text_without_emojis = text.replace(/[\u{10000}-\u{10FFFF}]/gu, '');

                    // Replace loading message with actual content
                    $('#aimodal .modal-body').html(text_without_emojis);
                },
                error: function() {
                    // Replace loading message with error message
                    $('#aimodal .modal-body').html('An error occurred. Please try again, check your internet connection, or contact the system administrator.');
                }
            });
            


            }


              
            });
        }, 2000);
       
        });
        function showai(){
          $(document).ready(function(){
        
            $('#aimodal').appendTo("body").modal('show');
            $('#aimodal .modal-body').html("The AI is processing your request. Please wait...");
          });
        }

        function barChart() {
          var self = this;
          let naempty = 0;
   

          $.post('barchart', function(serverData) {
            let data = JSON.parse(serverData);
            for (let i = 0; i < data.length; i++) {
            if (data[i][1] != 0 && data[i][1] != null && data[i][1] != "" && data[i][1] != "0") {
              mayValue = data[i][1];
              naempty = 1;
              break;
            }
          }
          if(naempty == 0){
            $('#flot-bar').html(`
          <div class="d-flex justify-content-center align-items-center flex-column" style="height: 200px;">
            <img src="assets/images/robo.gif" class="my-image">
            <h5 class="text-center">No data for this month or is on way!</h5>
          </div>
        `);

          $('<style>')
            .prop('type', 'text/css')
            .html(`
              .my-image {
                width: 100px;
                height: 100px;
              }
            `)
            .appendTo('head');  
          }else{
            let datas = data.map(item => [item[0], item[1]]);
            console.log(datas);
            


            $('#flot-bar').plot([datas], {
              series: {
                bars: {
                  show: true,
                  barWidth: 0.5,
                  align: 'center',
                  fillColor: {
                    colors: [{
                      opacity: 0.9
                    }, {
                      opacity: 0.1
                    }]
                  }
                }
              },
              colors: [self.getColor('teal')],
              grid: {
                hoverable: true,
                borderWidth: 0,
                color: self.getColor('gray')
              },
              xaxis: {
                mode: 'categories',
                tickLength: 0
              },
              yaxis: {
                tickColor: {
                  color: self.getColor('grayLighter')
                }
              }
            }, 'json');


          }


            
          });
        }
        barChart();


        function barChart1(){
          let aidata;
          var self = this;
          let naempty1 = 0;

          $.post('barchart2', function(serverData) {
            let data = JSON.parse(serverData);
            for(let i = 0; i < data.length; i++){
              if(data[i][1] != 0 && data[i][1] != null && data[i][1] != "" && data[i][1] != "0"){
                mayValue = data[i][1];
                naempty1 = 1;
                break;
              }
            }
            if(naempty1 == 0){
              $('#flot-bar2').html(`
          <div class="d-flex justify-content-center align-items-center flex-column" style="height: 200px;">
            <img src="assets/images/robo.gif" class="my-image">
            <h5 class="text-center">No data for this month or is on way!</h5>
          </div>
        `);

          $('<style>')
            .prop('type', 'text/css')
            .html(`
              .my-image {
                width: 100px;
                height: 100px;
              }
            `)
            .appendTo('head');  
            }else{
              let datas = data.map(item => [item[0], item[1]]);
             

            console.log(datas);

            


            $('#flot-bar2').plot([datas], {
              series: {
                bars: {
                  show: true,
                  barWidth: 0.5,
                  align: 'center',
                  fillColor: {
                    colors: [{
                      opacity: 0.9
                    }, {
                      opacity: 0.1
                    }]
                  }
                }
              },
              colors: [self.getColor('teal')],
              grid: {
                hoverable: true,
                borderWidth: 0,
                color: self.getColor('gray')
              },
              xaxis: {
                mode: 'categories',
                tickLength: 0
              },
              yaxis: {
                tickColor: {
                  color: self.getColor('grayLighter')
                }
              }
            }, 'json');
          }


          


            
          });


        }
        barChart1();
      </script>

    
      </script>
      <script src="assets/javascript/main.js"></script>
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