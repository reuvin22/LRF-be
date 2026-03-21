<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $primaryKey = 'attendance_id';

    public $timestamps = true;

    protected $fillable = [
        'employee_id',
        'work_date',
        'status',
        'total_work_minutes',
        'overtime_minutes',
    ];

    protected $casts = [
        'work_date' => 'date',
        'total_work_minutes' => 'integer',
        'overtime_minutes' => 'integer',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }

    public function segments()
    {
        return $this->hasMany(Segment::class, 'attendance_id', 'attendance_id');
    }

    public function transportation_expenses()
    {
        return $this->hasMany(TransportationExpenses::class, 'attendance_id', 'attendance_id');
    }
}
