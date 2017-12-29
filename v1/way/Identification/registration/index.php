<?php
session_start();
header("Access-Control-Allow-Origin: *");

$data = json_decode($_POST['json']);

$dbconn = pg_connect("host=localhost port=5432 dbname=REST user=postgres password=Rgrur4frg56eq16")
or die('Could not connect: ' . pg_last_error());

$sqlstr = "select * from newUserRequest( '"
    . $data->name . "', '"
    . $data->sName . "', '"
    . $data->login . "', '"
    . hash('sha256', $data->pass) . "', '"
    . $_SERVER['REMOTE_ADDR'] . "');";

$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

pg_free_result($result);
pg_close($dbconn);


//echo json_encode($data);//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);