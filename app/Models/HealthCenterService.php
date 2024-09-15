<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCenterService extends Model
{
    use HasFactory;

    protected $table = 'health_center_services';
    protected $primaryKey = 'health_center_services_id';

    protected $fillable = [
        'health_center_id',
        'service_id',
    ];
}
