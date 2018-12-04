<?php

namespace Baukevdw\Crud\Overview;

class Column
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Column constructor.
     * @param string $title
     * @param string $slug
     * @param mixed  $value
     */
    public function __construct(string $title, string $slug, $value)
    {
        $this->title = $title;
        $this->slug  = $slug;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        if ($this->value instanceof \DateTime) {
            return $this->value->format('H:i:s d-m-Y');
        }

        if (is_bool($this->value)) {
            return $this->value ? 'true' : 'false';
        }

        if (is_int($this->value)) {
            return (string)$this->value;
        }

        return $this->value;
    }
}
