<?php

namespace App\Http\Livewire\Student;

use App\Http\Livewire\Datatable\Datatable;
use App\Http\Livewire\Datatable\TableDefinition\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class StudentAppointmentsDatatable extends Datatable
{

    public string $department = '';
    public string $title = 'My Appointments';
    public string $primaryKey = 'id';

    public function query(): Builder
    {
        return Appointment::query()
            ->select(
                'appointments.id',
                'appointments.appointment_date',
                'appointments.status',
                'appointments.notes',
                DB::raw( 'CONCAT(appointments.time_from, " - ", appointments.time_to) as time_schedule'),
                DB::raw('appointments.id as document_name'),
                DB::raw('departments.display_name as department_name')
            )
            ->join('users', 'users.id', '=', 'appointments.user_id')
//            ->join('documents', 'documents.id', '=', 'appointments.document_id')
            ->join('departments', 'departments.id', '=', 'appointments.department_id')
            ->where('user_id', auth()->user()->id);
    }

    public function columns(): array
    {
        return [

            Column::make()
                ->field('appointment_date')
                ->title('Appointment Date')
                ->sortable(true)
                ->date(),

            Column::make()
                ->field('time_schedule')
                ->title('Time Schedule')
                ->sortable(true)
                ->string(),

            Column::make()
                ->field('department_name')
                ->title('Department Name')
                ->sortable(true)
                ->enum(),

            Column::make()
                ->field('document_name')
                ->title('Document Name')
                ->sortable(true)
                ->string(),

            Column::make()
                ->field('status')
                ->title('Status')
                ->sortable(true)
                ->enum(),

            Column::make()
                ->field('notes')
                ->title('Notes')
                ->sortable(true)
                ->string(),
        ];
    }

    public function formatColumnData(string | null $value, Column $column) : string | null
    {

        if($column->getField() === 'avatar' && $value !== '') {
            return "<img class='h-8 w-8 rounded-full' src='$value' alt=''>";
        }

        if($column->getField() === 'document_name') {

            $appointment_id = $value;
            $document_names = [];

            $documents = Appointment::where('id', $appointment_id)->first()->documents;

            foreach ($documents as $document){
                $document_names[] = $document->name;
            }

            $formatted = implode(', ', $document_names);
            return "<span>$formatted</span>";
        }

        if($column->getField() === 'status') {

            if($value === 'pending'){
                $value = ucfirst($value);
                return "<span class='ml-1 text-xs text-yellow-600 truncate px-2 py-0.5 rounded-full bg-yellow-200'>$value</span>";
            }else if($value === 'cancelled'){
                $value = ucfirst($value);
                return "<span class='ml-1 text-xs text-rose-600 truncate px-2 py-0.5 rounded-full bg-rose-200'>$value</span>";
            }else{
                $value = ucfirst($value);
                return "<span class='ml-1 text-xs text-green-600 truncate px-2 py-0.5 rounded-full bg-green-200'>$value</span>";
            }
        }

        return $value;
    }

    public function setup(): void
    {
        $this->canSearchRows()
            ->canSortColumns()
            ->withFilters()
            ->canResizeColumns()
//            ->withBulkActions()
        ;
    }


}
