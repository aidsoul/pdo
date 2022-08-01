<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Connect;
use Aidsoul\Pdo\Db;

/**
 * Class for constructing a insert data request 
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Insert extends Connect implements InsertInterface
{

    use ExecuteTrait;

    /**
     * @var array
     */
    private array $query = [];

    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param array $columns
     */
    public function __construct(Db $dbh, array $columns = [''])
    {
        parent::__construct($dbh);
        $this->query['columns'] = $columns;
    }

    /**
     * @param string $table
     * @return Insert
     */
    public function into(string $table = ''): Insert
    {

        $this->query['table'] = $table;

        return $this;
    }

    /**
     * @param array $values
     * @return Insert
     */
    public function values(array $values = ['value']): Insert
    {
        $this->query['params'] = $values;

        return $this;
    }

    /**
     * @return string
     */
    public function queryRender(): string
    {
        $cleanColumns = [];
        $columns = $this->query['columns'];
        foreach ($columns as $v) {
            if ($v == end($columns)) {
                $cleanColumns[] = $v;
            } else {
                $cleanColumns[] = $v . ',';
            }
        }
        $columns = implode(' ', $cleanColumns);
        $countParams = count($this->query['params']);
        $value = '?';
        if ($countParams != 1) {
            for ($i = 0; $i < $countParams - 1; $i++) {
                $value .= ',?';
            }
        }

        return  "INSERT INTO {$this->query['table']} ({$columns}) VALUES ({$value})";
    }
}
