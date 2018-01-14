<?php
session_start();
// session_destroy();
if (!defined('MY_CLASSES_ROOT')) {
    define('MY_CLASSES_ROOT', str_replace("\\", "/", dirname(__FILE__) . '/') );

    include(MY_CLASSES_ROOT . 'cards/index.php');
    include(MY_CLASSES_ROOT . 'settings.php');
    include(MY_CLASSES_ROOT . 'flow/index.php');
    include(MY_CLASSES_ROOT . 'DB/index.php');
    include(MY_CLASSES_ROOT . 'SessionWork/index.php');
    include(MY_CLASSES_ROOT . 'SessionWork/User.php');
    include(MY_CLASSES_ROOT . 'Form/Form.php');
//    include(MY_CLASSES_ROOT . 'flows/startPage.php');
}