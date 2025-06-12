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
use Illuminate\Support\Facades\Auth;


class calculoiaController extends Controller
{
    /**
     * Valida y formatea los resultados de la API
     */
    private function validateAndFormatApiResponse($response, $dinero_meta, $fecha_meta, $historicoapi)
    {
        if (!isset($response["ahorro_extra_diario_necesario"]) || !isset($response["ahorro_extra_mensual_necesario"])) {
            return null;
        }

        $ahorro_diario = $response["ahorro_extra_diario_necesario"];
        $ahorro_mensual = $response["ahorro_extra_mensual_necesario"];

        // Si los valores son negativos o cero, calcular ahorro mínimo
        if ($ahorro_diario <= 0 || $ahorro_mensual <= 0) {
            // Calcular días restantes hasta la meta
            $fecha_actual = Carbon::now();
            $fecha_objetivo = Carbon::createFromFormat('d-m-Y', $fecha_meta);
            $dias_restantes = $fecha_actual->diffInDays($fecha_objetivo, false);

            if ($dias_restantes > 0) {
                // Obtener el saldo actual (último registro)
                $saldo_actual = $historicoapi->last()->saldo ?? 0;
                
                // Calcular dinero faltante
                $dinero_faltante = $dinero_meta - $saldo_actual;
                
                if ($dinero_faltante > 0) {
                    // Calcular ahorro mínimo diario y mensual
                    $ahorro_diario = $dinero_faltante / $dias_restantes;
                    $ahorro_mensual = $ahorro_diario * 30;
                } else {
                    // Si ya se alcanzó la meta, poner valores en 0
                    $ahorro_diario = 0;
                    $ahorro_mensual = 0;
                }
            } else {
                // Si la fecha ya pasó, calcular como si fuera 1 día
                $saldo_actual = $historicoapi->last()->saldo ?? 0;
                $dinero_faltante = max(0, $dinero_meta - $saldo_actual);
                $ahorro_diario = $dinero_faltante;
                $ahorro_mensual = $dinero_faltante * 30;
            }
        }

        // Redondear a 2 decimales y formatear
        return [
            number_format($ahorro_diario, 2, '.', ''),
            number_format($ahorro_mensual, 2, '.', '')
        ];
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
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
                $apiResponse = $response->json();

                // Validar y formatear la respuesta
                $response = $this->validateAndFormatApiResponse($apiResponse, $previoapi->dinero_meta, $previoapi->fecha_meta, $historicoapi);

                if ($response) {
                    $ahorro_diario_formateado = floatval($response[0]);
                    
                    // Check if the response contains the necessary data
                    if ($ahorro_diario_formateado > 0) {
                        $ahorro = AhorroVisual::where('ahorro', '>=', $ahorro_diario_formateado)
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
                } else {
                    $response = null;
                    $ahorro = null;
                }
            } catch (RequestException $e) {
                $errores[] = "Error de conexión con la API";
                $response = null;
                $ahorro = null;
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
        $userId = Auth::user()->id;
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
                $apiCall = Http::accept('application/json')->post(env('API_URL'), [
                    'X' => $xapi,
                    'y' => $yapi,
                    'dinero_meta' => $metaapi->dinero_meta,
                    'fecha_meta' => $metaapi->fecha_meta
                ]);
                $apiResponse = $apiCall->json();

                // Validar y formatear la respuesta
                $response = $this->validateAndFormatApiResponse($apiResponse, $metaapi->dinero_meta, $metaapi->fecha_meta, $historicoapi);

                if ($response) {
                    $ahorro_diario_formateado = floatval($response[0]);
                    
                    if ($ahorro_diario_formateado > 0) {
                        $ahorro = AhorroVisual::where('ahorro', '>=', $ahorro_diario_formateado)
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
                } else {
                    $response = null;
                    $ahorro = null;
                }
            } catch (RequestException $e) {
                $errores[] = "Error de conexión con la API";
                $response = null;
                $ahorro = null;
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
