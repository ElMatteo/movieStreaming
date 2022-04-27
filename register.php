<?php
require_once('php/db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/cssRegister.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    <title>Document</title>
</head>
<body>
<div class="wrap">
    <form action="" method="POST">
        <fieldset>
            <legend><h3>Sign Up</h3></legend>
                <input type="text" name="nickname" placeholder="Nickname" required/>
                <input type="text" name="email" placeholder="Email" required/>
                <input type="password" name="password" placeholder="Password" required/>
                <input type="password" name="passwordConf" placeholder="Confirm password" required/>
        <form action="" method="POST">
            <h2>Or sign up with</h2>
            <button href="#"><i class="fa fa-facebook"></i>Facebook</button>
            <button href="#"><i class="fa fa-google-plus"></i>Google +</button>
            <button href="#"><i class="fa fa-twitter"></i>Twitter</button>
        </form>
        <input type="submit"  value="Submit">
        <h2>Click <a href="connexion.php">here to log-in</a></h2>

    <?php
    if(isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConf'])){
        if(!empty($_POST['nickname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConf'])){
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
            $query = "SELECT * FROM users WHERE nicknameUser = '$nickname' OR emailUser = '$email'";
            $result = mysqli_query($con,$query);
                if($result->num_rows > 0){
                    $row = mysqli_fetch_assoc($result);
                    if($row['nicknameUser'] == $nickname){
                        echo('<p class="errorText">Username already exists !</p>');
                    }
                    if($row['emailUser'] == $email){
                        echo('<p class="errorText">Email already exists !</p>');
                    }
                } else {
                    $query = "INSERT INTO users (nicknameUser,emailUser,passwordUser) VALUES ('$nickname','$email','$password')";
                    $result = mysqli_query($con,$query);
                    if($result){
                        header('Location: index.php');
                    } else {
                        echo('<p>Contact administrator !</p>');
                    }
                }
        }
    }
    ?>
        </fieldset>
    </form>
</div>
</body>
</html>