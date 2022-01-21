<!--
Author - Yağızcan Pançak | 260201020
-->

<?php session_start();
     include("connection.php"); ?>
<html>
    <head>
        <title>Register - Movie Review Website</title>
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
                        <a href="index.php#movies">Movies</a>
                    </li>
                    <li style="display: inline;padding: 1%;font-weight: bold;">
                        <a href="index.php#contact">Contact</a>
                    </li>
                </ul>
            </div>

            <div style="clear: both; float: none;"></div>
        </div>

        <div style="background-color: #139bda; padding: 5%;">
        <div style="border: 1px solid grey; width: 30%; margin: 5% auto; background-color: white; padding: 3%; text-align:center">
            <h1 style="text-align: center;">Register</h2>
            

            <form action="" method="POST" style="text-align: center;" >
                <br><br>Full Name:
                <br><input type="text" name="full_name" placeholder="Enter Full Name" required=True>
                
                <br><br>Username:
                <br><input type="text" name="username" placeholder="Enter Username" required=True>
                
                <?php
                    if(isset($_SESSION['change_username'])){
                        echo $_SESSION['change_username'];
                        unset($_SESSION['change_username']);
                    }
                ?>

                <br><br>Password:
                <br><input type="password" name="password" placeholder="Enter Password" required=True>
            
                <br><br><input type="submit" name="submit" value="Register" class="button">
            </form>
            
        </div>
    </div>


    </body>
</html>

<?php

    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $response = mysqli_query($connection, $sql);

        if(mysqli_num_rows($response)==0){
            $sql = "INSERT INTO users (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
            $response = mysqli_query($connection, $sql);
            
        }else{
            $_SESSION['change_username'] = "<div style='color: red; text-align: center;'>Username has already been taken.</div>";
            header("location:"."register.php");
            die;
        }
        

        
        header("location:"."login.php");
    }

?>