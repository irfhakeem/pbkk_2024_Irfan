<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, HasRoles;
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    protected $guard_name = 'web';
    protected $fillable = [
        'sip',
        'nama',
        'email',
        'no_hp',
        'tanggal_lahir',
        'jenis_kelamin',
        'spesialis_id',
        'health_center_id'
    ];
}
