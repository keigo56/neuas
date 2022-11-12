<?php

namespace App\Http\Livewire\Datatable;

use App\Http\Livewire\Datatable\TableDefinition\Column;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\Pure;
use App\Http\Livewire\Datatable\Traits\{WithBulkActions,
    WithDatatableSetup,
    WithFooter,
    WithItemAction,
    WithFilters,
    WithSorting};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder as DatabaseBuilder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use function collect;
use function view;

abstract class Datatable extends Component
{
    use WithPagination,
        WithFilters,
        WithItemAction,
        WithDatatableSetup,
        WithSorting,
        WithBulkActions,
        WithFooter;

    public string $title = 'Models';
    public int $perPage = 10;
    public string $search = '';
    public string $primaryKey = 'id';
    public string $primaryTable = 'users';
    protected $currentRow;


    abstract function setup(): void;

    abstract function query(): EloquentBuilder|DatabaseBuilder;

    abstract public function columns(): array;

    #[Pure]
    protected function getListeners(): array
    {
        $listeners = [
            'refresh' => '$refresh'
        ];

        if ($this->withFilters) {
            $listeners = array_merge($listeners, $this->getFilterListeners());
        }

        return $listeners;
    }

    public function mount()
    {
        $this->setup();
    }

    public function getColumns(): array
    {
        return $this->columns();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
        $this->reset('selectedIDS', 'selectAll', 'selectPage');
    }

    public function render(): View
    {

        $this->setup();

        if ($this->selectAll) {

            $this->selectedIDS = collect($this->getRowsData()->items())
                ->map(function ($row) {
                    return $this->getRowKey($row);
                })
                ->toArray();
        }

        if($this->canResizeColumns){
            $this->dispatchBrowserEvent('table-refreshed', [
                'table_id' => \Str::slug($this->title) . '-table'
            ]);
        }

        $this->emit('updateQuery', $this->getRowsQuery());
        $this->dispatchBrowserEvent('refreshSelectMenus',[]);

        return view('livewire.datatable.index', [
            'columns' => $this->getColumns(),
            'rows' => $this->getRowsData()
        ]);
    }

    public function getRowsQuery(): EloquentBuilder|DatabaseBuilder
    {
        $query = $this->query();
        $parentQuery = $query instanceof EloquentBuilder ? $query->getQuery() : $query;
        $query = DB::table(DB::raw("({$parentQuery->toSql()}) as main"))
            ->mergeBindings($parentQuery);

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

    private function searchRows($query)
    {
        if (empty($this->search)) return $query;

        $searchable_fields = collect($this->getColumns())
            ->filter(fn($column) => $column->isSearchable())
            ->map(function ($column) {
                return $column->getField();
            });

        $query->where(function ($query) use ($searchable_fields) {
            foreach ($searchable_fields as $field) {
                $query->orWhere($field, 'LIKE', "%$this->search%");
            }
        });

        return $query;
    }

    public function getRowsData(): LengthAwarePaginator
    {
//        dd($this->getRowsQuery()->paginate($this->perPage));
        return $this->getRowsQuery()->paginate($this->perPage)->onEachSide(1);
    }

    public function getColumnData($row, Column $column): string|null
    {

        if ($row instanceof Model) {
            $data = $row->getAttribute($column->getField());
        } else if (is_array($row)) {
            $data = $row[$column->getField()];
        } else {
            $data = $row->{$column->getField()};
        }

        return htmlspecialchars($data);
    }

    public function formatColumnData(string|null $value, Column $column): string|null
    {
        return $value;
    }

    public function createRecord()
    {
        $this->redirect('/');
    }


    // TODO: Add Group By, Export, Item Actions, Import Functionality
    // DONE: Item Actions Class for better code readability
    // DONE: Item Actions should have a middleware for each actions
    // TODO: Default Viewing should show All the fields in a modal
    // DONE: Default Item functions

    // TODO: Filter Modal Revamp (Add Casting Functionality (0,1) values to (Y,N))
    // TODO: Dropdown Livewire Model should be updated (Add Search Functionality)
    // TODO: Add Eloquent Model in GetRowData function() if the query is an Eloquent
    // TODO: Save Filters

    // TODO: Column Visibility
    // TODO: New Record Link Functionality
    // TODO: Batch Operations UI Revamp

    // TODO: Export Options should be executed in Jobs
    // TODO: Export Options PDF (Beta) should have a preview pane
    // TODO: Import Functionality
    // TODO: Customization of Pagination
    // TODO: Add Group By Functionality

    // TODO: ADD THEMES (LIGHT AND DARK MODE)
    // TODO: Change Scroll bar design
    // TODO: Add table modes (basic, simple, advanced)

    // TODO: Refactor some unnecessary codes
    // TODO: Add Restore Functionality
}
