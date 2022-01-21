<!--
Author - Yağızcan Pançak | 260201020
-->

<?php
    session_start(); 
    include("connection.php");
    include("fileIO.php");
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header("location:"."index.php");
        die;
    }

    $from = $_GET['from'];
    $key = $_GET['key'];

    if($from == 'users'){
        $sql = "DELETE FROM users WHERE username='$key'";
        $response = mysqli_query($connection, $sql);
        $_SESSION['delete'] = "<div style='color: green; text-align: center;'>Deleted succesfully.</div>";
        $_SESSION['users'] = '';
        write_log("Admin deleted user.");

    }else if($from == 'reviews'){
        $sql = "DELETE FROM reviews WHERE id='$key'";
        $response = mysqli_query($connection, $sql);

        $_SESSION['delete'] = "<div style='color: green; text-align: center;'>Deleted succesfully.</div>";
        $_SESSION['reviews'] = '';
        write_log("Admin deleted review.");

    }else if($from == 'movies'){
        $sql = "DELETE FROM movies WHERE id='$key'";
        $response = mysqli_query($connection, $sql);

        $_SESSION['delete'] = "<div style='color: green; text-align: center;'>Deleted succesfully.</div>";
        $_SESSION['movies'] = '';
        write_log("Admin deleted movie.");
    }



    
    header("location:"."admin.php")

?>