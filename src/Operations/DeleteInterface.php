<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Db;

/**
 * Delete operator interface
 *
 * @license MIT
 * @author name <email>
 */
interface DeleteInterface extends OperationInterface, WhereInterface
{
    /**
     * @param \Aidsoul\Pdo\Db $dbh
     */
    public function __construct(Db $dbh);

    /**
     * @param string $table
     * @return Delete
     */
    public function from(string $table = ''): Delete;
}
