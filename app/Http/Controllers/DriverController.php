<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Driver;
use App\Http\Requests\DriverRequest;
use App\Licence;
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
    public function store(DriverRequest $request)
    {
        Driver::create([
            'id' => $request['codigo'],
            'dependencies_id' => $request['dependencia'],
            'nombre' => $request['nombre'],
            'apaterno' => $request['apaterno'],
            'amaterno' => $request['amaterno'],
            'celular' => $request['celular'],
            'domicilio' => $request['domicilio']
        ]);

        Licence::create([
            'numero' => $request['licencia'],
            'vencimiento' => $request['vencimiento'],
            'licence_types_id' => $request['tipo_licencia'],
            'archivo' => "",
            'driver_id' => $request['codigo']
        ]);

        Contact::create([
            'nombre' => $request['nombre_cont'],
            'apaterno' => $request['apaterno_cont'],
            'amaterno' => $request['amaterno_cont'],
            'parentesco' => $request['parentesco_cont'],
            'telefono' => $request['telefono_cont'],
            'domicilio' => $request['domicilio_cont'],
            'driver_id' => $request['codigo']
        ]);

        return redirect()->route('conductor.index');
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
    public function edit($id)
    {
        //Añadido, podemos buscar mediante el método find que recibe como parámetro el id de la clase.
        $driver = Driver::findOrFail($id); //con findOrFail retorna un 404
        $dataExtra = [$driver->licence->licence_types_id, $driver->dependencies_id];
        $licence_type = $driver->licence->licence_types_id;
        $dependence = $driver->dependencies_id;
        return view('add_conductor', compact('driver', 'licence_type', 'dependence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update([
            'dependencies_id' => $request['dependencia'],
            'nombre' => $request['nombre'],
            'apaterno' => $request['apaterno'],
            'amaterno' => $request['amaterno'],
            'celular' => $request['celular'],
            'domicilio' => $request['domicilio']
        ]);

        $driver->licence->update([
            'numero' => $request['licencia'],
            'vencimiento' => $request['vencimiento'],
            'licence_types_id' => $request['tipo_licencia'],
            'archivo' => "",
        ]);

        $driver->contact->update([
            'nombre' => $request['nombre_cont'],
            'apaterno' => $request['apaterno_cont'],
            'amaterno' => $request['amaterno_cont'],
            'parentesco' => $request['parentesco_cont'],
            'telefono' => $request['telefono_cont'],
            'domicilio' => $request['domicilio_cont']
        ]);
        return redirect()->route('conductor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->licence->delete();
        $driver->contact->delete();
        $driver->delete();
        return redirect()->route('conductor.index');
    }
}
