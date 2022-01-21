<?php session_start(); 
    include("connection.php");?>
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
                        echo '<li style="display: inline;padding: 3%;font-weight: bold;">';
                        echo  '<a href="login.php">LogIn</a>';
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>

        <div style="clear: both; float: none;"></div>
    </div>

    <div style="background-color: #139bda; padding: 4% 0;">
    <div style="width: 80%; margin: 0 auto; padding: 1%;">
        <div style="width: 20% ; margin: 0 auto; padding: 0%; background-color: white; border-radius: 15px; ">
            <h2 style="text-align: center;">Reviews</h2>
        </div>

        <?php
            $sql = "SELECT * FROM reviews ";
            $response = mysqli_query($connection, $sql);
            
            while ($row = mysqli_fetch_array($response)){
                echo '<div style="width: auto; margin: 1%; padding: 2%; background-color: white; border-radius: 15px;>';
                echo '<h4 style="text-align: center;">';
                echo $row['movie_name']."</h4>";
                echo "<br><br><hr>".$row['review']."<br><br><hr>";
                echo "<b>User: </b>".$row['username'];
                echo "</div>";
            }
            
        ?>




    </div>
    </div>

</body>
</html>