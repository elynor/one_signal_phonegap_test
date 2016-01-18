<?php
include(__DIR__.'/autoload.php');

$baseApi = new BaseApi($_GET);
$action = $baseApi->getAction();
$api = new NotificationApi($_GET);
list($status, $message) = $api->parseInput($action);
$baseApi->renderResponse($status, $message);

?>