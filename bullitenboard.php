<?php
session_start();
$_SESSION['locator'] = 'ms';
$_SESSION['members'] = 'false';
$username = '';
if (isset($_SESSION["loggedin"])) {
  include "modules/inc/connection.php";
  $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
} else {
  header('Location: /signin.php');
  exit;
}
$course = "";
$type = "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Starter Template | Looper - Bootstrap 4 Admin Theme </title>
    <meta property="og:title" content="Starter Template">
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        #board-container {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            cursor: grab;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            background-size: cover;
            border: 2px solid #ccc;
            background: url('cardboard.jpg');
            overflow-x: scroll;
        }

        .note {
            overflow: hidden;
            overflow-y: scroll;
            font-size: 10px;
            box-shadow: 1px 1px 1px grey;
            width: 100px;
            height: 100px;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 10px;
            cursor: grab;
        }

        .note::-webkit-scrollbar {
            width: 0;
        }

        .note::-webkit-scrollbar-thumb {
            background: transparent;
        }
        #board-container::-webkit-scrollbar {
            width: 0;
        }

        #board-container::-webkit-scrollbar-thumb {
            background: transparent;
        }

        .controls {
            margin-top: 20px;
            text-align: center;
        }

        .controls a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
        }

        input[type="button"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
  <body>
    <div class="app">
      <?php include "assets/header_nav1.php" ?>

      <main class="">
        

        <div class="wrapper">
    
          <?php
            if($_SESSION['isSuperAdmin'] == 1){
          ?>
          <a href="#" class="btn d-section" style="float:right;">Delete Section</a>
          <?php
            }
          ?>
          <div class="page">
            <div class="page-inner">
              <h5>Bulliten Board</h1>
              <header class="page-title-bar">
                <!-- page title stuff goes here -->
              </header>
              <!-- /.page-title-bar -->
              <!-- .page-section -->
              <div class="page-section">
                <div id="board-container">
                  <?php
                    $sql = "SELECT * FROM  bulliten WHERE Deleted = 0";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                      $date = new DateTime($row['date']);
                      $formattedDate = $date->format('M d, Y');
                      echo ' <div class="note" draggable="true">
                      <p><b>'.htmlentities($formattedDate).'</b></p>
                      <a href="" class="delete btn" data-id="'.$row['id'].'" style="display:none;">Delete</a>
                          '.htmlentities($row['message']).'<br>
                      </div>';
                    }

                  ?>
                </div>
                <?php 
                  if($_SESSION['isSuperAdmin'] == 1){
                ?>
                  <div class="controls" style="display: flex; gap: 10px; align-items: center;">
                    <textarea type="text" id="note-text" placeholder="Enter your message" style="flex-grow: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                    <input type="button" class="add_note" value="Post" style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #007BFF; color: white; cursor: pointer;">
                  </div>
                <?php } ?>
    
              </div>

            </div>

          </div>

          </div>

        </main>

    </div>
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
      let toggle = 0;
      $(".d-section").click(function(){
        if(toggle == 0){
          $(".d-section").html("Cancel");
          $(".delete").css("display","block");
          toggle = 1;
        }else{
          $(".d-section").html("Delete Section");
          $(".delete").css("display","none");
          toggle = 0;
        }
      });
      $(".add_note").click(function(){
        var note = $("#note-text").val();
        if(note != ""){
          $.ajax({
    url: "add_b",
    type: "POST",
    data: {note: note},
    success: function(data){
       location.reload();
    }
});

        }else{
          alert("Please enter a message");
        }
      });

      $(".delete").click(function(){
    var userConfirmed = confirm("Are you sure you want to delete this note?");
    if(userConfirmed){
        var id = $(this).attr("data-id");
        $.ajax({
            url: "delete_b",
            type: "POST",
            data: {id: id},
            success: function(data){
                if(data == "success"){
                    location.reload();
                }else{
                    alert("You do not have permission to delete this note");
                }
            }
        });
    }else{
        // User clicked "Cancel"
    }
});
        const board = document.getElementById('board-container');
        let activeNote = null;

        board.addEventListener('dragstart', (e) => {
            if (e.target.classList.contains('note')) {
                e.target.style.opacity = '0.7';
                activeNote = e.target;
            }
        });

        board.addEventListener('dragend', (e) => {
            if (e.target.classList.contains('note')) {
                e.target.style.opacity = '1';
                activeNote = null;
            }
        });

        board.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        board.addEventListener('drop', (e) => {
            e.preventDefault();
            if (activeNote) {
                activeNote.style.opacity = '1';
                board.appendChild(activeNote);
                activeNote = null;
            }
        });
    </script>
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