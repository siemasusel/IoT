<?php
include("../config.php");
$prb_id = $_GET["id"];
$text = mysqli_real_escape_string($db, $_REQUEST['text']);
if(strcmp($_POST['edit_problem'], 'ans') == 0){
$sql = "INSERT INTO answers (ans_date, ans_text, ans_admin, ans_prb_id) VALUES (sysdate(), '$text', 0, '$prb_id')";
}
if(strcmp($_POST['edit_problem'], 'cls') == 0){
$sql = "UPDATE problems set prb_status = 'Closed' where prb_id = '$prb_id'";
}
mysqli_query($db, $sql);

header("Location: help-center.php?id=$prb_id");
exit();
?>