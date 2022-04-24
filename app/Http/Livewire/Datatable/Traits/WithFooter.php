<?php
namespace App\Http\Livewire\Datatable\Traits;

use App\Http\Livewire\Datatable\TableDefinition\Column;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB;

trait WithFooter {

    public function getFooterData(Column $column): string|null
    {
        $query = $this->getRowsQuery() instanceof EloquentBuilder ? $this->getRowsQuery()->getQuery() : $this->getRowsQuery();

        $aggregateQuery = DB::table(DB::raw("({$this->getRowsQuery()->toSql()}) as sub"))
            ->mergeBindings($query);

        $data = '';

        if ($column->showSummation() === true) $data = $aggregateQuery->sum($column->getField());

        return htmlspecialchars($data);
    }

    public function formatFooterColumn(string $value, Column $column): string
    {
        return $value;
    }
}
