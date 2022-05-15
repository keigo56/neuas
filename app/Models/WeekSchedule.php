<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekSchedule extends Model
{
    protected $fillable = ['day', 'available', 'department_id'];

    use HasFactory;
}
