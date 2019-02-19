<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\File;

use App\Event;
use App\Lot;

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

        $user = auth()->user();
        $listModel = Event::select('id', 'name', 'date')->where('user_id', $user->id)->paginate(10);
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
            "date"                      => "required|date|after_or_equal::".date('Y-m-d'),
            "date_end"                  => "required|date|after_or_equal::date",
            "time_end"                  => "required",
            "time_end"                  => "required",
            "place_name"                => "required",
            "place_city"                => "required",
            "place_uf"                  => "required",
            "image"                     => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);
        
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        dd($data["image"]);
        $path = $request->file('image')->store('images', 'public');
        $data["image"] = $path;

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
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $event     = Event::find($id);

        $listCrumbs = json_encode([
            ["title"=>"Dashboard", "url"=>route('dashboard')],
            ["title"=>"Eventos", "url"=>route('eventos.index')],
            ["title"=>"$event->name", "url"=>""]
        ]);
        $listModel = Lot::list($id, 10);
        return view('admin.events.show', compact('listCrumbs', 'listModel', 'event'));
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
            "date"                      => "required|date|after_or_equal::".date('Y-m-d'),
            "date_end"                  => "required|date|after_or_equal::date",
            "time_end"                  => "required",
            "time_end"                  => "required",
            "place_name"                => "required",
            "place_city"                => "required",
            "place_uf"                  => "required",
            "image"                     => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        // Verifica se foi enviada nova imagem
        if ($data["image"] != null){
            $event = Event::find($id);
            $image = $event->image;
            Storage::delete('public/'.$image);//Deleta antiga imagem
            $path = $request->file('image')->store('images', 'public');
            $data["image"] = $path;
        } else {
            // Retira a imagem do update para evitar salvar um valor nulo sob o path
            unset($data["image"]);
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

        $event = Event::find($id);
        if (isset($event)){
            $image = $event->image;
            Storage::delete('public/'.$image);
            $event->delete();
        }
        return redirect()->back();
    }
}
