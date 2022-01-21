<?php session_start();
     include("connection.php");
     include("fileIO.php"); ?>
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

        <div style="background-color: #139bda; padding: 1%;">
        <div style="border: 1px solid grey; width: 30%; margin: 2% auto; background-color: white; padding: 3%; text-align:center">
            <h1 style="text-align: center;">New Review</h2>
            
            <form action="" method="POST" style="text-align: center;" >
                <br><br>Movie:
                <br><select name="movie" id="movie">
                    <?php
                        $sql = "SELECT movie_name FROM movies ";
                        $response = mysqli_query($connection, $sql);
                        
                        while ($row = mysqli_fetch_array($response)){
                            echo "<option>".$row['movie_name']."</option>";
                        }
                        
                    ?>
                </select>
            
                <br><br>Review:
                <br><textarea name="review" required=True style="width: 80%; height: 30%;"></textarea>
            
                <br><br><input type="submit" name="submit" value="Send Review" class="button">
            </form>
            
        </div>
    </div>


    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        $movie = $_POST['movie'];
        $review = $_POST['review'];
        $username = $_SESSION['login'];

        $sql = "INSERT INTO reviews (movie_name, review, username) VALUES ('$movie', '$review', '$username')";
        $response = mysqli_query($connection, $sql);
        write_log("User: ".$username." added new review.");

        header("location:"."review-board.php");
    }
?>