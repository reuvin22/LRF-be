<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContractorWorkerMaster extends Model
{
    protected $fillable = [
        'subcontractor_id',
        'name',
        'name_kana',
        'status'
    ];
}
