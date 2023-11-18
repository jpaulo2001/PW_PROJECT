@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>UserID</th>
                        <th class="text-end">Acções</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->users_id }}</td>
                            <td class="text-end">
                                <a href="{{ route('documents.show', ['document' => $document->id]) }}"
                                    class="btn btn-primary btn-outline">Ver</a>


                                <a href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                   class="btn btn-warning btn-outline-sm">Modificar</a>
                                <a href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                   class="btn btn-delete btn-outline-danger">Eliminar</a>
{{--                                @endcan--}}
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
