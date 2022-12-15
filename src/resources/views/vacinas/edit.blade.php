@extends('vacinas.layout')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">
        <strong>Editar vacina</strong>
    </div> 
    <div class="card-body">
        <form action="{{ url('vacina/' . $vacina->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{$vacina->id}}">
            <label>Nome</label></br>
            <input type="text" name="nome" id="nome" value="{{$vacina->nome}}" class="form-control"></br>
            <label>Lote</label></br>
            <input type="number" name="lote" id="lote" value="{{$vacina->lote}}" class="form-control"></br>
            <label>Validade</label></br>
            <input type="date" name="dataValidade" id="dataValidade" value="{{$vacina->dataValidade}}" class="form-control"></br>
            <input type="submit" value="Atualizar" class="btn btn-success">
            <button onclick="window.location.href= '{{ url('/vacina') }}'" class="btn btn-danger" style="float: right;">Cancelar</button>
        </form>
        @if ($errors->any())
            <div class="max-width mt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
@stop