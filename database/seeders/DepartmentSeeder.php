<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::query()->create([
            'name' => 'college',
            'display_name' => 'College',
            'slug' => 'college'
        ]);

        Department::query()->create([
            'name' => 'high_school',
            'display_name' => 'High School',
            'slug' => 'high-school'
        ]);
    }
}
