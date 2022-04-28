<?php
include('php/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'PHPMailer/vendor/autoload.php';
$mail2 = new PHPMailer(true);
SESSION_START();
if(isset($_SESSION['username'])){
    $nickname = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE nicknameUser = '$nickname'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $email = $row['emailUser'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/contact.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact</title>
</head>
<body>
    <div class="topnav">
        <div class="left">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a class="active" href="">Contact</a>
        <?php if(isset($_SESSION['username'])){if($_SESSION['username'] == "ADMIN") {echo('<a href="addMovie.php">ADMIN</a>');}}?>
        </div>
        <?php if(isset($_SESSION['username'])) {echo("<div class='right'><form action='' method='POST'><button type='submit' class='btnDisc' name='disconnect'>Disconnect</button></form></div>");}
        else {echo('<a href="register.php">Sign up</a><a href="connexion.php">Sign in</a>');}
        ?>
      </div>
      <div class="background">
<?php
if(isset($_SESSION['username'])){
    echo('<div class="container">');
} else {
    $location = "location='connexion.php'";
    echo('  <div onclick="'.$location.'" class="container">');
}

?>
<form action="" method="POST">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>CONTACT</span>
            <span>ME</span>
          </div>
        </div>
        <div class="screen-body-item">
          <div class="app-form">
            <div class="app-form-group">
            <?php
                if(isset($_SESSION['username'])){
                    echo('<input class="app-form-control" name = "nickname" placeholder="NAME" value="'.$nickname.'">');
                } else {
                    echo('<input class="app-form-control" name = "nickname" placeholder="NAME" required>');
                }
                ?>
            </div>
            <div class="app-form-group">
                <?php
                if(isset($_SESSION['username'])){
                    echo('<input class="app-form-control" name="emaill" placeholder="EMAIL" value ="'.$email.'">');
                } else {
                    echo('<input class="app-form-control" name="emaill" placeholder="EMAIL" required>');
                }
              ?>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" name="object" placeholder="OBJECT" required>
            </div>
            <div class="app-form-group message">
              <textarea class="app-form-control-2" name ="message" placeholder="MESSAGE" required></textarea>
            </div>
            <div class="app-form-group buttons">
              <button type="submit" class="app-form-button">SEND</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>


<?php

if(isset($_POST['message']) && isset($_POST['object']) && isset($_POST['nickname']) && isset($_POST['emaill'])){
    if(!empty($_POST['message']) && isset($_POST['object']) && !empty($_POST['nickname']) && !empty($_POST['emaill'])){
        $nicknamee = $_POST['nickname'];
        $email = $_POST['emaill'];
        $object = $_POST['object'];
        $message = $_POST['message'];
        try {
            $mail2->isSMTP();
            $mail2->SMTPAuth = true;
            $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail2->Host = 'smtp.gmail.com';
            $mail2->Port = 465;
            $mail2->Username = 'zolaskiki@gmail.com';
            $mail2->Password = 'passworddeouf';
        
            $mail2->setFrom('zolaskiki@gmail.com', 'Mate Finder');
            $mail2->addAddress('zolaskiki@gmail.com');
        
            $mail2->isHTML(true);
            $mail2->Subject = 'movieStreaming - You received a message from ' . $nicknamee;
            $mail2->Body = '
            The message has been sent by : <b><i>'.$nicknamee.'</b></i> - ' . $email . ' <br> <br>
            Object: ' . $object . ' <br>
            Message: ' . $message . '
            ';
            $mail2->send();
            echo 'Message has been sent';
        } catch(Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail2->ErrorInfo}";
        }
    }
}

if(isset($_POST['disconnect'])) {
    SESSION_DESTROY();
    header('Location: contact.php');
}
?>
</div>
</body>
</html>