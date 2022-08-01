<?php

namespace Aidsoul\Pdo\Сonditions;

/**
 * Join operator interface
 * 
 * @license MIT
 * @author name <email>
 */
interface JoinInterface
{

    /**
     * @param string $leftTable
     * @param string $rightTable
     * @param string $leftColumn
     * @param string $rightColumn
     */
    public function __construct(
        string $leftTable = '',
        string $rightTable = '',
        string $leftColumn = '',
        string $rightColumn = ''
    );

    /**
     * @return void
     */
    public function join(): void;

    /**
     * @return void
     */
    public function left(): void;

    /**
     * @return void
     */
    public function right(): void;

    /**
     * @return void
     */
    public function get(): string;
}
