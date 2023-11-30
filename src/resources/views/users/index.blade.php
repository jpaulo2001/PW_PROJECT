@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                @can('create', App\Models\User::class) // está assim porque não conseguia o user e foi maneira de trabalhar...ver mais a frente
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm mb-3">Criar</a>
                @endcan

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="text-end">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-end">
                                <a href="{{ route('users.show', ['user' => $user]) }}" class="btn btn-primary btn-sm">Ver</a>
                                @can('create', App\Models\User::class)
                                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-warning btn-sm">Modificar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
