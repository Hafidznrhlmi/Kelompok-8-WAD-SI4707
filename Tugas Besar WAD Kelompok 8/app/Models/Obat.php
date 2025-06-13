<?php

// app/Models/Doctor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Obat as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dosage',
        'description',
        'stock',
    ];

}