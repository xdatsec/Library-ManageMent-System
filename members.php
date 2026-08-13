
<?php 
session_start();
$_SESSION['locator'] = 'tr';
$_SESSION['members'] = 'true';
if (isset($_SESSION["loggedin"])) {
    header('Location: library_members.php');
} else {
    header('Location: /signin.php');
    exit;
}

?>
