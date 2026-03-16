<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateMaster extends Model
{
    protected $fillable = [
        'rate_type',
        'target_type',
        'target_id',
        'site_id',
        'unit_price',
        'effective_from',
        'effective_to'
    ];
}
