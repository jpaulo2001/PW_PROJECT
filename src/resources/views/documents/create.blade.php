@extends('layouts.autenticado')
@section('main-content')

    <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <b>Nome documento:</b> <input type="text" name="doc_name" id="" class="form-control"><br>
        @error('doc_name') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Type:</b> <input type="text" name="type" id="" class="form-control"><br>
        @error('type') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Content:</b> <input type="text" name="content" id="" class="form-control"><br>
        @error('content') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Valor:</b> <input type="text" name="value" id="" class="form-control"><br>
        @error('value') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Tipo documento:</b> <input type="text" name="document" id="" class="form-control"><br>
        @error('tipo documento') <span class="text-danger">{{ $message }}</span><br>@enderror

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
