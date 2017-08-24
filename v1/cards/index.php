<?php

include_once('../../index.php');

$rest = new RestAPI("cardsv1");
$rest->makeAnsver();
$rest->giveAnsver();