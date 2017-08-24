<?php

include_once('../../restapi.php');

$rest = new RestAPI("cardsv1");
$rest->makeAnsver();
$rest->giveAnsver();

?>