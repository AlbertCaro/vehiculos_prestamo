<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;


class VehicleController extends Controller
{
    public function validateForm(Request $request){
        $this->validate($request,[
            'placas'=>'required',
            'modelo'=>'required',
            'capacidad'=>'required'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles=Vehicle::all();
        return view("manage_vehicles", compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("add_vehicles");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $vehicles = Vehicle::create([
            'placas'=>$request['placas'],
            'nombre'=>$request['modelo'],
            'capacidad'=>$request['capacidad'],
            'estado'=> $request['estado']
        ]);


        return redirect()->route('vehiculo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
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
        return view('add_vehicles', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateForm($request);
        $vehiculo = Vehicle::findOrFail($id);
        $vehiculo->update([
            'placas'=>$request['placas'],
            'nombre'=>$request['modelo'],
            'capacidad'=>$request['capacidad'],
        ]);
        return redirect()->route('vehiculo.index');
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
        return redirect()->route('vehiculo.index');
    }
}
