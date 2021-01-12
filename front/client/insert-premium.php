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

//$months = mysqli_real_escape_string($db, $_REQUEST['months']);

$end_date = strtotime(date('Y-m-d', strtotime(date($start_date))) . " +3 month");
//$end_date = DATE_ADD(date_create('2020-01-01'), INTERVAL 2 MONTH);

$start_date = mysqli_real_escape_string($db, $start_date);
$months = mysqli_real_escape_string($db, $months);
//$end_date = mysqli_real_escape_string($db, $end_date);


$sql = "INSERT INTO premium (prm_usr_id, prm_start_date, prm_months, prm_end_date) VALUES ('$usr_id', '$start_date', $months, $end_date)";
//sql = "INSERT INTO premium (prm_start_date, prm_months, prm_end_date) VALUES ($_REQUEST['start_date'], $_REQUEST['months'])";
mysqli_query($db, $sql);
header("Location: premium.php"); 
exit();

?>