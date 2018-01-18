<?php

$sessionWork = new SessionWork();
//ini_set('xdebug.var_display_max_depth', 12);
//ini_set('xdebug.var_display_max_children', 256);
//ini_set('xdebug.var_display_max_data', 1024);

$flow = new Flow("NewPerson", "Registration");

if($sessionWork->getSubFlowTargetName() == $flow->getFlowName()
    && $sessionWork->isSubFlowTaskDone())
{
    // Поля заполнены, регистрируем пользователя
    include 'registrate.php';
} else {
    //это если пришли сюда первый раз
    include 'getRequestData.php';
}