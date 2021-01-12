<?php
include("../config.php");
session_start();

$ctr_id = $_GET["id"];
// Escape user inputs for security
$mintmp = mysqli_real_escape_string($db, $_REQUEST['mintmp']);
$maxtmp = mysqli_real_escape_string($db, $_REQUEST['maxtmp']);
$minph = mysqli_real_escape_string($db, $_REQUEST['minph']);
$maxph = mysqli_real_escape_string($db, $_REQUEST['maxph']);
$minhmd = mysqli_real_escape_string($db, $_REQUEST['minhmd']);
$maxhmd = mysqli_real_escape_string($db, $_REQUEST['maxhmd']);
 
// Attempt insert query execution
$sql = "UPDATE control SET ctr_id='$ctr_id', ctr_min_tmp='$mintmp', ctr_max_tmp='$maxtmp', ctr_min_ph='$minph', ctr_max_ph='$maxph', ctr_min_hmd='$minhmd', ctr_max_hmd='$maxhmd' where ctr_id='$ctr_id'";
mysqli_query($db, $sql);
header("Location: control.php?id=$ctr_id");
exit();
?>