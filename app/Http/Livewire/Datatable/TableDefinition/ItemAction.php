<?php

namespace App\Http\Livewire\Datatable\TableDefinition;

use JetBrains\PhpStorm\Pure;

class ItemAction
{
    private string $text = '';
    private string $method = '';
    private string $icon = '';
    private string $class = '';
    private bool $allowed = false;

    #[Pure]
    static function make(): ItemAction
    {
        return new static();
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return ItemAction
     */
    public function text(string $text): ItemAction
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return ItemAction
     */
    public function method(string $method): ItemAction
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): string | null
    {
        if($this->icon === '') return null;
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return ItemAction
     */
    public function icon(string $icon): ItemAction
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return ItemAction
     */
    public function class(string $class): ItemAction
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowed(): bool
    {
        return $this->allowed;
    }

    /**
     * @param bool $allowed
     * @return ItemAction
     */
    public function authorize(bool $allowed): ItemAction
    {
        $this->allowed = $allowed;

        return $this;
    }
}
