<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'max_tickets_order', 'date', 'date_end', 'time', 'time_end', 'date_first_presentation',
    'date_last_presentation', 'image', 'place_address', 'place_city', 'place_uf', 'description', 'tickets',
    'closed', 'sold'];

    protected $dates= ['deleted_at'];
}
