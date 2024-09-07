<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numberFunction extends Model
{
    use HasFactory;

    public function formatNumber($number)
    {
        if ($number >= 1000) {
            $display = str(($number / 1000), 1) . 'K';
        } elseif ($number >= 1000000) {
            $display = str(($number / 1000000), 1) . 'M';
        } else {
            $display = $number;
        }

        return $display;
    }
}
