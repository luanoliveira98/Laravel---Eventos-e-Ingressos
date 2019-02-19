<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\Lot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCrumbs = json_encode([
            ["title"=>"Dashboard", "url"=>route('dashboard')],
            ["title"=>"Lista de Ingressos", "url"=>""]
        ]);

        $user = auth()->user();
        $listModel = Ticket::list(10);
        return view('admin.tickets.index', compact('listCrumbs', 'listModel'));
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
        $data = $request->all();
        $validation = \Validator::make($data,[
            'quantify' => 'required|numeric',
            'half_entrance' => 'required'
        ]);
        
        $lot = Lot::find($data["lots_id"]);
        if($data['half_entrance'] == 'S'){
            $data["total"] = $data['quantify'] * ($lot->price/2 + $lot->price*0.025);
        } else {
            $data["total"] = $data['quantify'] * ($lot->price + $lot->price*0.05);
        }
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $user = auth()->user();
        $user->ticket()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::find($id)->delete();
        return redirect()->back();
    }
}
