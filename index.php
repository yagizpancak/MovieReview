<!--
Author - Yağızcan Pançak | 260201020
-->

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


    <div style="background-image: url(./images/bg.jpg); background-size: 100%; background-repeat: no-repeat; background-position: center; padding: 7% 0; text-align: center;">
        <div style="width: 80%; margin: 0 auto; padding: 1%;">
            
        <form action="movie-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Movie.." required style="width: 50%; padding: 1%; font-size: 1rem; border: none; border-radius: 5px;">
            <input type="submit" name="submit" value="Search" class="button">
        </form>
        </div>
    </div>
    
     

    
    <div style="background-color: #ececec; padding: 4% 0;">
        <div style="width: 80%; margin: 0 auto; padding: 1%;">
            <h2 style="text-align: center;" id='movies'>Movies in Theaters</h2>

            <?php
                $sql = "SELECT * FROM movies ";
                $response = mysqli_query($connection, $sql);
                
                while ($row = mysqli_fetch_array($response)){
                    echo '<div style="width: 43%; margin: 1%; padding: 2%; float: left; background-color: white; border-radius: 15px;">';
                    echo '<div style="width: 20%; float: left;">';
                    echo '<img src="images/movies/'.$row['image_name'].'.jpg" alt="'.$row['image_name'].'"  style="width: 100%; border-radius: 15px;"></div>';
                    echo '<div style="width: 70%; float: left; margin-left: 8%;"><h4>'.$row['movie_name'].'</h4>';
                    echo '<p style="font-size: 1.2rem; margin: 2% 0;">'.$row['release_date'].'</p>';
                    echo '<p style="font-size: 1rem; color: #747d8c;">'.$row['text'].'</p><br>';
                    echo '<a href="login-check.php" class="button">Review Now</a>';
                    echo '<a href="review-board.php" class="button" style="margin-left: 10px;">See Reviews</a></div></div>';
                }
            ?>  

            <div style="clear: both; float: none;"></div>
        </div>
    </div>
    

    
    <div style="width: 80%; margin: 0 auto; padding: 1%; text-align: center;">
        <ul style="list-style-type: none">
            <li style="display: inline; padding: 1%;">
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
            </li>
            <li style="display: inline; padding: 1%;">
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
            </li>
            <li style="display: inline; padding: 1%;">
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
            </li>
        </ul>
    </div>
    <hr>
    <div style="width: 80%; margin: 0 auto; padding: 1%; text-align: center;">
        <p id="contact">Designed By Yağızcan Pançak - 260201020</p>
    </div>
   
    </body>
</html>