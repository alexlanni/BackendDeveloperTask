<?php


class Data
{
    private $connection;

    /**
     * Data constructor.
     *
     * @param $configdata Set di parametri di configurazione. Attesi: host, dbname, user, password
     * @throws Exception
     */
    public function __construct($configdata)
    {
        $config = require __DIR__ . '/../common/config.php';
        // TODO: verifica presenza chiavi di configurazione
        if (!isset($configdata['host'])) {
            throw new Exception('Impossibile trovare la chiave HOST nella configurazione del DB');
        }
        if (!isset($configdata['username'])) {
            throw new Exception('Impossibile trovare la chiave USERNAME nella configurazione del DB');
        }
        if (!isset($configdata['password'])) {
            throw new Exception('Impossibile trovare la chiave PASSWORD nella configurazione del DB');
        }
        if (!isset($configdata['dbName'])) {
            throw new Exception('Impossibile trovare la chiave DBNAME nella configurazione del DB');
        }
        // Setto l'obj di connessione Mysqli
        //$this->connection = ---;
        $this->connection = new mysqli(
            $config['db']['host'],
            $config['db']['username'],
            $config['db']['password'],
            $config['db']['dbname']
        );

        if ($this->connection->connect_error) {
            die(
                'Errore di connessione (' . $this->connection->connect_errno . ') '
                . $this->connection->connect_error
            );
        } else {
            echo 'Connesso. ' . $this->connection->host_info . "\n";
        }

        return $this->connection;
    }

    /**
     * Ottiene un Array di NodeTree
     * @return User []
     */
    public function getAll()
    {
        $sql = 'select * from users';
        return $sql;
    }

}