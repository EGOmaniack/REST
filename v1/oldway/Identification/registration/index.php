<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../../classes/index.php';

$data = json_decode($_POST['json']);

$sqlstr = "select * from newUserRequest( '"
    . $data->name . "', '"
    . $data->sName . "', '"
    . $data->patronymic . "', '"
    . $data->login . "', '"
    . hash('sha256', $data->pass) . "', '"
    . $_SERVER['REMOTE_ADDR'] . "');";

do {
    $repeat = false;
    try {
        pg::query("begin");

        $result = pg::query($sqlstr);

        pg::query("commit");

        echo $result[0]['newuserrequest'];
    }
    catch (DependencyException $e) {
        pg::query("rollback");
        $repeat = true;
    }
    catch (PostgresException $e) {
         $mess; //".*"
         preg_match_all('/{"code":\s[0-9]{1,1000},\s*"message":\s*(".*")\s*}/', $e->getMessage(), $mess);
         echo $mess[0][0];
    }
} while ($repeat);

//echo json_encode($_GET);//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);