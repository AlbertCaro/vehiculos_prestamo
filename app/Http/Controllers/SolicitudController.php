<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Driver;
use App\Event_Type;
use App\Http\Requests\GuardaSolicitudRequest;
use App\Http\Requests\SolicitudRequest;
use App\Licence;
use App\Mail\NuevaSolicitudDeVehiculo;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudController extends Controller
{
    private $date_interval;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @param Request $request
     **->Valida solo la parte del formulario que queda habilitada si se solicita conductor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function validateWithDriver(Request $request){
        $this->validate($request,[
            'txt_nombreE'=>'required|max:245',
            'txt_fecha1'=>'required',
            'tipo_evento'=>'required',
            'jefe_id'=>'required|numeric',
            'txt_domicilioE'=>'required|max:191',
            'slc_escala'=>'required|max:191',
            'txt_Personas'=>'required|max:191',
            'txt_kilometros'=>'required|max:191',
            'txt_fecha'=>'required',
        ]);
    }

    /**
     * @param Request $request
     * Valida el formulario completo de solicitud
     */
    function validateWithOutDriver(Request $request){
        $this->validate($request,[
            'txt_nombreE'=>'required|max:245',
            'txt_fecha1'=>'required',
            'tipo_evento'=>'required',
            'jefe_id'=>'required|numeric',
            'txt_domicilioE'=>'required|max:191',
            'slc_escala'=>'required|max:191',
            'txt_Personas'=>'required|max:191',
            'txt_kilometros'=>'required|max:191',
            'txt_fecha'=>'required',//
            'txt_codigoC'=>'required',
            'txt_nombreC'=>'required',
            'txt_celularC'=>'required',
            'dependencia'=>'required',
            'txt_licencia'=>'required',
            'txt_venc'=>'required',
            'tipo_licencia'=>'required',
            'archivo'=>'required',
            'txt_contacto'=>'required',
            'txt_parentesco'=>'required',
            'txt_domicilio'=>'required',
            'txt_telefono'=>'required',
        ]);
    }

    public function index()
    {
        if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles(['asistente_serv_generales'])){
            $solicitudes = Solicitud::all();
        }elseif(auth()->user()->hasRoles(['administrativo']) && auth()->user()->hasRoles(['jefe'])){
            $solicitudes = Solicitud::where('estatus',2)
            ->orWhere('jefe_id',auth()->user()->id)
                ->whereIn('estatus',[1,2])
            ->get();
        }elseif (auth()->user()->hasRoles(['jefe']) || auth()->user()->hasRoles(['asistente_jefe'])) {
            if(auth()->user()->hasRoles(['jefe'])){
                $solicitudes = Solicitud::all()
                    ->where('jefe_id', auth()->user()->id)
                    ->where('estatus',1);
            }elseif(auth()->user()->hasRoles(['asistente_jefe'])){
                $asistente = auth()->user();
               // dd($asistente::jefe($asistente->id)[0]->id_jefe);
                $solicitudes = Solicitud::all()
                    ->where('jefe_id', $asistente::jefe($asistente->id)[0]->id_jefe)
                    ->where('estatus',1);
            }

        } elseif(auth()->user()->hasRoles(['solicitante'])){
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
    public function store(Request $request)
    {
        $id_conductor = null;
        if ($request->has('solicito_conduc')) {
            $this->validateWithDriver($request);
        }else{
            $this->validateWithOutDriver($request);
        }
            if (!$request->has('solicito_conduc')) {
                $conductor = Driver::where('id', $request['txt_codigoC'])->get();

                //dd($conductor);
                if ($conductor->isEmpty()) {
                    $c = (new \App\Driver)->create([
                        'id' => $request['txt_codigoC'],
                        'nombre' => $request['txt_nombreC'],
                        'celular' => $request['txt_celularC'],
                        'dependencies_id' => $request['dependencia']
                    ]);
                    $id_conductor = $c->id;
                } else {
                    $id_conductor = $request['txt_codigoC'];
                }


                $licencia = Licence::where('numero', $request['txt_licencia'])->get();
                if ($licencia->isEmpty()) {
                    $l = (new \App\Licence)->create([
                        'numero' => $request['txt_licencia'],
                        'vencimiento' => $request['txt_venc'],
                        'archivo' => $request->file('archivo')->
                        storeAs('/public/licences', $request['txt_codigoC'].".".$request['archivo']->getClientOriginalExtension()),
                        'licence_types_id' => $request['tipo_licencia'],
                        'driver_id' => $id_conductor,
                    ]);

                    /*if ($request->hasFile('archivo')) {
                        $licencia->archivo = $request->file('archivo')->store('/public/licences');
                        $licencia->save();
                    }*/
                }
                $contacto = Contact::where('driver_id', '=', $id_conductor)->get();
                if ($contacto->isEmpty()) {
                    $contact = (new \App\Contact)->create([
                        'nombre' => $request['txt_contacto'],
                        'parentesco' => $request['txt_parentesco'],
                        'domicilio' => $request['txt_domicilio'],
                        'telefono' => $request['txt_telefono'],
                        'driver_id' => $id_conductor,
                    ]);
                }
            }


        //if($request->has(''))
        //dd($request['txt_fecha'].':00');
        if ($request->has('otro_evento')) {
            $this->validate($request,[
               'categoria_evento' => 'required|numeric',
                'otro_evento' => 'required'
            ]);
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
           'fecha_evento'=>Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha'].':00')->toDateTimeString(),
           'fecha_regreso'=>Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha1'].':00')->toDateTimeString(),
           'event_types_id'=>$event_type,
           'driver_id'=>$id_conductor,
           'solicitante_id'=>auth()->user()->id,
           'jefe_id'=>$request['jefe_id'],
           'distancia'=>$request['txt_kilometros'],
           'solicita_conductor'=>$request['solicito_conduc'],
           'vehiculo_propio'=>$request['rdio_disp'],

       ]);

       //dd($request['slc_jefe']);
        $jefe = User::datosJefe($request['jefe_id']);

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
    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $jefe = User::all()->where('id','=', $solicitud->jefe_id)->first();
        $tipo = Event_Type::all()->where('id','=',$solicitud->event_types_id)->first();
        $conductor = DB::table('drivers')
            ->join ('dependences','drivers.dependencies_id','=','dependences.id')
            ->join ('licences','drivers.id','=','licences.driver_id')
            ->join ('licence_types','licences.id','=','licence_types.id')
            ->join ('contacts','contacts.driver_id','=','drivers.id')
            ->select('dependences.nombre AS depen_nombre', 'drivers.*', 'licences.*', 'licence_types.tipo',
                'contacts.nombre AS cont_nombre', 'contacts.apaterno AS cont_paterno', 'contacts.amaterno AS cont_materno', 'contacts.parentesco', 'contacts.telefono', 'contacts.domicilio')
            ->where('drivers.id', '=',$solicitud->driver_id)
            ->first();
        //$conductor = Driver::findOrFail($solicitud->driver_id);
        //$conductor = Driver::all()->where('id', '=',$solicitud->driver_id)->first();
        //$jefes = User::listaByRol('jefe')->pluck(['nombre','id']);
        $categories = Category::all();
        $select_attribs = ['class' => 'form-control'];
        //dd($jefes);
        $title = "Detalles de la solicitud";
        return view('show_request', compact('solicitud','categories','tipo','conductor', 'jefe', 'title', 'select_attribs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $title = "Editar solicitud";
        return view('edit_request',compact('title','solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $d = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha'].':00')->toDateTimeString();
        $d1 = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha1'].':00')->toDateTimeString();
       // dd($d1);
        $this->validate($request, [
           'txt_fecha' => 'required',
           'txt_fecha1' => 'required'
        ]);
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->fecha_evento = $d;
        $solicitud->fecha_regreso = $d1;
        $solicitud->save();
        dd($solicitud);
        return redirect('solicitud')->with('alert', 'Información de la solicitud actualizada correctamente.');
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
        $GLOBALS['date_interval'] = [
            Carbon::parse($solicitud->fecha_evento)->toDateString(),
            Carbon::parse($solicitud->fecha_regreso)->toDateString()
        ];

        if ($solicitud->vehicles_id === null) {
            $vehiculos = $empty_option + DB::table('vehicles')
                    ->leftJoin('requests','vehicles.id','=','requests.vehicles_id')
                    ->select('vehicles.id', 'vehicles.nombre')
                    ->where(function ($query) {
                        $query
                            ->whereNull('requests.fecha_evento')
                            ->whereNull('requests.fecha_evento');
                    })
                    ->orWhere(function ($query) {
                        $query
                            ->whereNotBetween(DB::raw('DATE(requests.fecha_evento)'), $GLOBALS['date_interval'])
                            ->whereNotBetween(DB::raw('DATE(requests.fecha_regreso)'), $GLOBALS['date_interval'])
                            ->where(DB::raw('DATE(requests.fecha_evento)'), '!=', $GLOBALS['date_interval'][0])
                            ->where(DB::raw('DATE(requests.fecha_evento)'), '!=', $GLOBALS['date_interval'][1])
                            ->where(DB::raw('DATE(requests.fecha_regreso)'), '!=', $GLOBALS['date_interval'][0])
                            ->where(DB::raw('DATE(requests.fecha_regreso)'), '!=', $GLOBALS['date_interval'][1]);
                    })->get()->pluck('nombre','id')->toArray();
        }

        if ($solicitud->driver_id === null) {
            $conductores = $empty_option + DB::table('drivers')
                    ->leftJoin('requests','drivers.id','=','requests.driver_id')
                    ->select('drivers.id', 'drivers.nombre', 'requests.fecha_evento', 'requests.fecha_regreso')
                    ->where(function ($query) {
                        $query
                            ->whereNull('requests.fecha_evento')
                            ->whereNull('requests.fecha_evento');
                    })
                    ->orWhere(function ($query) {
                        $query
                            ->whereNotBetween(DB::raw('DATE(requests.fecha_evento)'), $GLOBALS['date_interval'])
                            ->whereNotBetween(DB::raw('DATE(requests.fecha_regreso)'), $GLOBALS['date_interval'])
                            ->where(DB::raw('DATE(requests.fecha_evento)'), '!=', $GLOBALS['date_interval'][0])
                            ->where(DB::raw('DATE(requests.fecha_evento)'), '!=', $GLOBALS['date_interval'][1])
                            ->where(DB::raw('DATE(requests.fecha_regreso)'), '!=', $GLOBALS['date_interval'][0])
                            ->where(DB::raw('DATE(requests.fecha_regreso)'), '!=', $GLOBALS['date_interval'][1]);
                    })->get()->pluck('nombre','id')->toArray();
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
        Mail::to($solicitud->user->email)->send(new NuevaSolicitudDeVehiculo("Solicitud aprobada","La solicitud que ha realizado, fue aprobada por todas las instancias. Puede revisarla ingresando al sistema."));

        $encargadoVehiculos = User::listaByRol('vehiculos');
        $vehiculo = $solicitud->vehicle;
        foreach ($encargadoVehiculos as $encargado){
            Mail::to($encargado->email)->send(new NuevaSolicitudDeVehiculo("Se ha prestado un vehículo","Se realizó una petición de vehículo y se ha asignado el ".$vehiculo->modelo." placas: ".$vehiculo->placas.". Para el ".Carbon::parse($solicitud->fecha_evento)->format('d-m-Y H:i:s')));
        }

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
                    $mensaje = "Se ha aprobado correctamente la solicitud como secretario administrativo, se ha enviado un correo al coordinador de servicios generales";
                    $titulo = "Ha aprobado la solicitud";
                    $coordGrales = User::listaByRol('coord_servicios_generales');
                    $asistenteGrales = User::listaByRol('asist_srv_grales');
                    //dd($coordGrales);

                    foreach ($coordGrales as $coord){
                        Mail::to($coord->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }
                    foreach ($asistenteGrales as $asistenteGral){
                        Mail::to($asistenteGral->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }


                }else{
                    if(auth()->user()->hasRoles(['jefe']) || auth()->user()->hasRoles(['asistente_jefe'])){//también la asistente del jefe puede autorizar
                        $mensaje = "Se ha aprobado correctamente la solicitud, se ha enviado un correo al secretario administrativo";
                        $titulo = "Ha aprobado la solicitud";
                        $estado=2;
                        $secretariosAdministrativos = User::listaByRol('administrativo');

                        foreach ($secretariosAdministrativos as $secretariosAdministrativo) {
                            TODO: Mail::to($secretariosAdministrativo->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                        }

                    }
                }
                break;
            case 2:
                if(auth()->user()->hasRoles(['administrativo'])){
                    $estado = 3;
                    $mensaje = "Se ha aprobado correctamente la solicitud como secretario administrativo, se ha enviado un correo al coordinador de servicios generales";
                    $titulo = "Ha aprobado la solicitud flujo normal";

                    $coordGrales = User::listaByRol('coord_servicios_generales');
                    $asistenteGrales = User::listaByRol('asist_srv_grales');
                    //dd($coordGrales);

                    foreach ($coordGrales as $coord){
                        Mail::to($coord->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }
                    foreach ($asistenteGrales as $asistenteGral){
                        Mail::to($asistenteGral->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }
                }
                break;
            case 3:
                if(auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles['asist_srv_grales']){//también la asistente del coordinador puede actualizar
                    $estado=4;
                    $mensaje = "Se ha aprobado correctamente como coordinador de servicios generales";
                    $titulo = "Ha aprobado la solicitud";
                    Mail::to($solicitud->user->email)->send(new NuevaSolicitudDeVehiculo("Solicitud aprobada","La solicitud que ha realizado, fue aprobada por todas las instancias. Puede revisarla ingresando al sistema."));
                }
                break;
            case 4:
                //está aprobada ya, ver qué hacer en estos casos
                break;
            case 5:
                //está rechazada por alguna instancia
                if(auth()->user()->hasRoles(['coord_servicios_generales'])){//también la asistente del coordinador puede actualizar
                    $estado=4;
                    $mensaje = "Se ha aprobado la solicitud por el coordinador de Servicios Generales";
                    $titulo = "Solicitud antes rechazada, ha sido aprobada";
                    Mail::to($solicitud->user->email)->send(new NuevaSolicitudDeVehiculo("Solicitud aprobada","La solicitud que ha realizado, fue aprobada por todas las instancias. Puede revisarla ingresando al sistema."));

                }
                break;
            default:
                $estado = $solicitud->estatus;
        }

        $solicitud->estatus = $estado;
        $solicitud->save();
        //alert("")
        alert()->success($mensaje,$titulo);

        return redirect()->route('solicitud.index');
    }

    public function rechazarSolicitud(Request $request){
        $solicitud = Solicitud::findOrFail($request['id_solicitud']);
        $solicitud->estatus=5;
        $solicitud->motivo_rechazo=$request['motivo_rechazo'];
        $solicitud->save();

        alert()->success("La solicitud se ha rechazado correctamente");

        Mail::to($solicitud->user->email)->send(new NuevaSolicitudDeVehiculo("Solicitud rechazada","La solicitud \"".$solicitud->nombre_evento."\" Ha sido rechazada por alguna instancia. Motivo de rechazo: ".$solicitud->motivo_rechazo."."));

        return redirect()->route('solicitud.index');
    }

    public function busquedaSolicitud(Request $request) {
        $GLOBALS['date_interval'] = [
            Carbon::parse($request->fecha)->format('Y-m-d'),
            Carbon::parse($request->fecha2)->format('Y-m-d')
        ];

        if (!is_null($request->fecha) && !is_null($request->fecha2) && !is_null($request->estatus) && $request['estatus'] !== 0) {
            $solicitudes = DB::table('requests')
                ->where(function ($query) {
                    $query
                        ->whereBetween(DB::raw('DATE(requests.fecha_evento)'), $GLOBALS['date_interval'])
                        ->whereBetween(DB::raw('DATE(requests.fecha_regreso)'), $GLOBALS['date_interval']);
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][0]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][0]));
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][0]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][1]));
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][1]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][1]));
                })
                ->where('requests.estatus','==', $request->estatus)
                ->get();
        } elseif (!is_null($request->fecha) && !is_null($request->fecha2) && is_null($request->estatus) && $request['estatus'] === 0) {
            $solicitudes = DB::table('requests')
                ->where(function ($query) {
                    $query
                        ->whereBetween(DB::raw('DATE(requests.fecha_evento)'), $GLOBALS['date_interval'])
                        ->whereBetween(DB::raw('DATE(requests.fecha_regreso)'), $GLOBALS['date_interval']);
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][0]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][0]));
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][0]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][1]));
                })
                ->orWhere(function ($query) {
                    $query
                        ->where(DB::raw('DATE(requests.fecha_evento)', '==', $GLOBALS['date_interval'][1]))
                        ->where(DB::raw('DATE(requests.fecha_regreso)', '==', $GLOBALS['date_interval'][1]));
                })
                ->get();
        } elseif (is_null($request->fecha) && is_null($request->fecha2) && !is_null($request->estatus) && $request['estatus'] !== 0) {
            $solicitudes = DB::table('requests')
                ->where('requests.estatus', '=', $request->estatus)
                ->get();
        } elseif ((is_null($request->fecha) && is_null($request->fecha2) && !is_null($request->estatus) && $request['estatus'] === 0) or
            (is_null($request->fecha) && is_null($request->fecha2) && is_null($request->estatus))) {
            $solicitudes = DB::table('requests')
                ->get();
        }
        return view('request_search_table', compact('solicitudes'));
    }
}
