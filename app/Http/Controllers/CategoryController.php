<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $title = 'Gestionar categorías';
        return view('manage_categories',compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_attribs = ['class' => 'form-control']; //Atributos base del select
        $title = 'Agregar categoría';
        return view('add_categories', compact('select_attribs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
        Category::create($request->all());
        return redirect('categoria')->with('alert', 'Categoría agregada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $show = true; //Variable que determina si se deshabilitarán los campos para sólo mostrar los datos, además de cambiar del botón
        $title = 'Detalles de la categoría';
        return view('add_categories', compact('category', 'show', 'select_attribs', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $title = 'Editar Categoría';
        return view('add_categories',compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategory $request, $id)
    {
        $categoria = Category::findOrFail($id);
        $categoria->update($request->all());
        return redirect('categoria')->with('alert', 'Información de la categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('categoria')->with('alert','Categoría eliminada correctamente.');
    }
}
