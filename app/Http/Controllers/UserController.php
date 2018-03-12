<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users=User::all();
      // dd($users);
        //recuerden que se manda el nombre de la variable sin $, esta cosa ya sabe a qué se refieren
        return view('manage_users',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * Sólo en este caso se hará así, ya que se debe encriptar el campo password.
         * */
       $user = User::create([
        'nombre'=>$request['nombre'],
        'apaterno'=>$request['apaterno'],
        'amaterno'=>$request['amaterno'],
        'email'=>$request['email'],
        'cargo'=>$request['cargo'],
        'celular'=>$request['celular'],
        'role_id'=> 1,
        'password'=>Hash::make($request['password']),
       ]);

        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //no sé si implementarlo, la neta.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('add_users',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update([
            'nombre'=>$request['nombre'],
            'apaterno'=>$request['apaterno'],
            'amaterno'=>$request['amaterno'],
            'email'=>$request['email'],
            'cargo'=>$request['cargo'],
            'celular'=>$request['celular'],
            'role_id'=> 1,
            'password'=>Hash::make($request['password']),
        ]);
        return redirect()->route('usuario.index');
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
        return redirect()->route('usuario.index');
    }
}
