<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSubContractorMaster extends Model
{
    protected $fillable = [
        'site_id',
        'subcontractor_id',
        'contract_type'
    ];
}
