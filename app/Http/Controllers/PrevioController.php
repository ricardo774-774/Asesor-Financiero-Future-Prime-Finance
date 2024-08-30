<?php

namespace App\Http\Controllers;

use App\Models\previo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PrevioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $previo=User::with('Previo')->find(Auth::user()->id);

        $exists_previo = previo::where('userID',Auth::user()->id)
                        ->exists();
        if($exists_previo==1){
            $condicion_previo=true;
        }
        else{
            $condicion_previo=false;
        }

            $previoapi = previo::where("userID", Auth::user()->id)-> first();
            if($previoapi){
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $previoapi->created_at);
            $date = $date->addDays($previoapi->fecha_previo);
            $previoapi->fecha_meta=$date->format('d-m-Y');

            $previoapi->dinero_meta=$previoapi->dinero_previo;
            }
            

        return view('previo.create', compact('condicion_previo', 'previo', 'previoapi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $varPrevio = new previo();
        $varPrevio->userID = Auth::user()->id;
        $varPrevio->dinero_previo = $request->cantidad;
    
        // Convertir la fecha seleccionada y la fecha actual a objetos Carbon
        $fechaSeleccionada = Carbon::parse($request->fecha);
        $fechaActual = Carbon::now();
    
        // Calcular la diferencia en días entre la fecha seleccionada y la fecha actual
        $diferenciaEnDias = $fechaSeleccionada->diffInDays($fechaActual);
    
        // Asegurar que la diferencia sea positiva y redondearla hacia arriba
        $diferenciaEnDias = ceil(abs($diferenciaEnDias));
    
        // Guardar la diferencia en días como un entero en la variable de fecha
        $varPrevio->fecha_previo = (int) $diferenciaEnDias;
    
        $varPrevio->save();
    
        return redirect()->route('previo.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(previo $previo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(previo $previo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, previo $previo)
    {
        
        $previo->userID = Auth::user()->id;
        $previo->dinero_previo = $request->cantidad;
    
        // Convertir la fecha seleccionada y la fecha actual a objetos Carbon
        $fechaSeleccionada = Carbon::parse($request->fecha);
        $fechaActual = Carbon::now();
    
        // Calcular la diferencia en días entre la fecha seleccionada y la fecha actual
        $diferenciaEnDias = $fechaSeleccionada->diffInDays($fechaActual);
    
        // Asegurar que la diferencia sea positiva y redondearla hacia arriba
        $diferenciaEnDias = ceil(abs($diferenciaEnDias));
    
        // Guardar la diferencia en días como un entero en la variable de fecha
        $previo->fecha_previo = (int) $diferenciaEnDias;
    
        $previo->save();
    
        return redirect()->route('previo.create');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(previo $previo)
    {
        //
    }
}
