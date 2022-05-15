<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    protected $fillable = ['available', 'slots'];

    use HasFactory;

    public function scopeAm(Builder $query): Builder
    {
        return $query->where('am_pm', 'am');
    }

    public function scopePm(Builder $query): Builder
    {
        return $query->where('am_pm', 'pm');
    }
}
