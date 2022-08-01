<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Db;

/**
 * Select operator interface
 */
interface SelectInterface extends OperationInterface, WhereInterface
{
    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param array $columns
     */
    public function __construct(Db $dbh, array $columns = ['*']);

    /**
     * @return boolean|array
     */
    public function fetch(): bool|array;

    /**
     * @return boolean|array
     */
    public function fetchAll(): bool|array;

    /**
     * @param string $table
     * @return Select
     */
    public function from(string $table = ''): Select;

    /**
     * @param string $rightTable
     * @return Select
     */
    public function join(string $rightTable = ''): Select;

    /**
     * @param string $rightTable
     * @return Select
     */
    public function leftJoin(string $rightTable = ''): Select;

    /**
     * @param integer $limit
     * @return Select
     */
    public function limit(int $limit = 0): Select;

    /**
     * @param string $leftColumn
     * @param string $rightColumn
     * @return Select
     */
    public function on(string $leftColumn = '', string $rightColumn = ''): Select;

    /**
     * @param array $columns
     * @return Select
     */
    public function orderBy(array $columns = ['id' => 'ASC']): Select;

    /**
     * @param string $rightTable
     * @return Select
     */
    public function rightJoin(string $rightTable = ''): Select;
}
