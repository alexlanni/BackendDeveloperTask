<?php

/** Configuration mydb connect*/

return [
    'db' => [
        'host' => '127.0.0.1',
        'username' => 'gianluca',
        'password' => 'password',
        'dbname' => 'apirest'
    ],
    'msgError' => [
        410 => 'Invalid node id',
        411 => 'Missing mandatory params',
        412 => 'Invalid page number requested',
        413 => 'Invalid page size requested'
    ],
];
