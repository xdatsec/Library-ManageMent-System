<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $email = $_GET["email"];
    // SQL query to check if the user with the given email exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned (user exists)
    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();

        try {

            $mail = new PHPMailer(true);

            // SMTP settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chmsulmsmailer@gmail.com'; // Your Gmail address
            $mail->Password = 'tnskvpybqahxhoao'; // Your App Password (or regular Gmail password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use ENCRYPTION_SMTPS for SSL
            $mail->Port = 587; // Use 465 for SSL

            // Sender and recipient
            $mail->setFrom('chmsulmsmailer@gmail.com', 'PHP Mailer');
            $mail->addAddress($email); // Email address without specifying a name
            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Code - CHMSU LMS';

            $min = 100000; // Minimum 6-digit number
            $max = 999999; // Maximum 6-digit number

            $randomCode = rand($min, $max);

            // Create a styled HTML email body
            $mail->Body = '<html>
       <head>
           <style>
               body {
                   font-family: Arial, sans-serif;
                   background-color: #f4f4f4;
               }
               .container {
                   max-width: 600px;
                   margin: 0 auto;
                   padding: 20px;
                   background-color: #fff;
                   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                   border-radius: 8px;
               }
               h1 {
                   color: #333;
               }
               p {
                   font-size: 16px;
                   color: #555;
               }
           </style>
       </head>
       <body>
           <div class="container">
               <h1>Reset Code</h1>
               <p>Hi ' . $row['UserName'] . ' We Recieve your Request to Reset your password!, Click the button below to reset it</p><br>
               <p>Ignore this email if you did not request a password reset.</p>
               <a href="http://localhost/reset.php?email=' . $email . '&code=' . $randomCode . '" style="text-decoration: none; background-color: #007BFF; color: #fff; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Reset Password</a>
           </div>
       </body>
   </html>';


            $haspasskey = password_hash($randomCode, PASSWORD_BCRYPT);

            $mail->send();
            $sql = "UPDATE user SET resetcode = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $haspasskey, $email);

            // Execute the prepared statement
            if ($stmt->execute()) {
?>
                <script>
                    var response = "Email sent successfully. Please check your inbox.";
                    window.opener.postMessage(response, window.location.origin);
                    window.close();
                </script>
            <?php
            } else {
            ?>
                <script>
                    var response = "Error resetting password. Please try again.";
                    window.opener.postMessage(response, window.location.origin);
                    window.close();
                </script>
            <?php
            }
        } catch (Exception $e) {
            ?>
            <script>
          
                var response = "Email could not be sent. Error:No Enternet connection could not reach api service";
                window.opener.postMessage(response, window.location.origin);
                window.close();
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            var response = "Email does not exist";
            window.opener.postMessage(response, window.location.origin);
            window.close();
        </script>
<?php
    }
    $conn->close();
}


?>