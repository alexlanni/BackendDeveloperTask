<?php

/** api rest*/
include __DIR__ . '/../library/sql/Data.php';
$config = include __DIR__ . '/../library/common/config.php';
/*include __DIR__ . '/../library/object/NodeTree.php';*/
/*spl_autoload_register(
    function ($class_name) {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        include __DIR__ . '../library/' . $class_name . '.php';
    }
);*/
header('Content-Type: application / json; charset = UTF-8');

$data = new Data($config['db']);

json_encode(array($data->selectAll()));
json_encode(array($data->filterByIdNode()));
json_encode(array($data->pagination()));




