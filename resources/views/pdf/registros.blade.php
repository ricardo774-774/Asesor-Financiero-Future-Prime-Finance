<!DOCTYPE html>
<html>
<head>
    <title>Mis Registros</title>
</head>
<body>
    <h1>Registros de Usuario</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Saldo</th>
                <th>Fecha de Clic</th>
            </tr>
        </thead>
        <tbody>
            @php $index = 1; @endphp <!-- Inicializamos el índice -->
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $index }}</td> <!-- Imprime el índice -->
                    <td>{{ number_format($registro->saldo, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha_click)->format('d-m-Y') }}</td>
                </tr>
                @php $index++; @endphp <!-- Incrementa el índice -->
            @endforeach
        </tbody>
    </table>
</body>
</html>
