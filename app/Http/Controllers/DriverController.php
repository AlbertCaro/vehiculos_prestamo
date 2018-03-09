<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        return view('manage_drivers', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_conductor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = Driver::create([
            'id' => $request['codigo'],
            'dependencies_id' => $request['dependencia'],
            'nombre' => $request['nombre'],
            'apaterno' => $request['apaterno'],
            'amaterno' => $request['amaterno'],
            'celular' => $request['celular']
        ]);

        $contact = Contact::create([
            'nombre' => $request['nombre_cont'],
            'apaterno' => $request['apaterno_cont'],
            'amaterno' => $request['amaterno_cont'],
            'parentesco' => $request['parentesco_cont'],
            'telefono' => $request['telefono_cont'],
            'drivers_id' => $request['codigo']
        ]);

        return "zi";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
        return dd($driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Driver::where('id', $id)->delete();
        return 'Eliminado: '.$id;
    }
}
