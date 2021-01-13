<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$usr_id = $_GET["id"];
// Escape user inputs for security
$pass = mysqli_real_escape_string($db, $_REQUEST['password']);
$pass_h = password_hash($pass, PASSWORD_DEFAULT);

// Attempt insert query execution
$sql = "UPDATE users SET usr_password='$pass_h' where usr_id='$usr_id'";
mysqli_query($db, $sql);

header("Location: account.php?id=$usr_id");
exit();
?>