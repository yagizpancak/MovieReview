<!--
Author - Yağızcan Pançak | 260201020
-->

<?php session_start(); 
    include("connection.php");
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header("location:"."index.php");
        die;
    }
    ?>
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
                <li style="display: inline;padding: 1%;font-weight: bold; color: #139bda;">
                    Admin Panel
                </li>
                <li style="display: inline;padding: 1%;font-weight: bold;">
                     <a href="logout.php">Logout</a>
                </li>
                
            </ul>
        </div>

        <div style="clear: both; float: none;"></div>


        <div style="text-align: center;line-height: 60px; background-color: #ececec; " >
            <ul>
                <form action="" method="POST">
                <li style="display: inline;padding: 1%;font-weight: bold;">
                    <input type="submit" name="users" value="Users" class="button">
                </li>
                <li style="display: inline;padding: 1%;font-weight: bold;">
                    <input type="submit" name="movies" value="Movies" class="button">
                </li>
                <li style="display: inline;padding: 1%;font-weight: bold;">
                    <input type="submit" name="reviews" value="Reviews" class="button">
                </li>
                <li style="display: inline;padding: 1%;font-weight: bold;">
                    <input type="submit" name="logs" value="Logs" class="button">
                </li>
                    
                </ul>
                </form>
        </div>
        
    </div>
    <br>

    <div align= 'center'>
    <?php
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            echo '<br>';
            unset($_SESSION['delete']);
        }

        if(isset($_POST['users']) || isset($_SESSION['users'])){
            unset($_SESSION['users']);
            echo '<table border="1" cellpadding="50px" cellspacing="0" width="500"><tbody>';
            echo '<tr><td>Full Name</td> <td>Username</td> <td>Password</td> <td>Delete</td></tr>';
            $sql = "SELECT * FROM users ";
            $response = mysqli_query($connection, $sql);
                
            while ($row = mysqli_fetch_array($response)){
                $full_name = $row['full_name'];
                $username = $row['username'];
                $password = $row['password'];
                if($username != 'admin'){
                    echo '<tr>';
                    echo '<td>'.$full_name.'</td> <td>'.$username.'</td> <td>'.$password.'</td>'; 
                    echo '<td align="center"><a href="delete.php?from=users&key='.$username.'" style="color: red;">[x]</a></td>';
                    echo '</tr>';
                }
            }

            echo "</tbody></table>";
        }

        if(isset($_POST['reviews']) || isset($_SESSION['reviews'])){
            unset($_SESSION['reviews']);
            echo '<table border="1" cellpadding="50px" cellspacing="0" width="500"><tbody>';
            echo '<tr><td>Movie Name</td> <td>Username</td> <td>Text</td> <td>Delete</td></tr>';
            $sql = "SELECT * FROM reviews ";
            $response = mysqli_query($connection, $sql);
                
            while ($row = mysqli_fetch_array($response)){
                $id = $row['id'];
                $movie_name = $row['movie_name'];
                $username = $row['username'];
                $text = $row['review'];
                
                echo '<tr>';
                echo '<td>'.$movie_name.'</td> <td>'.$username.'</td> <td>'.$text.'</td>'; 
                echo '<td align="center"><a href="delete.php?from=reviews&key='.$id.'" style="color: red;">[x]</a></td>';
                echo '</tr>';
                
            }

            echo "</tbody></table>";
        }

        if(isset($_POST['movies']) || isset($_SESSION['movies'])){
            unset($_SESSION['movies']);
            echo '<table border="1" cellpadding="50px" cellspacing="0" width="500"><tbody>';
            echo '<tr><td>Movie Name</td> <td>Release Date</td> <td>Image Name</td> <td>Text</td> <td>Delete</td></tr>';
            $sql = "SELECT * FROM movies ";
            $response = mysqli_query($connection, $sql);
                
            while ($row = mysqli_fetch_array($response)){
                $id = $row['id'];
                $movie_name = $row['movie_name'];
                $release_date = $row['release_date'];
                $image_name = $row['image_name'];
                $text = $row['text'];
                
                echo '<tr>';
                echo '<td>'.$movie_name.'</td> <td>'.$release_date.'</td> <td>'.$image_name.'</td><td>'.$text.'</td>'; 
                echo '<td align="center"><a href="delete.php?from=movies&key='.$id.'" style="color: red;">[x]</a></td>';
                echo '</tr>';
                
            }
            

            echo "</tbody></table>";
        }

        if(isset($_POST['logs'])){
            echo '<table border="1" cellpadding="50px" cellspacing="0" width="500"><tbody>';
            echo '<tr><td>Logs</td> ';
            $file = fopen('log.txt', 'r');

            while ($row = fgets($file)){
                
                echo '<tr>';
                echo '<td>'.$row.'</td>';
                echo '</tr>';
                
            }
            

            echo "</tbody></table>";
        }

        
        
    ?>
     </div>       
</body>
</html>