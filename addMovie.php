<?php
require_once('php/db.php');
SESSION_START();
if(!isset($_SESSION['username'])){
    header('Location: connexion.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/cssAddMovie.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    
    <title>ADMIN</title>
</head>
<body>
<div class="topnav">
  <div class="left">
  <a href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <?php if(isset($_SESSION['username'])){if($_SESSION['username'] == "ADMIN") {echo('<a class="active" href="addMovie.php">ADMIN</a>');}}?>
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
<div class="wrap">
    <form action="" method="POST" enctype='multipart/form-data'>
        <fieldset>
            <legend><h3>Add a movie</h3></legend>
                <input type="text" name="moviename" placeholder="Name"/>
                <input type="text" name="year" placeholder="Year"/>
                <input type="text" name="author" placeholder="Author"/>
                <input type="text" name="duration" placeholder="Duration"/><br><br>
                <textarea name="description" placeholder="Description"></textarea><br><br>
                <label for="vid">Select video: </label>
                <input type="file" name="vid" id ="vid" accept="video/*"/><br><br>
                <label for="ima">Select image: </label>
                <input type="file" name="ima" id ="ima" class="field-long" accept="image/*"/><br><br>
                <input type="submit"  value="Submit">
    </fieldset>
    </form>
    </div>
    <?php
    if(isset($_POST['moviename']) && isset($_POST['year']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['duration'])){
        if(!empty($_POST['moviename']) && !empty($_POST['year']) && !empty($_POST['author']) && !empty($_POST['description']) && !empty($_POST['duration'])){
            
            $moviename = htmlspecialchars($_POST['moviename'],ENT_QUOTES);
            $year = $_POST['year'];
            $author = $_POST['author'];
            $description = htmlspecialchars($_POST["description"],ENT_QUOTES);
            $duration = $_POST['duration']; 
            $query = "SELECT * FROM movielist WHERE nameMovie = '$moviename'";
            $result = mysqli_query($con,$query);
            if($result->num_rows == 0){
                if($_FILES['vid']['error'] == 0){
                    $pathVideo = 'video/'.$_FILES['vid']['name'];
                    if(copy($_FILES['vid']['tmp_name'],$pathVideo)){
                        $pathImage = 'image/'.$_FILES['ima']['name'];
                        if(copy($_FILES['ima']['tmp_name'],$pathImage)){
                            $query = "INSERT INTO movielist (nameMovie, descriptionMovie, authorMovie, yearMovie, durationMovie, pathMovie, pathImage) VALUES ('$moviename','$description','$author','$year','$duration','$pathVideo','$pathImage')";
                            $result = mysqli_query($con,$query);
                            if($result){
                                echo('<p class="validText">Movie added !</p>');
                            }
                        } else {
                            echo('<p class="errorText">Error: '. $_FILES["ima"]["error"].' !</p>');
                        }
                    }
                } else {
                    echo('<p class="errorText">Error: '. $_FILES["vid"]["error"].' !</p>');
                }
            } else {
                echo('<p class="errorText">Movie already in database !</p>');
            }
        } else {
        }
    }
    ?>
</body>
</html>
