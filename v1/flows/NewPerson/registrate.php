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

$sqlstr = "select * from newUserRequest( '"
    . $info['name'] . "', '"
    . $info['sName'] . "', '"
    . $info['patronymic'] . "', '"
    . $info['nickName'] . "', '"
    . hash('sha256', $info['pass']) . "', '"
    . $_SERVER['REMOTE_ADDR'] . "');";

$answer = sqlFunction($sqlstr, 'newuserrequest');

if($answer == 'accepted') {
    $sessionWork->setUserRegSended();
    $sessionWork->freeSubflow();
    $sessionWork->rollBack();
}