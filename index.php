<?php
require_once('php/db.php');
SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/index.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
</head>
<body>

  <div class="topnav">
  <div class="left">
  <a class="active" href="">Home</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <?php if(isset($_SESSION['username'])){if($_SESSION['username'] == "ADMIN") {echo('<a href="addMovie.php">ADMIN</a>');}}?>
  </div>
  <?php if(isset($_SESSION['username'])) {echo("<div class='right'><form action='' method='POST'><button type='submit' class='btnDisc' name='disconnect'>Disconnect</button></form></div>");}
  else {echo('<a href="register.php">Sign up</a><a href="connexion.php">Sign in</a>');}
  ?>
  <div class="search-container">
    <form action="" method="POST">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<?php

if(isset($_POST['search'])) {
    if(!empty($_POST['search'])){
        $search = $_POST['search'];
        $query = "SELECT * FROM movielist WHERE nameMovie LIKE '%$search%'";
        $result = mysqli_query($con,$query);
        $comp = 0;
        $nbFilms = 0;
        $query2 = "SELECT * FROM movielist WHERE nameMovie LIKE '%$search%'";
        $result2 = mysqli_query($con,$query);
        echo("<div class='container'>");
        while($row2 = mysqli_fetch_assoc($result2)){
            $nbFilms++;
        }
        echo('<p class="nbResSearch">'.$nbFilms.' films found: </p>');
        while($row = mysqli_fetch_assoc($result)){
                if($comp == 0){
                    echo('<div class ="flex-container">');
                    $pImg = $row['pathImage'];
                    $nMov = htmlspecialchars_decode($row['nameMovie'],ENT_QUOTES);
                    $desc = htmlspecialchars_decode($row['descriptionMovie'],ENT_QUOTES);
                    $auth = $row['authorMovie'];
                    $dur = $row['durationMovie'];
                    $ann = $row['yearMovie'];
                    echo("
                    <div class='flex-item'>
                    <div class='classImg'>");
                    if(isset($_SESSION['username'])){
                        echo("<a href='displayMovie.php?movieName=$nMov'>");
                    } else {
                        echo("<a href='connexion.php'>");
                    }
                    echo("
                    <img src='$pImg' style='width: 500px'>
                    </a>
                    </div>
                    <p class='d'>".$dur."</p>
                    <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
                    <p class='cent'>Directed by ".$auth."</p><br>
                    <p class='de'>".$desc."</p><br>
                    </div>
                    ");
                    $comp++;
                } else if($comp == 3){
                    echo("</div>");
                    echo('<div class ="flex-container">');
                    $pImg = $row['pathImage'];
                    $nMov = $row['nameMovie'];
                    $desc = $row['descriptionMovie'];
                    $auth = $row['authorMovie'];
                    $dur = $row['durationMovie'];
                    $ann = $row['yearMovie'];
                    echo("
                    <div class='flex-item'>
                    <div class='classImg'>");
                    if(isset($_SESSION['username'])){
                        echo("<a href='displayMovie.php?movieName=$nMov'>");
                    } else {
                        echo("<a href='connexion.php'>");
                    }
                    echo("
                    <img src='$pImg' style='width: 500px'>
                    </a>
                    </div>
                    <p class='d'>".$dur."</p>
                    <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
                    <p class='cent'>Directed by ".$auth."</p><br>
                    <p class='de'>".$desc."</p><br>
                    </div>
                    ");
                    $comp=1;
                } else {
                $pImg = $row['pathImage'];
                $nMov = $row['nameMovie'];
                $desc = $row['descriptionMovie'];
                $auth = $row['authorMovie'];
                $dur = $row['durationMovie'];
                $ann = $row['yearMovie'];
                echo("
                <div class='flex-item'>
                <div class='classImg'>");
                if(isset($_SESSION['username'])){
                    echo("<a href='displayMovie.php?movieName=$nMov'>");
                } else {
                    echo("<a href='connexion.php'>");
                }
                echo("
                <img src='$pImg' style='width: 500px'>
                </a>
                </div>
                <p class='d'>".$dur."</p>
                <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
                <p class='cent'>Directed by ".$auth."</p><br>
                <p class='de'>".$desc."</p><br>
                </div>
                ");
                $comp++;
                }
        }
        echo('</div>');
        if($nbFilms == 0){
            echo("
            <div class='notFoundImg'>
                <img src='media/notfound.png'/>
            </div>
            
            ");
        }
        echo('</div>');
    }
} else {
    echo("<div class='container'>");
    $query = "SELECT * FROM movielist";
    $result = mysqli_query($con,$query);
    $comp = 0;
    while($row = mysqli_fetch_assoc($result)){
            if($comp == 0){
                echo('<div class ="flex-container">');
                $pImg = $row['pathImage'];
                $nMov = $row['nameMovie'];
                $desc = $row['descriptionMovie'];
                $auth = $row['authorMovie'];
                $dur = $row['durationMovie'];
                $ann = $row['yearMovie'];
                echo("
                <div class='flex-item'>
                <div class='classImg'>");
                if(isset($_SESSION['username'])){
                    echo("<a href='displayMovie.php?movieName=$nMov'>");
                } else {
                    echo("<a href='connexion.php'>");
                }
                echo("
                <img src='$pImg' style='width: 500px'>
                </a>
                </div>
                <p class='d'>".$dur."</p>
                <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
                <p class='cent'>Directed by ".$auth."</p><br>
                <p class='de'>".$desc."</p><br>
                </div>
                ");
                $comp++;
            } else if($comp == 3){
                echo("</div>");
                echo('<div class ="flex-container">');
                $pImg = $row['pathImage'];
                $nMov = $row['nameMovie'];
                $desc = $row['descriptionMovie'];
                $auth = $row['authorMovie'];
                $dur = $row['durationMovie'];
                $ann = $row['yearMovie'];
                echo("
                <div class='flex-item'>
                <div class='classImg'>");
                if(isset($_SESSION['username'])){
                    echo("<a href='displayMovie.php?movieName=$nMov'>");
                } else {
                    echo("<a href='connexion.php'>");
                }
                echo("
                <img src='$pImg' style='width: 500px'>
                </a>
                </div>
                <p class='d'>".$dur."</p>
                <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
                <p class='cent'>Directed by ".$auth."</p><br>
                <p class='de'>".$desc."</p><br>
                </div>
                ");
                $comp = 1;
            } else {
            $pImg = $row['pathImage'];
            $nMov = $row['nameMovie'];
            $desc = $row['descriptionMovie'];
            $auth = $row['authorMovie'];
            $dur = $row['durationMovie'];
            $ann = $row['yearMovie'];
            echo("
            <div class='flex-item'>
            <div class='classImg'>");
            if(isset($_SESSION['username'])){
                echo("<a href='displayMovie.php?movieName=$nMov'>");
            } else {
                echo("<a href='connexion.php'>");
            }
            echo("
            <img src='$pImg' style='width: 500px'>
            </a>
            </div>
            <p class='d'>".$dur."</p>
            <p class='nbResSearch2'>".$nMov." - ".$ann."</p>
            <p class='cent'>Directed by ".$auth."</p><br>
            <p class='de'>".$desc."</p><br>
            </div>
            ");
            $comp++;
            }
    }
    echo('</div>');
}

if(isset($_POST['disconnect'])) {
    SESSION_DESTROY();
    header('Location: index.php');
}
?>
</div>
</body>
</html>