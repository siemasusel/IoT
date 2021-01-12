<?php
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$usr_id = $_SESSION["id"];
$spc_id = $_GET["id"];

 
// Attempt insert query execution
$sql = "UPDATE control SET ctr_spc_id='$spc_id' where ctr_usr_id='$usr_id'";
mysqli_query($db, $sql);

header("Location: edit-control.php?id=$spc_id");
exit();
?>