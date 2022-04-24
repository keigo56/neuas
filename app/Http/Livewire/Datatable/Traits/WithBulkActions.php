<?php
namespace App\Http\Livewire\Datatable\Traits;

use App\Jobs\ExportJob;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as DatabaseBuilder;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;

trait WithBulkActions {

    public array $selectedIDS = [];
    public bool $selectPage = false;
    public bool $selectAll = false;
    public string $fileType = 'csv';


    public function updatedSelectedIDS()
    {
        $this->selectPage = false;
        $this->selectAll = false;
    }

    public function updatingSelectPage($selected)
    {
        $this->selectedIDS = $selected ?
            collect($this->getRowsData()->items())
                ->map(function ($row) {
                    return $this->getRowKey($row);
                })
                ->toArray() :
            [];

        $this->selectAll = false;
    }

    public function getRowKey($row): string|null
    {
        $data = '';

        if ($row instanceof Model) {
            $data = $row->getAttribute($this->primaryKey);
        } else if (is_array($row)) {
            $data = $row[$this->primaryKey];
        } else if (is_object($row)) {
            $data = $row->{$this->primaryKey};
        }

        return htmlspecialchars($data);
    }

    public function resetSelected()
    {
        $this->reset('selectAll', 'selectPage', 'selectedIDS');
    }

    public function deleteSelected()
    {
        if (count($this->selectedIDS) !== 0) {
            $this->getActionsQuery()->delete();
        }

        $this->reset('selectAll', 'selectPage', 'selectedIDS');
        $this->dispatchBrowserEvent('close-delete-modal');
        $this->dispatchBrowserEvent('delete-notification');

    }

    /**
     * @throws Throwable
     */
    public function exportSelected()
    {
        if (count($this->selectedIDS) !== 0) {

            Bus::batch([
                new ExportJob($this)
            ])->dispatch();

            $this->reset('selectAll', 'selectPage', 'selectedIDS');
            $this->dispatchBrowserEvent('close-export-modal');
            $this->dispatchBrowserEvent('delete-notification');
        }
    }

    public function getRowsQueryForBulkAction()
    {
        $query = $this->query();

        if ($this->canSearchRows) {
            $this->searchRows($query);
        }

        //IF WITH FILTERS IS ENABLED, IT WILL BE EXECUTED
        if ($this->withFilters) {
            if ($this->isFiltered === true) {
                foreach ($this->filters as $filter) {
                    $query = $this->filterColumn($query, $filter);
                }
            }
        }

        if ($this->canSortColumns) {
            $this->applySorting($query);
        }

        return $query;
    }

    public function getActionsQuery(): EloquentBuilder|DatabaseBuilder
    {
        $heading_keys = collect($this->getHeadingKeys())
            ->map(function ($key) {
                return $key . " as " . $key;
            })
            ->toArray();

        dd( $this->getRowsQueryForBulkAction()
            ->unless($this->selectAll, function ($query) {
                $query->whereIn($this->primaryKey, $this->selectedIDS);
            })->delete()->toSql());

        return $this->getRowsQueryForBulkAction()
            ->unless($this->selectAll, function ($query) {
                $query->whereIn($this->primaryKey, $this->selectedIDS);
            });
    }

    public function getHeadings(): array
    {
        return collect($this->getColumns())
            ->map(function ($column) {
                return $column['display_name'];
            })
            ->values()
            ->toArray();
    }

    public function getHeadingKeys(): array
    {
        return collect($this->getColumns())
            ->map(function ($column, $key) {
                return $key;
            })
            ->values()
            ->toArray();
    }
}
