<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Vehicle;
use Illuminate\Http\Request;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles=Vehicle::all();
        $title = 'Gestionar vehiculos'; //Título de la página
        return view("manage_vehicles", compact('vehicles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Agregar vehiculo';
        return view("add_vehicles", compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {
        $vehicles = Vehicle::create([
            'placas'=>$request['placas'],
            'nombre'=>$request['modelo'],
            'capacidad'=>$request['capacidad'],
            'estado'=> $request['estado']
        ]);


        return redirect()->route('vehiculo.index')->with('alert', 'Vehiculo agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $title = 'Detalles del vehiculo';
        $show = true;
        return view('add_vehicles', compact('vehicle', 'placas', 'nombre', 'capacidad', 'show', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $title = 'Editar conductor';
        return view('add_vehicles', compact('vehicle', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, $id)
    {
        $vehiculo = Vehicle::findOrFail($id);
        $vehiculo->update([
            'placas'=>$request['placas'],
            'nombre'=>$request['modelo'],
            'capacidad'=>$request['capacidad'],
        ]);
        return redirect()->route('vehiculo.index')->with('alert', 'Información del vehiculos actualizada correctamente.');
    }

    /**   LL
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();
        return redirect()->route('vehiculo.index')->with('alert','vehiculo eliminado correctamente.');
    }
}
