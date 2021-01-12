<php
include("../config.php");

$usr_id = mysqli_real_escape_string($db, $_REQUEST['user_id'];
$id = usr_id;
$start_date = msqli_real_escape_string($db, $_REQUEST['start'];
$months = mysqli_real_escape_string($db, $_REQUEST['months']);

$sql = "INSERT INTO premium (prm_id, prm_usr_id, prm_start_date, prm_months, prm_added) VALUES ('$id', '$usr_id', str_to_date('$start_date',"%d %M %Y"), '$months', '1')'
mysqli_query($db, $sql);
header("Location: premium.php");
exit();
?>
