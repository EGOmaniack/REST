<?php

if (!defined('MY_CLASSES_ROOT')) {
    define('MY_CLASSES_ROOT', str_replace("\\", "/", dirname(__FILE__) . '/') );

    include(MY_CLASSES_ROOT . 'cards/index.php');
    include(MY_CLASSES_ROOT . 'settings.php');
    include(MY_CLASSES_ROOT . 'way/index.php');
    include(MY_CLASSES_ROOT . 'DB/index.php');
    include(MY_CLASSES_ROOT . 'SessionWork/index.php');
}