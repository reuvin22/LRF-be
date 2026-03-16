<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteExpenseCategory extends Model
{
    protected $table = 'site_expense_categories';

    protected $primaryKey = 'category_id';

    public $timestamps = true;

    protected $fillable = [
        'category_name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // public function expenses()
    // {
    //     return $this->hasMany(SiteExpense::class, 'category_id', 'category_id');
    // }
}
