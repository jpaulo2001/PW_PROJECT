@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <a href="{{ route('documents.create') }}" class="btn btn-success btn-sm mb-3">Criar</a>
                <a href="#" class="btn btn-success btn-sm mb-3">Links</a>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Documents ID</th>
                        <th>Documento Nome</th>
                        <th>Tipo Documento</th>
                        <th>Formato Documento</th>
                        <th class="text-right">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        @can('view', $document)
                            <tr>
                                <td>{{ $document->id }}</td>
                                <td>
                                    @if ($documentData = \DB::table('document_mdatas')
                                            ->join('mdatas', 'document_mdatas.mdata_id', '=', 'mdatas.id')
                                            ->select('mdatas.doc_name')
                                            ->where('document_mdatas.document_id', $document->id)
                                            ->first())
                                        {{ $documentData->doc_name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($documentData = \DB::table('document_mdatas')
                                        ->join('mdatas', 'document_mdatas.mdata_id', '=', 'mdatas.id')
                                        ->select('mdatas.type')
                                        ->where('document_mdatas.document_id', $document->id)
                                        ->first())
                                        {{ $documentData->type }}
                                    @endif
                                </td>
                                <td>
                                    @if ($documentData = \DB::table('document_mdatas')
                                        ->join('mdatas', 'document_mdatas.mdata_id', '=', 'mdatas.id')
                                        ->select('mdatas.format')
                                        ->where('document_mdatas.document_id', $document->id)
                                        ->first())
                                        {{ $documentData->format }}
                                    @endif
                                </td>
                                <td class="text-right">

                                    @can('view', $document)
                                        <a href="{{ route('documents.show', ['document' => $document->id]) }}"
                                           class="btn btn-primary btn-outline">Ver</a>
                                    @endcan
                                    @can('update', $document)
                                        <a href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                           class="btn btn-warning btn-outline-sm">Modificar</a>
                                    @endcan
                                    @can('delete', $document)
                                        <form action="{{ route('documents.destroy', ['document' => $document->id]) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-outline-danger">Eliminar
                                            </button>
                                        </form>
                                    @endcan
                                    @can('download', $document)
                                        <a href="{{ route('documents.download', ['document' => $document->id]) }}"
                                           class="btn btn-outline-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                    </tbody>
                </table>
                {{ $documents->links() }}
            </div>
        </div>
    </div>
@endsection
