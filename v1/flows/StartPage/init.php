<?php

header("Access-Control-Allow-Origin: *");
http_response_code (200);

$flow= new Flow("StartPage", "Cards");
$cards = new Cards(new Settings());
$initData['packs'] = $cards -> getCards();

$Answer['flow'] = $flow;// $initData);
$Answer['initData'] = $initData;

echo json_encode($Answer, JSON_UNESCAPED_UNICODE );

//echo '{ "accessLvl": "' . $accesLvl . '", "get":' . json_encode($_GET) . '}';