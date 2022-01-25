<!--
Author - Yağızcan Pançak | 260201020
-->

<?php session_start(); 
include("connection.php");
include("fileIO.php"); ?>
<html>
    <head>
        <title>Movie Review Website</title>
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
                <?php
                    echo  '<a href="profile.php">';
                    if(isset($_SESSION['login'])){
                        echo '<li style="display: inline;padding: 3%;font-weight: bold;">';
                        echo '<img src=';
                        if(file_exists("images/profile_images/".$_SESSION['login'].".jpg")){
                            echo '"images/profile_images/'.$_SESSION['login'].'.jpg"' ;
                        }else{
                            echo '"images/profile_images/no_photo.jpg"';
                        }
                        echo 'alt="Profile Photo" class="profile">';
                        echo $_SESSION['login'];
                        echo "</a></li>";
                        
                        echo '<li style="display: inline;padding: 1%;font-weight: bold;">';
                        echo '<a href="logout.php">Logout</a>';
                        echo "</li>";
                    }else{
                        header("location:"."login-check.php");
                        die;
                    }
                ?>
            </ul>
        </div>

        <div style="clear: both; float: none;"></div>
    </div>

    <div style="background-color: #139bda; padding: 5%;">
        <div style="border: 1px solid grey; width: 30%; margin: 1% auto; background-color: white; padding: 3%; text-align: center;">
            <img src=
            <?php     
                if(file_exists("images/profile_images/".$_SESSION['login'].".jpg")){
                                echo '"images/profile_images/'.$_SESSION['login'].'.jpg"' ;
                }else{
                    echo '"images/profile_images/no_photo.jpg"';
                }
            ?>
            alt="Profile Photo" class="profile-big">
            <br><br>
            <form action="" method="POST" style="text-align: center;" enctype="multipart/form-data">
                <input type="file" name="file" id="file" style="display: none;">
                <label for="file" style="cursor: pointer; background: rgba(0, 0, 0, 0.7); color: wheat;border-radius: 5px; padding: 1%; font-size: 15px;">Choose Photo</label>
                <input type="submit" name="photo" value="Update Photo" style="cursor: pointer; background: rgba(0, 0, 0, 0.7); color: wheat;border-radius: 5px; padding: 1%; font-size: 15px; border: none">
            </form>
            <?php 
                if(isset($_SESSION['extension'])){
                    echo $_SESSION['extension'];
                    unset($_SESSION['extension']);
                }
            ?>
            
            
            <?php 
            $username = $_SESSION['login'];
            $sql = "SELECT * FROM users WHERE username='$username'";
            $response = mysqli_query($connection, $sql);
            
            $res_array = mysqli_fetch_array($response);
            $full_name = $res_array['full_name'];
            $password = $res_array['password'];
            ?>
            <form action="" method="POST" style="text-align: center;" >
                <br><br>Full Name: <?php echo "<b>".$full_name."</b>";?>
                <br><input type="text" name="full_name" placeholder="Change Full Name">
                
                <br><br>Username: <?php echo "<b>".$username."</b>";?>
                <br><input type="text" name="username" placeholder="Change Username">
                
                <?php
                    if(isset($_SESSION['change_username'])){
                        echo $_SESSION['change_username'];
                        unset($_SESSION['change_username']);
                    }
                ?>

                <br><br>Password: <?php echo "<b>".$password."</b>";?>
                <br><input type="text" name="password" placeholder="Change Password">
            
                <br><br><input type="submit" name="submit" value="Update Profile" class="button">
            </form>
        
        
        </div>
    </div>

</body>
</html>

<?php
    if(isset($_POST['photo'])){
        $img_name = $_FILES['file']['name'];
        $extension=(strtolower(pathinfo($img_name, PATHINFO_EXTENSION)));
        if($extension=='jpg'){
            move_uploaded_file($_FILES['file']['tmp_name'], "images/profile_images/".$username.".jpg");
            write_log("User: ".$username." updated profile photo.");
            header("location:"."profile.php");
        }else {
            $_SESSION['extension'] = "<div style='color: red; text-align: center;'>Please upload .jpg file.</div>";
            header("location:"."profile.php");
        } 
    }

    if(isset($_POST['submit'])){
        if($_POST['full_name'] != $full_name && $_POST['full_name'] != ''){
            $full_name = $_POST['full_name'];
            $sql = "UPDATE users SET full_name='$full_name' WHERE username='$username'";
            $response = mysqli_query($connection, $sql);
            write_log("User: ".$username." updated full name.");
        }

        if($_POST['username'] != $username && $_POST['username'] != ''){
            $new_username = $_POST['username'];
            $sql = "SELECT * FROM users WHERE username='$new_username'";
            $response = mysqli_query($connection, $sql);

            if(mysqli_num_rows($response)==0){
                $sql = "UPDATE users SET username='$new_username' WHERE username='$username'";
                $response = mysqli_query($connection, $sql);
                rename("images/profile_images/".$username.".jpg", "images/profile_images/".$new_username.".jpg");
                $username = $new_username;
                write_log("User: ".$username." updated username.");
                $_SESSION['login'] = $username;
                
            }else{
                $_SESSION['change_username'] = "<div style='color: red; text-align: center;'>Username has already been taken.</div>";
            }
        }

        if($_POST['password'] != $password && $_POST['password'] != ''){
            $password = $_POST['password'];
            $sql = "UPDATE users SET password='$password' WHERE username='$username'";
            $response = mysqli_query($connection, $sql);
            write_log("User: ".$username." updated password.");
        }
        header("location:"."profile.php");
    }
    
?>