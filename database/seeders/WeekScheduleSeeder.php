<?php

namespace Database\Seeders;

use App\Models\WeekSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //COLLEGE WEEK SCHEDULE
        WeekSchedule::query()->create([
            'day' => 'sunday',
            'available' => false,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'monday',
            'available' => true,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'tuesday',
            'available' => true,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'wednesday',
            'available' => true,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'thursday',
            'available' => true,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'friday',
            'available' => true,
            'department_id' => '1'
        ]);

        WeekSchedule::query()->create([
            'day' => 'saturday',
            'available' => false,
            'department_id' => '1'
        ]);



        //High School
        WeekSchedule::query()->create([
            'day' => 'sunday',
            'available' => false,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'monday',
            'available' => true,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'tuesday',
            'available' => true,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'wednesday',
            'available' => true,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'thursday',
            'available' => true,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'friday',
            'available' => true,
            'department_id' => '2'
        ]);

        WeekSchedule::query()->create([
            'day' => 'saturday',
            'available' => false,
            'department_id' => '2'
        ]);

    }
}
