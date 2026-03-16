<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAssignmentMaster extends Model
{
    protected $fillable = [
        'employee_id',
        'site_id',
        'is_leader',
        'start_date',
        'end_date'
    ];
}
