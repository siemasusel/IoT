<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<?php

$hostname = "localhost";
$username = "root";
$password = "admin342";
$db = "smartarrium";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>

<table border="1" align="center">
<tr>
  <td>Reviewer Name</td>
  <td>Stars</td>
</tr>

<?php

$query = mysqli_query($dbconnect, "SELECT * FROM users")
   or die (mysqli_error($dbconnect));

/*while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['usr_id']}</td>
    <td>{$row['usr_admin']}</td>
   </tr>\n";

}*/

?>
</table>
</body>
</html>