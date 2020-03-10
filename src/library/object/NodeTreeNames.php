<?php


class NodeTreeNames
{
    /**
     * @var integer Identity column name in the table. This column should be foreign key.
     */
    public $idNode = 'idNode';
    /**
     * @var string Identity column name in the table.
     */
    public $language = 'language';
    /**
     * @var string Identity column name in the table.
     */
    public $nodeName = 'nodeName';

    /**
     * @return int
     */
    public function getIdNode(): int
    {
        return $this->idNode;
    }

    /**
     * @param int $idNode
     */
    public function setIdNode(int $idNode): void
    {
        $this->idNode = $idNode;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    /**
     * @param string $nodeName
     */
    public function setNodeName(string $nodeName): void
    {
        $this->nodeName = $nodeName;
    }

}