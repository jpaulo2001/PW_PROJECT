@extends('layouts.simple')
@section('main-content')

    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf

        Nome: <input type="text" name="nome" id="" class="form-control" value="{{ old('nome', $user->name) }}"><br>
        @error('nome') <span class="text-danger">{{ $message }}</span><br>@enderror

        Departament: <input type="text" name="departamento" id="" class="form-control" value="{{ old('department_id', $user->department_id) }}"><br>
        @error('department_id') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
