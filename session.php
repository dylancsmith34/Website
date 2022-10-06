<?php
//Start Session
session_start();

//If user is logged in, redirect to admin page
if(isset($_SESSION["uid"])){
    header('location: admin.php');
    exit;
}

?>
