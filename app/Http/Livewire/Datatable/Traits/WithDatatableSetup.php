<?php

namespace App\Http\Livewire\Datatable\Traits;
use App\Http\Livewire\Datatable\Datatable;

trait WithDatatableSetup {

    public bool $canResizeColumns = false;
    public bool $canSortColumns = false;
    public bool $canSearchRows = false;
    public bool $canCreateRecord = false;
    public bool $withBulkActions = false;
    public bool $withColumnVisibility = false;
    public bool $withFilters = false;
    public bool $withItemActions = false;
    public bool $withFooter = false;
    public bool $withImport = false;
    public bool $withMoreOptions = false;
    public bool $canExport = false;
    public bool $canDelete = false;


    public function isBaseTable(): bool
    {
        return
            $this->withColumnVisibility === false &&
            $this->withBulkActions === false &&
            $this->withFilters === false &&
            $this->canSearchRows === false;
    }

    public function canResizeColumns(): Datatable
    {
        $this->canResizeColumns = true;

        return $this;
    }

    public function cannotResizeColumns(): Datatable
    {
        $this->canResizeColumns = false;

        return $this;
    }

    public function withFilters(): Datatable
    {
        $this->withFilters = true;

        return $this;
    }

    public function withoutFilters(): Datatable
    {
        $this->withFilters = false;

        return $this;
    }

    public function canSortColumns(): Datatable
    {
        $this->canSortColumns = true;

        return $this;
    }

    public function cannotSortColumns(): Datatable
    {
        $this->canSortColumns = false;

        return $this;
    }

    public function withBulkActions(): Datatable
    {
        $this->withBulkActions = true;

        return $this;
    }

    public function withoutBulkActions(): Datatable
    {
        $this->withBulkActions = false;

        return $this;
    }

    public function withColumnVisibility(): Datatable
    {
        $this->withColumnVisibility = true;

        return $this;
    }

    public function withoutColumnVisibility(): Datatable
    {
        $this->withColumnVisibility = false;

        return $this;
    }

    public function canSearchRows(): Datatable
    {
        $this->canSearchRows = true;

        return $this;
    }

    public function cannotSearchRows(): Datatable
    {
        $this->canSearchRows = false;

        return $this;
    }

    public function canCreateRecord(): Datatable
    {
        $this->canCreateRecord = true;

        return $this;
    }

    public function cannotCreateRecord(): Datatable
    {
        $this->canCreateRecord = false;

        return $this;
    }

    public function withItemActions(): Datatable
    {
        $this->withItemActions = true;

        return $this;
    }

    public function withoutItemActions(): Datatable
    {
        $this->withItemActions = false;

        return $this;
    }

    public function withFooter(): Datatable
    {
        $this->withFooter = true;

        return $this;
    }

    public function withoutFooter(): Datatable
    {
        $this->withFooter = false;

        return $this;
    }

    public function withImport() : Datatable
    {
        $this->withImport = true;

        return $this;
    }

    public function withoutImport() : Datatable
    {
        $this->withImport = false;

        return $this;
    }

    public function withMoreOptions() : Datatable
    {
        $this->withMoreOptions = true;

        return $this;
    }

    public function withoutMoreOptions() : Datatable
    {
        $this->withMoreOptions = false;

        return $this;
    }

    public function canExport(): Datatable
    {
        $this->canExport = true;

        return $this;
    }

    public function cannotExport(): Datatable
    {
        $this->canExport = false;

        return $this;
    }

    public function canDelete(): Datatable
    {
        $this->canDelete = true;

        return $this;
    }

    public function cannotDelete(): Datatable
    {
        $this->canDelete = false;

        return $this;
    }

    public function advancedTable(): Datatable
    {
        return $this
            ->withFilters()
            ->withBulkActions()
            ->withColumnVisibility()
            ->canResizeColumns()
            ->canSortColumns()
            ->canSearchRows()
            ->canCreateRecord()
            ->withItemActions()
            ->withFooter()
            ->withImport()
            ->withMoreOptions()
            ->canExport()
            ->canDelete()
            ;
    }
}
