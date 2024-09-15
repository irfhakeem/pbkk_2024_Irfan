<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Patient extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'patients';
    protected $primaryKey = 'patient_id';

    protected $guard_name = 'web';
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
