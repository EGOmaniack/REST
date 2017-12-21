<?php
if(isset($_GET['flowName'])){

    include_once('../../index.php');
    
    $rest = new RestAPI("getFullInfov1");
    $rest->makeAnsver($_GET['flowName']);
    $rest->giveAnsver();
} else {
    // header("Access-Control-Allow-Origin: *");
    header("HTTP/1.0 406 Not Acceptable");
    die('Параметр flowName не задан');
}
?>