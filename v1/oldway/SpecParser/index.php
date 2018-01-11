<?php
session_start();
include '../../../classes/index.php';

header("Access-Control-Allow-Origin: *");
http_response_code (200);
$way = new Flow("SpecParser", "SimpleSpecParser", "GetProjectInfo");
$cards = new Cards(new Settings());
$initData = $cards -> getFullInfo("SpecParcer");

$Answer = new GetWayAnswer($way, $initData);

echo json_encode($Answer, JSON_UNESCAPED_UNICODE );