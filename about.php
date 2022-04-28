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
    <link href='css/about.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>About</title>
</head>
<body>
    <div class="topnav">
        <div class="left">
        <a href="index.php">Home</a>
        <a class="active" href="">About</a>
        <a href="contact.php">Contact</a>
        <?php if(isset($_SESSION['username'])){if($_SESSION['username'] == "ADMIN") {echo('<a href="addMovie.php">ADMIN</a>');}}?>
        </div>
        <?php if(isset($_SESSION['username'])) {echo("<div class='right'><form action='' method='POST'><button type='submit' class='btnDisc' name='disconnect'>Disconnect</button></form></div>");}
        else {echo('<a href="register.php">Sign up</a><a href="connexion.php">Sign in</a>');}
        ?>
      </div>

  <div class="about">
    <p class='title-text'>
    Information
    </p>
    <p class='main-text'>
    This site is a personal non-profit project that I realized in order to practice HTML, CSS, SQL and PHP languages.<br>    
    This project may contain code or convention errors that will be corrected in the future.
    <p>
    <p class='title-text'>
    Presentation of the project
    </p>
    <p class='main-text'>
    This site contains information and trailers of the 50 most watched movies in the history of cinema.<br><br>

    You can access the information of these films but you must have an account to access the trailers.<br><br>

    The site has 6 pages:<br><br>

    - Registration: a page to create your account<br>
    - Connection: a page to connect to your account<br>
    - Index: the home page where you can see the list of films<br>
    - About: the page where you are currently located<br>
    - Contact: a page to send a message to the project mailbox<br>
    - And a last page unique for each film to see the trailer.<br>

    <br><br>

    The site also contains an administrator access to add more movies to the database.

    <br><br>

    More features will be added in the future

    <br>
    </p>

    <p style="color: red; font-weight: bold;" class="main-text">For any question about the project, please contact me by <a href="contact.php" class="main-text">clicking here</a></p>
</p>
  </div>
</body>
</html>