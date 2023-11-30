@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('users.create', ['user' => $user]) }}" method="post">
        @method('POST')
        @csrf

        Nome: <input type="text" name="nome" id="" class="form-control" value="{{ old('nome', $user->name) }}"><br>
        @error('nome') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
