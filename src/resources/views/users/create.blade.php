@extends('layouts.autenticado')
@section('main-content')

    <form action="{{ route('users.store') }}" method="post">
        @csrf

        Nome: <input type="text" name="name" id="" class="form-control"><br>
        @error('name') <span class="text-danger">{{ $message }}</span><br>@enderror

        Email: <input type="text" name="email" id="" class="form-control"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror

        Password: <input type="text" name="password" id="" class="form-control"><br>
        @error('password') <span class="text-danger">{{ $message }}</span><br>@enderror

        Departamento: <input type="text" name="department_id" id="" class="form-control"><br>
        @error('department_id') <span class="text-danger">{{ $message }}</span><br>@enderror

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
    </form>


@endsection
