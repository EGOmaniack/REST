<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.01.18
 * Time: 16:20
 */

header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
include '../../classes/index.php';

//var_dump($_POST);
$sessionWork = new SessionWork();
$Answer['user'] = $sessionWork->getUser();
echo json_encode($Answer, JSON_UNESCAPED_UNICODE);