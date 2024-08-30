<?php

namespace App\Http\Controllers;

use App\Models\meta_historico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MetaHistoricoController extends Controller
{
    //
    public function store(Request $request){
        $metahistorico=new meta_historico();
        $id=Auth::user()->id;
        $consultabalanceg = DB::table('gastos')
        ->select(DB::raw('SUM(monto) as total_sales'))->where('userID', '=', Auth::user()->id)->first();

        $dateForDatabase = Carbon::now()->format('Y-m-d'); // Alternatively, you can use date('Y-m-d');
        $metahistorico->fecha_click = $dateForDatabase;

        // Acceder al total
        $totalSales = $consultabalanceg->total_sales;;

        $consultabalancei = DB::table('ingresos')
        ->select(DB::raw('SUM(ingreso_fijo + ingreso_variable + ingreso_saldo) as total_sales'))
        ->where('userID', '=', Auth::user()->id)
        ->first();
        // Acceder al total
        $totalSaldo = $consultabalancei->total_sales;
        $operacionfinal = $totalSaldo - $totalSales;

        $metahistorico->saldo=$operacionfinal;
        $metahistorico->userID=$id;
        $metahistorico->save(); 
        return redirect()->route('meta.create');
    }
}
