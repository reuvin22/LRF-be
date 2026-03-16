<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCalendar extends Model
{
    protected $table = 'company_calendar';

    protected $primaryKey = 'date';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'date',
        'day_type',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
