@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <b>Nome documento:</b> <input type="text" name="doc_name" id="" class="form-control"><br>
        @error('doc_name') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Tipo de Documento:</b> <input type="text" name="type" id="" class="form-control"><br>
        @error('type') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Autor:</b> <input type="text" name="author" id="" class="form-control"><br>
        @error('author') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Proprietario:</b> <input type="text" name="proprietary" id="" class="form-control"><br>
        @error('proprietary') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Escolher departamento:</b> <br>
        @foreach ($departments as $department)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="selected_departments[]" value="{{ $department->id }}">
                <label class="form-check-label">{{ $department->name }}</label>
            </div>

            <b>Permissões do departamento:</b> <br>
            @foreach ($permitions as $permition)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="selected_permissions[]" value="{{ $permition->id }}">
                    <label class="form-check-label">{{ $permition->types }}</label>
                </div>
            @endforeach
            @error('permition') <span class="text-danger">{{ $message }}</span><br>@enderror
        @endforeach
        @error('selected_departments') <span class="text-danger">{{ $message }}</span><br>@enderror



        <b>Escolher ficheiro:</b><br>
        <input type="file" name="file" class="form-control"><br>

        <input type="submit" value="Guardar Modificações" class="btn btn-primary">

    </form>

@endsection
