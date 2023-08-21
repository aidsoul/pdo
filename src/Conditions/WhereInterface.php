<?php

namespace Aidsoul\Pdo\Conditions;

/**
 * Where operator interface
 *
 * @license MIT
 * @author name <email>
 */
interface WhereInterface
{
    /**
     * @param string $column
     * @param string $whereType
     */
    public function __construct(
        string $column = '',
        string $whereType = '='
    );

    /**
     * @return void
     */
    public function where(): void;

    /**
     * @return void
     */
    public function and(): void;

    /**
     * @return void
     */
    public function or(): void;

    /**
     * @return string
     */
    public function get(): string;
}
