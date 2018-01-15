<?php

$data = json_decode($_POST['json']);

$sqlstr = "select * from newUserRequest( '"
    . $data->name . "', '"
    . $data->sName . "', '"
    . $data->patronymic . "', '"
    . $data->nickname . "', '"
    . hash('sha256', $data->pass) . "', '"
    . $_SERVER['REMOTE_ADDR'] . "');";

$answer = sqlFunction($sqlstr, 'newuserrequest');

if($answer == 'accepted') {
    $sessionWork->rollBack();
}