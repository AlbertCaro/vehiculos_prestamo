<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Driver;
use App\Http\Requests\DriverRequest;
use App\Licence;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        $select_attribs = ['class' => 'form-control'];
        return view('add_conductor', compact('select_attribs'));
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

        return redirect()->route('conductor.index')->with('alert','Conductor agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        $licence_type = $driver->licence->licence_types_id;
        $dependence = $driver->dependencies_id;
        $select_attribs = ['class' => 'form-control', 'disabled' => ''];
        $show = true;
        return view('add_conductor', compact('driver', 'licence_type', 'dependence', 'show', 'select_attribs'));
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
        $licence_type = $driver->licence->licence_types_id;
        $dependence = $driver->dependencies_id;
        $select_attribs = ['class' => 'form-control'];
        return view('add_conductor', compact('driver', 'licence_type', 'dependence', 'select_attribs'));
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
        return redirect()->route('conductor.index')->with('alert','Información del conductor actualizada correctamente.');
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
        return redirect()->route('conductor.index')->with('alert','Conductor eliminado correctamente.');
    }

    public function autocompletar()
    {
        $term = Input::get('term');
        $results = array();

        $queries = DB::table('drivers')
            ->join('licences', 'drivers.id', '=', 'licences.driver_id')
            ->join('contacts', 'drivers.id', '=', 'contacts.driver_id')
            ->join('licence_types', 'licences.licence_types_id', '=', 'licence_types.id')
            ->select('drivers.*', 'licences.numero as num_licencia', 'licences.archivo', 'licences.vencimiento', 'licence_types.id as tipo', 'contacts.nombre as nombrec', 'contacts.apaterno as apaternoc', 'contacts.amaterno as amaternoc', 'contacts.parentesco', 'contacts.telefono as telefonoc','contacts.domicilio')
            ->where('drivers.id', 'LIKE', '%' . $term . '%')
            ->get();
        //dd($queries);
        foreach ($queries as $query) {
            $results[] = ['value' => $query->id, 'dependencia' => $query->dependencies_id, 'nombre' => $query->nombre . ' ' . $query->apaterno . ' ' . $query->amaterno, 'celular' => $query->celular, 'num_licencia' => $query->num_licencia, 'archivo' => $query->archivo, 'vencimiento' => $query->vencimiento, 'tipo' => $query->tipo, 'nombre_contacto' => $query->nombrec . ' ' . $query->apaternoc . ' ' . $query->amaternoc, 'parentesco' => $query->parentesco, 'tel_cont' => $query->telefonoc,'domicilio'=>$query->domicilio];
        }

        return $results;
    }

}
