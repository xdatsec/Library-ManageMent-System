<?php
 
 // Check if the user is logged in, if not then redirect him to login page

$conn = mysqli_connect("localhost", "root", "", "lib_sis");
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>