<?php

namespace Baukevdw\Crud\Overview;

class Row
{
    /**
     * @var Column[]
     */
    protected $columns;

    /**
     * @var RowAction[]
     */
    protected $actions;

    /**
     * @param string $title
     * @param string $slug
     * @param mixed  $value
     * @return $this
     */
    public function column(string $title, string $slug, $value): self
    {
        $this->columns[] = new Column($title, $slug, $value);

        return $this;
    }

    /**
     * @param Column $column
     * @return $this
     */
    public function addColumn(Column $column): self
    {
        $this->columns[] = $column;

        return $this;
    }

    /**
     * @param string      $url
     * @param string      $name
     * @param string|null $image
     * @return $this
     */
    public function action(string $url, string $name, string $image = null)
    {
        $this->actions[] = new RowAction($url, $name, $image);

        return $this;
    }

    /**
     * @param RowAction $action
     * @return $this
     */
    public function addAction(RowAction $action): self
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function renderHeader()
    {
        $columns = array_map(function (Column $column) {
            return "<th>{$column->getTitle()}</th>";
        }, $this->columns);
        if (!empty($this->actions)) {
            $columns[] = '<th></th>';
        }

        return implode('', $columns);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $columns = array_map(function (Column $column) {
            return "<td>{$column->getValue()}</td>";
        }, $this->columns);
        if (!empty($this->actions)) {
            $columns[] = "<td class='action-column'>{$this->renderActions()}</td>";
        }

        return implode('', $columns);
    }

    /**
     * @return string
     */
    protected function renderActions(): string
    {
        $actions = array_map(function (RowAction $action) {
            return $action->render();
        }, $this->actions);

        return implode('', $actions);
    }
}
