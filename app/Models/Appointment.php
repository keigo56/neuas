<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable = [
        'student_name',
        'document_id',
        'department_id',
        'appointment_date',
        'time_from',
        'time_to',
        'appointment_code',
        'user_id',
        'status',
        'notes'
    ];

    use HasFactory;
}
