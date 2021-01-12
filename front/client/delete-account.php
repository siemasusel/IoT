<?php 
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$usr_id = $_SESSION['id'];
$sql = "delete from users where usr_id = '$usr_id'";
$result = mysqli_query($db, $sql);
header("Location: login.php");
exit();
?>
