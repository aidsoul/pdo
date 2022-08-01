<?php

namespace Aidsoul\Pdo;

use PDO;

/**
 * A class for connecting to the database
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class Connect
{

    public function __construct(protected PDO $dbh)
    {
    }

    /**
     * Function for sending a query to the database
     *
     * @param string $query
     * @param array $params
     * 
     * @return object
     */
    public function executeQuery(string $query = '', array $params = []): object
    {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
