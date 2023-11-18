@extends('layouts.simple')

@section('main-content')

    <h1>Ficha de Utilizador</h1>

    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    Dados Gerais
                </div>
                <card-body>
                    Olá, {{ $documents->user_id }}
                </card-body>
            </div>
        </div>
    </div>

@endsection
