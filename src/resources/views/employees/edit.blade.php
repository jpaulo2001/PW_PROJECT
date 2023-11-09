@extends('layouts.simple')

@section('main-content')

    <form action="{{ route('employees.update', ['employee' => $employee]) }}" method="post">
        @method('PUT')
        @csrf

        Nome: <input type="text" name="nome" id="" class="form-control" value="{{ old('nome', $employee->name) }}"><br>
        @error('nome') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
