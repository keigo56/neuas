<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Datatable\Contracts\InitializesDatatable;
use App\Http\Livewire\Datatable\Datatable;
use App\Http\Livewire\Datatable\TableDefinition\Column;
use App\Http\Livewire\Datatable\TableDefinition\ItemAction;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\Pure;

class UsersDatatable extends Datatable
{

    public string $title = 'Users';
    public string $primaryKey = 'id';

    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [

            Column::make()
                ->field('avatar')
                ->title('Avatar')
                ->sortable(false)
                ->string(),

            Column::make()
                ->field('name')
                ->title('Full Name')
                ->sortable(true)
                ->enum(),

            Column::make()
                ->field('email')
                ->title('Email Address')
                ->sortable(true)
                ->string(),

            Column::make()
                ->field('department')
                ->title('Department')
                ->sortable(true)
                ->string(),

        ];
    }

    public function formatColumnData(string | null $value, Column $column) : string | null
    {

        if($column->getField() === 'avatar' && $value !== '') {
            return "<img class='h-8 w-8 rounded-full' src='$value' alt=''>";
        }

        return $value;
    }

    public function setup(): void
    {
        $this->advancedTable()
             ->withoutFooter()
             ->withoutImport();
    }

    public function itemActions(): array
    {
        return [
            $this->getViewItemAction()->authorize(true),
            $this->getEditItemAction(),
            $this->getCopyToClipboardItemAction(),
            $this->getExportItemAction(),
            $this->getDeleteItemAction()
        ];
    }

    #[Pure]
    public function allowItemActionIf(ItemAction $itemAction, $row): bool
    {
        return true;
    }
}
