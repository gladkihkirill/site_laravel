<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'day'
    ];
}
