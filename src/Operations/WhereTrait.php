<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Сonditions\Where;

trait WhereTrait
{
    /**
     * @param string $typeOperation
     * @param string $column
     * @param string $whereType
     * @param string $value
     * @return void
     */
    private function patternWhere(
        string $typeOperation = 'where',
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ) {
        $where = new Where($column, $whereType);
        $where->$typeOperation();
        $this->query['where'][] = $where->get();
        $this->query['params'][] = $value;
    }

    /**
     * @param string $column
     * @param string $whereType
     * @param string $value
     * @return self
     */
    public function where(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {
        $this->patternWhere('where', $column, $whereType, $value);

        return $this;
    }

    /**
     * @param string $column
     * @param string $whereType
     * @param string $value
     * @return self
     */
    public function and(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {
        $this->patternWhere('and', $column, $whereType, $value);

        return $this;
    }

    /**
     * @param string $column
     * @param string $whereType
     * @param string $value
     * @return self
     */
    public function or(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {
        $this->patternWhere('or', $column, $whereType, $value);

        return $this;
    }
}
