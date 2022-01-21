<!--
Author - Yağızcan Pançak | 260201020
-->

<?php
    include("fileIO.php");
    session_start();
    $username = $_SESSION['login'];
    write_log("User: ". $username. " has logged out.");

    unset($_SESSION['login']);
    header("location:"."index.php");
    die;
 ?>