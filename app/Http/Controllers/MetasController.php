<?php

namespace App\Http\Controllers;

use App\Models\meta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetasController extends Controller
{
    public function create()
    {
        $meta=User::with('Meta')->find(Auth::user()->id);

        $exists_meta = meta::where('userID',Auth::user()->id)
                        ->exists();
        if($exists_meta==1){
            $condicion_meta=true;
        }
        else{
            $condicion_meta=false;
        }

        $metaapi = meta::where("userID", Auth::user()->id)->first();

        if($metaapi){
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $metaapi->created_at);
        $date = $date->addDays($metaapi->meta_fecha);
        $metaapi->fecha_meta=$date->format('d-m-Y');

        $metaapi->dinero_meta=$metaapi->meta_dinero;
        }
        return view('meta.create', compact('condicion_meta', 'meta','metaapi'));
    }
    public function store(Request $request)
    {
        $varMeta = new meta();
        $varMeta->userID = Auth::user()->id;
        $varMeta->meta_dinero = $request->cantidad;
    
        // Convertir la fecha seleccionada y la fecha actual a objetos Carbon
        $fechaSeleccionada = Carbon::parse($request->fecha);
        $fechaActual = Carbon::now();
    
        // Calcular la diferencia en días entre la fecha seleccionada y la fecha actual
        $diferenciaEnDias = $fechaSeleccionada->diffInDays($fechaActual);
    
        // Asegurar que la diferencia sea positiva y redondearla hacia arriba
        $diferenciaEnDias = ceil(abs($diferenciaEnDias));
    
        // Guardar la diferencia en días como un entero en la variable de fecha
        $varMeta->meta_fecha = (int) $diferenciaEnDias;

        $varMeta->foto = isset($request->foto)?$request->foto:null;
    
        $varMeta->save();
    
        return redirect()->route('meta.create');
    }

    public function update(Request $request, meta $meta)
    {
        
        $meta->userID = Auth::user()->id;
        $meta->meta_dinero = $request->cantidad;
    
        // Convertir la fecha seleccionada y la fecha actual a objetos Carbon
        $fechaSeleccionada = Carbon::parse($request->fecha);
        $fechaActual = Carbon::now();
    
        // Calcular la diferencia en días entre la fecha seleccionada y la fecha actual
        $diferenciaEnDias = $fechaSeleccionada->diffInDays($fechaActual);
    
        // Asegurar que la diferencia sea positiva y redondearla hacia arriba
        $diferenciaEnDias = ceil(abs($diferenciaEnDias));
    
        // Guardar la diferencia en días como un entero en la variable de fecha
        $meta->meta_fecha = (int) $diferenciaEnDias;

        $meta->foto = isset($request->foto)?$request->foto:null;
    
        $meta->save();
    
        return redirect()->route('meta.create');
        

    }

}
