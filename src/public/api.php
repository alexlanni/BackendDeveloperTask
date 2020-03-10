<?php

/** api rest*/
include __DIR__ . '/../library/sql/Data.php';
$config = include __DIR__ . '/../library/common/config.php';

/*spl_autoload_register(
    function ($class_name) {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        include __DIR__ . '../library/' . $class_name . '.php';
    }
);*/
/*header('Access-Control-Allow-Origin: *');*/
header('Content-Type: application / json; charset = UTF-8');

$data = new Data();
$query = $data->getAllNodeTree();
if (isset($_GET['idNode']) && isset($_GET['level']) && isset($_GET['iLeft']) && isset($_GET['iRight'])) {
    $idNode = $_GET['idNode'];
    $level = $_GET['level'];
    $iLeft = $_GET['iLeft'];
    $iRight = $_GET['iRight'];
    $SQL = $mysqli->prepare($query);
    $SQL->execute();

    if ($SQL) {
        echo json_encode(array('RESPONSE' => 'SUCCESS'));
    } else {
        echo json_encode(array('RESPONSE' => 'FAILED'));
    }
} else {
    echo 'Ops qualcosa è andato storto';
}
var_dump($query);