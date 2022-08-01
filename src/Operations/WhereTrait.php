<?php

namespace Aidsoul\Pdo\Operations;

use Aidsoul\Pdo\Сonditions\Where;

trait WhereTrait
{
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
    public function where(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {

        $this->patternWhere('where', $column, $whereType, $value);

        return $this;
    }
    public function and(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {

        $this->patternWhere('and', $column, $whereType, $value);

        return $this;
    }

    public function or(
        string $column = '',
        string $whereType = '=',
        string|int $value = ''
    ): self {

        $this->patternWhere('or', $column, $whereType, $value);

        return $this;
    }
}
