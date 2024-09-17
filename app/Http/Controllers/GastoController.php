<?php

namespace App\Http\Controllers;

use App\Models\categoriasg;
use App\Models\Gasto;
use App\Models\historialg;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        
        $historial_variableg = historialg::where('userID','=',$id)->whereIn('categoriasID', [7, 8])
        ->orderBy('id', 'desc')
        ->get();
        $index_hgv=1;

        $categorias=DB::table('categoriasgs')->where('fv','=',0)->get();
        $historial=Gasto::with('categoria')->where('userID','=',$id)->get();
        
        $gasto=User::with('Gasto')->find($id);


        $tabla = DB::table('gastos')
                    ->where('userID', '=', $id)
                    ->pluck('categoriasID');

        
        $categoriasVar = categoriasg::where('fv',0)->get()->pluck('id');

        //consultas para gastos fijos
        $exists1 = Gasto::where('userID', $id)->whereIn('categoriasID', $categoriasVar)
                        ->exists();
        
        $exists2 = Gasto::where('userID', $id)
                        ->where('categoriasID', '=', 2)
                        ->exists();

        //consultas para gastos fijos

        $existsvn = Gasto::where('userID', $id)
                        ->where('categoriasID', '=', 7)
                        ->exists();
        
        $existsvnn = Gasto::where('userID', $id)
                        ->where('categoriasID', '=', 8)
                        ->exists();
        
        
        //gastos fijos
        
        //gastos fijos
        
        if ($exists1) {
            $condicion = true;
        } else {
            $condicion = false;
        }

        if($existsvn==1){
            $condicionvn=true;
        }
        else{
            $condicionvn=false;
        }

        if($existsvnn==1){
            $condicionvnn=true;
        }
        else{
            $condicionvnn=false;
        }


// Consulta y final para gvn, consulta 2 y final 2 para gvnn
        $id = Auth::id(); // o el ID del usuario que corresponda
        $consulta = DB::table('gastos')
        ->where('userID', '=', $id)
        ->where('categoriasID', '=', 7)
        ->first(); // usamos first() en lugar de get() para obtener un solo registro
        $final = $consulta ? (string) $consulta->monto : '0'; // obtenemos el monto como cadena o '0' si no hay resultado

        
        $consulta2 = DB::table('gastos')
        ->where('userID', '=', $id)
        ->where('categoriasID', '=', 8)
        ->first(); // usamos first() en lugar de get() para obtener un solo registro
        $final2 = $consulta2 ? (string) $consulta2->monto : '0';

        $consultabalanceg = DB::table('gastos')
        ->select(DB::raw('SUM(monto) as total_sales'))->where('userID', '=', $id)->first();

        // Acceder al total
        $totalSales = $consultabalanceg->total_sales;;

        return view("gasto.index", compact('categorias','historial','condicion','gasto', 'condicionvn', 'condicionvnn','final','final2','historial_variableg', 'index_hgv', 'totalSales'));

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
    public function store(Request $request)
{
    $historial = new Historialg();
    $gasto = new Gasto();

    if ($request->indicador == 0) {
        // Verificar si ya existe un registro de Gasto con las mismas categoriasID y userID
        $gastoExistente = Gasto::where('userID', Auth::user()->id)
                               ->where('categoriasID', $request->categoriasID)
                               ->first();

        if ($gastoExistente) {
            // Si existe, actualizar el registro existente
            $gastoExistente->monto = $request->monto_fijo ?? 0; // Asigna 0 si $request->monto_fijo es null
            $gastoExistente->save();
        } else {
            // Si no existe, crear un nuevo registro de Gasto
            $gasto->userID = Auth::user()->id;
            $gasto->monto = $request->monto_fijo ?? 0; // Asigna 0 si $request->monto_fijo es null
            $gasto->categoriasID = $request->categoriasID;
            $gasto->save();
        }

        // Crear registro en Historial
        $historial->userID = Auth::user()->id;
        $historial->monto = $request->monto_fijo ?? 0; // Asigna 0 si $request->monto_fijo es null
        $historial->categoriasID = $request->categoriasID;
        $historial->fv = 0;
        $historial->save();
    } 
    else if($request->indicador==1){
        $gasto = Gasto::where('categoriasID', '=',7)->
        where('userID', Auth::user()->id)->first();
        $gasto->monto+=$request->gvn2;
        $gasto->categoriasID=7;
        $historial->categoriasID=7;
        $gasto->userID = Auth::user()->id;
        $historial->fv = 1;
        $historial->monto = $request->gvn2;

        $historial->userID = Auth::user()->id;
        $gasto->save();
        $historial->save();
        
    }

    else if($request->indicador==2){
        $gasto = Gasto::where('categoriasID', '=',8)->
        where('userID', Auth::user()->id)->first();
        $gasto->monto+=$request->gvnn2;
        $gasto->categoriasID=8;
        $historial->categoriasID=8;
        $gasto->userID = Auth::user()->id;
        $historial->fv = 1;
        $historial->monto = $request->gvnn2;

        $historial->userID = Auth::user()->id;
        $gasto->save();
        $historial->save();
    }
    
    
    else {
        // Otro caso (opcional)
    }

    return redirect()->route("gasto.index");
}


    /**
     * Display the specified resource.
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gasto $gasto)
{
    // Encontrar y actualizar el gasto específico
    $gasto = Gasto::findOrFail($gasto->id);
    $historial = new Historialg();

    
    if ($request->indicador == 0) {
        // Actualizar el gasto y el historial
        $gasto->monto = $request->monto_fijo;
        $gasto->userID = Auth::user()->id;
        $gasto->save();

        // Crear y guardar el historial
        $historial->fv = 0;
        $historial->categoriasID = $request->categoriasID;
        $historial->userID = Auth::user()->id;
        $historial->monto = $request->monto_fijo;
        $historial->save();
    } 

    else if($request->indicador==1){
        $gasto = Gasto::where('userID', '=',Auth::user()->id)->where('categoriasID', '=',7)->first();
        $gasto->monto+=$request->gvn2;
        $gasto->categoriasID=7;
        $historial->categoriasID=7;
        $gasto->userID = Auth::user()->id;
        $historial->fv = 1;
        $historial->monto = $request->gvn2;

        $historial->userID = Auth::user()->id;
        $gasto->save();
        $historial->save();
        
    }

    else if($request->indicador==2){
        $gasto = Gasto::where('userID', '=',Auth::user()->id)->where('categoriasID', '=',8)->first();
        $gasto->monto+=$request->gvnn2;
        $gasto->categoriasID=8;
        $historial->categoriasID=8;
        $gasto->userID = Auth::user()->id;
        $historial->fv = 1;
        $historial->monto = $request->gvnn2;

        $historial->userID = Auth::user()->id;
        $gasto->save();
        $historial->save();
        
    }
    else {
        // Manejar el caso en el que no se encuentra el gasto
        // Puedes lanzar una excepción, redirigir con un mensaje de error, etc.
        return redirect()->route("gasto.index")->with('error', 'Gasto no encontrado');
    }



    return redirect()->route("gasto.index");
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gasto $gasto)
    {
        //
    }

    
}
