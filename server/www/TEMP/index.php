<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
include('./listener.php');

$collection = ['{"price": 100, "tip": 10, "sum": 110}'];
if (isset($_SESSION['tips'])) {
    $collection = $_SESSION['tips'];
}

$listener = new RequestListener($collection);
$result = $listener->parseRequest();
echo($result);
?>