<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\historico;
use App\Models\Ingreso;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $consultabalanceg = DB::table('gastos')
        ->select(DB::raw('SUM(monto) as total_sales'))->where('userID', '=', Auth::user()->id)->first();



        // Acceder al total
        $totalSales = $consultabalanceg->total_sales;;

        $consultabalancei = DB::table('ingresos')
        ->select(DB::raw('SUM(ingreso_fijo + ingreso_variable + ingreso_saldo) as total_sales'))
        ->where('userID', '=', Auth::user()->id)
        ->first();


        

        // Acceder al total
        $totalSaldo = $consultabalancei->total_sales;

        $operacionfinal = $totalSaldo - $totalSales;

        return view('saldo.index', compact('operacionfinal'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saldo $saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }

    public function reset()
    {
        $id=Auth::user()->id;
        $historico=Ingreso::where('userID', $id)->first();
        if (!$historico ){
            $historico=new Ingreso();
            $historico->userID=$id;
        }
        $consultabalanceg = DB::table('gastos')
        ->select(DB::raw('SUM(monto) as total_sales'))->where('userID', '=', Auth::user()->id)->first();

        // Acceder al total
        $totalSales = $consultabalanceg->total_sales;;

        $consultabalancei = DB::table('ingresos')
        ->select(DB::raw('SUM(ingreso_fijo + ingreso_variable + ingreso_saldo) as total_sales'))
        ->where('userID', '=', Auth::user()->id)
        ->first();
        // Acceder al total
        $totalSaldo = $consultabalancei->total_sales;
        $operacionfinal = $totalSaldo - $totalSales;

        $historico->ingreso_saldo=$operacionfinal;
        $historico->save();
        
        
        Gasto::where("userID",$id)->update(["monto"=>0]);
        Ingreso::where("userID",$id)->update(["ingreso_fijo"=>0,"ingreso_variable"=>0]);

        return redirect()->route('saldo.index');
    }


}
