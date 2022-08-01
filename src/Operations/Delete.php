<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Connect;
use Aidsoul\Pdo\Db;

/**
 * Class for constructing a deletion data request 
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Delete extends Connect implements DeleteInterface
{

    use WhereTrait, ExecuteTrait;

    /**
     * Stores data to form the query
     *
     * @var array
     */
    private array $query = [];

    /**
     * @param \Aidsoul\Pdo\Db $dbh
     */
    public function __construct(Db $dbh)
    {
        parent::__construct($dbh);
    }

    /**
     * Delete from table
     *
     * @param string $table
     * @return Delete
     */
    public function from(string $table = ''): Delete
    {
        $this->query['table'] = $table;

        return $this;
    }

    /**
     * @return string
     */
    private function queryRender(): string
    {
        $where = implode(' ', $this->query['where'] ?? []);
        $sql = "DELETE FROM {$this->query['table']} {$where}";

        return $sql;
    }
}
