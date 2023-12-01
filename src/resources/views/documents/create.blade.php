@extends('layouts.autenticado')
@section('main-content')

    <form action="{{ route('documents.store') }}" method="post">
        @csrf

        Nome documento: <input type="text" name="name" id="" class="form-control"><br>
        @error('name') <span class="text-danger">{{ $message }}</span><br>@enderror

        Tipo documento: <input type="text" name="document" id="" class="form-control"><br>
        @error('tipo documento') <span class="text-danger">{{ $message }}</span><br>@enderror

        Permissões do documento: <br>

        <input class="form-check-input-inline" type="radio" name="flexRadioDefault">
            <label class="form-check-inline" for="flexRadioDefault1">
                Editar
            </label><br>
        <input class="form-check-input-inline" type="radio" name="flexRadioDefault">
            <label class="form-check-inline" for="flexRadioDefault2">
                Ver
            </label><br>
        <input class="form-check-input-inline" type="radio" name="flexRadioDefault">
            <label class="form-check-inline" for="flexRadioDefault2">
                Remover
            </label>
        @error('name') <span class="text-danger">{{ $message }}</span><br>@enderror<br>

        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>


    </form>


@endsection
