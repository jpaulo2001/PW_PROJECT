@extends('layouts.autenticado')
@section('main-content')

    <form action="{{ route('documents.store') }}" method="post">
        @csrf

        <b>Nome documento:</b> <input type="text" name="name" id="" class="form-control"><br>
        @error('name') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Tipo documento:</b> <input type="text" name="document" id="" class="form-control"><br>
        @error('tipo documento') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Path:</b> <input type="text" name="document" id="" class="form-control"><br>
        @error('Path') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Escolher departamento: </b> <br>
        <select name="department_id" id="" class="form-control">
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select><br>
        <b>Permissões do departamento:</b><br>
        <select name="type" id="" class="form-control">
{{--            @foreach ($user_type_permitions as $type)--}}
{{--                <option value="{{ $type->id }}" {{ old('department_id', $user->department_id) == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>--}}
{{--            @endforeach--}}
        </select>

        <br><button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>


    </form>


@endsection
