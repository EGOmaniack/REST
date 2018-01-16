<?php
/**
 * SubFlow
 */

http_response_code (200);


$sessionWork = new SessionWork();

if($sessionWork->hasSubFlowTask()) {
    $form = $sessionWork->getSubFlowTask()->getToEditForm($sessionWork->getSubFlowTask()->toEditForm->currentStep);
    $flowForFront= new Flow($sessionWork->getCurrentWorkflow()->getFlowName(), "RubberSteps");

    $Answer['flow'] = $flowForFront;
    $Answer['initData'] = $form;
//    $Answer['sess2'] = $_SESSION;

    echo json_encode($Answer, JSON_UNESCAPED_UNICODE );
} else {
    // не понятно как мы тут оказались. Если субтаска нет то и попадать на этот файл не должны
    $sessionWork->rollBack();
}

