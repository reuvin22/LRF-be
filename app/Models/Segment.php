<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $primaryKey = 'segment_id';
    protected $fillable = [
        'attendance_id',
        'segment_type',
        'site_id',
        'start_time',
        'end_time',
        'type'
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'attendance_id');
    }
}
