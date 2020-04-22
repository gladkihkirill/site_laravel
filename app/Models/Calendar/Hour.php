<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'day_id', 'end','begin'
    ];
}
