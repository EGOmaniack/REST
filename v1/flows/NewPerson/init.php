<?php
switch ($accesLvl) {
    default:
        http_response_code (200);

        $flow = new Flow("NewPerson", "Registration");

        $sessionWork = new SessionWork();
        $sessionWork->pushWorkflowState($flow);
//        var_dump($sessionWork);exit;
        $form = new Form(null, 'Регистрация',
            'Заполните поля отмеченные *', 'Зарегистрирроваться', 'registration');
        $form->addField(new RubberField('name', 'Имя'));
        $form->addField(new RubberField('sName', 'Фамилия'));
        $form->addField(new RubberField('patronymic', 'Отчество'));
        $form->addField(new RubberField('nickname', 'Придумайте никнэйм', '', true));
        $form->addField(new RubberField('pass', 'Пароль','', true,'pass'));
        $form->addField(new RubberField('pass1', 'Повторите пароль', '', true, 'pass'));

        $initData = $form;

        $Answer['flow'] = $flow;// $initData);
        $Answer['initData'] = $initData;

        echo json_encode($Answer, JSON_UNESCAPED_UNICODE);
}