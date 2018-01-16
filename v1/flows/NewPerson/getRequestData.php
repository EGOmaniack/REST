<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 11:14
 */
http_response_code(200);

$sessionWork->pushWorkflowState($flow);
$form = new Form(1, 'Регистрация',
    'Заполните поля отмеченные *', 'reg', 'registration');
$form->addField(new RubberField('name'));
$form->addField(new RubberField('sName'));
$form->addField(new RubberField('patronymic'));
$form->addField(new RubberField('nickName', '', true));
$form->addField(new RubberField('pass', '', true, 'pass'));
$form->addField(new RubberField('pass1', '', true, 'pass'));

$subFlTask = new SubflowTask($form);
$sessionWork->newSubFlowTask($subFlTask);

$sessionWork->startSubFlow(new Flow("RubberFieldsFlow"), $flow);