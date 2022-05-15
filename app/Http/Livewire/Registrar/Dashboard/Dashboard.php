<?php

namespace App\Http\Livewire\Registrar\Dashboard;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Dashboard extends Component
{
    public string $range = 'today';
    public string $department = '';

    private function dateRange(Builder $query) : Builder
    {
        $query->when($this->range === 'today', fn($query) => $query->whereBetween('appointment_date', [now()->toDateString(), now()->addDay()->toDateString()]));
        $query->when($this->range === 'yesterday', fn($query) => $query->whereBetween('appointment_date', [now()->subDay()->toDateString(), now()->toDateString()]));
        $query->when($this->range === 'last_7_days', fn($query) => $query->whereBetween('appointment_date', [now()->subDays(7)->toDateString(), now()->toDateString()]));
        $query->when($this->range === 'all_time', fn($query) => $query);

        return $query;
    }

    private function getDashboardTilesData() : array
    {

        $all_appointments_query = Appointment::query()
            ->where('department_id', $this->department);

        $pending_appointments_query = Appointment::query()
            ->where('department_id', $this->department)
            ->where('status', 'pending');

        $done_appointments_query = Appointment::query()
            ->where('department_id', $this->department)
            ->where('status', 'finished');

        $cancelled_appointments_query = Appointment::query()
            ->where('department_id', $this->department)
            ->where('status', 'cancelled');


        $all_appointments_count = $this->dateRange($all_appointments_query)->count();
        $pending_appointments_query = $this->dateRange($pending_appointments_query)->count();
        $done_appointments_query = $this->dateRange($done_appointments_query)->count();
        $cancelled_appointments_query = $this->dateRange($cancelled_appointments_query)->count();

        return [
            'all' => $all_appointments_count,
            'pending' => $pending_appointments_query,
            'done' => $done_appointments_query,
            'cancelled' => $cancelled_appointments_query,
        ];
    }

    public function render()
    {
        $data = $this->getDashboardTilesData();
        return view('livewire.registrar.dashboard.dashboard', [
            'data' => $data
        ]);
    }
}
