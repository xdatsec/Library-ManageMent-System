<?php
  session_start();
  $_SESSION['members'] = false;
  $_SESSION['locator'] = 'rp';
  if (isset($_SESSION["loggedin"])) {

      header('Location: /index.php');
    
  } else {
  
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
    <title> Password Reset | Looper - Bootstrap 4 Admin Theme </title>
    <meta property="og:title" content="Password Reset">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="//uselooper.com">
    <meta property="og:url" content="//uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Password Reset",
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
      <!-- form -->
      <form class="auth-form auth-form-reflow">
        <div class="text-center mb-4">
          <div class="mb-4">
            <img class="rounded" src="assets/apple-touch-icon.png" alt="" height="72"> </div>
          <h1 class="h3"> Reset Your Password </h1>
        </div>
        <!-- .form-group -->
        <div class="form-group mb-4">
          <label class="d-block text-left" for="email">Email</label>
          <input type="email" id="email" class="form-control form-control-lg" required="" autofocus="">
          <p class="text-muted">
            <small>We'll send password reset link to your email.</small>
          </p>
        </div>
        <!-- /.form-group -->
        <!-- actions -->
        <div class="d-block d-md-inline-block mb-2">
          <button class="reset btn btn-lg btn-block btn-primary" type="button">Reset Password</button>
        </div>
        <div class="d-block d-md-inline-block">
          <a href="index.php" class="btn btn-block btn-light">Return to signin</a>
        </div>
      </form>
    
    </main>
    <!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script>
      	window.addEventListener('message', function(event) {
				if (event.origin === window.location.origin) {
					var response = event.data;
					if (response == "Email sent successfully. Please check your inbox") {
            alert("Please check your email for the reset link");
					} else {
						alert(response);
					}
					// Process the response as needed
				}
			});


      $(".reset").click(function(){
        if ($("#email").val() == "") {
						alert("Please enter your Email");
					} else {
						var newTab = window.open('mail?email=' + $("#email").val(), '_blank');




					}
      });
      </script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- END BASE JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/main.min.js"></script>
    <!-- END THEME JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
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