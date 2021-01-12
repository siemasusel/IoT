<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$name = mysqli_real_escape_string($db, $_REQUEST['name']);
$mintmp = mysqli_real_escape_string($db, $_REQUEST['mintmp']);
$maxtmp = mysqli_real_escape_string($db, $_REQUEST['maxtmp']);
$minph = mysqli_real_escape_string($db, $_REQUEST['minph']);
$maxph = mysqli_real_escape_string($db, $_REQUEST['maxph']);
$minhmd = mysqli_real_escape_string($db, $_REQUEST['minhmd']);
$maxhmd = mysqli_real_escape_string($db, $_REQUEST['maxhmd']); 

$sql = "INSERT INTO species (spc_name, spc_min_tmp, spc_max_tmp, spc_min_ph, spc_max_ph, spc_min_hmd, spc_max_hmd) VALUES ('$name', '$mintmp', '$maxtmp', '$minph', '$maxph', '$minhmd', '$maxhmd')";
mysqli_query($db, $sql);
header("Location: list-species.php");
exit();
?>