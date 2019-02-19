<?php

namespace App\Http\Controllers\Admin;

use App\Lot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'price' => 'required|numeric',
            'tickets' => 'required|integer',
            'event_id' => 'required|integer'
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        Lot::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Lot::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function edit(Lot $lot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validation = \Validator::make($data,[
            'price' => 'required|numeric',
            'tickets' => 'required|integer'
        ]);

        // Caso não seja selecionada a opção de meia-entrada deve-se setar o valor como "N"
        if(!isset($data['half_entrance'])){
            $data['half_entrance'] = 'N';
        }
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        Lot::find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lot::find($id)->delete();
        return redirect()->back();
    }
}
