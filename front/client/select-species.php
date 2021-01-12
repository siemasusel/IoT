<?php
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$usr_id = $_SESSION["id"];
$spc_id = $_GET["id"];

$end_date = mysqli_real_escape_string($db, $_REQUEST['end_date']);

 
// Attempt insert query execution
$sql = "UPDATE control SET ctr_spc_id='$spc_id' where ctr_usr_id='$usr_id'";
mysqli_query($db, $sql);

header("Location: species.php?id=$spc_id");
exit();
?>