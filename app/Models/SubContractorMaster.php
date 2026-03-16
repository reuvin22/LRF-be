<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContractorMaster extends Model
{
    protected $fillable = [
        'company_name',
        'contact_person',
        'contact_phone',
        'status'
    ];
}
