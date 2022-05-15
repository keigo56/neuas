<?php

namespace App\Http\Livewire\Guard;

use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchStudent extends Component
{
    public string $student_email = '';
    public bool $validationPassed = false;
    public Appointment | null $appointment;
    protected array $rules = [
        'student_email' => 'required|email|exists:users,email'
    ];

    protected array $messages = [
        'student_email.exists' => 'Student email does not exists in our records'
    ];

    private function getAppointment() : Appointment | null
    {
        return Appointment::query()
            ->select(
                'appointments.id',
                'appointments.appointment_date',
                'appointments.status',
                'appointments.notes',
                DB::raw( 'CONCAT(appointments.time_from, " - ", appointments.time_to) as time_schedule'),
                DB::raw('documents.name as document_name'),
                DB::raw('departments.display_name as department_name'),
                'users.name',
                'users.email'
            )
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('documents', 'documents.id', '=', 'appointments.document_id')
            ->join('departments', 'departments.id', '=', 'appointments.department_id')
            ->where('appointments.appointment_date', now()->toDateString())
            ->where('users.email', $this->student_email)
            ->first()
            ;
    }

    public function render()
    {
        return view('livewire.guard.search-employee');
    }

    public function search()
    {
       $this->validationPassed = false;
       $this->validate();
       $this->validationPassed = true;
       $this->appointment = $this->getAppointment();
    }

    public function resetSearch()
    {
        $this->appointment = null;
        $this->resetExcept('appointment');
        $this->dispatchBrowserEvent('close-search-student-modal');
    }
}
