<?php session_start();
     include("connection.php");
     include("fileIO.php"); ?>
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
                    <a href="index.php#movies">Movies</a>
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

    <div style="background-color: #139bda; padding: 5%;">
        <div style="border: 1px solid grey; width: 30%; margin: 5% auto; background-color: white; padding: 3%; text-align:center">
            <h1 style="text-align: center;">LogIn</h2>
            <br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br>
            <form action="" method="POST" style="text-align: center;">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username" required=True> <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password" required=True> <br><br>

                <input type="submit" name="submit" value="Login" class="button">
            </form>
            
            <br><br>
            <a href="register.php" class="button">Register</a>
        </div>
    </div>

    </body>
</html>

<?php

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $response = mysqli_query($connection, $sql);

        if(mysqli_num_rows($response)==1){
            $_SESSION['login'] = $username;
            if($username == 'admin'){
                header("location:"."admin.php");

            }else {
                write_log("User: ".$username." has logged in.");
                header("location:"."index.php");
            }
        }else{
            //user not exist
            $_SESSION['login'] = "<div style='color: red; text-align: center;'>Username or password is incorrect.</div>";
            header("location:"."login.php");

        }
    }

?>