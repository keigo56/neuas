<?php

namespace Database\Seeders;

use App\Models\TimeSchedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $week_schedule_ids = [1, 2, 3, 4, 5, 6, 7];
        $department_ids = [1, 2];

        $time_range = \Carbon\CarbonPeriod::since('00:00')->hours(1)->until('23:00')->toArray();

        foreach ([1,2,3,4,5,6,7] as $week_schedule_id) {
            foreach ($time_range as $time){
                TimeSchedule::query()->create([
                    'available' => str($time->format('H:i')) >= '08:00' && str($time->format('H:i')) <= '17:00',
                    'am_pm' => str($time->format('a'))->contains('am') ? 'am' : 'pm',
                    'time_from' => $time->format('H:i'),
                    'time_to' => $time->addHour()->format('H:i'),
                    'department_id' => 1,
                    'week_schedule_id' => $week_schedule_id,
                    'slots' => 10
                ]);
            }
            $time_range = \Carbon\CarbonPeriod::since('00:00')->hours(1)->until('23:00')->toArray();
        }

        foreach ([8,9,10,11,12,13,14] as $week_schedule_id) {
            foreach ($time_range as $time){
                TimeSchedule::query()->create([
                    'available' => str($time->format('H:i')) >= '08:00' && str($time->format('H:i')) <= '17:00',
                    'am_pm' => str($time->format('a'))->contains('am') ? 'am' : 'pm',
                    'time_from' => $time->format('H:i'),
                    'time_to' => $time->addHour()->format('H:i'),
                    'department_id' => 2,
                    'week_schedule_id' => $week_schedule_id,
                    'slots' => 10
                ]);
            }
            $time_range = \Carbon\CarbonPeriod::since('00:00')->hours(1)->until('23:00')->toArray();
        }
    }
}
