<?php

http_response_code (200);

$flow= new Flow("StartPage", "Cards");

$sessionWork = new SessionWork();
$sessionWork->pushWorkflowState($flow);

$cards = new Cards(new Settings());
$initData['packs'] = $cards -> getCards();

$Answer['flow'] = $flow;// $initData);
$Answer['initData'] = $initData;
$Answer['sess0'] = $_SESSION;

echo json_encode($Answer, JSON_UNESCAPED_UNICODE );

//echo '{ "accessLvl": "' . $accesLvl . '", "get":' . json_encode($_GET) . '}';