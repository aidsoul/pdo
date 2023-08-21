<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Connect;
use Aidsoul\Pdo\Db;

/**
 * Class for constructing a update data request
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Update extends Connect implements UpdateInterface
{
    use WhereTrait;
    use ExecuteTrait;

    /**
     * @var array
     */
    private array $query = [];

    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param string $table
     */
    public function __construct(Db $dbh, string $table = '')
    {
        parent::__construct($dbh);
        $this->query['table'] = $table;
    }

    /**
     * @param array $columns
     * @return Update
     */
    public function set(array $columns = ['id' => 1]): Update
    {
        foreach ($columns as $k => $v) {
            $pattern = "{$k} = ?";
            if ($v == $columns[array_key_last($columns)]) {
                $this->query['columns'][] = $pattern;
            } else {
                $this->query['columns'][] = $pattern . ',';
            }
            $this->query['params'][] = $v;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function queryRender(): string
    {
        $collumns = implode(' ', $this->query['columns']);
        $where = implode(' ', $this->query['where'] ?? []);
        $sql = "UPDATE {$this->query['table']} SET {$collumns} {$where}";

        return $sql;
    }
}
