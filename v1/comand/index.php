<?php

include '../../classes/index.php';
//header("Access-Control-Allow-Origin: http://localhost:9002");
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

$sessionWork = new SessionWork();
$currentWorkflow = $sessionWork->getCurrentWorkflow();

$data = $_GET;

switch ($data['comand']) {
    case 'EVENT':
        include '../flows/' . $currentWorkflow->getFlowName() . '/' . $data['name'] . ".php";
        break;
    case 'ROLLBACK':
        $sessionWork->rollBack();
        break;
    default:
//        $sessionWork->rollBack();
        echo "comand не задан"; exit;
}