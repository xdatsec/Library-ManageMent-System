<?php
session_start();
$_SESSION['locator'] = 'us';
$_SESSION['members'] = 'false';
$username = '';
if (isset($_SESSION["loggedin"])) {
  include "modules/inc/connection.php";
  if($_SESSION['isSuperAdmin'] != 1){
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
     
        <div class="wrapper">
          <!-- .page -->
            <div class="page">
          
              <nav class="page-navs">
              
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
                              <a href="user.php" class="nav-link ">Account</a>
                              <?php if ($_SESSION['isSuperAdmin'] == 1) { ?>
                                <a href="users.php" class="nav-link active">Users</a>
                                <a href="userlist.php" class="nav-link ">User List</a>
                              <?php } ?>
                        
                            </nav>
                            <!-- /.nav -->
                          </div>
                          <!-- /.card -->
                        </div>
                      

          
                        <!-- grid column -->
                        <div class="col-lg-8">
                          <!-- .card -->
                          <div class="card card-fluid">
                            <h6 class="card-header">Create User</h6>
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
                                
                                  
                                  <label>Title</label>

                                  <select class="form-control custom-select" id="userroles">
                                    <option value="1">Staff.</option>
                                    <option value="2">Librarian.</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" id="username" class="form-control" value="" >
                                </div>
                                <div class="form-group">
                                  <label>Email</label>
                                  <div class="alert alert-info" role="alert">
                                    This can be used to reset your password if forgotten.
                                  </div>
                                  <input type="email"  id="email" class="form-control" id="input03" value="" placeholder="Email">
                                </div>
                                <!-- /.form-group -->
                                <!-- .form-group -->
                                <div class="form-group">
                                  <label for="input04">Password</label>
                                  <div class="input-group">
                                    <input type="password" class="form-control" id="password" value="" required=""  placeholder="Password">
                                    <div class="input-group-append">
                                      <button id="togglePassword3" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="input04">Confirm Password</label>
                                  <div class="input-group">
                                    <input type="password" class="form-control" id="confirmpassword" value="" required="" placeholder="Confirm Password">
                                    <div class="input-group-append">
                                      <button id="togglePassword4" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                              
                                  <button type="button" class="saveuser btn btn-primary ml-2">Save</button>
                                </div>
                                <!-- /.form-actions -->
                              </form>
                              <script src="assets/vendor/jquery/jquery.min.js"></script>
                              <script>
                                $(".saveuser").click(function() {
                                  let username = $("#username").val();
                                  let email = $("#email").val();
                                  let password = $("#password").val();
                                  let confirmpassword = $("#confirmpassword").val();
                                  let userroles = $("#userroles").val();
                                  if (username == '' || email == '' || password == '' || confirmpassword == '') {
                                    alert("Please fill all fields");
                                    return false;
                                  }
                                  if (password != confirmpassword) {
                                    alert("Password does not match");
                                    return false;
                                  }
                                  $.ajax({
                                    type: "POST",
                                    url: "createuser",
                                    data: {
                                      username: username,
                                      email: email,
                                      password: password,
                                      userroles: userroles
                                    },
                                    success: function(data) {
                                    if(data !=""){
                                      alert(data);
                                    
                                    
                                    }else{
                                      alert("User Created");
                                      window.location.href = "userlist.php";

                                    }
                                    }
                                  });
                                });
                                const togglePassword4 = document.querySelector('#togglePassword4');
                                const password = document.querySelector('#confirmpassword');
                                togglePassword4.addEventListener('click', function(e) {
                                  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                  password.setAttribute('type', type);
                  
                                  
                                  
                                });
                                const togglePassword3 = document.querySelector('#togglePassword3');
                                const password1 = document.querySelector('#password');
                                togglePassword3.addEventListener('click', function(e) {
                                  const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                                  password1.setAttribute('type', type);
                  
                                  
                                  
                                });

                              </script>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        
          
                      </div>

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