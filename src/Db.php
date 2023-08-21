<?php

namespace Aidsoul\Pdo;

use Aidsoul\Pdo\Operations\Delete;
use Aidsoul\Pdo\Operations\DeleteInterface;
use Aidsoul\Pdo\Operations\Insert;
use Aidsoul\Pdo\Operations\InsertInterface;
use Aidsoul\Pdo\Operations\Select;
use Aidsoul\Pdo\Operations\SelectInterface;
use Aidsoul\Pdo\Operations\Update;
use Aidsoul\Pdo\Operations\UpdateInterface;
use PDO;

/**
 * Db class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Db extends PDO
{
    /**
     * @param string            $dsn
     * @param string|null       $username
     * @param string|null       $password
     * @param array<int, mixed> $options
     *
     */
    public function __construct(
        string $dsn,
        ?string $username = null,
        ?string $password = null,
        array $options = []
    ) {
        parent::__construct($dsn, $username, $password, $options + $this->getDefaultOptions());
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<int, mixed>
     */
    protected function getDefaultOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    /**
     * Undocumented function
     *
     * @param array $columns
     * @return \Aidsoul\Pdo\Operations\SelectInterface
     */
    public function select(array $columns = ['*']): SelectInterface
    {
        return new Select($this, $columns);
    }

    /**
     * Function for deleting data from a database table
     *
     * @return \Aidsoul\Pdo\Operations\DeleteInterface
     */
    public function delete(): DeleteInterface
    {
        return new Delete($this);
    }

    /**
     * Function to insert data into a database table
     *
     * @param array $columns
     * @return \Aidsoul\Pdo\Operations\InsertInterface
     */
    public function insert(array $columns = ['']): InsertInterface
    {
        return new Insert($this, $columns);
    }

    /**
     * Function to update data into a database table
     *
     * @param array $columns
     * @return \Aidsoul\Pdo\Operations\UpdateInterface
     */
    public function update(string $tableName = ''): UpdateInterface
    {
        return new Update($this, $tableName);
    }
}
