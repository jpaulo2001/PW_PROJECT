@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('users.create', ['user' => $user]) }}" method="post">
        @method('POST')
        @csrf

        Nome: <input type="text" name="nome" id="" class="form-control"><br>
        @error('nome') <span class="text-danger">{{ $message }}</span><br>@enderror

        Email: <input type="text" name="email" id="" class="form-control"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror

        Password: <input type="text" name="password" id="" class="form-control"><br>
        @error('password') <span class="text-danger">{{ $message }}</span><br>@enderror

        Departamento: <input type="text" name="departamento" id="" class="form-control"><br>
        @error('departamento') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
