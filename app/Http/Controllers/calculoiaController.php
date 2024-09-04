<?php

namespace App\Http\Controllers;

use App\Models\AhorroVisual;
use App\Models\previo;
use App\Models\historico;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use App\Models\meta_historico;
use App\Models\meta;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;


class calculoiaController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $previoapi = previo::where("userID", $userId)->first();
        $historicoapi = historico::where("userID", $userId)->get();

        $errores = [];


        $previo = User::with('Previo')->find($userId);

        $exists_previo = previo::where('userID', $userId)
            ->exists();
        if ($exists_previo == 1) {
            $condicion_previo = true;
        } else {
            $condicion_previo = false;
        }
        if ($previoapi) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $previoapi->created_at);
            $date = $date->addDays($previoapi->fecha_previo);
            $previoapi->fecha_meta = $date->format('d-m-Y');

            $previoapi->dinero_meta = $previoapi->dinero_previo;
        } else {
            $errores[] = 'No has fijado un objetivo financiero';
        }

        $xapia = $historicoapi->pluck("fecha_click");
        $yapi = $historicoapi->pluck("saldo");

        $xapi = [];

        foreach ($xapia as $key => $value) {
            $xapi[] = $value;
        }

        if (count($xapi) == 0 && count($yapi) == 0) {
            $errores[] = 'No hay registros historicos para continuar';
        }

        if (count($errores) == 0) {
            try {


                $response = Http::timeout(10) // Set timeout to 10 seconds
                    ->accept('application/json')
                    ->post(env('API_URL'), [
                        'X' => $xapi,
                        'y' => $yapi,
                        'dinero_meta' => $previoapi->dinero_meta,
                        'fecha_meta' => $previoapi->fecha_meta
                    ]);
                // Decode JSON response
                $responseData = $response->json();

                // Check if the response contains the necessary data
                if (isset($responseData["ahorro_extra_diario_necesario"]) && $responseData["ahorro_extra_diario_necesario"] > 0) {
                    $ahorro = AhorroVisual::where('ahorro', '>=', $responseData["ahorro_extra_diario_necesario"])
                        ->orderBy('ahorro', 'asc')
                        ->first();

                    if (!$ahorro) {
                        $ahorro = new \stdClass;
                        $ahorro->ejemplo = "¡Cuidado, tu meta de ahorro tiene una baja probabilidad de tener éxito!";
                        $ahorro->foto = 'foto_irreal.jpg';
                    }
                } else {
                    $ahorro = new \stdClass;
                    $ahorro->ejemplo = "¡MUY BIEN, VAS SOBRADO EN TUS AHORROS PARA LOGRAR TU META!";
                    $ahorro->foto = 'foto_feliz.jpg';
                }
            } catch (RequestException $e) {
                dd("DIE");
            } catch (Exception $e) {
                $errores[] = "NO SE PUDO CONECTAR A LA API";
                $response = null;
                $ahorro = null;
            }
        } else {
            $response = null;
            $ahorro = null;
        }


        return view('previo.create', compact('condicion_previo', 'previo', 'previoapi', 'historicoapi', 'response', 'errores', 'ahorro'));
    }

    public function meta(Request $request)
    {
        $userId = auth()->user()->id;
        $metaapi = meta::where("userID", $userId)->first();
        $historicoapi = historico::where("userID", $userId)->get();

        $errores = [];


        $meta = User::with('Meta')->find($userId);

        $exists_meta = meta::where('userID', $userId)
            ->exists();
        if ($exists_meta == 1) {
            $condicion_meta = true;
        } else {
            $condicion_meta = false;
        }
        if ($metaapi) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $metaapi->created_at);
            $date = $date->addDays($metaapi->meta_fecha);
            $metaapi->fecha_meta = $date->format('d-m-Y');

            $metaapi->dinero_meta = $metaapi->meta_dinero;
        } else {
            $errores[] = 'No has fijado una meta';
        }

        $xapia = $historicoapi->pluck("fecha_click");
        $yapi = $historicoapi->pluck("saldo");

        $xapi = [];

        foreach ($xapia as $key => $value) {
            $xapi[] = $value;
        }

        if (count($xapi) == 0 && count($yapi) == 0) {
            $errores[] = 'No hay registros historicos para continuar';
        }

        if (count($errores) == 0) {
            try {
                $response = Http::accept('application/json')->post(env('API_URL'), [
                    'X' => $xapi,
                    'y' => $yapi,
                    'dinero_meta' => $metaapi->dinero_meta,
                    'fecha_meta' => $metaapi->fecha_meta
                ]);
                $response = $response->json();
                if ($response["ahorro_extra_diario_necesario"] > 0) {

                    $ahorro = AhorroVisual::where('ahorro', '>=', $response["ahorro_extra_diario_necesario"])->orderBy('ahorro', 'asc')->first();
                    if (!$ahorro) {
                        $ahorro = new \stdClass;
                        $ahorro->ejemplo = "¡Cuidado, tu meta de ahorro tiene una baja probabilidad de tener éxito!";
                        $ahorro->foto = 'foto_irreal.jpg';
                    }
                } else {
                    $ahorro = new \stdClass;
                    $ahorro->ejemplo = "¡MUY BIEN, VAS SOBRADO EN TUS AHORROS PARA LOGARAR TU META!";
                    $ahorro->foto = 'foto_feliz.jpg';
                }
            } catch (RequestException $e) {
                dd("DIE");
            } catch (Exception $e) {
                $errores[] = "NO SE PUDO CONECTAR A LA API";
                $response = null;
                $ahorro = null;
            }
        } else {
            $response = null;
            $ahorro = null;
        }


        return view('meta.create', compact('condicion_meta', 'meta', 'metaapi', 'historicoapi', 'response', 'errores', 'ahorro'));
    }
}
