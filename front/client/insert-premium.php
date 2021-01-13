<?php
include("../config.php");
session_start();

if (!isset($_SESSION['username']) or (strcmp($_SESSION['username'], 'admin') == 0))
{
    header("location: ../login.php");
    die();
}

$usr_id = mysqli_real_escape_string($db, $_SESSION['id']);
$start_date = mysqli_real_escape_string($db, $_REQUEST['start_date']);

$start_date = $_REQUEST['start_date'];
$months = $_REQUEST['months'];

$start_date = mysqli_real_escape_string($db, $start_date);
$months = mysqli_real_escape_string($db, $months);

$sql = "INSERT INTO premium (prm_usr_id, prm_start_date, prm_months, prm_end_date) VALUES ('$usr_id', '$start_date', $months, DATE_ADD('$start_date', INTERVAL '$months' MONTH))";

mysqli_query($db, $sql);
header("Location: premium.php"); 
exit();

?>