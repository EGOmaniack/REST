<?php
session_start();
include '../../../classes/index.php';

$FloatRequest = null;

if(isset($_GET['flowName']))
    $FloatRequest = $_GET['flowName'];

header("Access-Control-Allow-Origin: *");
http_response_code (200);

if($FloatRequest == 'NewPerson') {
    $way = new Flow("NewPerson", "Registration");
    $initData = null;
} else {
    $way = new Flow("Enter", "Enter");
    $initData = null;
}

$Answer = new GetWayAnswer($way, $initData);
echo json_encode($Answer, JSON_UNESCAPED_UNICODE );