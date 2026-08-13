<?php
session_start();
$_SESSION['members'] = false;
$_SESSION['locator'] = 'rp';
if (isset($_SESSION["loggedin"])) {

} else {
  header('Location: /signin.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <title>Entrance</title>
    <style>
        body {
            background-image:url(data:image/png;base64,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);
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 4em;
        }

        .welcome-container {
            height: 2em; 
    
        }



        form {
            text-align: center;
            margin-top: 90px;
            text-shadow:1px 1px 1px black;
        }

        label, input, button {
            display: inline-block;
            margin-bottom: 10px;
            text-shadow:1px 1px 1px black;
        }

        input {
            padding: 10px;
            font-size: 2em;
            width: 200px;
            font-weight: bold;
            box-shadow: 0px 0px 0px black;
        }

        button {
            padding: 10px;
            font-size: 2em;
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            box-shadow: 1px 1px 2px black;
        }

        .note {
            font-size: 2em;
            margin-top: 10px;
            text-shadow:1px 1px 1px black;
        }
        .note2 {
            font-size: 2em;
        }
        .note3 {
            font-size: 2em;
        }
    </style>
</head>

<body>
    <center>
        <form>
            <img src="assets/chmsu.png">
            <p class="note2">Please type your LIBRARY CARD NO. <br> then Press Enter</p>
            <input type="text" id="libnum" name="username"  placeholder="">
            <button class="login" type="button">Enter</button>
            <p class="note3"></p>
        </form>
      
        <p class="note">Note: Your Login Attendance is good for 1 HOUR ONLY. Please<br> Login after AN Hour</p>
    </center>

    <script>
        $(document).on('input', '#libnum', function() {
            if(this.value.length ==11){
            event.preventDefault();
            const libno = $("#libnum").val();
            $.ajax({
                url: "entrancecheck2",
                type: "POST",
                data: {
                    libno: libno
                },
                success: function (data) {
                    $(".note3").text(data);
                    $("#libnum").val("0");
                    $("#libnum").val("");
                    usernameInput.focus();

                }
            });
            }
        });

        const usernameInput = document.getElementById('libnum');
        $("#libnum").on('keyup', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const libno = $("#libnum").val();
                $.ajax({
                    url: "entrancecheck",
                    type: "POST",
                    data: {
                        libno: libno
                    },
                    success: function (data) {
                        $(".note3").text(data);
                        $("#libnum").val("");
                        usernameInput.focus();
                    }
                });
            }
        });


        // Set focus on the input field

        // Disable form submission on Enter key
        $('form').on('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });


        $(".login").click(function(){
            const libno = $("#libnum").val();
            $.ajax({
                url: "entrancecheck",
                type: "POST",
                data: {
                    libno: libno
                },
                success: function(data){
                   $(".note3").text(data);
                   usernameInput.focus();
                }
            });
        });
   
        $(document).on('contextmenu', function() {
            usernameInput.focus();
            return false; // Prevent default right-click menu
        });

        $(document).on('click', function() {
            // Left-click
            usernameInput.focus();
        });

        // JavaScript for typing animation
        function typeText(element, text, speed, delay) {
            let i = 0;
            const intervalId = setInterval(function () {
                element.innerHTML += text.charAt(i);
                i++;
                if (i > text.length) {
                    clearInterval(intervalId);
                    setTimeout(function () {
                        element.innerHTML = ''; // Reset the text content
                        setTimeout(function () {
                            typeText(element, text, speed, delay); // Restart the animation
                        }, delay);
                    }, 2000); // Wait for 2 seconds before restarting
                }
            }, speed);
        }

        // Trigger the typing animation
        const welcomeText = document.getElementById('welcomeText');
        const welcomeContainer = document.getElementById('welcomeContainer');

        // Apply CSS property for preserving line breaks
        welcomeText.style.whiteSpace = 'pre-line';
       
    </script>
</body>

</html>
