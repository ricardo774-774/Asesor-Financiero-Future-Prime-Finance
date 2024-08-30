@extends('layouts.app')

@section('css')
    <style>
        .balance-container {
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        .balance-input {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: none;
            color: white;
            font-size: 1.75rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .balance-input:disabled {
            cursor: not-allowed;
        }

        .reset-button {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .reset-button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="balance-container max-w-md w-full text-center">
            <label for="saldo" class="block mb-4 text-3xl font-extrabold tracking-tight">Mi Saldo Actual</label>
            <input type="text" id="saldo" name="saldo" value="{{ $operacionfinal }}" class="balance-input" disabled>
            <p class="mt-4 text-lg font-medium">Este es tu saldo disponible basado en las últimas operaciones.</p>
            <form action="{{ route('saldo.reset') }}" method="POST">
                @csrf
                <button type="submit" class="reset-button">Resetear INGRESOS Y GASTOS</button>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
