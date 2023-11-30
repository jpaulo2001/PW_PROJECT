@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('users.create', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf
            <div class="form-group">
                Nome: <input type="text" name="nome" id="" class="form-control" placeholder="Introduza o nome"
                             value="{{ old('nome', $user->name) }}"><br>
                Email: <input type="text" name="email" id="" class="form-control" placeholder="Introuza o email"
                              value="{{ old('nome', $user->name) }}"><br>
                Password: <input type="password" name="password" id="" class="form-control" placeholder="Introuza a password"
                              value="{{ old('nome', $user->name) }}"><br>
            </div>
        @error('nome') <span class="text-danger">{{ $message }}</span><br>@enderror
        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
