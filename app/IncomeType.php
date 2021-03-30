<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    protected $fillable = [
        'income_type',
        'created_by',
    ];
}
