<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Driver;
use App\Http\Requests\GuardaSolicitudRequest;
use App\Licence;
use App\Mail\NuevaSolicitudDeVehiculo;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales'])){
            $solicitudes = Solicitud::all();
        } elseif (auth()->user()->hasRoles(['solicitante'])) {
            $solicitudes = Solicitud::all()->where('solicitante_id', auth()->user()->id);
        } elseif (auth()->user()->hasRoles(['jefe'])) {
            $solicitudes = Solicitud::all()->where('jefe_id', auth()->user()->id);
        }
        /*
        Si es solicitante solo las del solicitante
        si es jefe, las que le han pedido
        si es coordinador de servicios generales, todas
        */
        //dd($solicitudes);
        $title = 'Gestionar solicitudes';
        return view('solicitudes', compact('solicitudes', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $jefes = User::listaByRol('jefe')->pluck(['nombre','id']);
        //dd($jefes);
        return view('new_request', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardaSolicitudRequest $request)
    {
        $conductor = Driver::where('id',$request['txt_codigoC'])->get();
        $id_conductor = null;
        //dd($conductor);
        if($conductor->isEmpty()){
            $c = (new \App\Driver)->create([
                'id'=>$request['txt_codigoC'],
                'nombre'=>$request['txt_nombreC'],
                'celular'=>$request['txt_celularC'],
                'dependencies_id' => $request['dependencia']
            ]);
            $id_conductor = $c->id;
        }else{
            $id_conductor = $request['txt_codigoC'];
        }

        $licencia = Licence::where('numero',$request['txt_licencia'])->get();
        if($licencia->isEmpty()){
            $l = (new \App\Licence)->create([
                'numero'=>$request['txt_licencia'],
                'vencimiento'=>$request['txt_venc'],
                'licence_types_id'=>$request['tipo_licencia'],
                'driver_id'=>$id_conductor,
            ]);

        }
        $contacto = Contact::where('driver_id',$id_conductor)->get();
        if($contacto->isEmpty()){
            $contact = (new \App\Contact)->create([
                'nombre'=>$request['txt_contacto'],
                'parentesco'=>$request['txt_parentesco'],
                'domicilio'=>$request['txt_domicilio'],
                'telefono'=>$request['txt_telefono'],
                'driver_id'=>$id_conductor,
            ]);
        }

        //if($request->has(''))
        //dd($request['txt_fecha'].':00');
       $sol = (new \App\Solicitud)->create([
           'nombre_evento'=>$request['txt_nombreE'],
           'domicilio'=>$request['txt_domicilioE'],
           'escala'=>$request['slc_escala'],
           'personas'=>$request['txt_Personas'],
           'estatus'=>1,
           'fecha_solicitud'=>Carbon::now(),
           'fecha_evento'=>$request['txt_fecha'],
           'fecha_regreso'=>$request['txt_fecha1'],
           'event_types_id'=>$request['tipo_evento'],
           'driver_id'=>$id_conductor,
           'vehicles_id'=>1,
           'solicitante_id'=>auth()->user()->id,
           'jefe_id'=>$request['slc_jefe'],
           'distancia'=>$request['txt_kilometros'],

       ]);

        $jefe = $this->datosJefe($request['slc_jefe']);

        Mail::to($jefe->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));

        alert()->success('Se ha guardado todo exitosamente','Solicitud guardada ok!');

        //Mail::to(auth()->user()->email)
        return redirect()->route('solicitud.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }

    private function datosJefe($idJefe){
        $user = User::findOrFail($idJefe);
        return $user;
    }
}
