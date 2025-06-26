<?php

namespace App\Http\Controllers;

use App\Models\previo;
use App\Models\User;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $userId = Auth::user()->id;
        $previo = User::with('Previo')->find($userId);

        $exists_previo = previo::where('userID', $userId)->exists();
        $condicion_previo = $exists_previo ? true : false;

        $previoapi = previo::where("userID", $userId)->first();
        if($previoapi){
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $previoapi->created_at);
            $date = $date->addDays($previoapi->fecha_previo);
            $previoapi->fecha_meta = $date->format('d-m-Y');
            $previoapi->dinero_meta = $previoapi->dinero_previo;
        }

        // Obtener datos financieros reales del usuario para el análisis
        $ingreso = Ingreso::where('userID', $userId)->first();
        $gastos = Gasto::where('userID', $userId)->get();
        $historicos = historico::where('userID', $userId)
                              ->orderBy('fecha_click', 'desc')
                              ->limit(30)
                              ->get();

        // Calcular totales
        $ingresoTotal = 0;
        $gastoTotal = 0;
        $saldoActual = 0;

        if ($ingreso) {
            $ingresoTotal = ($ingreso->ingreso_fijo ?? 0) + ($ingreso->ingreso_variable ?? 0);
            $saldoActual = $ingreso->ingreso_saldo ?? 0;
        }

        if ($gastos) {
            $gastoTotal = $gastos->sum('monto');
        }

        // Calcular capacidad de ahorro
        $capacidadAhorro = $ingresoTotal - $gastoTotal;

        // Obtener el último saldo registrado si existe
        if ($historicos->count() > 0) {
            $ultimoHistorico = $historicos->first();
            $saldoActual = $ultimoHistorico->saldo;
        }

        // Preparar datos para JavaScript
        $datosFinancieros = [
            'ingreso_mensual' => $ingresoTotal,
            'gastos_mensuales' => $gastoTotal,
            'saldo_actual' => $saldoActual,
            'capacidad_ahorro' => $capacidadAhorro,
            'historico_saldos' => $historicos->pluck('saldo')->toArray(),
            'fechas_historico' => $historicos->pluck('fecha_click')->toArray(),
        ];

        return view('previo.create', compact(
            'condicion_previo', 
            'previo', 
            'previoapi', 
            'datosFinancieros'
        ));
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
