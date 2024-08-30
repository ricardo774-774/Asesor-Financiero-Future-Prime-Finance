<?php

namespace App\Http\Controllers;

use App\Models\categoriasg;
use App\Models\Gasto;
use App\Models\historialg;
use Illuminate\Http\Request;

class CategoriasgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $categorias=categoriasg::all();

        return view("categoriasg.index",compact('categorias'));

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categoriasg.create");
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria=new categoriasg();
        $categoria->Nombre=$request->Nombre;
        $categoria->fv=$request->fv;
        $categoria->id=$request->id;
        $categoria->save();

        return redirect()->route("categoriasg.index");
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(categoriasg $categoriasg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoriasg $categoriasg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categoriasg $categoriasg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categoriasg $categoriasg)
    {

        $categoriasg->delete();
        
        return redirect()->route("categoriasg.index");

        //
    }

    public function handleAjaxRequest(Request $request)
    {
        $categoriasID = $request->input('categoriasID');

        // Realiza las acciones necesarias con el ID de la categoría
        // Por ejemplo, obtener el gasto fijo actual de esa categoría
        $gasto = Gasto::where('categoriasID', $categoriasID)->first();


        // Ejemplo de respuesta JSON
        return response()->json([
            'message' => 'Categoría seleccionada correctamente',
            'categoriasID' => $categoriasID,
            'gastoFijo' => $gasto->gasto_fijo ?? 0
        ]);
    }
}
