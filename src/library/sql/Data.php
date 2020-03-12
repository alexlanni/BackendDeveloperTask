<?php

class Data
{

    private $connection;

    /**
     * Data constructor.
     *
     * @param array $configdata Set di parametri di configurazione. Attesi: host, dbname, user, password
     * @throws Exception
     */
    public function __construct($configdata = [])
    {
        $config = require __DIR__ . '/../common/config.php';
        /**Verifica la presenza di chiavi di configurazione: */
        if (!isset($configdata['host'])) {
            throw new Exception('Impossibile trovare la chiave HOST nella configurazione del DB');
        }
        if (!isset($configdata['username'])) {
            throw new Exception('Impossibile trovare la chiave USERNAME nella configurazione del DB');
        }
        if (!isset($configdata['password'])) {
            throw new Exception('Impossibile trovare la chiave PASSWORD nella configurazione del DB');
        }
        if (!isset($configdata['dbname'])) {
            throw new Exception('Impossibile trovare la chiave DBNAME nella configurazione del DB');
        }
        try {
            $this->connection = new mysqli($config['db']['host'],
                $config['db']['username'],
                $config['db']['password'],
                $config['db']['dbname']);
            if ($this->connection->connect_error) {
                die(
                    'Errore di connessione (' . $this->connection->connect_errno . ') '
                    . $this->connection->connect_error
                );
            } else {
                /*echo 'Connesso. ' . $this->connection->host_info . "\n";*/
                return $this->connection;
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @return NodeTree[]
     */
    private function getAllNodeTree()
    {
        return [
            'selectAll' => 'select * from node_tree inner join node_tree_names on node_tree.idNode = node_tree_names.idNode',
            'filter' => 'select * from node_tree inner join node_tree_names on node_tree.idNode = node_tree_names.idNode where node_tree.idNode = ?'
        ];
    }

    private function includeNodeTree()
    {
        include_once __DIR__ . '/../object/NodeTree.php';
        $nodeTree = new NodeTree();
        return [
            $idNode = $nodeTree->idNode,
            $level = $nodeTree->level,
            $iLeft = $nodeTree->iLeft,
            $iRight = $nodeTree->iRight
        ];
    }

    private function includeNodeTreeNames()
    {
        include_once __DIR__ . '/../object/NodeTreeNames.php';
        $nodeTreeNames = new NodeTreeNames();
        return [
            $idNodeF = $nodeTreeNames->idNode,
            $language = $nodeTreeNames->language,
            $nodeName = $nodeTreeNames->nodeName
        ];
    }

    public function selectAll()
    {
        $SQL = mysqli_query($this->connection, $this->getAllNodeTree()['selectAll']);
        $result = array();
        $idNode = $this->includeNodeTree()[0];
        $level = $this->includeNodeTree()[1];
        $iLeft = $this->includeNodeTree()[2];
        $iRight = $this->includeNodeTree()[3];
        $idNodeF = $this->includeNodeTreeNames()[0];
        $language = $this->includeNodeTreeNames()[1];
        $nodeName = $this->includeNodeTreeNames()[2];
        while ($row = mysqli_fetch_array($SQL)) {
            ARRAY_PUSH($result, array(
                $idNode => $row[$idNode],
                $level => $row[$level],
                $iLeft => $row[$iLeft],
                $iRight => $row[$iRight],
                $idNodeF => $row[$idNodeF],
                $language => $row[$language],
                $nodeName => $row[$nodeName]
            ));
        }
        echo json_encode(array($result));
    }


    public function filterByIdNode()
    {
        $idNode = $this->includeNodeTree()[0];
        if (isset($_POST[$idNode])) {
            $idNode = $_POST[$idNode];
            $SQL = $this->connection->prepare($this->getAllNodeTree()['filter']);
            $SQL->bind_param("i", $idNode);
            $SQL->execute();
            $result = $SQL->get_result();
            $fetchAll = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($fetchAll as $key) {
                if ($key) {
                    echo json_encode(array('RESPONSE' => 'SUCCESS'));
                } else {
                    echo json_encode(array('RESPONSE' => 'FAILED'));
                }
            }
            $SQL->close();
        } else {
            echo 'ERROR NO CALL';
        }
    }

    public function pagination()
    {
        if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }
        $records_per_page = 10;
        $offset = ($pag - 1) * $records_per_page;

        $conn = $this->connection;

        $total_pages_sql = "SELECT COUNT(*) FROM node_tree inner join node_tree_names on node_tree.idNode = node_tree_names.idNode";
        $result = mysqli_query($conn, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $records_per_page);

        $sql = "SELECT * FROM node_tree inner join node_tree_names on node_tree.idNode = node_tree_names.idNode LIMIT $offset, $records_per_page";
        $res_data = mysqli_query($conn, $sql);
        $res = array();
        $idNode = $this->includeNodeTree()[0];
        $level = $this->includeNodeTree()[1];
        $iLeft = $this->includeNodeTree()[2];
        $iRight = $this->includeNodeTree()[3];
        $idNodeF = $this->includeNodeTreeNames()[0];
        $language = $this->includeNodeTreeNames()[1];
        $nodeName = $this->includeNodeTreeNames()[2];
        while ($row = mysqli_fetch_array($res_data)) {
            ARRAY_PUSH($res, array(
                $idNode => $row[$idNode],
                $level => $row[$level],
                $iLeft => $row[$iLeft],
                $iRight => $row[$iRight],
                $idNodeF => $row[$idNodeF],
                $language => $row[$language],
                $nodeName => $row[$nodeName]
            ));
        }
        mysqli_close($conn);
    }

}