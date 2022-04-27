<?php
require_once('php/db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/connexion.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    <title>Document</title>
</head>
<body>
<div class="wrap">
    <form action="" method="POST">
        <fieldset>
            <legend><h3>Sign In</h3></legend>
                <input type="text" name="nickname" placeholder="Nickname"/>
                <input type="password" name="password" placeholder="Password"/>
        <form action="#">
            <h2>Or sign in with</h2>
            <button href="#"><i class="fa fa-facebook"></i>Facebook</button>
            <button href="#"><i class="fa fa-google-plus"></i>Google +</button>
            <button href="#"><i class="fa fa-twitter"></i>Twitter</button>
        </form>
        <input type="submit"  value="Submit">
        <h2>Click <a href="register.php">here to register</a></h2>


    <?php
    if(isset($_POST['nickname']) && isset($_POST['password'])){
        if(!empty($_POST['nickname']) && $_POST['password']){
            $nickname = $_POST['nickname'];
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE nicknameUser = '$nickname'";
            $result = mysqli_query($con,$query);
            if($result->num_rows>0){
                $row = mysqli_fetch_assoc($result);
                if($row['passwordUser'] == $password){
                    SESSION_START();
                    $_SESSION['username'] = $nickname;
                    header('Location: index.php');
                } else {
                    echo('<p class="errorText">Incorrect password !</p>');
                }
            } else {
                echo('<p class="errorText">Username does not exist !</p>');
            }
        }
    }

    ?>
        </fieldset>
    </form>
</div>
</body>
</html>