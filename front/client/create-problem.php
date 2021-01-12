<?php
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }
$usr_id = $_SESSION['id'];
$topic = mysqli_real_escape_string($db, $_REQUEST['topic']);
$desc = mysqli_real_escape_string($db, $_REQUEST['desc']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$premium = mysqli_real_escape_string($db, $_REQUEST['premium']);
 

$sql = "INSERT INTO problems (prb_usr_id, prb_topic, prb_status, prb_description, prb_date) VALUES ('$usr_id', '$topic', 'Open', '$desc', now())";
mysqli_query($db, $sql);
header("Location: help-center.php");
exit();
?>