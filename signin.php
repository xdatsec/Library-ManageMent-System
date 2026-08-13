<?php

  $encryptionKey = 'X1W2Z3Y4X1W2Z3Y4';
  $secretkey ='codecmakergamersx1234@@@123';


  function setEncryptedCookie($name, $value, $username, $expiration) {
      global $encryptionKey;
      $iv = openssl_random_pseudo_bytes(16); // Generate a 16-byte IV
      $encryptedValue = openssl_encrypt($value, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
      $cookieValue = base64_encode($iv . $encryptedValue);
      setcookie($name, $cookieValue, $expiration, '/');
  }


  function getDecryptedCookie($name, $username) {
    global $encryptionKey;
    if (isset($_COOKIE[$name])) {
        $cookieValue = base64_decode($_COOKIE[$name]);
        $iv = substr($cookieValue, 0, 16); // Extract the first 16 bytes as IV
        $encryptedValue = substr($cookieValue, 16); // Rest is encrypted data
        $decryptedValue = @openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
        if ($decryptedValue !== false) {
            return $decryptedValue;
        } else {

            return null;
        }
    }
    return null;
  }


  session_start();
  if(getDecryptedCookie('loggedin', $secretkey) !== null && getDecryptedCookie('loggedin', $secretkey) ==true){
    $_SESSION['loggedin'] = getDecryptedCookie('loggedin', $secretkey);
    $_SESSION['username'] = getDecryptedCookie('username', $secretkey);
    $_SESSION['staff_name'] = getDecryptedCookie('staff_name', $secretkey);
    $_SESSION['isSuperAdmin'] = getDecryptedCookie('isSuperAdmin', $secretkey);

      header("location: index.php");
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
    <title> Sign In | CHMSU LMS  </title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta property="og:title" content="Sign In">
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
        "headline": "Sign In",
        "@context": "http://schema.org"
      }
    </script>
    <!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0">
    <!-- BEGIN BASE STYLES -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/fontawesome-all.min.css">
    <!-- END BASE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="assets/stylesheets/main.min.css">
    <link rel="stylesheet" href="assets/stylesheets/custom.css">
    <!-- END THEME STYLES -->
  </head>
  <body>
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header">
        <h1 style="background-color: #346cb0;">
          <img src="assets/images/brand-inverse.png" alt="" height="72">
          <span class="sr-only">Sign In</span>
        </h1>
        <a clas="btn btn-primary" id="checktime" style="color:black;background-color: white;text-decoration:none;">Check Time</a>
        <p id="clock"style="display:none;"></p>
        <p> Don't have a account?
          <a href="#" style="color:black;text-decoration: none;"><strong>Contact the Administrator!</strong></a>
        </p>
      </header>
      <!-- form -->
      <form class="auth-form" novalidate>

        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputUser" class="form-control" val="" placeholder="Username" required="" autofocus="">
            <label for="inputUser">Username</label>
          </div>
        </div>
        <label style="display:none;" for="inputUser" class="text-red username_err"></label>
   
        <div class="form-group">
          <div class="form-label-group input-group">
            <input type="password" id="inputPassword"  val="" class="form-control" placeholder="Password" required="">
            <label for="inputPassword">Password</label>
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-eye" id="togglePassword"></i>
              </span>
            </div>
          </div>
        </div>
        <label style="display:none;" for="inputUser" class="text-red password_err"></label>
        <script>
          document.getElementById("checktime").addEventListener("click", function() {
            document.getElementById("clock").style.display = "block";
          });
      
          setInterval(function() {
              var now = new Date();
              var hours = now.getHours();
              var minutes = now.getMinutes();
              var seconds = now.getSeconds();
              var ampm = hours >= 12 ? 'PM' : 'AM';
              hours = hours % 12;
              hours = hours ? hours : 12;
              var time = "Current Time:"+hours + ":" + minutes + " " + ampm;
              document.getElementById("clock").innerHTML = time;
          }, 1000); 

          const togglePassword = document.querySelector('#togglePassword');
          const password = document.querySelector('#inputPassword');

          togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
          });
        </script>
   
        <label style="display:none;" for="inputUser" class="text-red general_err">ssssssss</label>
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" id="signin" >Sign In</button>
        </div>
       
        <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me">
            <label class="custom-control-label" for="remember-me">Remember Me</label>
          </div>
          <a href="forgotpassword.php" class="forgot-link">Forgot Password?</a>
        </div>

       
      </form>
   
      <footer class="auth-footer"> © 2023 All Rights Reserved.
      
      </footer>
    </main>


    <!-- /.auth -->
    <!-- BEGIN PLUGINS JS -->

    <!-- END PLUGINS JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/javascript/main.js"></script>
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