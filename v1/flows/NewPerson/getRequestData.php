<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 11:14
 */
http_response_code(200);

$sessionWork->pushWorkflowState($flow);
$form = new Form(2, 'Регистрация',
    'Заполните поля отмеченные *', 'reg', 'registration');
$form->addField(new RubberField('name'));
$form->addField(new RubberField('sName'));
$form->addField(new RubberField('patronymic'));
$form->addField(new RubberField('nickName', '', true), 2);
$form->addField(new RubberField('pass', '', true, 'pass'), 2);
$form->addField(new RubberField('pass1', '', true, 'pass'), 2);

$subFlTask = new SubflowTask($form);
$sessionWork->newSubFlowTask($subFlTask);

$sessionWork->startSubFlow(new Flow("RubberFieldsFlow"), $flow);