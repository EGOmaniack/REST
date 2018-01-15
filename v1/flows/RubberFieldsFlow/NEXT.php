<?php
/**
 * SubFlow
 */
//echo 111;
http_response_code (200);

$sessionWork = new SessionWork();

//запоминаем что ввел пользователь на предыдущем шаге
$data = json_decode($_POST['json']);


$sessionWork->getSubFlowTask()->update($data);
bool: $havMoreSteps = $sessionWork->getSubFlowTask()->addStep();

if($sessionWork->hasSubFlowTask() && $havMoreSteps) {
    $form = $sessionWork->getSubFlowTask()->getToEditForm($sessionWork->getSubFlowTask()->toEditForm->currentStep);
    $flowForFront= new Flow($sessionWork->getCurrentWorkflow()->getFlowName(), "RubberSteps");

    $Answer['flow'] = $flowForFront;
    $Answer['initData'] = $form;

    echo json_encode($Answer, JSON_UNESCAPED_UNICODE );
} else {
    $sessionWork->rollBack();
}

