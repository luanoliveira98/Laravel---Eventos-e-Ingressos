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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function list($paginate){

        $user = auth()->user();

        if($user->admin == "S"){
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' ,'users.name', 'events.date')
                    ->whereNull('deleted_at')
                    ->orderBy('events.id', 'desc')
                    ->paginate($paginate); 
        }
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' ,'users.name', 'events.date')
                    ->whereNull('deleted_at')
                    ->where('events.user_id', $user->id)
                    ->orderBy('events.id', 'desc')
                    ->paginate($paginate); 
    }

    public static function listSite($paginate, $search = null){
        if($search){
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' ,'users.name as author', 'events.date')
                    ->whereNull('deleted_at')
                    ->whereDate('date', '<=', date('Y-m-d'))
                    ->where(function($query) use ($search){
                        $query->orWhere('name', 'like', '%'.$search.'%')
                              ->orWhere('description', 'like', '%'.$search.'%');
                    })
                    ->orderBy('date', 'desc')
                    ->paginate($paginate);
        } else {
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' ,'users.name as author', 'events.date')
                    ->whereNull('deleted_at')
                    ->whereDate('date', '<=', date('Y-m-d'))
                    ->orderBy('date', 'desc')
                    ->paginate($paginate);
        }    
    }
}
