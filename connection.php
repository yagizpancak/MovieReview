<?php
    $connection = mysqli_connect('localhost', 'root', '') or die('There was a problem connecting to the database');
    $db = mysqli_select_db($connection, 'movie_review') or die('There was a problem connecting to the database');
?>