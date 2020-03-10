<?php

/** api rest*/

/*$database = require_once __DIR__ . '/../public/common/database.php';*/
include_once __DIR__ . '/../public/object/User.php';
include_once __DIR__ . '/../public/sql/Data.php';
$config = include_once __DIR__ . '/../public/common/config.php';

/*spl_autoload_register(
    function ($class_name) {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        include __DIR__ . '../library/' . $class_name . '.php';
    }
);*/

header('Access-Control-Allow-Origin: *');
header('Content-Type: application / json; charset = UTF-8');


$conn = new Data();

$testConn = $conn->__construct($config['db']);
echo $testConn;