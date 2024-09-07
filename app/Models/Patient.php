<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'patient_id';
    protected $fillable = [
        'name',
        'nik',
        'tanggal_lahir',
        'email',
        'no_hp',
        'Golongan_darah',
        'jenis_kelamin',
    ];
}
