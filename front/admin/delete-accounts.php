<?php 
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }


$usr_id = $_GET["id"];
if (isset($usr_id)) {
$deletes = $usr_id;
} else {
$deletes = implode("','", $_POST['delete']);
}
$sql = "delete from users where usr_id in ('$deletes')";
$result = mysqli_query($db, $sql);
header("Location: list-accounts.php");
exit();
?>
