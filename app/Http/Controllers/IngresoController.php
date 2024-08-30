<?php

namespace App\Http\Controllers;

use App\Models\historiali;
use App\Models\Ingreso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        $index_hif=1;
        $index_hiv=1;

        $historial_fijo = historiali::orderBy('id', 'desc')->where('userID', $id)->whereNotNull('ingreso_fijo')->get();
        $historial_variable = historiali::orderBy('id', 'desc')->where('userID', $id)->whereNotNull('ingreso_variable')->get();


        $ingreso=User::with('Ingreso')->find($id);

        $exists = Ingreso::where('userID', $id)->exists();
        if($exists==1){
            $condicion=true;
        }
        else{
            $condicion=false;
        }


    
        return view('ingreso.index', compact('condicion','ingreso','historial_fijo','historial_variable', 'index_hif','index_hiv'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Ingreso $ingreso)
    {
        $historial=new historiali();

        if($request->tipo_ingreso==0){
            $ingreso->ingreso_fijo=$request->ingreso_fijo;
            $historial->ingreso_fijo=$request->ingreso_fijo;
            $historial->tipo_ingreso=$request->tipo_ingreso;
        }
        else{
            $historial->ingreso_variable=$request->ingreso_variable;
            $ingreso->ingreso_variable=$request->ingreso_variable;
            $historial->tipo_ingreso=$request->tipo_ingreso;
        }
        
        $historial->userID=Auth::user()->id;
        $historial->save();

        
        $ingreso->userID=Auth::user()->id;
        $ingreso->save();
        return redirect()->route("ingreso.index");
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        $historial=new historiali();

        if($request->tipo_ingreso==0){
           
            $historial->ingreso_fijo=$request->ingreso_fijo;
            $historial->tipo_ingreso=$request->tipo_ingreso;
        }
        else{
            $historial->ingreso_variable=$request->ingreso_variable;
           
            $historial->tipo_ingreso=$request->tipo_ingreso;
        }
        
        $historial->userID=Auth::user()->id;
        $historial->save();

 /**
     * Ucomentario
     */

            $ingreso->ingreso_fijo=$request->ingreso_fijo;
            $ingreso->userID=Auth::user()->id;
            

            $ingreso->ingreso_variable+=$request->ingreso_variable;
            $ingreso->save();
            return redirect()->route("ingreso.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingreso $ingreso)
    {
        //
    }
}
