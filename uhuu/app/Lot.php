<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Lot extends Model
{
    use SoftDeletes;

    protected $fillable = ['price', 'tickets', 'half_entrance', 'event_id'];

    protected $dates= ['deleted_at'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public static function list($id, $paginate){
        return  DB::table('lots')
                ->leftJoin('tickets','lots.id','tickets.lots_id')
                ->select(DB::raw('lots.id, lots.price, lots.tickets, IF(SUM(tickets.quantify) is NULL, "0", tickets.quantify) AS quantify'))
                ->whereNull('deleted_at')
                ->where('lots.event_id', $id)
                ->groupBy('tickets.id')
                ->paginate($paginate); 
    }
}
