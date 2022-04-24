<?php

namespace App\Http\Livewire\Datatable\TableDefinition;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use \Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Str;

class Column
{
    private string $field = 'id';
    private string $displayName = '';
    private bool $sortable = true;
    private string $textAlign = 'left';
    private string $dataType = 'string';
    private bool $isVisible = true;
    private bool $isSearchable = true;
    private bool $showSummation = false;
    private QueryBuilder|EloquentBuilder|null $enumQuery = null;


    public static function make(): Column
    {
        return new static();
    }

    public function field(string $field): Column
    {
        $this->field = $field;

        return $this;
    }

    public function sortable(bool $sortable): Column
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * @param bool $isSearchable
     * @return Column
     */
    public function searchable(bool $isSearchable): Column
    {
        $this->isSearchable = $isSearchable;

        return $this;
    }

    public function textAlign(string $textAlign): Column
    {
        if ($textAlign !== 'left' &&
            $textAlign !== 'center' &&
            $textAlign !== 'right'
        ) {
            $textAlign = 'left';
        }

        $this->textAlign = $textAlign;

        return $this;
    }

    public function textLeft(): Column
    {
        $this->textAlign = 'left';

        return $this;
    }

    public function textCenter(): Column
    {
        $this->textAlign = 'center';

        return $this;
    }

    public function textRight(): Column
    {
        $this->textAlign = 'right';

        return $this;
    }

    public function hidden(): Column
    {
        $this->isVisible = false;

        return $this;
    }

    public function numeric(): Column
    {
        $this->dataType = 'numeric';

        return $this;
    }

    public function string(): Column
    {
        $this->dataType = 'string';

        return $this;
    }

    public function datetime(): Column
    {
        $this->dataType = 'datetime';

        return $this;
    }

    public function date(): Column
    {
        $this->dataType = 'date';

        return $this;
    }

    public function boolean(): Column
    {
        $this->dataType = 'boolean';

        return $this;
    }

    public function enum(): Column
    {
        $this->dataType = 'enum';
        return $this;
    }

    public function enumQueryBuilder(EloquentBuilder | QueryBuilder $query) : Column
    {
        $this->enumQuery = $query;

        return $this;
    }


    public function title(string $title): Column
    {
        $this->displayName = $title;

        return $this;
    }


    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        if ($this->displayName === '') {
            return Str::of($this->field)
                ->replace('_', ' ')
                ->replace('-', ' ')
                ->title();
        }
        return $this->displayName;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * @return string
     */
    public function getTextAlign(): string
    {
        return $this->textAlign;
    }

    /**
     * @return string
     */
    public function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    /**
     * @return QueryBuilder | EloquentBuilder | null
     */
    public function getEnumQuery(): QueryBuilder | EloquentBuilder | null
    {
        return $this->enumQuery;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->isSearchable;
    }

    /**
     * @return Column
     */
    public function withSummation(): Column
    {
        if($this->dataType !== 'numeric') return $this;

        $this->showSummation = true;

        return $this;
    }

    public function showSummation() : bool
    {
        return $this->showSummation;
    }

}
