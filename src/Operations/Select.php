<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Connect;
use Aidsoul\Pdo\Db;
use Aidsoul\Pdo\Conditions\Join;

/**
 * Class for constructing a select data request 
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Select extends Connect implements SelectInterface
{
    /**
     * 
     */
    use WhereTrait;

    /**
     * @var array
     */
    private array $query = [];

    /**
     * Temporary data storage
     * 
     * @var array
     */
    private array $trush;

    /**
     * @var object
     */
    private object $reply;

    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param array $columns
     */
    public function __construct(Db $dbh, array $columns = ['*'])
    {
        parent::__construct($dbh);
        $this->query['columns'] = $columns;
    }

    /**
     * @param string $table
     * @return Select
     */
    public function from(string $table = ''): Select
    {
        $this->query['table'] = $table;

        return $this;
    }

    /**
     * @param string $joinType
     * @param string $rightTable
     * @return void
     */
    private function patternJoin(string $joinType, string $rightTable)
    {
        $this->trush['type'] = $joinType;
        $this->trush['rightTable'] = $rightTable;
    }

    /**
     * @param string $rightTable
     * @return Select
     */
    public function join(string $rightTable = ''): Select
    {
        $this->patternJoin('join', $rightTable);

        return $this;
    }

    /**
     * @param string $rightTable
     * @return Select
     */
    public function leftJoin(string $rightTable = ''): Select
    {
        $this->patternJoin('left', $rightTable);

        return $this;
    }

    /**
     * @param string $rightTable
     * @return Select
     */
    public function rightJoin(string $rightTable = ''): Select
    {
        $this->patternJoin('left', $rightTable);

        return $this;
    }

    /**
     * @param string $leftColumn
     * @param string $rightColumn
     * @return Select
     */
    public function on(string $leftColumn = '', string $rightColumn = ''): Select
    {
        $join = new Join(
            $this->query['table'],
            $this->trush['rightTable'],
            $leftColumn,
            $rightColumn
        );
        $joinType = $this->trush['type'];
        $join->$joinType();
        $this->query['join'][] = $join->get();

        return $this;
    }

    /**
     * @param integer $limit
     * @return Select
     */
    public function limit(int $limit = 0): Select
    {
        $this->query['limit'][] = "LIMIT {$limit}";

        return $this;
    }

    /**
     * @param integer $limit
     * @return Select
     */
    public function offset(int $offset = 0): Select
    {
        $this->query['limit'][] = "OFFSET {$offset}";

        return $this;
    }

    /**
     * @param array $columns
     * @return Select
     */
    public function orderBy(array $columns = ['id' => 'ASC']): Select
    {
        $this->query['orderBy'][] = "ORDER BY";
        foreach ($columns as $k => $v) {
            if ($v == $columns[array_key_last($columns)]) {
                $this->query['orderBy'][] = "{$k} {$v}";
            } else {
                $this->query['orderBy'][] = "{$k} {$v},";
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    private function queryRender(): string
    {
        if (count($this->query['columns']) > 1) {
            $columns = implode(', ', $this->query['columns']);
        } else {
            $columns = $this->query['columns'][0];
        }

        $sql = "SELECT {$columns} FROM {$this->query['table']} ";
        $sql .= implode(' ', $this->query['join'] ?? []) . ' ';
        $sql .= implode(' ', $this->query['where'] ?? []) . ' ';
        $sql .= implode(' ', $this->query['orderBy'] ?? []) . ' ';
        $sql .= implode(' ', $this->query['limit'] ?? []);

        return $sql;
    }

    /**
     * @return Select
     */
    public function execute(): Select
    {
        try {
            $this->reply = parent::executeQuery($this->queryRender(), $this->query['params'] ?? []);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $this;
    }

    /**
     * @return boolean|array
     */
    public function fetch(): bool|array
    {
        return $this->reply->fetch();
    }

    /**
     * @return boolean|array
     */
    public function fetchAll(): bool|array
    {
        return $this->reply->fetchAll();
    }
}
