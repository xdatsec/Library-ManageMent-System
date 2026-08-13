<?php
    $encryptionKey = 'X1W2Z3Y4X1W2Z3Y4';
    $secretkey = 'codecmakergamersx1234@@@123';

    function setEncryptedCookie($name, $value, $username, $expiration)
    {
        global $encryptionKey;
        $iv = openssl_random_pseudo_bytes(16); // Generate a 16-byte IV
        $encryptedValue = openssl_encrypt($value, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
        $cookieValue = base64_encode($iv . $encryptedValue);
        setcookie($name, $cookieValue, $expiration, '/');
    }


    function getDecryptedCookie($name, $username)
    {
        global $encryptionKey;
        if (isset($_COOKIE[$name])) {
            $cookieValue = base64_decode($_COOKIE[$name]);
            $iv = substr($cookieValue, 0, 16); // Extract the first 16 bytes as IV
            $encryptedValue = substr($cookieValue, 16); // Rest is encrypted data
            $decryptedValue = @openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptionKey . $username, 0, $iv);
            if ($decryptedValue !== false) {
                return $decryptedValue;
            } else {
                // Handle the decryption error gracefully
                // For example, log the error or return a default value
                return null;
            }
        }
        return null;
    }

    $timeout = 300; // Set the session timeout to 300 seconds (5 minutes)
    session_start();

    if (!isset($_SESSION['counter'])) {
        // Initialize the session variable if it doesn't exist
        $_SESSION['counter'] = 0;
    }

    if ($_SESSION['counter'] >= 5) {
        if (!isset($_SESSION['timestamp']) || (time() - $_SESSION['timestamp']) >= $timeout) {
            $_SESSION['counter'] = 0;
            $_SESSION['timestamp'] = time(); // Reset the timestamp
        } else {
            ?>
            <script>
                alert("You have exceeded the maximum number of reset attempts. Please try again later.");
                window.location.href = "index.php";
            </script>
            <?php
            exit;
        }
    }





    include 'modules/inc/connection.php';
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: index.php");
        exit;
    } else {
        if ($_GET['code'] == null) {
            header("location: index.php");
            exit;
        }
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");

    
        $stmt->bind_param("s", $email);


        $stmt->execute();


        $result = $stmt->get_result();


        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $secretcode = $_GET['code'];
            if (password_verify($secretcode, $row['resetcode'])) {
                // The password is correct
            } else {
                ?>
                    <script>
                        alert("Email not found or invalid credentials, note that persestent error can lead to get block temporarily");
                        window.location.href = "index.php";
                    </script>

                <?php
                $_SESSION['counter']++;
                exit;
            }
        } else {
            ?>
                <script>
                    alert("Email not found or invalid credentials, note that persestent error can lead to get block temporarily");
                    window.location.href = "index.php";
                </script>

            <?php
            $_SESSION['counter']++;
            exit;
        }

        
        $stmt->close();
    }
    if (getDecryptedCookie('loggedin', $secretkey) !== null && getDecryptedCookie('loggedin', $secretkey) == true) {
        $_SESSION['loggedin'] = getDecryptedCookie('loggedin', $secretkey);
        $_SESSION['username'] = getDecryptedCookie('username', $secretkey);
        $_SESSION['Name'] = getDecryptedCookie('staff_name', $secretkey);
        $_SESSION['isAdmin'] = getDecryptedCookie('isAdmin', $secretkey);

        header("location: dashboard.php");
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
          <label class="d-block text-left" for="email">Enter your new password</label>
          <input type="text" id="newpassword" class="form-control form-control-lg" required="" autofocus="">
        
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
      $(document).on('click', '.reset', function() {
                event.preventDefault();
                var password = $("#newpassword").val();
                if (password != "") {
                    // Check if password is at least 8 characters long
                    if (password.length < 8) {
                        alert("Password should be at least 8 characters");
                        return;
                    }else {
                        const searchParams = new URLSearchParams(window.location.search);
                        const email = searchParams.get('email');
                        const code = searchParams.get('code');
                        const newpassword = $("#newpassword").val();
                        $.ajax({
                            url: 'reset',
                            type: 'POST',
                            data: {
                                code,code,
                                email: email,
                                newpassword: newpassword

                            },
                            success: function(response) {
                               if(response == "Password change!"){
                                alert("Password changed successfully. You can now login with your new password");
                                window.location.href = "index.php";
                               }else{
                                   alert(response);
                                   window.location.href = "index.php";
                               }
                            },
                            error: function(xhr, status, error) {
                               alert("Error occured while resetting password");
                            }
                        });
                    }

                    // If all conditions are met, continue with the rest of your code
                } else {
                    $(".alert-login").text("Please enter the new password");
                    $(".alert-login").addClass("alert alert-warning alert-login");
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