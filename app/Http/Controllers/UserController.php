<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['auth'])->except('create','store');
        //sólo si es admin podrá ver los usuarios
        $this->middleware(['roles:admin'])->only('index');
    }

    public function index()
    {
        $users=User::all();
        $title = "Gestionar usuario";
      // dd($users);
        //recuerden que se manda el nombre de la variable sin $, esta cosa ya sabe a qué se refieren
        //$solicitudes = Solicitud::all()->where('jefe_id', auth()->user()->id);


        return view('manage_users',compact('users', "title", "solicitudes"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Agregar usuario";
        $select_attribs = ['class' => 'form-control'];
        return view('add_users', compact('title', 'select_attribs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        /*
         * Sólo en este caso se hará así, ya que se debe encriptar el campo password.
         * */

        $request['password'] = Hash::make($request['password']);
       /*$user = User::create([
        'nombre'=>$request['nombre'],
        'apaterno'=>$request['apaterno'],
        'amaterno'=>$request['amaterno'],
        'email'=>$request['email'],
        'cargo'=>$request['cargo'],
        'celular'=>$request['celular'],
        'role_id'=> 1,
        'password'=>Hash::make($request['password']),
       ]);*/

        $user = User::create($request->all());


        return redirect()->route('usuario.index')->with("alert", 'Usuario agregado correcamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $title = 'Detalles del usuario';
        $show = true;
        $jefe = $user->id_jefe;

        //dd($jefe);
        $select_attribs = ['class' => 'form-control', 'disabled' => ''];



        $roles = Role::all();
        return view('add_users', compact('user','roles','nombre', 'apaterno', 'amaterno', 'cargo', 'celular', 'email', 'show', 'title', 'jefe', 'select_attribs', 'datosjefe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $title = 'Editar usuario';
        /*$this->authorize($user);/revisará la política de acceso para ver si este usuario tiene permiso
        de editar el usuario que quiere editar, si no es él mismo, no podrá editarse.*/
        //$jefe = User::datosJefe('slc_jefe');
        $edit = true;
        $jefe = $user->id_jefe;
        //dd($jefe);
        $select_attribs = ['class' => 'form-control'];
        $roles = Role::all();
        return view('add_users',compact('user','roles', 'title', 'select_attribs', 'edit', 'jefe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
       // dd($request->all());
        $usuario = User::findOrFail($id);


        if ($request->has('cambiar_pw')) {//si se solicita cambiar contraseña, la cambiamos
            $request['password'] = Hash::make($request['password']);
        } else {//si no, la dejamos como estaba, aunque no escriban nada en el campo.
            $request['password'] = $usuario->password;
        }


        if($request->has('slc_jefe')){
            $jefe = User::datosJefe($request['slc_jefe']);
            $usuario->roles()->sync($request->role_id);
        }

        //$usuario->update(['id_jefe' => $request['slc_jefe']]);
        //$this->validate($request,['slc_jefe'=>'required']);


        if ($request->has('slc_jefe')) {
            $request['id_jefe'] = $request['slc_jefe'];
        }else{
            $request['id_jefe'] = null;
        }


        //dd($usuario);

        $usuario->update($request->all());


        return redirect()->route('usuario.index')->with("alert","Editado correctamente");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuario.index')->with('alert', 'Usuario eliminado correctamente');
    }

    public function muestra_jefes(){
        $users = User::listaByRol('jefe');
        $titulo = 'Funcionarios que pueden autorizar peticiones';
        return view('manage_jefes',compact('users','titulo'));
    }

    public function muestraSolicitantes(){
        $users = User::listaByRol('solicitante');
        $titulo = 'Usuarios que pueden solicitar';
        return view('manage_jefes',compact('users','titulo'));
    }
}
