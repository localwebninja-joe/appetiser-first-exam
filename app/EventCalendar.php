<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCalendar extends Model
{
    protected $fillable = ['name', 'date_from', 'date_to', 'dow'];
}