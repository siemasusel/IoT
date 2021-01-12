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
$next = $_REQUEST['next'];
//$next = mysqli_real_escape_string($db, $_REQUEST['next']);

// Attempt insert query execution
$sql = "UPDATE cleaning SET cln_next='$next' WHERE cln_usr_id='$usr_id'";
mysqli_query($db, $sql);
header("Location: add-cleaning.php");
exit();
?>
