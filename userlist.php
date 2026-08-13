<?php
session_start();
$_SESSION['locator'] = 'us';
$_SESSION['members'] = 'false';
$username = '';
if (isset($_SESSION["loggedin"])) {
  include "modules/inc/connection.php";
  if ($_SESSION['isSuperAdmin'] != 1) {
    header('Location: /');
    exit;
  }
  $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
} else {
  header('Location: /signin.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- End Required meta tags -->
  <!-- Begin SEO tag -->
  <title> Account Settings | CHMSU LMS </title>
  <meta property="og:title" content="Account Settings">
  <meta name="author" content="CodecMaker">


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
 
  <div class="app">

    <?php include "assets/header_nav1.php" ?>
    <main class="">
      <!-- .wrapper -->
      <div class="wrapper">
        <!-- .page -->
        <div class="page">
          <!-- .page-cover -->

          <!-- /.page-cover -->
          <!-- Followers Modal -->
          <!-- .modal -->

          <!-- /.modal -->
          <!-- /Followers Modal -->
          <!-- Following Modal -->
          <!-- .modal -->

          <!-- /.modal -->
          <!-- /Following Modal -->
          <!-- .page-navs -->
          <nav class="page-navs">
            <!-- .nav-scroller -->

            <!-- /.nav-scroller -->
          </nav>
          <!-- /.page-navs -->
          <!-- .page-inner -->
          <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active">
                    <a href="/">
                      <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Home</a>
                  </li>
                </ol>
              </nav>
            </header>
            <!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
              <!-- grid row -->
              <div class="row">
                <!-- grid column -->
                <div class="col-lg-4">
                  <!-- .card -->
                  <div class="card card-fluid">
                    <h6 class="card-header">User Manager</h6>
                    <!-- .nav -->
                    <nav class="nav nav-tabs flex-column">
                      <a href="user.php" class="nav-link ">Account</a>
                      <?php if ($_SESSION['isSuperAdmin'] == 1) { ?>
                        <a href="users.php" class="nav-link ">Users</a>
                        <a href="userlist.php" class="nav-link active">User List</a>
                      <?php } ?>

                    </nav>
         
                  </div>
             
                </div>
                <div class="col-lg-8">
                  <!-- .card -->
                  <div class="card card-fluid">
                    <h6 class="card-header">Library Users</h6>
                    <!-- .card-body -->
                    <div class="card-body">
                     
                      <form method="post">
                                  
                          <div class="form-group">

                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">username</th>
                                  <th scope="col">email</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $count = 0;
                                $sql = "SELECT * FROM user WHERE username != ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $username);
                                $username = $_SESSION['username'];
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                  while($row = $result->fetch_assoc()){
                                    $count++;
                                    echo '<tr>
                                    <th scope="row">'.$count.'</th>
                                    <td>'.$row['Title'].'</td>
                                    <td>'.$row['UserName'].'</td>
                                    <td>'.$row['email'].'</td>';
                                    if($row['deactivated'] == 0){
                                      echo '<td><button type="button" class="btn btn-sm" id="deactivate" data-id="'.$row['UserName'].'">Deactivate</button></td>';
                                    }else{
                                      echo '<td><button type="button" class="btn btn-sm" id="reactivate" data-id="'.$row['UserName'].'">Activate</button></td>';
                                    }
                                    
                                  
                                  }
                                }

                                ?>
                              </tbody>
                            </table>


                          </div>
                      </form>
                      <script src="assets/vendor/jquery/jquery.min.js"></script>
                      <script>
                         $(document).on('click', '#reactivate', function() {
                          let deactivate = confirm("Are you sure you want to reactivate this account?");
                          let username = $(this).attr('data-id');
                          if (deactivate == true) {
                            $.ajax({
                              type: "POST",
                              url: "deactivate",
                              data: {
                                username: username
                              },
                              success: function(data) {
                                alert(data);
                                location.reload();
                              }
                            });
                          } else {
                            return false;
                          }
                        });
                        
                        $(document).on('click', '#deactivate', function() {
                          let deactivate = confirm("Are you sure you want to deactivate this account?");
                          let username = $(this).attr('data-id');
                          if (deactivate == true) {
                            $.ajax({
                              type: "POST",
                              url: "deactivate",
                              data: {
                                username: username
                              },
                              success: function(data) {
                                alert(data);
                                location.reload();
                              }
                            });
                          } else {
                            return false;
                          }
                        });
                        
                      </script>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>

                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /grid column -->
          </div>
          <!-- /grid row -->
        </div>
        <!-- /.page-section -->
  

      </div>
 
    </main>

  </div>

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