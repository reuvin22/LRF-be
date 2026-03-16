<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSubContractors extends Model
{
    protected $table = 'site_sub_contractors';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'site_id',
        'subcontractor_id',
        'contract_type',
    ];

    protected $casts = [
        'contract_type' => 'string',
    ];

    // public function site()
    // {
    //     return $this->belongsTo(Site::class, 'site_id', 'site_id');
    // }

    public function subcontractor()
    {
        return $this->belongsTo(SubContractors::class, 'subcontractor_id', 'subcontractor_id');
    }
}
