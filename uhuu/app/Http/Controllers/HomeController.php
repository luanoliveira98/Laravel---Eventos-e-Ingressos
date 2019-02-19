<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Lot;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(isset($req->search) && $req->search != ""){
            $search = $req->search;
            $list   = Event::listSite(10, $search);
        } else {
            $list   = Event::listSite(10);
            $search = '';
        }
        return view('site/home/index', compact('list', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $lot = Lot::listSite($id);
        if($lot == null){
            dd('ue');
        }

        // Salva primeiro lote que tiver ingressos disponíveis
        $sold = true;
        foreach ($lot as $key => $value) {
            if($value->quantify < $value->tickets){
                $lot = $value;
                $sold = false;
                break;
            }
        }
        return view('site.events.show', compact('event', 'lot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
