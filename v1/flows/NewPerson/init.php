<?php
switch ($accesLvl) {
    default:
        http_response_code (200);
        $flow = new Flow("NewPerson", "Registration");

        $form = new Form(null, 'Регистрация',
            'Заполните поля отмеченные *', 'Зарегистрирроваться', '');
        $form->addField(new RubberField('name', 'Имя'));
        $form->addField(new RubberField('sName', 'Фамилия'));
        $form->addField(new RubberField('patronymic', 'Отчество'));
        $form->addField(new RubberField('nickname', 'никнэйм'));
        $form->addField(new RubberField('pass1', 'Пароль'));
        $form->addField(new RubberField('pass2', 'Повторите пароль'));

        $initData = $form;

        $Answer['flow'] = $flow;// $initData);
        $Answer['initData'] = $initData;

        echo json_encode($Answer, JSON_UNESCAPED_UNICODE);
}