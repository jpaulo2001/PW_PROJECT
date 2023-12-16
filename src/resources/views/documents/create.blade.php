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

        <b>Escolher departamento: </b> <br>
        <select name="department_id" id="" class="form-control">
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select><br>

        <b>Permissões do departamento:</b> <input type="text" name="document_permition_id" id="" class="form-control"><br>
        @error('document_permition_id') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Escolher ficheiro:</b><br>
        <input type="file" name="file" class="form-control"><br>

        <input type="submit" value="Guardar Modificações" class="btn btn-primary">

    </form>

@endsection
