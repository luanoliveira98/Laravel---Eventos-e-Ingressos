<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'max_tickets_order', 'date', 'date_end', 'time', 'time_end', 'image', 
    'place_name', 'place_city', 'place_uf', 'description', 'tickets', 'closed', 'sold'];

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
                    ->orderBy('date', 'asc')
                    ->paginate($paginate); 
        }
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' ,'users.name', 'events.date')
                    ->whereNull('deleted_at')
                    ->where('events.user_id', $user->id)
                    ->orderBy('date', 'asc')
                    ->paginate($paginate); 
    }

    public static function listSite($paginate, $search = null){
        if($search){
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' , 'events.date', 'events.date_end', 'events.place_name', 
                    'events.place_city', 'events.place_uf', 'users.name as organization', 'events.image', 'events.time', 'events.time_end')
                    ->whereNull('events.deleted_at')
                    ->whereDate('date_end', '>=', date('Y-m-d'))
                    ->where(function($query) use ($search){
                        $query->orWhere('events.name', 'like', '%'.$search.'%')
                              ->orWhere('description', 'like', '%'.$search.'%')
                              ->orWhere('place_name', 'like', '%'.$search.'%')
                              ->orWhere('place_city', 'like', '%'.$search.'%');
                    })
                    ->orderBy('date', 'asc')
                    ->paginate($paginate);
        } else {
            return  DB::table('events')
                    ->join('users','users.id','events.user_id')
                    ->select('events.id', 'events.name', 'events.description' , 'events.date', 'events.date_end', 'events.place_name', 
                    'events.place_city', 'events.place_uf', 'users.name as organization', 'events.image', 'events.time', 'events.time_end')
                    ->whereNull('events.deleted_at')
                    ->whereDate('date_end', '>=', date('Y-m-d'))
                    ->orderBy('date', 'asc')
                    ->paginate($paginate);
        }    
    }
}
