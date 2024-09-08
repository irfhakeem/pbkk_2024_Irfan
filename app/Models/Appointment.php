<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'health_center_id',
        'service_id',
        'date',
        'time',
    ];
}
