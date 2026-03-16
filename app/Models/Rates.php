<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    protected $table = 'rates';

    protected $primaryKey = 'rate_id';

    public $timestamps = false;

    protected $fillable = [
        'rate_type',
        'target_type',
        'target_id',
        'site_id',
        'unit_price',
        'effective_from',
        'effective_to',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function target()
    {
        return $this->belongsTo(Employees::class, 'target_id', 'employee_id');
    }

    // public function site()
    // {
    //     return $this->belongsTo(Site::class, 'site_id', 'site_id');
    // }
}
