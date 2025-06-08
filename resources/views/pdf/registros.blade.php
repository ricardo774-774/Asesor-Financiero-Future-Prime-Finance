<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Registros Financieros</title>
    <style>
        @page {
            margin: 40px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b; /* slate-800 */
            font-size: 12px;
            background-color: #f8fafc; /* slate-50 */
        }

        .header-section {
            background-color: #1e40af; /* blue-800 */
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 20px;
        }

        p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 6px rgba(30, 64, 175, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8); /* slate-200 */
        }

        th {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 8px;
            border-top: 1px solid #e2e8f0; /* slate-200 */
            color: #334155; /* slate-700 */
        }

        tr:nth-child(even) {
            background-color: #f1f5f9; /* slate-100 */
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 10px;
            color: #64748b; /* slate-500 */
        }

        .badge {
            display: inline-block;
            background-color: #3b82f6; /* blue-500 */
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header-section">
        <h1>Mis Registros Financieros</h1>
        <p>Generado automáticamente por Asesor Financiero</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->id }}</td>
                    <td>{{ $registro->concepto }}</td>
                    <td>${{ number_format($registro->monto, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                    <td><span class="badge">{{ $registro->categoria }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Reporte generado el {{ now()->format('d/m/Y H:i') }} · Asesor Financiero © {{ now()->year }}
    </div>

</body>
</html>