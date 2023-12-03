@extends('layouts.simple')

@section('main-content')

    <h1>Ficha do documento</h1>

    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    Dados Gerais
                </div>
                <card-body>
                    O caminho do documento: {{ $documents->first()->path }}
                </card-body>
            </div>
        </div>
    </div>

@endsection
