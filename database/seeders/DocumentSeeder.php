<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::query()->create([
           'name' => 'Form 137',
           'department_id' => '2'
        ]);

        Document::query()->create([
            'name' => 'Form 138',
            'department_id' => '2'
        ]);

        Document::query()->create([
            'name' => 'Transcript of Records',
            'department_id' => '1'
        ]);

        Document::query()->create([
            'name' => 'Diploma',
            'department_id' => '1'
        ]);
    }
}
