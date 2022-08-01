<?php

namespace Aidsoul\Pdo\Operations;

/**
 * Where operator interface
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface WhereInterface
{
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
    ): self;

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
    ): self;

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
    ): self;
}
