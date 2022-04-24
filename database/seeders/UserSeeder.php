<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrar = User::create([
            'name' => 'Keigo Victor Fujita',
            'email' => 'keigofujita19@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode('Keigo Victor Fujita') . '&color=7F9CF5&background=EBF4FF',
            'remember_token' => \Str::random(10),
        ]);

        $registrar->assignRole('registrar');

        $student = User::create([
            'name' => 'Rovin Cruz',
            'email' => 'rovincruz@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode('Rovin Cruz') . '&color=7F9CF5&background=EBF4FF',
            'remember_token' => \Str::random(10),
        ]);

        $student->assignRole('student');

        $guard = User::create([
            'name' => 'Prince Hope Ibasco',
            'email' => 'princehopeibasco@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode('Prince Hope Ibasco') . '&color=7F9CF5&background=EBF4FF',
            'remember_token' => \Str::random(10),
        ]);

        $guard->assignRole('guard');
    }
}
