<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Db;

/**
 * Update operator interface
 *
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface UpdateInterface extends OperationInterface, WhereInterface
{
    /**
     * @param \Aidsoul\Pdo\Db $dbh
     * @param string $table
     */
    public function __construct(Db $dbh, string $table = '');

    /**
     * @param array $columns
     * @return Update
     */
    public function set(array $columns = ['id' => 1]): Update;
}
