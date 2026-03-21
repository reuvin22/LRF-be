<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportationExpenses extends Model
{
    protected $table = 'transportation_expenses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'attendance_id',
        'site_id',
        'amount',
        'route'
    ];
}
