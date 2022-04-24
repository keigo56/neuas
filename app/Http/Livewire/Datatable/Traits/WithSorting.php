<?php
namespace App\Http\Livewire\Datatable\Traits;

trait WithSorting {

    public string $sortField = '';
    public string $sortDirection = 'asc';

    public function sortBy($field)
    {
        if (!$this->canSortColumns) return;

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $this->sortField === $field
            ? $this->sortDirection === 'asc' ? "" : $field
            : $field;

    }

    protected function applySorting($query)
    {
        if (!$this->canSortColumns) return $query;
        if (empty($this->sortField)) return $query;

        return $query->orderBy($this->sortField, $this->sortDirection);

    }
}
