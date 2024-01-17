
@extends('layouts.autenticado')

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .col-sm {
        flex: 1;
        padding: 20px;
        background-color: #f9f9f9;
        margin: 10px;
        border-radius: 8px;
    }

    h1 {
        color: #333;
    }


    strong {
        font-weight: bold;
        color: #333;
    }
</style>
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Documentos da Semana</h1>

        @php
            $documents = app(\App\Services\DashboardService::class)->getLastSevenDocuments();
        @endphp

        @if ($documents->isEmpty())
            <p>Não existem Documentos na ultima semana.</p>
        @else
            <ul>
                @foreach ($documents as $document)
                    <li>
                        <strong>Document ID:</strong> {{ $document->document_id }}
                        <!-- Add other relevant fields as needed -->
                        <br>
                        <strong>Created At:</strong> {{ $document->created_at }}
                    </li>
                @endforeach
            </ul>
        @endif
            </div>
            <div class="col-sm">
                <h1>Ultimos Documentos</h1>
            </div>
            <div class="col-sm">
                <h1>Memoria Utilizada</h1>
            </div>
          </div>

    </div>
@endsection
