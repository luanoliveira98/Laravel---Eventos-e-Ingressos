<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $fillable = ['quantify', 'total', 'half_entrance', 'lots_id', 'user_id'];

    public static function list($paginate){
        $user = auth()->user();
        return  DB::table('tickets')
                ->join('lots', 'lots.id', 'tickets.lots_id')
                ->join('events', 'lots.event_id', 'events.id')
                ->select('tickets.id', 'tickets.quantify', 'tickets.total', 'events.name')
                ->where('tickets.user_id', $user->id)
                ->paginate($paginate); 
    }
}
