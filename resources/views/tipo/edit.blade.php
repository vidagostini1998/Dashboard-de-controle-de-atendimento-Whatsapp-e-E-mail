@extends('home')

@section('main')
<div class="container">
<form action="{{route('email.editar.tipo',$tipo->id)}}" method="post" class="row g-2 shadow p-3">
    @csrf
    <div class="col-md-8">
        <div class="form-floating">
            <input type="text" name="nome" id="nome" class="form-control" value="{{$tipo->nome}}">
            <label for="nome">Nome do Tipo</label>
        </div>
    </div>
    <div class="col ms-4 mt-2">
        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right"
        data-bs-title="Salvar"><i class="fa-regular fa-floppy-disk fa-2x"></i></button>
        <a href="{{route('email')}}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right"
        data-bs-title="Voltar"><i class="fa-solid fa-arrow-left fa-2x"></i></a>
    </div>
</form>
</div>
    
@endsection