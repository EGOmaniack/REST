<?php

//ini_set('display_errors', 0) ;

//header("Access-Control-Allow-Origin: http://localhost:9002");
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

/*
 * Скрипт принимает запросы на смену Flow и в зависимости от Уровня доступа выдает тот или иной flow и state + initData
*/

function changeFlow($newFlowName) {
    if($newFlowName) {
        $flowsInfo = getFlowsInfo();

        $validFlowName = false;
        foreach ($flowsInfo as $flow) {
            if(in_array($newFlowName, $flow)) {
                $validFlowName = true;
                break;
            }
        }
        if($validFlowName) {
            include '../flows/' . $newFlowName . '/init.php';
        } else {
            include '../flows/StartPage/init.php';
        }

    } else {
        include '../flows/StartPage/init.php';
    }
}
if(isset($_GET['flowName'])) {
    $newFlowName = $_GET['flowName'];
    include '../../classes/index.php';
    changeFlow($newFlowName);
}
//echo '{"get":' . json_encode($_GET) . '}';//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);