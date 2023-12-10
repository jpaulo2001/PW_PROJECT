@extends('layouts.autenticado')
@section('main-content')

    <form action="{{ route('documents.store') }}" method="post">
        @csrf


        <b>Nome documento:</b> <input type="text" name="doc_name" id="" class="form-control"><br>
        @error('doc_name') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Size:</b> <input type="text" name="size" id="" class="form-control"><br>
        @error('size') <span class="text-danger">{{ $message }}</span><br>@enderror

        <b>Type:</b> <input type="text" name="type" id="" class="form-control"><br>
        @error('type') <span class="text-danger">{{ $message }}</span><br>@enderror


        <b>Format:</b> <input type="text" name="format" id="" class="form-control"><br>
        @error('format') <span class="text-danger">{{ $message }}</span><br>@enderror

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




        {{--@endforeach--}}

        </select>
        <?php
         echo Form::open(array('url' => '/uploadfile','files'=>'true'));
         echo Form::file('image');
         echo "</br>";  
         echo Form::submit('Guardar Modificações');
         echo Form::close();
        ?>
    </form>





@endsection
