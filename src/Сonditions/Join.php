<?php

namespace Aidsoul\Pdo\Сonditions;

/**
 * Class for constructing a join 
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Join implements JoinInterface
{
    /**
     * @var string
     */
    private string $sql;

    /**
     * @param string $leftTable
     * @param string $rightTable
     * @param string $leftColumn
     * @param string $rightColumn
     */
    public function __construct(
        private string $leftTable = '',
        private string $rightTable = '',
        private string $leftColumn = '',
        private string $rightColumn = ''

    ) {
    }

    /**
     * @return void
     */
    private function on(): void
    {
        $this->sql .= ' ' . $this->rightTable . ' ';
        $this->sql .= 'ON ';
        $this->sql .= "{$this->leftTable}.{$this->leftColumn} ";
        $this->sql .= '= ';
        $this->sql .= "{$this->rightTable}.{$this->rightColumn}";
    }

    /**
     * @return void
     */
    public function join(): void
    {
        $this->sql = "JOIN";
        $this->on();
    }

    /**
     * @return void
     */
    public function left(): void
    {
        $this->sql = 'LEFT JOIN';
        $this->on();
    }

    /**
     * @return void
     */
    public function right(): void
    {
        $this->sql = 'RIGHT JOIN';
        $this->on();
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->sql;
    }
}
