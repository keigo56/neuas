<?php
namespace App\Http\Livewire\Datatable\Traits;

trait WithColumnVisibility {

    public bool $selectAllColumns = true;
    public array $temporaryColumns = [];
    public array $columnsVisible = [];

    public function mountWithColumnVisibility()
    {
        $this->temporaryColumns = $this->getDefaultTemporaryColumns();
        $this->columnsVisible = $this->temporaryColumns;
    }

    public function getDefaultTemporaryColumns(): array
    {
        return collect($this->columns())
            ->keys()
            ->toArray();
    }

    public function getTemporaryColumns(): array
    {
        return $this->temporaryColumns;
    }

    public function resetColumns()
    {
        $this->temporaryColumns = $this->getDefaultTemporaryColumns();
        $this->columnsVisible = $this->temporaryColumns;
        $this->dispatchBrowserEvent('close-columns-modal');
        $this->reset('selectAllColumns');
    }

    public function applyColumn()
    {
        $this->columnsVisible = $this->temporaryColumns;
        $this->dispatchBrowserEvent('close-columns-modal');
    }

    public function updatedSelectAllColumns($value)
    {
        $this->temporaryColumns = $value ? $this->getDefaultTemporaryColumns() : [];
    }
}
