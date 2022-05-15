<?php

namespace App\Http\Livewire\Registrar\Settings;

use App\Models\TimeSchedule;
use App\Models\WeekSchedule;
use Livewire\Component;

class Schedule extends Component
{

    public array $week_schedules = [];
    public int $selectedWeekSchedule = 1;
    public array $time_schedules = [];

    public bool $isChanged = false;

    public function updating()
    {
        $this->isChanged = true;
    }

    public function selectWeekSchedule($id)
    {
        $this->selectedWeekSchedule = $id;
    }

    public function getWeekSchedule() : array
    {
        return $this->week_schedules[$this->selectedWeekSchedule];
    }

    public function mount()
    {
        $this->week_schedules = WeekSchedule::query()
            ->where('department_id', auth()->user()->department->id)
            ->get()
            ->mapWithKeys(function ($week_schedule){
                return [ $week_schedule->id => $week_schedule ];
            })
            ->toArray();

        foreach ($this->week_schedules as $week_schedule){
            $time_schedules = TimeSchedule::query()
                ->where('department_id', auth()->user()->department->id)
                ->where('week_schedule_id', $week_schedule['id'])
                ->get()
                ->toArray();

            $this->time_schedules[] = $time_schedules;
        }

        $this->time_schedules = collect($this->time_schedules)
            ->flatten(1)
            ->mapWithKeys(function($time_schedule){
                return [ $time_schedule['id']  => $time_schedule ];
            })
            ->toArray();


        $this->selectedWeekSchedule = $this->week_schedules[array_key_first($this->week_schedules)]['id'];
    }

    public function render()
    {

        $time_schedules_am = TimeSchedule::query()
            ->where('department_id', auth()->user()->department->id)
            ->where('week_schedule_id', $this->selectedWeekSchedule)
            ->am()
            ->get();

        $time_schedules_pm = TimeSchedule::query()
            ->where('department_id', auth()->user()->department->id)
            ->where('week_schedule_id', $this->selectedWeekSchedule)
            ->pm()
            ->get();

        return view('livewire.registrar.settings.schedule',[
            'time_schedules_am' => $time_schedules_am,
            'time_schedules_pm' => $time_schedules_pm
        ]);
    }


    public function save()
    {
        foreach($this->week_schedules as $week_schedule){
            WeekSchedule::query()
                ->where('id', $week_schedule['id'])
                ->update([
                    'available' =>  $week_schedule['available']
                ]);
        }


        foreach ($this->time_schedules as $time_schedule){
            TimeSchedule::query()
                ->where('id', $time_schedule['id'])
                ->update([
                    'available' => $time_schedule['available'],
                    'slots' => $time_schedule['slots']
                ]);
        }

        $this->resetExcept([]);
        $this->mount();
    }
}
