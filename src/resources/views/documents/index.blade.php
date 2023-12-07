@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <a href="{{ route('documents.create') }}" class="btn btn-success btn-sm mb-3">Criar</a>
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

                                <a href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                   class="btn btn-warning btn-outline-sm">Modificar</a>

                                @can('delete', $document)
                                    <form action="{{ route('documents.destroy', ['document' => $document->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-outline-danger">Eliminar</button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $documents->links() }}
            </div>
        </div>
    </div>
@endsection
