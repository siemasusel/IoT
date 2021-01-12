<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$first_name = mysqli_real_escape_string($db, $_REQUEST['name']);
$last_name = mysqli_real_escape_string($db, $_REQUEST['last_name']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$premium = mysqli_real_escape_string($db, $_REQUEST['premium']);
 

$sql = "INSERT INTO users (usr_name, usr_last_name, usr_email, usr_premium) VALUES ('$first_name', '$last_name', '$email', (CASE WHEN '$premium'='on' THEN 1 ELSE 0 END))";
mysqli_query($db, $sql);
header("Location: list-accounts.php");
exit();
?>