<!--
Author - Yağızcan Pançak | 260201020
-->

<?php
/*
    $connection = mysqli_connect('localhost', 'root', '') or die('There was a problem connecting to the database');
    $db = mysqli_select_db($connection, 'movie_review') or die('There was a problem connecting to the database');
*/
?>

<?php

    //Get Heroku ClearDB connection information
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;

    // Connect to DB
    $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password);
    $db = mysqli_select_db($connection, $cleardb_db);

?>