<?php

namespace App\Http\Livewire\Student;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Document;
use App\Models\TimeSchedule;
use App\Models\WeekSchedule;
use Carbon\Carbon;
use Livewire\Component;

class CreateAppointment extends Component
{

    public bool $done = false;

    public string $student_name = '';
    public string $student_department = '';
    public array $student_document = [];

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
        $this->appointment_date = now()->format('Y-m-d');
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

        $week_schedule = WeekSchedule::query()
            ->where('day', str(Carbon::parse($this->appointment_date)->dayName)->lower())
            ->where('department_id', $this->student_department)
            ->first();

        $available_time_schedules = [];

        $valid_date = Carbon::parse($this->appointment_date)->greaterThan(now());

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
            'user_id' => auth()->user()->id
        ]);

        $appointment->documents()->sync($this->student_document);

        $this->done = true;
        $this->dispatchBrowserEvent('close-confirm-appointment-modal');

    }
}
