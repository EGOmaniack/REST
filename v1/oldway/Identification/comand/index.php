<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../../classes/index.php';

$data = json_decode($_POST['json']);


echo '{"post":' . json_encode($data) . ',"get":' . json_encode($_GET) . '}';//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);