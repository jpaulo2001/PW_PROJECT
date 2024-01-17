
@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Last Seven Documents</h1>

        @php
            $documents = app(\App\Services\DashboardService::class)->getLastSevenDocuments();
        @endphp

        @if ($documents->isEmpty())
            <p>No documents found.</p>
        @else
            <ul>
                @foreach ($documents as $document)
                    <li>
                        <strong>Document ID:</strong> {{ $document->documents_id }}
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
