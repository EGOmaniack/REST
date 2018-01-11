<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../classes/index.php';

$sessionWork = new SessionWork();
/*
 * Скрипт принимает запросы на смену Flow и в зависимости от Уровня доступа выдает тот или иной flow и state + initData
*/
if(isset($_GET['flowName'])) {
    $userFlowName = $_GET['flowName'];
    $accesLvl = $sessionWork->getAccessLvl();

    $flowsInfo = getFlowsInfo();

    $validFlowName = false;
    foreach ($flowsInfo as $flow) {
        if(in_array($userFlowName, $flow)) {
            $validFlowName = true;
            break;
        }
    }
    if($validFlowName) {
        include '../flows/' . $userFlowName . '/init.php';
    } else {
        include '../flows/StartPage/init.php';
    }


} else {
    include '../flows/StartPage/init.php';
}

//echo '{"get":' . json_encode($_GET) . '}';//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);