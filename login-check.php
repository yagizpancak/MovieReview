<?php session_start();
     include("connection.php"); ?>
<html>
    <head>
        <title>LogIn - Movie Review Website</title>
        <meta charset="utf-8">
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div style="width: 80%; margin: 0 auto; padding: 1%;">
            <div style="width: 6%; float: left;">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Logo" style="width: 100%;">
                    
                </a>
            </div>

            <div style="text-align: right;line-height: 60px;" >
                <ul>
                    <li style="display: inline;padding: 1%;font-weight: bold;">
                        <a href="index.php">Home</a>
                    </li>
                    <li style="display: inline;padding: 1%;font-weight: bold;">
                        <a href="index.php#foods">Movies</a>
                    </li>
                    <li style="display: inline;padding: 1%;font-weight: bold;">
                        <a href="index.php#contact">Contact</a>
                    </li>
                    <li style="display: inline;padding: 3%;font-weight: bold;">
                        <a href="login.php">LogIn</a>
                    </li>
                </ul>
            </div>

            <div style="clear: both; float: none;"></div>
        </div>

        <?php
            if(isset($_SESSION['login'])){
                header("location:"."review.php");
            }else {
                echo '<div style="background-color: #139bda; padding: 5%;">';
                echo '<div style="border: 1px solid grey; width: 30%; margin: 5% auto; background-color: white; padding: 3%; text-align: center;">';
                echo '<h1 style="text-align: center;">You need to logged in to continue...</h2>';
                echo '<br><a href="login.php" class="button">Login</a>';
                echo '</div></div>';
            }
        ?>



    </body>

</html>