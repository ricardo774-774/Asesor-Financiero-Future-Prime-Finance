<?php

namespace App\Http\Controllers;

use App\Models\historico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoricosController extends Controller
{
    public function store(Request $request){
        $dateForDatabase = Carbon::now()->format('Y-m-d'); // Alternatively, you can use date('Y-m-d');
        $validar = historico::where([['fecha_click', $dateForDatabase], ['userID', Auth::user()->id]])->first();
        if($validar)
        {
            $errores = ['Solo se permite un registro por dia'];
            return redirect()->back()->with('errores', $errores);
        }
        $historico=new historico();
        $id=Auth::user()->id;
        $consultabalanceg = DB::table('gastos')
        ->select(DB::raw('SUM(monto) as total_sales'))->where('userID', '=', Auth::user()->id)->first();

        $historico->fecha_click = $dateForDatabase;
        
        

        // Acceder al total
        $totalSales = $consultabalanceg->total_sales;;

        $consultabalancei = DB::table('ingresos')
        ->select(DB::raw('SUM(ingreso_fijo + ingreso_variable + ingreso_saldo) as total_sales'))
        ->where('userID', '=', Auth::user()->id)
        ->first();
        // Acceder al total
        $totalSaldo = $consultabalancei->total_sales;
        $operacionfinal = $totalSaldo - $totalSales;

        $historico->saldo=$operacionfinal;
        $historico->userID=$id;
        $historico->save(); 
        return redirect()->back();
    }
}

