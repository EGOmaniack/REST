<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 11:14
 * @param $sessionWork
 * @param $flow
 * @param string $message
 */
function getLoginData($sessionWork, $flow, $message = '')
{
    http_response_code(200);
    $sessionWork->pushWorkflowState($flow);
    $form = new Form(array('введите данные для входа'), 'Вход в систему',
        'Введите данные для входа', 'login', 'none', $message);
    $form->addField(new RubberField('userlogin', '', true));
    $form->addField(new RubberField('loginpass', '', true, 'pass'));

    $subFlTask = new SubflowTask($form);
    $sessionWork->newSubFlowTask($subFlTask);

    $sessionWork->startSubFlow(new Flow("RubberFieldsFlow"), $flow);
}