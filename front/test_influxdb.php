<?php
require __DIR__ . '/vendor/autoload.php';

$dbname = "metrics_test";

$client = new \InfluxDB\Client('127.0.0.1', 8086, '', '');
$database = $client->selectDB($dbname);
// executing a query will yield a resultset object
//$result = $database->query('select * from temperature LIMIT 5');

// get the points from the resultset yields an array
//$points = $result->getPoints();
var_dump($database->query('select * from temperature LIMIT 5;'));
?>
