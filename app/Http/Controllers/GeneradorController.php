<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneradorCategoria; // Importa el modelo GeneradorCategoria
use App\Models\GeneradorSugerencia;
use App\Models\Ingreso;
use App\Models\meta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GeneradorController extends Controller
{
    /**
     * Muestra una lista de categorías en la vista generador.index.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener todas las categorías de la tabla generador_categorias
        $categorias = GeneradorCategoria::all();

        // Retornar la vista 'generador.index' con la lista de categorías
        return view('generador.create', compact('categorias'));
    }

    public function sugerencia(Request $request)
    {
        $errores = [];
        $categorias = GeneradorCategoria::all();

        $categoria = GeneradorCategoria::find($request->categoria);
        $saldo = Ingreso::where("userID", Auth::user()->id)->first();
        if ($saldo){
            $monto = $categoria->tiempo_meta * $saldo->ingreso_fijo;
        
        }
        else{
            $monto=0;
        } 
        $sugerencia = GeneradorSugerencia::where([['sugerencia_cid',$categoria->id],['monto', '<=', $monto]])->orderBy("monto", "desc")->first();
        if(!$sugerencia){
            $errores[] = "No puedes continuar, informacion insuficiente"; 
        }
        else{
            $fecha = Carbon::now()->addMonths($categoria->tiempo_meta);
            $sugerencia->fecha=$fecha->toDateString();
        }
        
        $meta=meta::where("userID", Auth::user()->id)->first();
        return view('generador.create', compact('categorias', 'sugerencia', 'meta', 'errores'));
    }
    
}
