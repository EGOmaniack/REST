<?php
switch ($accesLvl) {
    default:
        http_response_code (200);
        $flow = new Flow("SimpleSpecParser", "GetProjectInfo");
        $cards = new Cards(new Settings());
        $initData = $cards->getFullInfo("SimpleSpecParser");

        $Answer['flow'] = $flow;// $initData);
        $Answer['initData'] = $initData;

        echo json_encode($Answer, JSON_UNESCAPED_UNICODE);
}