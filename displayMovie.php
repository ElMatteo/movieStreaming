<?php
require_once('php/db.php');
SESSION_START();
if(!isset($_SESSION['username'])){
    header('Location: php/connexion.php');
}

$movieName = htmlspecialchars($_GET['movieName'],ENT_QUOTES);
$query = "SELECT * FROM movielist WHERE nameMovie = '$movieName'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result)){
    $desc = $row['descriptionMovie'];
    $auth = $row['authorMovie'];
    $dur = $row['durationMovie'];
    $ann = $row['yearMovie'];
    $pathVid = $row['pathMovie'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/styleDisplayMovie.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    
    <title>Document</title>
</head>
<body>
    <div class="classMovie">
        <p class="titleMovie"><?php echo($movieName)?></p>
        <center>
            <video controls width="100%">
                <source src="<?php echo($pathVid)?>" type="video/mp4">
            </video>
        </center>
        <p class="descMovie"><?php echo($desc)?></p>
    </div>
</body>
</html>