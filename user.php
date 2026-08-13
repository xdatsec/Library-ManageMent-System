<?php
session_start();
$_SESSION['locator'] = 'us';
$_SESSION['members'] = 'false';
$username = '';
if (isset($_SESSION["loggedin"]) ) {
  include "modules/inc/connection.php";
 

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

      <div class="wrapper">
  
        <div class="page">
          
          <nav class="page-navs">
            <!-- .nav-scroller -->

            <!-- /.nav-scroller -->
          </nav>
     
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
                      <a href="user.php" class="nav-link active">Account</a>
                      <?php if ($_SESSION['isSuperAdmin'] == 1) { ?>
                        <a href="users.php" class="nav-link">Users</a>
                        <a href="userlist.php" class="nav-link ">User List</a>
                      <?php } ?>
                
                    </nav>
                    <!-- /.nav -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /grid column -->
                <!-- grid column -->
                <div class="col-lg-8">
                  <!-- .card -->
                  <div class="card card-fluid">
                    <h6 class="card-header">Account</h6>
                    <!-- .card-body -->
                    <div class="card-body">
                      <!-- form -->
                      <form method="post">
                        <!-- form row -->
                        <div class="form-row">
                          <!-- form column -->

                          <!-- /form column -->
                          <!-- form column -->

                          <!-- /form column -->
                        </div>
                        <!-- /form row -->
                        <!-- .form-group -->
                        <div class="form-group">
                          <?php
                          $sql = "SELECT * FROM user WHERE username = ?";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("s", $username);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_assoc();

                          ?>
                          <label>Title</label>
                          <input type="text" class="form-control" value="<?php echo $row['Title']; ?>" disabled>
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" value="<?php echo $row['UserName']; ?>" disabled>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <div class="alert alert-info" role="alert">
                            This can be used to reset your password if forgotten.
                          </div>
                          <input type="email" class="form-control" id="input03" value="<?php echo $row['email']; ?>" disabled>
                        </div>
                        <!-- /.form-group -->
                        <!-- .form-group -->
                        <div class="form-group">
                          <label for="input04">New Password</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="newpassword" value="" required="">
                            <div class="input-group-append">
                              <button id="togglePassword3" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="input04">Confirm New Password</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="confirmnewpassword" value="" required="">
                            <div class="input-group-append">
                              <button id="togglePassword4" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="form-actions">
                          <div class="input-group">
                            <input type="password" class="form-control ml-auto mr-3" id="input06" placeholder="Enter Current Password" required="">
                            <div class="input-group-append">
                              <button id="togglePassword2" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                          </div>
                          <button type="button" class="updatepassword btn btn-primary ml-2">Update Password</button>
                        </div>
                        <!-- /.form-actions -->
                      </form>
                      <script src="assets/vendor/jquery/jquery.min.js"></script>
                      <script>

                        $('.updatepassword').click(function() {
                          let changepw = confirm('Are you sure you want to update your password?');
                          if (changepw == true) {
                          
                          var newpassword = $('#newpassword').val();
                          var confirmnewpassword = $('#confirmnewpassword').val();
                          var currentpassword = $('#input06').val();
                          if(newpassword ==""){
                            alert('Please Enter New Password');
                            return false;
                          }
                          if(confirmnewpassword ==""){
                            alert('Please Enter Confirm New Password');
                            return false;
                          }
                          if (newpassword == confirmnewpassword) {
                            $.ajax({
                              url: 'updateaccount',
                              type: 'POST',
                              data: {
                                newpassword: newpassword,
                                currentpassword: currentpassword
                              },
                              success: function(data) {
                                if (data == '') {
                                  alert('Password Updated /n Please Login Again');

                                  window.location.href = 'logout';
                                } else {
                                  alert(data);
                                }
                              }
                            });
                          } else {
                            alert('Password Not Match');
                          }
                        }else{
                          return false;
                          }
                          
                        });

                        const togglePassword4 = document.querySelector('#togglePassword4');
                        const password = document.querySelector('#confirmnewpassword');
                        togglePassword4.addEventListener('click', function(e) {
                          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                          password.setAttribute('type', type);
          
                          
                          
                        });
                        const togglePassword3 = document.querySelector('#togglePassword3');
                        const password1 = document.querySelector('#newpassword');
                        togglePassword3.addEventListener('click', function(e) {
                          const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                          password1.setAttribute('type', type);
          
                          
                          
                        });

                        const togglePassword2 = document.querySelector('#togglePassword2');
                        const password2 = document.querySelector('#input06');
                        togglePassword2.addEventListener('click', function(e) {
                          const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                          password2.setAttribute('type', type);
                   
                        });
                      </script>
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

        </div>
     
      </div>
  
    </main>
  </div>
  <!-- /.app -->
  <!-- BEGIN BASE JS -->

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