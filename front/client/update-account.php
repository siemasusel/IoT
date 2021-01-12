<?php
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$usr_id = $_SESSION["id"];
// Escape user inputs for security
$first_name = mysqli_real_escape_string($db, $_REQUEST['name']);
$last_name = mysqli_real_escape_string($db, $_REQUEST['last_name']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$premium = mysqli_real_escape_string($db, $_REQUEST['premium']);
$terrarium = mysqli_real_escape_string($db, $_REQUEST['terrarium']);

$end_date = mysqli_real_escape_string($db, $_REQUEST['end_date']);

 
// Attempt insert query execution
$sql = "UPDATE users SET usr_name='$first_name', usr_last_name='$last_name', usr_email='$email', usr_trm_id='$terrarium' where usr_id='$usr_id'";
mysqli_query($db, $sql);

header("Location: account.php");
exit();
?>