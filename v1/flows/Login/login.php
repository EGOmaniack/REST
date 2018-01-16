<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 11:16
 */
$form = $sessionWork->getSubFlowTask()->getForm()->getRubberFields();

foreach ($form as $step)
{
    foreach ($step as $field) {
        $info[$field->fieldName] = $field->value;
    }
}
//Валидируем данные
//

$sqlstr = "select * from LoginUser( '"
    . $info['userlogin'] . "', '"
    . hash('sha256', $info['loginpass']) . "');";

$answer = sqlFunction($sqlstr, 'loginuser');
//var_dump($answer);exit;
if($answer['status'] == 'OK') {
    $sessionWork->setUserRegSended();
    $sessionWork->freeSubflow();
    $token['token'] = $answer['answer']['newusertoken'];
    $sessionWork->setDopInfo($token);
    $sessionWork->rollBack();
} else if($answer['status'] == 'ERROR'){
    if($answer['answer']['code'] == 202) {
        $sessionWork->freeSubflow();
        include 'getLoginData.php';
        getLoginData($sessionWork, $flow, $answer['answer']['message']);
    }
//    var_dump($answer);exit;
}