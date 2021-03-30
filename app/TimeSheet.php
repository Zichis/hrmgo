<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'hours',
        'remark',
    ];

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'employee_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }
}

