<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    protected $fillable = [
        'employee_code',
        'name',
        'name_kana',
        'line_user_id',
        'email',
        'role',
        'salary',
        'base_salary',
        'monthly_work_hours',
        'cost_rate',
        'communte_cost_monthly',
        'joined_date',
        'status'
    ];
}
