<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionSites extends Model
{
    protected $table = 'sites';

    protected $primaryKey = 'site_id';

    public $timestamps = true; // uses created_at & updated_at

    protected $fillable = [
        'site_code',
        'site_name',
        'client_name',
        'contract_type',
        'address',
        'status',
        'start_date',
        'end_date',
        'contract_amount',
        'dotto_genka_code',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'contract_amount' => 'integer',
    ];

    public function siteAssignments()
    {
        return $this->hasMany(SiteAssignments::class, 'site_id', 'site_id');
    }

    public function subcontractors()
    {
        return $this->hasMany(SiteSubContractors::class, 'site_id', 'site_id');
    }

    // public function expenses()
    // {
    //     return $this->hasMany(SiteExpens::class, 'site_id', 'site_id');
    // }
}
