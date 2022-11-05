<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentProofOfPayment extends Model
{
    use HasFactory;
    protected $fillable = ['image_path','appointment_id'];
}
