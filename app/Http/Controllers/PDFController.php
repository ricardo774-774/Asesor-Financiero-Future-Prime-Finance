<?php

namespace App\Http\Controllers;

use App\Models\historico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PDFController extends Controller
{
    public function generarPDF()
    {
        $userId = Auth::id();
        $registros = historico::where('userID', $userId)->get();
        $pdf = Pdf::loadView('pdf.registros', compact('registros'));
        return $pdf->download('mis_registros.pdf');
    }
}
