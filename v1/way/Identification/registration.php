<?php
session_start();
header("Access-Control-Allow-Origin: *");
echo json_encode($_POST);//, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);