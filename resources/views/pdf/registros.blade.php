<!DOCTYPE html>
<html>
<head>
    <title>Mis Registros Diarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #1e293b;
        }
        
        h1 {
            color: #1e40af;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid #1e40af;
        }
        
        th {
            background-color: #1e40af;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 14px;
        }
        
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
        }
        
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .saldo-positivo {
            color: #059669;
            font-weight: bold;
        }
        
        .saldo-negativo {
            color: #dc2626;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        
        .header-info {
            text-align: center;
            margin-bottom: 20px;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Registros Diarios de Saldo</h1>
    
    <div class="header-info">
        <p><strong>Finanzas Pro</strong> - Tu Asesor Financiero Personal</p>
        <p>Reporte generado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 35%;">Concepto</th>
                <th style="width: 30%;">Saldo</th>
                <th style="width: 25%;">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @php $index = 1; @endphp
            @foreach($registros as $registro)
                <tr>
                    <td><strong>{{ $index }}</strong></td>
                    <td>Registro diario</td>
                    <td class="{{ $registro->saldo >= 0 ? 'saldo-positivo' : 'saldo-negativo' }}">
                        ${{ number_format($registro->saldo, 2) }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha_click)->format('d/m/Y') }}</td>
                </tr>
                @php $index++; @endphp
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p><strong>Total de registros:</strong> {{ count($registros) }}</p>
        <p>Este documento contiene el historial de registros diarios de saldo</p>
        <p> {{ now()->year }} Finanzas Pro - Todos los derechos reservados</p>
    </div>
</body>
</html>