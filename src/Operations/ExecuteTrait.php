<?php

namespace Aidsoul\Pdo\Operations;

/**
 * Execute trait
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
trait ExecuteTrait
{
    /**
     * @return boolean
     */
    public function execute(): bool
    {
        try {
            parent::executeQuery($this->queryRender(), $this->query['params'] ?? []);
            return true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
