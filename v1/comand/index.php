<?php

include '../../classes/index.php';
//header("Access-Control-Allow-Origin: http://localhost:9002");
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

$sessionWork = new SessionWork();
$currentFlowSubFlowName = $sessionWork->getFlowSubFlowName();

$data = $_GET;

switch ($data['comand']) {
    case 'EVENT':
        include '../flows/' . $currentFlowSubFlowName . '/' . $data['name'] . ".php";
        break;
    case 'ROLLBACK':
        $sessionWork->rollBack();
        break;
    default:
//        $sessionWork->rollBack();
        echo "comand не задан"; exit;
}