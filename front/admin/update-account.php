<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$usr_id = $_GET["id"];
// Escape user inputs for security
$first_name = mysqli_real_escape_string($db, $_REQUEST['name']);
$last_name = mysqli_real_escape_string($db, $_REQUEST['last_name']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$premium = mysqli_real_escape_string($db, $_REQUEST['premium']);
$terrarium = mysqli_real_escape_string($db, $_REQUEST['terrarium']);

$end_date = mysqli_real_escape_string($db, $_REQUEST['end_date']);

 
// Attempt insert query execution
$sql = "UPDATE users SET usr_name='$first_name', usr_last_name='$last_name', usr_email='$email', usr_trm_id='$terrarium', usr_premium = (CASE WHEN '$premium'='on' THEN 1 ELSE 0 END) where usr_id='$usr_id'";
mysqli_query($db, $sql);

$sql = "UPDATE premium SET prm_end_date='$end_date' where prm_usr_id='$usr_id' and prm_archive='0'";
mysqli_query($db, $sql);


header("Location: account.php?id=$usr_id");
exit();
?>