@extends('layouts.naoautenticado')

@section('main-content')

    <h1>Ficha do documento</h1>

    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    Dados Gerais
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <p><strong>ID do Documento:</strong> {{ $document->id }}</p>
                    <p><strong>Caminho do Documento:</strong> {{ $document->path }}</p>

                    @php
                        $documentData = \DB::table('document_mdatas')
                            ->join('mdatas', 'document_mdatas.mdata_id', '=', 'mdatas.id')
                            ->select('mdatas.*')
                            ->where('document_mdatas.document_id', $document->id)
                            ->first();
                    @endphp

                    @if ($documentData)
                        <p><strong>Nome do Documento:</strong> {{ $documentData->doc_name }}</p>
                        <p><strong>Tipo:</strong> {{ $documentData->type }}</p>
                        <p><strong>Formato:</strong> {{ $documentData->format }}</p>
                        <p><strong>Tamanho:</strong> {{ $documentData->size }}</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
