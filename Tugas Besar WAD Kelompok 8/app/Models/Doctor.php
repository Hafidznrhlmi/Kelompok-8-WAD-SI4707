<?php

// app/Models/Doctor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'short_description',
        'full_description',
        'status',
        'joined_date',
        'practice_start_time',
        'practice_end_time',
        'practice_days'
    ];

    protected $casts = [
        'joined_date' => 'date',
        'practice_start_time' => 'datetime',
        'practice_end_time' => 'datetime'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getFormattedPracticeHoursAttribute()
    {
        return date('H:i', strtotime($this->practice_start_time)) . ' - ' . 
               date('H:i', strtotime($this->practice_end_time));
    }
}