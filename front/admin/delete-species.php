<?php 
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$spc_id = $_GET["id"];
if (isset($spc_id)) {
$deletes = $spc_id;
} else {
$deletes = implode("','", $_POST['delete']);
}
$sql = "delete from species where spc_id in ('$deletes')";
$result = mysqli_query($db, $sql);
header("Location: list-species.php");
exit();
?>
