<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 11:14
 */
http_response_code(200);

$sessionWork->pushWorkflowState($flow);
$form = new Form(1, 'Войти в систему',
    'Заполните поля отмеченные *', 'login', 'none');
$form->addField(new RubberField('userlogin', '', true));
$form->addField(new RubberField('loginpass', '', true, 'pass'));

$subFlTask = new SubflowTask($form);
$sessionWork->newSubFlowTask($subFlTask);

$sessionWork->startSubFlow(new Flow("RubberFieldsFlow"), $flow);