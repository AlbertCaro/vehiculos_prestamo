<?php

namespace App\Http\Controllers;

use App\Event_Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event_Type::all();

        return view('manage_events',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_events');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event_Type::created($request->validate([
            'nombre'=>'nombre',
            'categories_id'=>'categories_id'
        ]));
        return "evento creado exitosamente con el id: ".$event->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function show(Event_Type $event_Type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Event_Type $event_Type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event_Type $event_Type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event_Type $event_Type)
    {
        //
    }
}
