<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Driver;
use App\Event_Type;
use App\Http\Requests\ObservacionesRequest;
use App\Licence;
use App\Mail\NuevaSolicitudDeVehiculo;
use App\Observacion;
use App\Solicitud;
use App\User;
use App\Vehicle;
use Carbon\Carbon;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use UxWeb\SweetAlert\SweetAlert;

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



    public function index()
    {
        //dd(Solicitud::all()[0]->fecha_evento>=Carbon::now()->format('Y-m-d H:i:s'));
        if(auth()->user()->hasRoles(['admin']) || auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles(['asistente_serv_generales'])){
            $hoy = Carbon::now()->format('Y-m-d H:i:s');
            //dd(date($hoy));
            $solicitudes = Solicitud::where('fecha_regreso','>=',date($hoy))
                ->where('estatus','<>',5)->where('estatus','<>',4)->orderBy("fecha_evento","ASC")->get();
            $aprobadas = Solicitud::where('fecha_regreso','>=',date($hoy))
                ->where('estatus','=',4)->orderBy("fecha_evento","ASC")->get();

            //dd($solicitudes);
        } elseif(auth()->user()->hasRoles(['administrativo']) || auth()->user()->hasRoles(['jefe'])){
            if (auth()->user()->hasRoles(['administrativo']) && auth()->user()->hasRoles(['jefe'])) {
                $solicitudes = Solicitud::where('estatus',"=",2)
                    ->orWhere('jefe_id', auth()->user()->id)
                    ->whereIn('estatus',[1,2])

                    ->get();
                $aprobadas = collect();
//->where('fecha_evento','>',Carbon::now())
            } else {
                if (auth()->user()->hasRoles(['administrativo'])) {
                    $solicitudes = Solicitud::where('estatus', '=', 2)->where('fecha_evento','>',Carbon::now())->get();
                    $aprobadas = collect();
                   // dd($solicitudes);
                } else if (auth()->user()->hasRoles(['jefe'])) {
                    $solicitudes = Solicitud::where('estatus', '=', 1)->
                    where('jefe_id', '=', auth()->user()->id)->get();
                    $aprobadas = collect();
                    //->where('fecha_evento','>',Carbon::now())->where('fecha_evento','>',Carbon::now()->format("Y-m-d H:i:s"))
                }
            }
        } elseif (auth()->user()->hasRoles(['jefe']) || auth()->user()->hasRoles(['asistente_jefe'])) {
            if(auth()->user()->hasRoles(['jefe'])){
                $solicitudes = Solicitud::where('jefe_id', auth()->user()->id)
                    ->where('estatus',"=",1)->where('fecha_evento','>',Carbon::now())->get();
                $aprobadas = collect();
            } elseif(auth()->user()->hasRoles(['asistente_jefe'])){
                $asistente = auth()->user();
                // dd($asistente::jefe($asistente->id)[0]->id_jefe);
                $solicitudes = Solicitud::where('jefe_id', $asistente::jefe($asistente->id)[0]->id_jefe)
                    ->where('estatus',"=",1)->get();
                $aprobadas = collect();
                ////->where('fecha_evento','>',Carbon::now())
            }

        } elseif(auth()->user()->hasRoles(['solicitante'])){
            $solicitudes = Solicitud::all()->where('solicitante_id', auth()->user()->id);
            $aprobadas = collect();
        } elseif(auth()->user()->hasRoles(['vehiculos'])){
            $hoy = Carbon::now()->format('Y-m-d H:i:s');
            $solicitudes = Solicitud::where('estatus',"=","4")->where('fecha_regreso','>=',date($hoy))->get();
            $aprobadas = collect();
        }
        /*
        Si es solicitante solo las del solicitante
        si es jefe, las que le han pedido
        si es coordinador de servicios generales, todas
        */
        // dd($solicitudes);
        $title = 'Gestionar solicitudes';
        return view('solicitudes', compact('solicitudes', 'title','aprobadas'));

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
        $tipo_evento = null;
        return view('new_request', compact('categories', 'title', 'select_attribs', 'tipo_evento'));
    }

    private function getCarbonDate($date) {
        return Carbon::parse(str_replace('/', '-', explode(" ", $date)[0]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $fecha_licencia = Carbon::parse($request->txt_venc);
            $message = "";
            if ($fecha_licencia < Carbon::now())
                $message = 'La licencia del conductor está vencida.';
            else if ($fecha_licencia < $this->getCarbonDate($request->txt_fecha))
                $message = 'La licencia del conductor estará vencida antes del evento.';
            else if ($fecha_licencia <= $this->getCarbonDate($request->txt_fecha1))
                $message = 'La licencia del conductor se vencerá durante el evento.';

            if ($message != "") {
                return redirect()->route('solicitud.create')->with('alert', $message);
            }
        } catch (\Exception $exception) {
            dd($exception);
        }


        $id_conductor = null;

        $this->validateWithOutDriver($request);

        //dd($request->all());
        //if (!$request->has('solicito_conduc')) {
        $conductor = Driver::where('id','=', $request['txt_codigoC'])->get();


        if ($conductor->isEmpty()) {
            $c = Driver::create([
                'id' => $request['txt_codigoC'],
                'nombre' => $request['txt_nombreC'],
                'celular' => $request['txt_celularC'],
                'dependencies_id' => $request['dependencia']
            ]);

            $c2 = Driver::findOrFail($request['txt_codigoC']);
            $conductor =  $c2;

        }else{
            $conductor = $conductor[0];
        }
        // dd($conductor->id);
        $id_conductor = $conductor->id;

        //dd($conductor,$id_conductor);


        $diagonal = strpos($request['txt_venc'],'/');
        //dd($request['txt_venc'],$diagonal);

        if($diagonal > 0) {

            $fecha_form = $request['txt_venc'];

            //dd($fecha_form);
            $fecha_vencimiento = Carbon::createFromFormat('d/m/Y',$fecha_form)->toDateString();
            //dd($fecha_vencimiento);
        } else {
            $fecha_vencimiento = Carbon::parse($request['txt_venc'])->format('Y-m-d');
        }
        //dd($conductor,$id_conductor,$fecha_vencimiento);
        $licencia = Licence::where('numero','=', $request['txt_licencia'])->get();
        ///dd($id_conductor);
        if ($licencia->isEmpty()) {
            $l = Licence::create([
                'numero' => $request['txt_licencia'],
                'vencimiento' => $fecha_vencimiento,
                'licence_types_id' => $request['tipo_licencia'],
                'driver_id' => $id_conductor,
            ]);

            if($request['subir_archivo']=="1"){
                $this->validarLicencia($request);
            }
            if($request->hasFile('archivo')){
                $l->archivo = $request->file('archivo')->
                storeAs('', $request['txt_codigoC'].".".$request['archivo']->
                    getClientOriginalExtension());
                $l->save();
            }

        }
        $contacto = Contact::where('driver_id', '=', $id_conductor)->get();
        if ($contacto->isEmpty()) {
            $contact = Contact::create([
                'nombre' => $request['txt_contacto'],
                'parentesco' => $request['txt_parentesco'],
                'domicilio' => $request['txt_domicilio'],
                'telefono' => $request['txt_telefono'],
                'driver_id' => $id_conductor,
            ]);
        }
        //dd($l,$contact);
        //}


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

        $sol = Solicitud::create([
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
            'observaciones'=>$request['observaciones'],

        ]);

        //dd($request['slc_jefe']);
        $jefe = User::datosJefe($request['jefe_id']);

        Mail::to($jefe->email)->send(new  NuevaSolicitudDeVehiculo("Asunto pendiente, nueva solicitud de vehículo","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
        Mail::to(env('MAIL_USERNAME'))->send(new  NuevaSolicitudDeVehiculo("Asunto pendiente, nueva solicitud de vehículo","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));

        if($jefe->asistente !== null){
            Mail::to($jefe->asistente->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente, nueva solicitud de vehículo","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
        }
        //Mail::to(auth()->user()->email)

        alert()->success('Se ha guardado todo exitosamente','Solicitud guardada ok!');
        return redirect()->route('solicitud.index');
    }

    public function validarLicencia(Request $request){
        $this->validate($request,[
            'archivo'=>'required|max:2000|mimes:jpg,jpeg,pdf,doc,docx'
        ]);
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
            'txt_contacto'=>'required',
            'txt_parentesco'=>'required',
            'txt_domicilio'=>'required',
            'txt_telefono'=>'required',
        ]);
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

        try {
            $this->authorize('owner', $solicitud);
        } catch (AuthorizationException $e) {
            return view('errors.no_autorizado');
        }

        $jefe = User::all()->where('id','=', $solicitud->jefe_id)->first();
        $tipo = Event_Type::all()->where('id','=',$solicitud->event_types_id)->first();
        $conductor = Driver::find($solicitud->driver_id);

        if($conductor == null){
            $title = "Detalles de la solicitud";
            return view('show_request', compact('solicitud','categories','tipo', 'jefe', 'title'));
        }else{
            $categories = Category::all();
            $select_attribs = ['class' => 'form-control'];
            $title = "Detalles de la solicitud";
            return view('show_request', compact('solicitud','categories','tipo','conductor', 'jefe', 'title', 'select_attribs'));
        }

        //dd($jefes);

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
        try {
            $this->authorize('owner', $solicitud);
        } catch (AuthorizationException $e) {
            return view('errors.no_autorizado');
        }
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
        $solicitud = Solicitud::findOrFail($id);

        $this->authorize('owner',$solicitud);

        $cambiar = false;

        if((Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_evento)->format('d-m-Y H:i:s') != $request['txt_fecha']) && (Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_regreso)->format('d-m-Y H:i:s') != $request['txt_fecha1'])){
            $d = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha'].':00')->toDateTimeString();
            $d1 = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha1'].':00')->toDateTimeString();
            $cambiar = true;
        }elseif((Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_evento)->format('d-m-Y H:i:s') == $request['txt_fecha']) && (Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_regreso)->format('d-m-Y H:i:s') != $request['txt_fecha1'])){
            $d = Carbon::createFromFormat('d-m-Y H:i:s',$request['txt_fecha'])->toDateTimeString();
            $d1 = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha1'].':00')->toDateTimeString();
            $cambiar = true;
        }elseif ((Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_evento)->format('d-m-Y H:i:s') != $request['txt_fecha']) && (Carbon::createFromFormat('Y-m-d H:i:s',$solicitud->fecha_regreso)->format('d-m-Y H:i:s') == $request['txt_fecha1'])){
            $d = Carbon::createFromFormat('d/m/Y H:i:s',$request['txt_fecha'].':00')->toDateTimeString();
            $d1 = Carbon::createFromFormat('d-m-Y H:i:s',$request['txt_fecha1'])->toDateTimeString();
            $cambiar=true;
        }else{
            $cambiar = false;
        }

        // dd($d1);
        $this->validate($request, [
            'txt_fecha' => 'required',
            'txt_fecha1' => 'required'
        ]);
        if($cambiar){
            $solicitud->fecha_evento = $d;
            $solicitud->fecha_regreso = $d1;
            $solicitud->save();
            return redirect('solicitud')->with('alert', 'Información de la solicitud actualizada correctamente.');
        }else{
            return redirect('solicitud')->with('alert', 'No se detectaron cambios.');
        }

        //dd($solicitud);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();
        return redirect('solicitud')->with('alert', 'Se ha eliminado la solicitud');
    }

    public function assignRequest($id)
    {
        $solicitud = \App\Solicitud::findOrFail($id);
        $empty_option = ['' => '- Selecciona una opción -'];
        $GLOBALS['date_interval'] = [
            Carbon::parse($solicitud->fecha_evento)->toDateTimeString(),
            Carbon::parse($solicitud->fecha_regreso)->toDateTimeString()
        ];

        $vehiculosOcupados = DB::table('vehicles')
            ->join('requests','vehicles.id','=','requests.vehicles_id')
            ->select('vehicles.id as vehiculo_id')
            ->whereDate('requests.fecha_evento','<=', $GLOBALS['date_interval'])
            ->whereDate('requests.fecha_regreso','>=', $GLOBALS['date_interval'])
            ->get()->pluck('vehiculo_id')->toArray();


        $vehiculos = $empty_option + Vehicle::select(['nombre','id'])->whereNotIn('id',$vehiculosOcupados)->get()->pluck('nombre','id')->toArray();

        if ($solicitud->driver == null) {
            $conductoresOcupados = DB::table('drivers')
                ->join('requests','drivers.id','=','requests.driver_id')
                ->select('drivers.id as conductor_id')
                ->whereDate('requests.fecha_evento','<=', $GLOBALS['date_interval'])
                ->whereDate('requests.fecha_regreso','>=', $GLOBALS['date_interval'])
                ->get()->pluck('conductor_id')->toArray();

            $conductores = $empty_option + Driver::select(['nombre','apaterno','amaterno','id'])->whereNotIn('id',$conductoresOcupados)->get()->pluck('nombre','id')->toArray();
        }

        if ($solicitud->vehicles_id !== null && $solicitud->driver !== null) {
            $title = "Editar vehiculo";
            $subtitle = "Cambiar vehiculo";
            $vehiculo = $solicitud->vehicles_id;
            $boton = "Editar";
        } else {
            $title = "Asignar peticiones";
            $subtitle = "Proporcionar peticiones";
            $vehiculo = null;
            $boton = "Guardar";
        }


        $conductor = null;
        $select_attribs = ['class' => 'form-control'];

        // dd($conductores,$conductoresOcupados);
        return view('assign_request',
            compact('vehiculos', 'conductores', 'conductor', 'vehiculo', 'select_attribs', 'id', 'title', 'subtitle', 'boton'));
    }

    public function saveDriverVehicleRequest(Request $request)
    {
        $solicitud = \App\Solicitud::findOrFail($request['solicitud']);
        $data = [];
        $conductor = false;
        $aceptado = false;
        $vehiculoValles = false;
        $message = "Se ha asignado ";

        if ($request->has('conductor')) {
            $data = $data + ['driver_id' => $request['conductor']];
            $message = $message."conductor";
            $conductor = true;
            $aceptado = true;
        }
        if ($request->has('vehiculo') && $request['vehiculo']!="") {
            $data = $data + ['vehicles_id' => $request['vehiculo']];
            $aceptado = true;
            $vehiculoValles = true;

            if ($conductor)
                $message = $message." y ";
            $message = $message."vehículo";
        }

        if($aceptado)
            $data = $data + ['estatus'=>4];


        $message = $message." correctamente";
        $solicitud->update($data);
        Mail::to($solicitud->user->email)->send(new NuevaSolicitudDeVehiculo("Solicitud aprobada","La solicitud que ha realizado, fue aprobada por todas las instancias. Puede revisarla ingresando al sistema."));


        if($vehiculoValles){
            $encargadoVehiculos = User::listaByRol('vehiculos');
            $vehiculo = $solicitud->vehicle;
            foreach ($encargadoVehiculos as $encargado){
                Mail::to($encargado->email)->send(new NuevaSolicitudDeVehiculo("Se ha prestado un vehículo","Se realizó una petición de vehículo y se ha asignado el ".$vehiculo->modelo." placas: ".$vehiculo->placas.". Para el ".Carbon::parse($solicitud->fecha_evento)->format('d-m-Y H:i:s')));
            }
        }

        return redirect()->route('solicitud.index')->with('alert', $message);
    }

    public function editDriverVehicleRequest(Request $request) {
        $solicitud = \App\Solicitud::findOrFail($request['solicitud']);

        $solicitud->update(['vehicles_id' => $request['vehiculo']]);

        return redirect()->route('solicitud.index')->with('alert', 'Se ha actualizado el vehiculo correctamente.');
    }

    public function aceptarSolicitud($id){

        $solicitud = Solicitud::findOrFail($id);
        $estado = $solicitud->estatus;
        $mensaje = "Al parecer, no tiene privilegios sobre esta solicitud";
        $titulo = "Sin cambios";

        switch ($solicitud->estatus){
            case 1:
                if(auth()->user()->hasRoles(['administrativo'])){
                    $estado = 3;
                    $mensaje = "Se ha aprobado correctamente la solicitud como secretario administrativo, se ha enviado un correo al coordinador de servicios generales";
                    $titulo = "Ha aprobado la solicitud";
                    $coordGrales = User::listaByRol('coord_servicios_generales');
                    $asistenteGrales = User::listaByRol('asistente_serv_generales');
                    //dd($coordGrales);

                    foreach ($coordGrales as $coord){
                        Mail::to($coord->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }
                    foreach ($asistenteGrales as $asistenteGral){
                        Mail::to($asistenteGral->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Tiene una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
                    }


                }else{
                    if(auth()->user()->hasRoles(['jefe'])){
                        $mensaje = "Se ha aprobado correctamente la solicitud, se ha enviado un correo al secretario administrativo";
                        $titulo = "Ha aprobado la solicitud";
                        $estado=2;
                        $secretariosAdministrativos = User::listaByRol('administrativo');

                        foreach ($secretariosAdministrativos as $secretariosAdministrativo) {
                            Mail::to($secretariosAdministrativo->email)->send(new NuevaSolicitudDeVehiculo("Asunto pendiente","Se ha creado una nueva solicitud para el préstamo de un vehículo. Es necesario que revise dicha solicitud."));
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
                    $asistenteGrales = User::listaByRol('asistente_serv_generales');
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
                if(auth()->user()->hasRoles(['coord_servicios_generales']) || auth()->user()->hasRoles['asistente_serv_generales']){//también la asistente del coordinador puede actualizar
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


    public function nuevaObservacion($id){
        return view('observacion',compact('id'));
    }
    public function guardaObservacion(ObservacionesRequest $request, $id){

        $solicitud = Solicitud::findOrFail($id);
        $request['users_id']=auth()->user()->id;
        $request['requests_id']=$id;
        $solicitud->observacionesRel()->save(new Observacion($request->all()));

        $solicitante = $solicitud->solicitante;
        //dd($solicitante,$solicitud->jefeAutoriza);


        Mail::to($solicitud->jefeAutoriza->email)->send(new NuevaSolicitudDeVehiculo("Observaciones nuevas para la solicitud de ".$solicitud->solicitante->nombre,"Se ha creado una nueva observación a la solicitud que realizó ".$solicitud->solicitante->nombre." para el préstamo de un vehículo: ".$request['observacion']."."));
        Mail::to($solicitud->solicitante->email)->send(new NuevaSolicitudDeVehiculo("Observaciones nuevas para su solicitud","Hola ".$solicitud->solicitante->nombre.", Se ha realizado una observación para su solicitud de préstamo de un vehículo. La observación es la siguiente: ".$request['observacion']."."));




        alert()->success("Se añadió una nueva observación a esta solicitud y se notificó a los interesados","¡Éxito!")->persistent();

        return redirect()->route('solicitud.show',$id);
    }

    public function muestraObservaciones($id){
        $sol = Solicitud::findOrFail($id);

        $info ="<ul>";

        foreach ($sol->observacionesRel as $observacion){
            $info .= "<li>". $observacion->observacion." - ".$observacion->creador->nombre." ".$observacion->creador->apaterno." (".$observacion->created_at.")<li/>";
        }

        $info .= "</ul>";
        alert()->info($info,"Observaciones para esta solicitud")->html()->persistent("OK");

        return redirect()->route('solicitud.show',$id);
    }
}
