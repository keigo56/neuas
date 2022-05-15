<?php
namespace App\Http\Livewire\Datatable\Traits;

use App\Http\Livewire\Datatable\TableDefinition\Column;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as DatabaseBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait WithFilters {

    public bool $isFiltered = false;
    public array $tempFilters = [];
    public array $filters = [];
    public string $selectedColumn = 'id';
    public string $selectedOperation = 'equals';
    public string $selectedValue = '';


    public function columnsToFilter() : array
    {
        return collect($this->columns())
            ->filter(fn($column) => $column->isSearchable())
            ->mapWithKeys(fn($column) => [ $column->getField() => $column ])
            ->toArray();
    }

    public function getColumn(string $key) : Column
    {
        return $this->columnsToFilter()[$key];
    }

    private function getFirstColumn() : Column
    {
        return collect($this->columnsToFilter())->first();
    }

    public function mountWithFilters()
    {
        $this->tempFilters[] = $this->makeEmptyFilter();
        $this->filters = $this->makeEmptyFilter();
    }

    public function addFilter()
    {
        $this->tempFilters[] = $this->makeEmptyFilter();
    }

    private function makeEmptyFilter() : array
    {
        return [
            'field' => $this->getFirstColumn()->getField(),
            'table' => $this->getFirstColumn()->getTable() === '' ? $this->primaryTable : $this->getFirstColumn()->getTable(),
            'condition' => 'equals',
            'value' => '',
            'logical_expression' => 'and',
            'items' => []
        ];
    }

    public function deleteFilter($index)
    {
        array_splice($this->tempFilters, $index, 1);
        array_splice($this->filters, $index, 1);

        if (count($this->tempFilters) === 0) {
            $this->resetFilter();
        }
    }

    public function getColumnQuery(string $field): EloquentBuilder | DatabaseBuilder
    {
        $query = $this->getColumn($field)->getEnumQuery();

        if(!isset($query)){
            $query = $this->getRowsQuery()->select("$field as $field")->distinct();
        }

        return $query;
    }

    public function getEnumItems($field) : array
    {
        $column = $this->getColumn($field);

        $query = $column->getEnumQuery();

        if(!isset($query)){
            $query = $this->getRowsQuery()->select("$field as $field")->distinct();
        }

        return $query->get()
            ->map(function ($data) use ($field) {
                return [
                    'key' => $data->{$field},
                    'value' => Str::ucfirst($data->{$field})
                ];
            })
            ->values()
            ->toArray();
    }

    public function updatingTempFilters($value, $index)
    {
        $exploded = explode(".", $index);

        if ($exploded[1] === 'field' && $this->getDatatype($value) === 'enum') {
            $index = explode(".", $index)[0];
            $this->tempFilters[$index]['condition'] = 'in';
        }

        if ($exploded[1] === 'field' && $this->getDatatype($value) !== 'enum') {
            $index = explode(".", $index)[0];
            $this->tempFilters[$index]['condition'] = 'equals';
        }

    }

    public function applyFilter()
    {
        $this->filters = $this->tempFilters;

        $this->isFiltered = true;

        $this->resetPage();
        $this->reset('selectedIDS', 'selectAll', 'selectPage');

        $this->dispatchBrowserEvent('close-filter-modal');
    }

    function resetFilter()
    {
        $this->isFiltered = false;

        $this->resetPage();
        $this->reset('selectedIDS', 'selectAll', 'selectPage', 'tempFilters', 'filters');

        $this->tempFilters[] = $this->makeEmptyFilter();
        $this->filters = $this->tempFilters;

        $this->dispatchBrowserEvent('close-filter-modal');
        $this->emit('resetSelectMenu');
    }

    public function filterColumn($query, $filter)
    {
        $column = $filter['field'];
        $operation = $filter['condition'];
        $value = $filter['value'];
        $logical_expression = $filter['logical_expression'];

        //IF THE LOGICAL EXPRESSION IS NOT 'AND' OR 'OR' THEN WILL FALLBACK TO 'AND'
        if ($logical_expression !== 'and' && $logical_expression !== 'or') {
            $logical_expression = 'and';
        }

        switch ($operation) {
            case 'equals' :
                if ($value === '') $query->whereNull($column, $logical_expression);
                if ($value !== '') $query->where($column, '=', $value, $logical_expression);
                break;

            case 'contains' :
                $query->where($column, 'LIKE', '%' . $value . '%', $logical_expression);
                break;

            case 'does_not_contain' :
                $query->where($column, 'NOT LIKE', '%' . $value . '%', $logical_expression);
                break;

            case 'starts_with' :
                $query->where($column, 'LIKE', $value . '%', $logical_expression);
                break;

            case 'does_not_start_with' :
                $query->where($column, 'NOT LIKE', $value . '%', $logical_expression);
                break;

            case 'ends_with' :
                $query->where($column, 'LIKE', '%' . $value, $logical_expression);
                break;

            case 'does_not_end_with' :
                $query->where($column, 'NOT LIKE', '%' . $value, $logical_expression);
                break;

            case 'greater_than' :
                $query->where($column, '>', $value, $logical_expression);
                break;

            case 'less_than' :
                $query->where($column, '<', $value, $logical_expression);
                break;

            case 'greater_than_equal_to' :
                $query->where($column, '>=', $value, $logical_expression);
                break;

            case 'less_than_equal_to' :
                $query->where($column, '<=', $value, $logical_expression);
                break;

            case 'not_equal_to' :
                if ($value === '') $query->whereNotNull($column, $logical_expression);
                if ($value !== '') $query->where($column, '!=', $value, $logical_expression);
                break;

            case 'in' :
                if (in_array("", $filter['items'])) {
                    $query->where(function ($query) use ($column, $filter) {
                        $query->whereNull($column);
                        $query->orWhereIn($column, $filter['items']);
                    }, null, null, $logical_expression);
                } else {
                    $query->whereIn($column, $filter['items'], $logical_expression);
                }

                break;
            case 'not_in' :
                if (in_array("", $filter['items'])) {
                    $query->where(function ($query) use ($column, $filter) {
                        $query->whereNotNull($column);
                        $query->orWhereNotIn($column, $filter['items']);
                    }, null, null, $logical_expression);

                } else {
                    $query->whereNotIn($column, $filter['items'], $logical_expression);
                }

                break;
        }

        return $query;
    }

    public function getColumnsForSelect(): array
    {
        return collect($this->columnsToFilter())
            ->map(function ($column) {
                return [
                    'key' => $column->getField(),
                    'value' => $column->getDisplayName()
                ];
            })
            ->values()
            ->toArray();
    }

    public function getDatatype($field) : string
    {
        return $this->getColumn($field)->getDatatype();
    }

    public function getFilters($field): array
    {

        $datatype = $this->getDatatype($field);

        $filters = [
            [
                'key' => 'equals',
                'value' => 'Equals',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date', 'boolean', 'enum']
            ],
            [
                'key' => 'not_equal_to',
                'value' => 'Not Equal To',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date', 'boolean', 'enum']
            ],
            [
                'key' => 'contains',
                'value' => 'Contains',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'does_not_contain',
                'value' => 'Does Not Contain',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'starts_with',
                'value' => 'Starts With',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'does_not_start_with',
                'value' => 'Does not start with',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'ends_with',
                'value' => 'Ends With',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'does_not_end_with',
                'value' => 'Does not end with',
                'datatype_supported' => ['string', 'enum']
            ],
            [
                'key' => 'greater_than',
                'value' => 'Greater Than',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date']
            ],
            [
                'key' => 'less_than',
                'value' => 'Less Than',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date']
            ],
            [
                'key' => 'greater_than_equal_to',
                'value' => 'Greater Than Equal',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date']
            ],
            [
                'key' => 'less_than_equal_to',
                'value' => 'Less Than Equal',
                'datatype_supported' => ['string', 'numeric', 'datetime', 'date']
            ],
            [
                'key' => 'in',
                'value' => 'In',
                'datatype_supported' => ['enum']
            ],
            [
                'key' => 'not_in',
                'value' => 'Not in',
                'datatype_supported' => ['enum']
            ],
        ];

        return collect($filters)
            ->filter(function ($filter) use ($datatype) {
                return in_array($datatype, $filter['datatype_supported']);
            })
            ->map(function ($filter) {
                return [
                    'key' => $filter['key'],
                    'value' => $filter['value']
                ];
            })
            ->values()
            ->toArray();
    }

    public function getFilterTranslation($filter, $index = -1): string
    {
        $column = $this->getColumn($filter['field']);
        $columnName = $column->getDisplayName();

        $value = $filter['value'];

        if ($index !== -1 && $value !== '') {
            $datatype = $column->getDataType();
            if ($datatype === 'date') {
                $value = Carbon::parse($value)->format('M d, Y');
            } else if ($datatype === 'datetime') {
                $value = Carbon::parse($value)->format('M d, Y g:i A');
            }
        }

        if ($value === '') {
            $value = "<blank>";
        }

        $condition = $filter['condition'];
        $filter_translation = "";

        switch ($condition) {
            case 'equals' :
                $filter_translation = "$columnName is equal to $value";
                break;

            case 'contains' :
                $filter_translation = "$columnName contains '$value'";
                break;

            case 'does_not_contain' :
                $filter_translation = "$columnName does not contain '$value'";
                break;

            case 'starts_with' :
                $filter_translation = "$columnName starts with '$value'";
                break;

            case 'does_not_start_with' :
                $filter_translation = "$columnName does not start with '$value'";
                break;

            case 'ends_with' :
                $filter_translation = "$columnName ends with '$value'";
                break;

            case 'does_not_end_with' :
                $filter_translation = "$columnName does not end with '$value'";
                break;

            case 'greater_than' :
                $filter_translation = "$columnName is greater than $value";
                break;

            case 'less_than' :
                $filter_translation = "$columnName is less than $value";
                break;

            case 'greater_than_equal_to' :
                $filter_translation = "$columnName is greater than equal to $value";
                break;

            case 'less_than_equal_to' :
                $filter_translation = "$columnName is less than equal to $value";
                break;

            case 'not_equal_to' :
                $filter_translation = "$columnName is not equal to $value";
                break;

            case 'in' :
                $items = $filter['items'];

                foreach ($items as $index => $item) if ($item === "") $items[$index] = '<blank>';

                if (count($items) === 0) return "$columnName is empty";

                if (count($items) >= 1 && count($items) <= 3) {
                    $items_str = implode(", ", $items);
                    $filter_translation = "$columnName is in ($items_str)";
                } else {
                    $items_str = implode(", ", array_slice($items, 0, 3));
                    $count = count($items) - 3;
                    $other = $count > 1 ? "others" : "other";
                    $filter_translation = "$columnName is in ($items_str and $count $other)";
                }

                break;

            case 'not_in' :
                $items = $filter['items'];

                foreach ($items as $index => $item) if ($item === "") $items[$index] = '<blank>';

                if (count($items) === 0) return "$columnName is not empty";

                if (count($items) >= 1 && count($items) <= 3) {
                    $items_str = implode(", ", $items);
                    $filter_translation = "$columnName is not in ($items_str)";
                } else {
                    $items_str = implode(", ", array_slice($items, 0, 3));
                    $count = count($items) - 3;
                    $other = $count > 1 ? "others" : "other";
                    $filter_translation = "$columnName is not in ($items_str and $count $other)";
                }
                break;
        }

        return $filter_translation;
    }

    public function getFilterListeners(): array
    {
        return [
            'selectMenuUpdated' => 'updateFilter'
        ];
    }

    /*
     *  Updates the selected filter for enum
     */
    public function updateFilter($model, $values)
    {
        Arr::set($this->tempFilters, explode(".", $model)[1] . '.' . explode(".", $model)[2], $values);
        $this->updatingTempFilters($values , explode(".", $model)[1] . '.' . explode(".", $model)[2]);
    }

}
