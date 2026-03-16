<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteExpenseCategoryMaster extends Model
{
    protected $fillable = [
        'category_id',
        'category_name',
        'description',
        'status'
    ];
}
