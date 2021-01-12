<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$spc_id = $_GET["id"];
// Escape user inputs for security
$name = mysqli_real_escape_string($db, $_REQUEST['name']);
$mintmp = mysqli_real_escape_string($db, $_REQUEST['mintmp']);
$maxtmp = mysqli_real_escape_string($db, $_REQUEST['maxtmp']);
$minph = mysqli_real_escape_string($db, $_REQUEST['minph']);
$maxph = mysqli_real_escape_string($db, $_REQUEST['maxph']);
$minhmd = mysqli_real_escape_string($db, $_REQUEST['minhmd']);
$maxhmd = mysqli_real_escape_string($db, $_REQUEST['maxhmd']);
 
// Attempt insert query execution
$sql = "UPDATE species SET spc_name='$name', spc_min_tmp='$mintmp', spc_max_tmp='$maxtmp', spc_min_ph='$minph', spc_max_ph='$maxph', spc_min_hmd='$minhmd', spc_max_hmd='$maxhmd' where spc_id='$spc_id'";
mysqli_query($db, $sql);
header("Location: species.php?id=$spc_id");
exit();
?>