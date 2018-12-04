<?php

namespace Baukevdw\Crud\Overview;

class RowAction
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $image;

    /**
     * RowAction constructor.
     * @param string      $url
     * @param string      $name
     * @param string|null $image
     */
    public function __construct(string $url, string $name, string $image = null)
    {
        $this->url   = $url;
        $this->name  = $name;
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if (!$this->image) {
            return "<a href='{$this->getUrl()}' class='action-link'><img src='{$this->getImage()}' alt='{$this->getName()}'></a>";
        }

        return "<a href='{$this->getUrl()}' class='action-link'>{$this->getName()}</a>";
    }
}
