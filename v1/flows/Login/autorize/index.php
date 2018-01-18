<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 017 17.01.18
 * Time: 15:30
 */
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
include '../../../../classes/index.php';

$sessionWork = new SessionWork();

$data = json_decode($_POST['json'], true);

$userLogin = $data['userlogin'];
$userPass = $data['loginpass'];
$sqlstr = "select * from LoginUser( '"
    . $userLogin . "', '"
    . hash('sha256', $userPass) . "');";
//var_dump($sqlstr); exit;
$answer = sqlFunction($sqlstr);
//var_dump($answer);exit;
if($answer['status'] == 'OK') {

    $newUser = new User();
    $newUser->setAutorized(true);
    $newUser->setToken($answer['answer']['newusertoken']);
    $newUser->setUserId($answer['answer']['newuser_id']);
    $newUser->getinfo();
    $sessionWork->updateUser('fullUpdate', $newUser);

    $sessionWork->setUserRegSended();
    $sessionWork->freeSubflow();
//    $sessionWork->rollBack();

    $Answer['user'] = $sessionWork->getUser();
    $Answer['token'] = $sessionWork->getUser()->getToken();
//    var_dump($_POST);
    echo json_encode($Answer, JSON_UNESCAPED_UNICODE);

} else if($answer['status'] == 'ERROR'){
    if($answer['answer']['code'] == 202) {
        echo $answer['answer'];
//        $sessionWork->freeSubflow();
//        getLoginData($sessionWork, $flow, $answer['answer']['message']);
//        $flow = new Flow("Login", "Login");
//        $Answer['flow']
    }
//    var_dump($answer);exit;
}
//echo 111;