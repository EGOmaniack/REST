<?php

$sessionWork = new SessionWork();

// TODO: Остановился тут. С SubFlow пришли данные. Обноили их в toEditForm. и откатились сюда.
// Если данные пришли и мы initializer то пора отправить их в БД и идти далтше или rollBack()
//if($sessionWork->getSubflowInitializerName() == 'NewPerson') {
    //это если пришли сюда первый раз
    http_response_code(200);

    $flow = new Flow("NewPerson", "Registration");
    $sessionWork->pushWorkflowState($flow);

//        var_dump($sessionWork);exit;
    $form = new Form(1, 'Регистрация',
        'Заполните поля отмеченные *', 'Зарегистрирроваться', 'registration');
    $form->addField(new RubberField('name', 'Имя'));
    $form->addField(new RubberField('sName', 'Фамилия'));
    $form->addField(new RubberField('patronymic', 'Отчество'));
    $form->addField(new RubberField('nickname', 'Придумайте никнэйм', '', true));
    $form->addField(new RubberField('pass', 'Пароль', '', true, 'pass'));
    $form->addField(new RubberField('pass1', 'Повторите пароль', '', true, 'pass'));

    $subFlTask = new SubflowTask($form);
    $sessionWork->newSubFlowTask($subFlTask);

    $sessionWork->startSubFlow(new Flow("RubberFieldsFlow"), $flow);
//        $initData = $form;

//        $Answer['flow'] = $flow;// $initData);
//        $Answer['initData'] = $initData;

//        echo json_encode($Answer, JSON_UNESCAPED_UNICODE);
//}