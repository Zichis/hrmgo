<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    protected $fillable = [
        'payer_name',
        'contact_number',
        'created_by',
    ];
}
