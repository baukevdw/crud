<?php

namespace Baukevdw\Crud\Overview;

class Table
{
    /**
     * @var Row[]
     */
    protected $rows;

    /**
     * Table constructor.
     * @param Row ...$rows
     */
    public function __construct(Row ...$rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $row    = reset($this->rows);
        $header = "<tr>{$row->renderHeader()}</tr>";
        $rows   = array_map(function (Row $row) {
            return "<tr>{$row->render()}</tr>";
        }, $this->rows);
        $body   = implode('', $rows);

        return <<<HTML
<table class="table">
<thead>$header</thead>
<tbody>$body</tbody>
</table>
HTML;
    }
}
