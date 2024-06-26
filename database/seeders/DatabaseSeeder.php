<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(WeekScheduleSeeder::class);
        $this->call(TimeScheduleSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
