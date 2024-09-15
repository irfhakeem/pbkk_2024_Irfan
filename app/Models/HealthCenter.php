<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCenter extends Model
{
    use HasFactory;

    protected $table = 'health_centers';
    protected $primaryKey = 'health_center_id';
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'email',
    ];
}
