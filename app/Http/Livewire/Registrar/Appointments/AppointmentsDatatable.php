<?php

namespace App\Http\Livewire\Registrar\Appointments;

use App\Http\Livewire\Datatable\Datatable;
use App\Http\Livewire\Datatable\TableDefinition\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AppointmentsDatatable extends Datatable
{

    public string $department = '';
    public string $title = 'Appointments';
    public string $primaryKey = 'id';

    public function query(): Builder
    {
        return Appointment::query()
            ->select(
                'appointments.id',
                'users.avatar',
                'users.email',
                'appointments.student_name',
                'appointments.appointment_date',
                'appointments.status',
                'appointments.notes',
                DB::raw( 'CONCAT(appointments.time_from, " - ", appointments.time_to) as time_schedule'),
                DB::raw('documents.name as document_name'),
                DB::raw('departments.display_name as department_name')
            )
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('documents', 'documents.id', '=', 'appointments.document_id')
            ->join('departments', 'departments.id', '=', 'appointments.department_id')
            ->where('appointments.department_id', $this->department);
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
                ->field('student_name')
                ->title('Student Name')
                ->sortable(true)
                ->string(),

            Column::make()
                ->field('email')
                ->title('Email Address')
                ->sortable(true)
                ->string(),

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
                ->enum(),

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
        $this->advancedTable()
             ->withoutImport()
             ->cannotCreateRecord()
             ->withoutFooter()
             ->withoutItemActions()
             ->withoutMoreOptions()
             ->cannotDelete()
             ->cannotExport()
        ;
    }

    public function buttonActionItems(): array
    {
        return [
            'update_status' => [
                'title' => 'Update Status',
                'icon' => 'check',
                'action' => 'x-on:click="' . "\$dispatch('toggle-appointment-update-status-modal')" . '"'
            ]
        ];
    }

    public function getListeners(): array
    {
        return array_merge(parent::getListeners(),[
           'update-status' => 'updateStatus'
        ]);
    }

    public function updateStatus($status, $notes)
    {
        $this->getActionsQuery()->update([
            'status' => $status,
            'notes' => $notes
        ]);

        $this->reset('selectAll', 'selectPage', 'selectedIDS');
        $this->dispatchBrowserEvent('delete-notification');
    }

}
