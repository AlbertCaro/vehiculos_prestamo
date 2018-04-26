<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event_Type;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\CreateEventTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $categories = Category::all();
        $title = 'Gestionar eventos';
        return view('manage_events',compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $title = 'Agregar evento';
        return view('add_events',compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventTypeRequest $request)
    {
        Event_Type::create($request->all());
        return redirect('tipo_evento')->with('alert', 'Tipo de evento agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event_Type::findOrFail($id);
        $categories = Category::all();
        $select_attribs = ['class' => 'form-control', 'disabled' => ''];
        $title = 'Detalles del evento';
        $show = true;
        return view('add_events',compact('event', 'categories', 'show', 'title', 'select_attribs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event_Type::findOrFail($id);
        $categories = Category::all();
        $select_attribs = ['class' => 'form-control', 'disabled' => ''];
        $title = 'Editar evento';
        return view('add_events',compact('event', 'categories', 'title', 'select_attribs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEventTypeRequest $request, $id)
    {
        $event = Event_Type::findOrFail($id);
        $event->update($request->all());
        return redirect('tipo_evento')->with('alert', 'Información del tipo de evento actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event_Type::findOrFail($id);
        $event->delete();
        return redirect('tipo_evento')->with('alert','Tipo de evento eliminado correctamente.');
    }
}
