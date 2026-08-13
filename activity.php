<?php
session_start();
if (isset($_SESSION["loggedin"])) {
} else {
  header('Location: /signin.php');
  exit;
}
$_SESSION['locator'] = '';
include "modules/inc/connection.php";
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
  <title> Activity Logs | CHMSU LMS </title>
  <meta property="og:title" content="Activity Logs">
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

<body>
  <!-- .app -->
  <div class="app">
    <!-- .nav -->
    <?php include "assets/header_nav1.php" ?>
    <!-- /.app-aside -->
    <!-- .app-main -->
    <main class="">
      <!-- .wrapper -->
      <div class="">
        <!-- .page -->
        <div class="page has-sidebar">
          <!-- .page-inner -->
          <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
              <h1 class="page-title"> Activity Logs</h1>
            </header>

            <div class="page-section" style="position:relative;overflow-y:scroll;">
              <!-- .section-block -->

              <!-- /.section-block -->
              <!-- .section-block -->
              <div class="section-block">
                <h2 class="section-title"> Today </h2>
                <!-- .timeline -->
                <ul class="timeline">
                <?php
$todayDate = date("Y-m-d");
$query = "SELECT * FROM logs WHERE DATE(date) = '$todayDate' ORDER BY date DESC ";
$result = mysqli_query($conn, $query);

if ($result) {
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['type'] == "login") {
            $icon = "fa fa-sign-in-alt";
        } else if ($row['type'] == "DROP") {
            $icon = "fa fa-trash";
        } else if ($row['type'] == "UPDATE") {
            $icon = "fa fa-edit";
        } else if ($row['type'] == "INSERT") {
            $icon = "fa fa-plus";
        }else if ($row['type'] == "insert") {
          $icon = "fa fa-plus";
      }else if ($row['type'] == "update") {
        $icon = "fa fa-edit";
    } else if ($row['type'] == "drop") {
        $icon = "fa fa-plus";
    }else{
        $icon = "fa fa-question";
    }

        
        $timestamp = strtotime($row['date']);
        $timeDifference = time() - $timestamp;
        $timeAgo = '';

        if ($timeDifference < 60) {
            $timeAgo = "About a minute ago";
        } else if ($timeDifference < 3600) {
            $minutesAgo = floor($timeDifference / 60);
            $timeAgo = "About $minutesAgo minute" . ($minutesAgo > 1 ? 's' : '') . ' ago';
        } else {
            $hoursAgo = floor($timeDifference / 3600);
            $timeAgo = "About $hoursAgo hour" . ($hoursAgo > 1 ? 's' : '') . ' ago';
        }

        echo '<li class="timeline-item">
            <div class="timeline-figure">
                <span class="tile tile-circle tile-sm">
                    <i class="far ' . $icon . '"></i>
                </span>
            </div>
            <div class="timeline-body">
                <div class="media">
                    <div class="media-body">
                        <h6 class="timeline-heading">
                            <a  class="text-link">' . htmlentities($row['type']) . '</a>
                        </h6>
                        <p class="mb-0">
                        <a>' . htmlentities($row['action']) . '</a>
                        </p>
                        <p class="timeline-date d-sm-none">' . $timeAgo . '</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <span class="timeline-date">' . $timeAgo . '</span>
                    </div>
                </div>
            </div>
        </li>';
    }

    
    mysqli_free_result($result);
  }else{
    echo '<p class="text-center">No Activity Today</p>';
  }
} else {
    
    echo "Error: " . mysqli_error($conn);
}

?>



                  <!-- /.timeline-item -->
                  <!-- .timeline-item -->
                
                  <!-- /.timeline-item -->
                </ul>
                <!-- .timeline -->
                <h2 class="section-title"> Yesterday </h2>
                <!-- .timeline -->
                <?php
$yesterdayDate = date("Y-m-d", strtotime("-1 day"));
$query = "SELECT * FROM logs WHERE DATE(date) = '$yesterdayDate' ORDER BY date DESC ";
$result = mysqli_query($conn, $query);

if ($result) {
  if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['type'] == "login") {
            $icon = "fa fa-sign-in-alt";
        } else if ($row['type'] == "DROP") {
            $icon = "fa fa-trash";
        } else if ($row['type'] == "UPDATE") {
            $icon = "fa fa-edit";
        } else if ($row['type'] == "INSERT") {
            $icon = "fa fa-plus";
        }

        
        $timestamp = strtotime($row['date']);
        $timeDifference = time() - $timestamp;
        $timeAgo = '';



        echo '<li class="timeline-item">
            <div class="timeline-figure">
                <span class="tile tile-circle tile-sm">
                    <i class="far ' . $icon . '"></i>
                </span>
            </div>
            <div class="timeline-body">
                <div class="media">
                    <div class="media-body">
                        <h6 class="timeline-heading">
                            <a  class="text-link">' . htmlentities($row['type']) . '</a>
                        </h6>
                        <p class="mb-0">
                            <a>' . htmlentities($row['action']) . '</a>
                        </p>
                 
                    </div>
                    <div class="d-none d-sm-block">
                  
                    </div>
                </div>
            </div>
        </li>';
    }

    
    mysqli_free_result($result);
  } else {
    echo '<p class="text-center">No Activity Yesterday</p>';
  }
} else {
    
    echo "Error: " . mysqli_error($conn);
}

?>

                <!-- .timeline -->
                <?php
$todayDate = date("Y-m-d");
$query = "SELECT * FROM logs WHERE DATE(date) != '$todayDate' ORDER BY date DESC";
$result = mysqli_query($conn, $query);

$currentDate = null;

if ($result) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $logDate = date('F j, Y', strtotime($row['date']));

        if ($logDate != $currentDate) {
            
            echo '<h2 class="section-title">' . $logDate . '</h2>';
            echo '<ul class="timeline">';
            $currentDate = $logDate;
        }

        if ($row['type'] == "login") {
            $icon = "fa fa-sign-in-alt";
        } else if ($row['type'] == "DROP") {
            $icon = "fa fa-trash";
        } else if ($row['type'] == "UPDATE") {
            $icon = "fa fa-edit";
        } else if ($row['type'] == "INSERT") {
            $icon = "fa fa-plus";
        }

        
        $timestamp = strtotime($row['date']);
        $timeDifference = time() - $timestamp;
        $timeAgo = '';

        echo '<li class="timeline-item">
            <div class="timeline-figure">
                <span class="tile tile-circle tile-sm">
                    <i class="far ' . $icon . '"></i>
                </span>
            </div>
            <div class="timeline-body">
                <div class="media">
                    <div class="media-body">
                        <h6 class="timeline-heading">
                            <a  class="text-link">' . htmlentities($row['type']) . '</a>
                        </h6>
                        <p class="mb-0">
                            <a>' . htmlentities($row['action']) . '</a>
                        </p>
       
                    </div>

                </div>
            </div>
        </li>';
    }

    
    echo '</ul>';

    
    mysqli_free_result($result);
} else {
    
    echo "Error: " . mysqli_error($conn);
}


?>


                <!-- /.timeline -->
              </div>
              <!-- /.section-block -->
              <hr>
              <!-- .section-block -->
              
            <!-- /.page-section -->
          </div>
          <!-- /.page-inner -->
          <!-- .page-sidebar -->
          <div class="page-sidebar page-sidebar-fixed border-left bg-white">
            <!-- .sidebar-header -->
            <header class="sidebar-header d-sm-none">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active">
                    <a href="#" onclick="Looper.toggleSidebar()">
                      <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back</a>
                  </li>
                </ol>
              </nav>
            </header>
            <!-- /.sidebar-header -->
            <!-- .sidebar-section -->
            <div class="sidebar-section">
              <!-- .timeline -->
              <ul class="timeline timeline-fluid mb-0">
              <h2 class="section-title"> Latest Actions </h2>
              <?php
$todayDate = date("Y-m-d");
$query = "SELECT * FROM logs  WHERE DATE(date) = '$todayDate' ORDER BY date DESC LIMIT 4";
$result = mysqli_query($conn, $query);

if ($result) {
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['type'] == "login") {
            $icon = "fa fa-sign-in-alt";
        } else if ($row['type'] == "DROP") {
            $icon = "fa fa-trash";
        } else if ($row['type'] == "UPDATE") {
            $icon = "fa fa-edit";
        } else if ($row['type'] == "INSERT") {
            $icon = "fa fa-plus";
        }

        
        $timestamp = strtotime($row['date']);
        $timeDifference = time() - $timestamp;
        $timeAgo = '';

        if ($timeDifference < 60) {
            $timeAgo = "About a minute ago";
        } else if ($timeDifference < 3600) {
            $minutesAgo = floor($timeDifference / 60);
            $timeAgo = "About $minutesAgo minute" . ($minutesAgo > 1 ? 's' : '') . ' ago';
        } else {
            $hoursAgo = floor($timeDifference / 3600);
            $timeAgo = "About $hoursAgo hour" . ($hoursAgo > 1 ? 's' : '') . ' ago';
        }

        echo '<li class="timeline-item">
            <div class="timeline-figure">
                <span class="tile tile-circle tile-sm">
                    <i class="far ' . $icon . '"></i>
                </span>
            </div>
            <div class="timeline-body">
                <div class="media">
                    <div class="media-body">
                        <h6 class="timeline-heading">
                            <a  class="text-link">' . htmlentities($row['type']) . '</a>
                        </h6>
                        <p class="mb-0">
                            <a>' . htmlentities($row['action']) . '</a>
                        </p>
                        <p class="timeline-date d-sm-none">' . $timeAgo . '</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <span class="timeline-date">' . $timeAgo . '</span>
                    </div>
                </div>
            </div>
        </li>';
    }

    
    mysqli_free_result($result);
  }else{
    echo '<p class="text-center">No Activity Today</p>';
  }
} else {
    
    echo "Error: " . mysqli_error($conn);
}

?>
              </ul>
              <!-- /.timeline -->
            </div>
            <!-- /.sidebar-section -->
          </div>
          <!-- /.page-sidebar -->
        </div>
        <!-- /.page -->
      </div>
      <!-- /.wrapper -->
    </main>
    <!-- /.app-main -->
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
  <!-- END PLUGINS JS -->
  <!-- BEGIN THEME JS -->
  <script src="assets/javascript/main.min.js"></script>
  <!-- END THEME JS -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https:
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