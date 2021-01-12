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
$mintmp = mysqli_real_escape_string($db, $_REQUEST['mintmp']);
$maxtmp = mysqli_real_escape_string($db, $_REQUEST['maxtmp']);
$minph = mysqli_real_escape_string($db, $_REQUEST['minph']);
$maxph = mysqli_real_escape_string($db, $_REQUEST['maxph']);
$minhmd = mysqli_real_escape_string($db, $_REQUEST['minhmd']);
$maxhmd = mysqli_real_escape_string($db, $_REQUEST['maxhmd']);
 
//Send temperature to device
$tmp = $_REQUEST['mintmp']+$_REQUEST['maxtmp']/2;

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://localhost:9944/temperature");
curl_setopt($ch, CURLOPT_POST, true);
$data = array(
'tempValue' => strval($tmp)
);
$data_string = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

//Send humidity to device
$humid = $_REQUEST['minhmd']+$_REQUEST['maxhmd']/2;

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://localhost:9944/humidity");
curl_setopt($ch, CURLOPT_POST, true);
$data = array(
'humidityValue' => strval($humid)
);
$data_string = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

// Attempt insert query execution
$sql = "INSERT INTO control (ctr_usr_id, ctr_min_tmp, ctr_max_tmp, ctr_min_ph, ctr_max_ph, ctr_min_hmd, ctr_max_hmd) VALUES ('$usr_id', '$mintmp', '$maxtmp', '$minph', '$maxph', '$minhmd', '$maxhmd')";
//$sql = "UPDATE control SET ctr_id='$ctr_id', ctr_min_tmp='$mintmp', ctr_max_tmp='$maxtmp', ctr_min_ph='$minph', ctr_max_ph='$maxph', ctr_min_hmd='$minhmd', ctr_max_hmd='$maxhmd' where ctr_id='$ctr_id'";
mysqli_query($db, $sql);
header("Location: control.php");
exit();
?>
