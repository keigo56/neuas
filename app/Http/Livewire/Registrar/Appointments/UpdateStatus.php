<?php

namespace App\Http\Livewire\Registrar\Appointments;

use App\Http\Livewire\Datatable\Datatable;
use App\Http\Livewire\Datatable\TableDefinition\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateStatus extends Component
{
    public string $appointment_status = 'active';
    public string $notes = '';


    public function render()
    {
        return view('livewire.registrar.appointments.update-status');
    }

    public function updateStatus()
    {
        $this->emit('update-status', $this->appointment_status, $this->notes);
        $this->resetExcept();
        $this->dispatchBrowserEvent('close-appointment-update-status-modal');
    }
}
