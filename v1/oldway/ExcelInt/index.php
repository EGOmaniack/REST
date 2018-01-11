<?php
session_start();
include '../../../classes/index.php';

header("Access-Control-Allow-Origin: *");
http_response_code (200);
$flow = new Flow("SimpleExcelInt", "MergeCalc");
$cards = new Cards(new Settings());
$initData = $cards -> getFullInfo("ExcelInt");

$Answer['flow'] = $flow;// $initData);
$Answer['initData'] = $initData;

echo json_encode($Answer, JSON_UNESCAPED_UNICODE );