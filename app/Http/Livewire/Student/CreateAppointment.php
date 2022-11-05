<?php

namespace App\Http\Livewire\Student;

use App\Mail\AppointmentStatusMail;
use App\Models\Appointment;
use App\Models\AppointmentDocument;
use App\Models\AppointmentProofOfPayment;
use App\Models\Department;
use App\Models\Document;
use App\Models\TimeSchedule;
use App\Models\WeekSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAppointment extends Component
{

    use WithFileUploads;

    public bool $done = false;

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

    public int $current_step = 1;
    public int $max_step_reached = 1;

    public array $steps = [
        1 => [
            'title' => 'Application Form',
            'done' => false
        ],
        2 => [
            'title' => 'Date and Time',
            'done' => false
        ],
        3 => [
            'title' => 'Confirmation',
            'done' => false
        ],
    ];


    public function mount()
    {
        $this->student_name = auth()->user()->name;
        $this->appointment_date = $this->getWorkingDaysMinimum()->format('Y-m-d');
        $this->student_department = Department::first()->id;
    }

    public function updatedAppointmentDate()
    {
        $this->dispatchBrowserEvent('reload-items');
    }

    public function updatedStudentDepartment()
    {
        $this->student_document = [];
    }

    public function updatedAppointmentTimeId()
    {
        $this->resetValidation('appointment_time_id');

        if($this->appointment_time_id !== 'no_sched'){
            $time_schedule = TimeSchedule::query()->find($this->appointment_time_id);
            $appointment_date = \Illuminate\Support\Carbon::parse($this->appointment_date);
            $this->appointment_time_code = $appointment_date->format('Y-m-d') . '|' . $time_schedule->time_from . '-' . $time_schedule->time_to;
            $this->appointment_time_display = $time_schedule->time_from . ' - ' . $time_schedule->time_to;
        }else{
            $this->appointment_time_code = 'no_sched';
            $this->appointment_time_display = 'no_sched';
        }
    }

    public function render()
    {
        $departments = Department::all();
        $this->departments = Department::all()->toArray();

        $week_schedule = WeekSchedule::query()
            ->where('day', str(Carbon::parse($this->appointment_date)->dayName)->lower())
            ->where('department_id', $this->student_department)
            ->first();

        $available_time_schedules = [];

        $valid_date = Carbon::parse($this->appointment_date)->greaterThanOrEqualTo($this->getWorkingDaysMinimum()->subDay());

        if($week_schedule->available === 1 && $valid_date){
            $available_time_schedules = TimeSchedule::query()
                ->where('week_schedule_id', $week_schedule->id)
                ->where('available', 1)
                ->get()
                ->map(function ($time_schedule){

                    $appointment_time_code =
                        Carbon::parse($this->appointment_date)->format('Y-m-d') . '|' . $time_schedule->time_from . '-' . $time_schedule->time_to;

                    $existing_appointments = Appointment::query()
                        ->where('appointment_code', $appointment_time_code)
                        ->count();

                    $maximum_slots = $time_schedule->slots;

                    $remaining_slots = $maximum_slots - $existing_appointments;

                    return [
                        'id' => $time_schedule->id,
                        'time_range' => $time_schedule->time_from . ' - ' . $time_schedule->time_to,
                        'remaining_slots' => $remaining_slots
                    ];
                });
        }

        $documents = Document::query()
            ->where('department_id', $this->student_department)
            ->get();


        return view('livewire.student.create-appointment',[
            'departments' => $departments,
            'documents' => $documents,
            'time_schedules' => $available_time_schedules,
        ]);
    }

    public function setCurrentPage($value)
    {
        if($value > $this->max_step_reached) return;

        $this->current_step = $value;
    }

    public function next()
    {
        if($this->current_step === 1){
            $this->validate([
                'student_name' => 'required|min:6',
                'student_document' => 'required|exists:documents,id',
//                'student_address' => 'required',
            ]);
        }else if($this->current_step === 2) {
            $this->validate(['appointment_time_id' => function ($attribute, $value, $fail) {
                if (str($value)->contains('no_sched')) {
                    $fail('Please select a valid time schedule');
                }
            }]);
        }

        $this->steps[$this->current_step]['done'] = true;
        $this->max_step_reached++;
        $this->current_step++;
    }

    public function previous()
    {
        $this->current_step--;
    }

    public function submit()
    {

        $time_schedule = TimeSchedule::query()->find($this->appointment_time_id);

        $appointment = Appointment::query()->create([
            'student_name' => $this->student_name,
            'department_id' => $this->student_department,
            'appointment_date' => $this->appointment_date,
            'appointment_code' => $this->appointment_time_code,
            'time_from' => $time_schedule->time_from,
            'time_to' =>  $time_schedule->time_to,
            'user_id' => auth()->user()->id,
            'other_documents' => $this->student_other_documents,
            'address_type' => $this->student_address_type,
            'address' => $this->student_address
        ]);

        $appointment->documents()->sync($this->student_document);

        foreach ($this->student_proof_of_payments as $photo) {
            $image_path = $photo->storePublicly('proof_of_payment','public');
            AppointmentProofOfPayment::query()
                ->create([
                    'appointment_id' => $appointment->id,
                    'image_path' => $image_path,
                ]);
        }

        $this->done = true;
        $this->dispatchBrowserEvent('close-confirm-appointment-modal');
    }

    public function getDepartmentName() : string
    {
        $department_name = \App\Models\Department::query()->where('id', $this->student_department)->first()->name ?? 'N/A';
        return str($department_name)->replace('_', ' ')->title()->toString();
    }

    public function getWorkingDaysMinimum()
    {
        $day_allowance = 10;
        $allowed_date = now();
        $added_days = 0;

        while(true){
            $allowed_date = $allowed_date->addDay();
            if($allowed_date->isWeekday()){
                $added_days++;
            }
            if($added_days === $day_allowance) break;
        }

        return $allowed_date;
    }
}
