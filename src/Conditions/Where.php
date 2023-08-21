<?php

namespace Aidsoul\Pdo\Conditions;

/**
 * Class for constructing a where
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Where implements WhereInterface
{
    /**
     * @var string
     */
    private string $sql;

    public function __construct(
        private string $column = '',
        private string $whereType = '=',
    ) {
    }

    /**
     * @return void
     */
    public function where(): void
    {
        $this->sql = 'WHERE';
    }

    /**
     * @return void
     */
    public function and(): void
    {
        $this->sql = 'AND';
    }

    /**
     * @return void
     */
    public function or(): void
    {
        $this->sql = 'OR';
    }

    /**
     * @return string
     */
    public function get(): string
    {
        $this->sql .= " {$this->column} {$this->whereType} ?";
        return $this->sql;
    }
}
