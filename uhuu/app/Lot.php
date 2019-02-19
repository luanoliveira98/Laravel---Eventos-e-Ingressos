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

    /**
     * Função para listar todos os lotes de ingressos de um evento de acordo com seu "id"
     * @param  Integer  $id  Chave de Indetificação do Evento
     * @param  Integer  $paginate  Quantidade de lotes por página
     */
    public static function list($id, $paginate){
        return  DB::table('lots')
                ->leftJoin('tickets','lots.id','tickets.lots_id')
                ->select(DB::raw('lots.id, lots.price, lots.tickets, SUM(tickets.quantify) AS quantify'))
                ->whereNull('deleted_at')
                ->where('lots.event_id', $id)
                ->groupBy('lots.id')
                ->paginate($paginate); 
    }

    public static function listSite($id){
        return  DB::table('lots')
                ->leftJoin('tickets','lots.id','tickets.lots_id')
                ->select(DB::raw('lots.id, lots.price, lots.tickets, lots.half_entrance, SUM(tickets.quantify) AS quantify'))
                ->whereNull('deleted_at')
                ->where('lots.event_id', $id) 
                ->groupBy('lots.id')
                ->get();
    }
}
