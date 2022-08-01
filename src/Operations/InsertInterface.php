<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Db;

/**
 * Insert operator interface
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface InsertInterface extends OperationInterface
{
    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param array $columns
     */
    public function __construct(Db $dbh, array $columns = ['']);

    /**
     * @param string $table
     * @return Insert
     */
    public function into(string $table = ''): Insert;

    /**
     * @param array $values
     * @return Insert
     */
    public function values(array $values = ['value']): Insert;
}
