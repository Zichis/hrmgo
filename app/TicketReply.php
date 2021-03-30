<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'employee_id',
        'description',
        'created_by',
    ];
}
