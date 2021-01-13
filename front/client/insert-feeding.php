<?php
include("../config.php");
session_start();

if (!isset($_SESSION['username']) or (strcmp($_SESSION['username'], 'admin') == 0))
{
    header("location: ../login.php");
    die();
}

$usr_id = $_SESSION['id'];

// Escape user inputs for security
$name = $_REQUEST['name'];
$next = $_REQUEST['next'];
$food = $_REQUEST['food'];

// Attempt update query execution
//$sql = "UPDATE feeding SET fdn_next='$next' WHERE fdn_usr_id='$usr_id'";
$sql = "UPDATE feeding SET fdn_name='$name', fdn_next='$next', fdn_food='$food' WHERE fdn_usr_id='$usr_id'";
mysqli_query($db, $sql);
header("Location: feeding.php");
exit();
?>
