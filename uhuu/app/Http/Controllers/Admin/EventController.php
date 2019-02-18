<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Event;

class EventController extends Controller
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
            ["title"=>"Lista de Eventos", "url"=>""]
        ]);

        $listModel = Event::select('id', 'name', 'date')->paginate(10);
        return view('admin.events.index', compact('listCrumbs', 'listModel'));
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
            "name"                      => "required",
            "description"               => "required",
            "max_tickets_order"         => "required",
            "date"                      => "required",
            "date_end"                  => "required",
            "time_end"                  => "required",
            "time_end"                  => "required"
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = auth()->user();
        $user->event()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Event::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validation = \Validator::make($data,[
            "name"                      => "required",
            "description"               => "required",
            "max_tickets_order"         => "required",
            "date"                      => "required",
            "date_end"                  => "required",
            "time_end"                  => "required",
            "time_end"                  => "required"
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $user = auth()->user();
        $user->event()->find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->back();
    }
}
