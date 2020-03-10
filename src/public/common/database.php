<?php

/**
 * Descrizione del file
 * @deprecated
 */

/** importo il file config.php contenente la configurazione della connessione al db
 */
$config = require __DIR__ . '/../common/config.php';

/** mediante la libreia mysqli creo la connessione al db e gestisco eventuali errori di connessione*/
// TODO: da spostare in Data.php
$mysqli = new mysqli(
    $config['db']['host'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['dbname']
);

if ($mysqli->connect_error) {
    die(
        'Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error
    );
} else {
    echo 'Connesso. ' . $mysqli->host_info . "\n";
}

return $mysqli;
