<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCalendarMaster extends Model
{
    protected $fillable = [
        'date',
        'day_type',
        'note'
    ];
}
