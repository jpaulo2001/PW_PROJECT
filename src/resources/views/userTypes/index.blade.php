@extends('layouts.autenticado')

@section('main-content')

    <h1>Permissões</h1>

    @foreach($userTypes as $userType)
        <div>
            <p>ID: {{ $userTypes->id }}</p>
            <p>Nome: {{ $userTypes->type}}</p>
        </div>
    @endforeach

@endsection
