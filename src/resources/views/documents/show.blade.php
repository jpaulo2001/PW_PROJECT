@extends('layouts.autenticado')
@section('main-content')

    <h1>Ficha do documento</h1>
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    Dados Gerais
                </div>

                <div class="card-body">
                    <a href="{{ route('documents.share', $document->id) }}" class="btn btn-primary">Partilhar
                        Documento</a>
                    <a href="{{ route('historics.show', $document->id) }}" class="btn btn-secondary">Ver Histórico</a>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <p><strong>ID do Documento:</strong> {{ $document->id }}</p>
                    <p><strong>Caminho do Documento:</strong> {{ $document->path }}</p>
                    @php
                        $documentData = app('App\Http\Controllers\DocumentController')->getDocumentData($document->id);
                    @endphp

                    @if ($documentData)
                        <p><strong>Nome do Documento:</strong> {{ $documentData->doc_name }}</p>
                        <p><strong>Tipo:</strong> {{ $documentData->type }}</p>
                        <p><strong>Formato:</strong> {{ $documentData->format }}</p>
                        <p><strong>Tamanho:</strong> {{ $documentData->size }}</p>
                    @endif

                    @php
                        if (Storage::exists($document->path)) {
                            $content = Storage::get($document->path);
                        } else {
                            $content = 'O documento solicitado não existe.';
                        }
                    @endphp
                    <h2>Conteúdo do Documento:</h2>
                    <pre>{{ $content }}</pre>

                </div>

            </div>
        </div>
    </div>

@endsection
