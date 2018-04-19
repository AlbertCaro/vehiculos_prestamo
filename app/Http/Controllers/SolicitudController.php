<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Driver;
use App\Event_Type;
use App\Http\Requests\GuardaSolicitudRequest;
use App\Licence;
use App\Mail\NuevaSolicitudDeVehiculo;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        } elseif (auth()->user()->hasRoles(['jefe'])) {
            $solicitudes = Solicitud::all()->where('jefe_id', auth()->user()->id);
        } elseif (auth()->user()->hasRoles(['solicitante'])) {
            $solicitudes = Solicitud::all()->where('solicitante_id', auth()->user()->id);
        }
        /*
        Si es solicitante solo las del solicitante
        si es jefe, las que le han pedido
        si es coordinador de servicios generales, todas
        */
       // dd($solicitudes);
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
        //dd($jefes);
        $select_attribs = ['class' => 'form-control'];
        $title = "Haz una nueva solicitud";
        return view('new_request', compact('categories', 'title', 'select_attribs'));
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
                'archivo' => $request->file('archivo')->store('/public/licences'),
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
        if ($request->has('otro_evento')) {
            $event_type = (new \App\Event_Type)->create([
                'nombre' => $request['otro_evento'],
                'categories_id' => $request['categoria_evento']
            ])->id;
        } else
            $event_type = $request['tipo_evento'];

       $sol = (new \App\Solicitud)->create([
           'nombre_evento'=>$request['txt_nombreE'],
           'domicilio'=>$request['txt_domicilioE'],
           'escala'=>$request['slc_escala'],
           'personas'=>$request['txt_Personas'],
           'estatus'=>1,
           'fecha_solicitud'=>Carbon::now(),
           'fecha_evento'=>$request['txt_fecha'],
           'fecha_regreso'=>$request['txt_fecha1'],
           'event_types_id'=>$event_type,
           'driver_id'=>$id_conductor,
           'vehicles_id'=>1,
           'solicitante_id'=>auth()->user()->id,
           'jefe_id'=>$request['slc_jefe'],
           'distancia'=>$request['txt_kilometros'],
           'solicita_conductor'=>$request['solicito_conduc'],
           'vehiculo_propio'=>$request['rdio_disp'],

       ]);

        $jefe = User::datosJefe($request['slc_jefe']);

      //  Mail::to($jefe->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));

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
    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $jefe = User::all()->where('id','=', $solicitud->jefe_id)->first();
        $tipo = Event_Type::all()->where('id','=',$solicitud->event_types_id)->first();
        //$jefes = User::listaByRol('jefe')->pluck(['nombre','id']);
        $categories = Category::all();
        $select_attribs = ['class' => 'form-control'];
        //dd($jefes);
        $title = "Detalles de la solicitud";
        return view('show_request', compact('solicitud','categories','tipo', 'jefe', 'title', 'select_attribs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(GuardaSolicitudRequest $request, $id)
    {

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

    public function assignRequest($id)
    {
        $solicitud = \App\Solicitud::findOrFail($id);
        $empty_option = ['' => '- Selecciona una opción -'];

        if ($solicitud->vehicles_id == null) {
            $vehiculos = $empty_option + DB::table('vehicles')->
            leftJoin('requests','vehicles.id','=','requests.vehicles_id')->
            select('vehicles.id', 'vehicles.nombre')->
            whereNotBetween(DB::raw("'{$solicitud->fecha_evento}'"), ['requests.fecha_evento','requests.fecha_regreso'])->
            get()->pluck('nombre','id')->toArray();
        }

        if ($solicitud->drivers_id == null) {
            $conductores = $empty_option + DB::table('drivers')->
            leftJoin('requests','drivers.id','=','requests.driver_id')->
            select('drivers.id', 'drivers.nombre', 'requests.fecha_evento', 'requests.fecha_regreso')->
            whereNotBetween(DB::raw("'{$solicitud->fecha_evento}'"), ['requests.fecha_evento','requests.fecha_regreso'])->
            get()->pluck('nombre','id')->toArray();
        }

        $vehiculo = null;
        $conductor = null;
        $select_attribs = ['class' => 'form-control'];

        return view('assign_request',
            compact('vehiculos', 'conductores', 'conductor', 'vehiculo', 'select_attribs', 'id'));
    }

    public function saveDriverVehicleRequest(Request $request)
    {
        $solicitud = \App\Solicitud::findOrFail($request['solicitud']);
        $data = [];
        $conductor = false;
        $message = "Se ha asignado ";

        if ($request->has('conductor')) {
            $data = $data + ['driver_id' => $request['conductor']];
            $message = $message."conductor";
            $conductor = true;
        }
        if ($request->has('vehiculo')) {
            $data = $data + ['vehicles_id' => $request['vehiculo']];
            if ($conductor)
                $message = $message." y ";
            $message = $message."vehículo";
        }

        $message = $message." correctamente";
        $solicitud->update($data);

        return redirect()->route('solicitud.index')->with('alert', $message);
    }

    public function aceptarSolicitud($id){

        $solicitud = Solicitud::findOrFail($id);
        $estado = 0;
        $mensaje = "Mensaje por defecto";
        $titulo = "Título por defecto";

        switch ($solicitud->estatus){
            case 1:
                if(auth()->user()->hasRoles(['administrativo'])){
                    $estado = 3;
                    $mensaje = "Se ha aprobado correctamente como secretario administrativo, correo a coordinador srvgrales";
                    $titulo = "Ha aprobado la solicitud flujo anormal";

                }else{
                    if(auth()->user()->hasRoles(['jefe']) || auth()->user()->hasRoles(['asistente_jefe'])){//también la asistente del jefe puede autorizar
                        $mensaje = "Se ha aprobado correctamente como jefe o asistente, correo a secretario administrativo";
                        $titulo = "Ha aprobado la solicitud";
                        $estado=2;
                    }
                }
                break;
            case 2:
                if(auth()->user()->hasRoles(['administrativo'])){
                    $estado = 3;
                    $mensaje = "Se ha aprobado correctamente como secretario administrativo, correo a coordinador srvgrales";
                    $titulo = "Ha aprobado la solicitud flujo normal";

                }
                break;
            case 3:
                if(auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles['asist_srv_grales']){//también la asistente del coordinador puede actualizar
                    $estado=4;
                    $mensaje = "Se ha aprobado correctamente como coordinador de servicios generales";
                    $titulo = "Ha aprobado la solicitud";
                }
                break;
            case 4:
                //está aprobada ya, ver qué hacer en estos casos
                break;
            case 5:
                //está rechazada por alguna instancia
                if(auth()->user()->hasRoles(['coord_servicios_generales'])){//también la asistente del coordinador puede actualizar
                    return "La solicitud pasa a 4";
                }
                break;
            default:
                $estado = $solicitud->estatus;
        }

        $solicitud->estatus = $estado;
        $solicitud->save();
        //alert("")
        alert($mensaje,$titulo);
        return "Aceptamos, compa!".$id.$mensaje.$titulo;
    }

    public function rechazarSolicitud($id){
        return "Se rechaza y pasa a estatus 5";
    }
}
