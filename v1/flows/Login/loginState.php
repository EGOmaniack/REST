<?php
http_response_code(200);

$sessionWork->pushWorkflowState($flow);

$Answer['flow'] = $flow;// $initData);
$Answer['initData'] = null;

echo json_encode($Answer, JSON_UNESCAPED_UNICODE);
