<?php


class NodeTree
{
    /**
     * @var integer Identity column name in the table. This column should be primary key.
     */
    public $idNode = 'idNode';
    /**
     * @var integer Identity column name in the table.
     */
    public $level = 'level';
    /**
     * @var integer Identity column name in the table.
     */
    public $iLeft = 'iLeft';
    /**
     * @var integer Identity column name in the table.
     */
    public $iRight = 'iRight';

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
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getILeft(): int
    {
        return $this->iLeft;
    }

    /**
     * @param int $iLeft
     */
    public function setILeft(int $iLeft): void
    {
        $this->iLeft = $iLeft;
    }

    /**
     * @return int
     */
    public function getIRight(): int
    {
        return $this->iRight;
    }

    /**
     * @param int $iRight
     */
    public function setIRight(int $iRight): void
    {
        $this->iRight = $iRight;
    }

}