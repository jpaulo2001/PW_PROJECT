@extends('layouts.simple')
@section('main-content')

    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf

        Nome: <input type="text" name="name" id="" class="form-control" value="{{ old('name', $user->name) }}"><br>
        @error('name') <span class="text-danger">{{ $message }}</span><br>@enderror

        Email: <input type="text" name="email" id="" class="form-control" value="{{ old('email', $user->email) }}"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror

        Departament: <input type="text" name="department_id" id="" class="form-control" value="{{ old('department_id', $user->department_id) }}"><br>
        @error('department_id') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>

@endsection
