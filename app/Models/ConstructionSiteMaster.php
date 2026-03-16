<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionSiteMaster extends Model
{
    protected $fillable = [
        'site_code',
        'site_name',
        'client_name',
        'contract_type',
        'address',
        'status',
        'start_date',
        'end_date',
        'contract_amount',
        'dotto_genka_code'
    ];
}
