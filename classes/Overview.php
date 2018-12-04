<?php

namespace Baukevdw\Crud;

use Baukevdw\Crud\Overview\Row;
use Baukevdw\Crud\Overview\Table;
use Neat\Object\Query;
use Neat\Object\Repository;

class Overview
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var callable
     */
    private $rowCallback;

    /**
     * Overview constructor.
     * @param Repository $repository
     * @param Query      $query
     */
    public function __construct(Repository $repository, Query $query)
    {
        $this->repository = $repository;
        $this->query      = $query;
    }

    /**
     * @param callable $row
     * @return $this
     */
    public function row(callable $row): self
    {
        $this->rowCallback = $row;

        return $this;
    }

    /**
     * @return Row[] $rows
     */
    protected function rows(): array
    {
        return $this->query->collection()->map($this->rowCallback)->all();
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $table = new Table(...$this->rows());

        return $table->render();
    }
}
