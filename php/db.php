<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "moviestreaming";
$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
    echo("Error");
}
?>