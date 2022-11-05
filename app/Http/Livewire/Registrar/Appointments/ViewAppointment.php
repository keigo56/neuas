<?php

namespace App\Http\Livewire\Registrar\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentProofOfPayment;
use App\Models\Department;
use App\Models\TimeSchedule;
use Livewire\Component;

class ViewAppointment extends Component
{

    public array $departments = [];

    public string $student_name = '';
    public string $student_department = '';
    public array $student_document = [];
    public string $student_other_documents = '';
    public string $student_address_type = 'local';
    public string $student_address = '';

    public $student_proof_of_payments = [];

    public string $appointment_date = '';
    public string $appointment_time_id = 'no_sched';
    public string $appointment_time_code = 'no_sched';
    public string $appointment_time_display = 'no_sched';

    protected $listeners = ['view_appointment' => 'view_appointment'];

    public function render()
    {
        return view('livewire.registrar.appointments.view-appointment');
    }

    public function view_appointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $this->student_name = $appointment->student_name;
        $this->student_department = str(Department::query()->findOrFail($appointment->department_id)->name)->title();
        $this->student_document = $appointment->documents()->get()->pluck('id')->toArray();
        $this->appointment_date = $appointment->appointment_date;
        $this->student_address_type = $appointment->address_type;
        $this->student_address = $appointment->address;

        $this->appointment_time_display = $appointment->time_from . ' - ' . $appointment->time_to;

        $this->student_proof_of_payments = AppointmentProofOfPayment::query()
            ->where('appointment_id', $appointment->id)
            ->get()
            ->map(function($pof){
                return [
                    'url' => $pof->image_path
                ];
            })
            ->toArray();

        $this->dispatchBrowserEvent('toggle-appointment-view-modal');
    }
}
